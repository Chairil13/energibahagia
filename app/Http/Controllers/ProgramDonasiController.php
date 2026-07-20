<?php

namespace App\Http\Controllers;

use App\Models\KategoriProgram;
use App\Models\ProgramDonasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProgramDonasiController extends Controller
{
    // Index - Tampilkan semua program
    public function index()
    {
        $programs = ProgramDonasi::with('kategori')->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.program.index', compact('programs'));
    }

    // Create - Form tambah program
    public function create()
    {
        $kategoris = KategoriProgram::where('is_active', true)->orderBy('urutan', 'asc')->get();

        return view('admin.program.create', compact('kategoris'));
    }

    // Store - Simpan program baru
    public function store(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi_singkat' => 'required|string',
                'deskripsi_lengkap' => 'required|string',
                'id_kategori' => 'required|exists:kategori_programs,id',
                'target_dana' => 'required|numeric|min:0',
                'penerima' => 'nullable|integer|min:0',
                'tanggal_mulai' => 'nullable|date',
                'tanggal_berakhir' => 'nullable|date|after_or_equal:tanggal_mulai',
                'status' => 'required|in:Aktif,Selesai,Ditutup',
                'is_featured' => 'nullable|boolean',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            $program = new ProgramDonasi;
            $program->judul = $request->judul;
            $program->deskripsi_singkat = $request->deskripsi_singkat;
            $program->deskripsi_lengkap = $request->deskripsi_lengkap;
            $program->id_kategori = $request->id_kategori;
            $program->target_dana = $request->target_dana;
            $program->penerima = $request->penerima ?? 0;
            $program->tanggal_mulai = $request->tanggal_mulai;
            $program->tanggal_berakhir = $request->tanggal_berakhir;
            $program->status = $request->status;
            $program->is_featured = $request->has('is_featured');
            $program->penulis = Auth::user()->name ?? 'Admin';
            $program->dana_terkumpul = 0;
            $program->jumlah_donatur = 0;

            // Upload gambar
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $imageName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
                $uploadPath = public_path('uploads/program');
                if (! file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                $file->move($uploadPath, $imageName);
                $program->gambar = $imageName;
            }

            $program->save();

            return redirect()->route('admin.program.index')->with('success', 'Program donasi berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Program store error: '.$e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    // Edit - Form edit program
    public function edit($id)
    {
        $program = ProgramDonasi::findOrFail($id);
        $kategoris = KategoriProgram::where('is_active', true)->orderBy('urutan', 'asc')->get();

        return view('admin.program.edit', compact('program', 'kategoris'));
    }

    // Update - Update program
    public function update(Request $request, $id)
    {
        try {
            $program = ProgramDonasi::findOrFail($id);

            $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi_singkat' => 'required|string',
                'deskripsi_lengkap' => 'required|string',
                'id_kategori' => 'required|exists:kategori_programs,id',
                'target_dana' => 'required|numeric|min:0',
                'penerima' => 'nullable|integer|min:0',
                'tanggal_mulai' => 'nullable|date',
                'tanggal_berakhir' => 'nullable|date|after_or_equal:tanggal_mulai',
                'status' => 'required|in:Aktif,Selesai,Ditutup',
                'is_featured' => 'nullable|boolean',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            $program->judul = $request->judul;
            $program->deskripsi_singkat = $request->deskripsi_singkat;
            $program->deskripsi_lengkap = $request->deskripsi_lengkap;
            $program->id_kategori = $request->id_kategori;
            $program->target_dana = $request->target_dana;
            $program->penerima = $request->penerima ?? 0;
            $program->tanggal_mulai = $request->tanggal_mulai;
            $program->tanggal_berakhir = $request->tanggal_berakhir;
            $program->status = $request->status;
            $program->is_featured = $request->has('is_featured');

            // Upload gambar baru
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama
                if ($program->gambar && file_exists(public_path('uploads/program/'.$program->gambar))) {
                    unlink(public_path('uploads/program/'.$program->gambar));
                }

                $file = $request->file('gambar');
                $imageName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
                $uploadPath = public_path('uploads/program');
                if (! file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                $file->move($uploadPath, $imageName);
                $program->gambar = $imageName;
            }

            $program->save();

            return redirect()->route('admin.program.index')->with('success', 'Program donasi berhasil diupdate!');
        } catch (\Exception $e) {
            Log::error('Program update error: '.$e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    // Destroy - Hapus program
    public function destroy($id)
    {
        try {
            $program = ProgramDonasi::findOrFail($id);

            // Hapus gambar
            if ($program->gambar && file_exists(public_path('uploads/program/'.$program->gambar))) {
                unlink(public_path('uploads/program/'.$program->gambar));
            }

            $program->delete();

            return redirect()->route('admin.program.index')->with('success', 'Program donasi berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Program delete error: '.$e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    // Public index untuk halaman program donasi
    public function publicIndex(Request $request)
    {
        $query = ProgramDonasi::with('kategori')->where('status', 'Aktif');

        // Filter by kategori
        if ($request->filled('kategori')) {
            $kategori = KategoriProgram::where('slug', $request->kategori)->first();
            if ($kategori) {
                $query->where('id_kategori', $kategori->id);
            }
        }

        // Filter by search
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'ilike', "%{$search}%")
                    ->orWhere('deskripsi_singkat', 'ilike', "%{$search}%");
            });
        }

        $programs = $query->orderBy('created_at', 'desc')->paginate(9)->withQueryString();
        $kategoris = KategoriProgram::where('is_active', true)->orderBy('urutan', 'asc')->get();

        return view('home.programs', compact('programs', 'kategoris'));
    }
}
