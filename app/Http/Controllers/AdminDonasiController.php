<?php

namespace App\Http\Controllers;

use App\Mail\DonationCancelledMail;
use App\Models\Bank;
use App\Models\Donasi;
use App\Models\DonationSetting;
use App\Models\ProgramDonasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdminDonasiController extends Controller
{
    // Halaman daftar donasi pending
    public function index()
    {
        $donationSetting = DonationSetting::current();
        $donasis = Donasi::with(['program', 'bank', 'confirmedBy'])
            ->where('status', 'pending')
            ->whereNotNull('bukti_transfer')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.donasi.index', compact('donasis', 'donationSetting'));
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'transfer_expiration_minutes' => 'required|integer|min:1|max:10080',
        ], [
            'transfer_expiration_minutes.required' => 'Batas waktu transfer wajib diisi.',
            'transfer_expiration_minutes.integer' => 'Batas waktu transfer harus berupa angka menit.',
            'transfer_expiration_minutes.min' => 'Batas waktu transfer minimal 1 menit.',
            'transfer_expiration_minutes.max' => 'Batas waktu transfer maksimal 10080 menit atau 7 hari.',
        ]);

        DonationSetting::current()->update($validated);

        return redirect()->route('admin.donasi.index')->with('success', 'Batas waktu transfer berhasil diperbarui!');
    }

    // Halaman daftar donasi sudah dikonfirmasi
    public function confirmed(Request $request)
    {
        $selectedProgramId = $request->get('program');

        $query = Donasi::with(['program', 'bank', 'confirmedBy'])
            ->where('status', 'confirmed')
            ->where('nominal', '>=', 10000);

        if ($selectedProgramId && $selectedProgramId != '') {
            $query->where('program_id', $selectedProgramId);
        }

        $donasis = $query->orderBy('confirmed_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        $statsQuery = Donasi::where('status', 'confirmed')->where('nominal', '>=', 10000);
        if ($selectedProgramId && $selectedProgramId != '') {
            $statsQuery->where('program_id', $selectedProgramId);
        }

        $totalConfirmed = $statsQuery->sum('nominal');
        $totalDonatur = $statsQuery->count();
        $totalProgram = $statsQuery->distinct('program_id')->count('program_id');

        $banks = Bank::where('is_active', true)->orderBy('urutan', 'asc')->get();
        $bankStats = [];

        foreach ($banks as $bank) {
            $bankTotal = Donasi::where('status', 'confirmed')
                ->where('nominal', '>=', 10000)
                ->where('bank_id', $bank->id);

            if ($selectedProgramId && $selectedProgramId != '') {
                $bankTotal->where('program_id', $selectedProgramId);
            }

            $bankStats[$bank->id] = [
                'total' => $bankTotal->sum('nominal'),
                'count' => $bankTotal->count(),
            ];
        }

        $programs = ProgramDonasi::where('status', 'Aktif')->orderBy('judul', 'asc')->get();
        $selectedProgram = $selectedProgramId ? ProgramDonasi::find($selectedProgramId) : null;

        return view('admin.donasi.confirmed', compact(
            'donasis',
            'programs',
            'selectedProgram',
            'selectedProgramId',
            'totalConfirmed',
            'totalDonatur',
            'totalProgram',
            'bankStats',
            'banks'
        ));
    }

    // Halaman donasi ditolak
    public function cancelled()
    {
        $donasis = Donasi::with(['program', 'bank'])
            ->where('status', 'cancelled')
            ->orderBy('updated_at', 'desc')
            ->paginate(15);

        return view('admin.donasi.cancelled', compact('donasis'));
    }

    // Proses konfirmasi donasi
    public function confirm(Request $request, $id)
    {
        try {
            $donasi = Donasi::findOrFail($id);

            if ($donasi->status != 'pending') {
                return redirect()->back()->with('error', 'Donasi sudah dikonfirmasi sebelumnya!');
            }

            if (! $donasi->bukti_transfer) {
                return redirect()->back()->with('error', 'Donasi belum upload bukti transfer, jadi belum bisa dikonfirmasi.');
            }

            $request->validate([
                'admin_note' => 'nullable|string|max:500',
            ]);

            $donasi->status = 'confirmed';
            $donasi->confirmed_at = now();
            $donasi->confirmed_by = Auth::id();
            $donasi->admin_note = $request->admin_note;
            $donasi->save();

            $program = ProgramDonasi::find($donasi->program_id);
            if ($program) {
                $program->dana_terkumpul += $donasi->nominal;
                $program->jumlah_donatur += 1;
                $program->save();
            }

            return redirect()->route('admin.donasi.index')->with('success', 'Donasi berhasil dikonfirmasi!');
        } catch (\Exception $e) {
            Log::error('Konfirmasi donasi error: '.$e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    // TOLAK DONASI - Method ini yang dipanggil
    public function cancel(Request $request, $id)
    {
        try {
            $donasi = Donasi::findOrFail($id);

            // Cek apakah donasi masih pending
            if ($donasi->status != 'pending') {
                return redirect()->back()->with('error', 'Donasi sudah diproses sebelumnya!');
            }

            $validated = $request->validate([
                'cancel_reason' => 'nullable|string|max:500',
            ]);

            // Update status menjadi cancelled
            $donasi->status = 'cancelled';
            $donasi->admin_note = $validated['cancel_reason'] ?? 'Donasi ditolak oleh admin';
            $donasi->save();

            if ($donasi->email) {
                try {
                    Mail::to($donasi->email)->send(new DonationCancelledMail($donasi));
                } catch (\Exception $e) {
                    Log::error('Email penolakan gagal dikirim: '.$e->getMessage());
                }
            }

            return redirect()->route('admin.donasi.index')->with('success', 'Donasi berhasil ditolak!');
        } catch (\Exception $e) {
            Log::error('Tolak donasi error: '.$e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    // Batal konfirmasi (untuk donasi yang sudah di-confirm)
    public function unconfirm($id)
    {
        try {
            $donasi = Donasi::findOrFail($id);

            if ($donasi->status == 'confirmed') {
                $program = ProgramDonasi::find($donasi->program_id);
                if ($program) {
                    $program->dana_terkumpul -= $donasi->nominal;
                    $program->jumlah_donatur -= 1;
                    $program->save();
                }
            }

            $donasi->status = 'pending';
            $donasi->confirmed_at = null;
            $donasi->confirmed_by = null;
            $donasi->save();

            return redirect()->route('admin.donasi.confirmed')->with('success', 'Konfirmasi donasi dibatalkan!');
        } catch (\Exception $e) {
            Log::error('Batal konfirmasi error: '.$e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    // Di AdminDonasiController.php, tambahkan:

    // Kembalikan donasi dari cancelled ke pending
    public function restore(Request $request, $id)
    {
        try {
            $donasi = Donasi::findOrFail($id);

            if ($donasi->status != 'cancelled') {
                return redirect()->back()->with('error', 'Donasi tidak dalam status ditolak!');
            }

            // Kembalikan ke pending
            $donasi->status = 'pending';
            $donasi->admin_note = $request->restore_note ?? 'Donasi dikembalikan ke pending oleh admin';
            $donasi->save();

            return redirect()->route('admin.donasi.cancelled')->with('success', 'Donasi berhasil dikembalikan ke pending!');
        } catch (\Exception $e) {
            Log::error('Restore donasi error: '.$e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    // Tambahkan method show untuk detail
    public function show($id)
    {
        $donasi = Donasi::with(['program', 'bank'])->findOrFail($id);

        return response()->json($donasi);
    }
}
