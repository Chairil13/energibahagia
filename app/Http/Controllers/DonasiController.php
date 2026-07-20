<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Donasi;
use App\Models\DonationSetting;
use App\Models\ProgramDonasi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DonasiController extends Controller
{
    // ========== HALAMAN KONFIRMASI DONASI (POST) ==========
    public function confirm(Request $request, $program_id)
    {
        $validated = $request->validate([
            'nominal_value' => 'required|integer|min:10000',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'pesan' => 'nullable|string',
            'payment' => 'required|exists:banks,kode',
        ], [
            'nominal_value.required' => 'Nominal donasi wajib dipilih atau diisi.',
            'nominal_value.min' => 'Nominal donasi minimal Rp 10.000.',
            'nama.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'payment.required' => 'Metode pembayaran wajib dipilih.',
            'payment.exists' => 'Metode pembayaran tidak valid.',
        ]);

        $program = ProgramDonasi::findOrFail($program_id);
        $bank = Bank::where('kode', $validated['payment'])->firstOrFail();
        $nominal = (int) $validated['nominal_value'];

        $data = [
            'program' => $program,
            'bank' => $bank,
            'nominal' => $nominal,
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'alamat' => $validated['alamat'] ?? null,
            'pesan' => $validated['pesan'] ?? null,
        ];

        return view('home.donation-confirm', $data);
    }

    // ========== PROSES SIMPAN DONASI ==========
    public function store(Request $request)
    {
        $request->validate([
            'program_id' => 'required|exists:program_donasis,id',
            'bank_id' => 'required|exists:banks,id',
            'nominal' => 'required|numeric|min:10000',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'pesan' => 'nullable|string',
        ]);

        try {
            $kodeUnik = 'DON-'.strtoupper(Str::random(8)).'-'.time();
            $expiresAt = now()->addMinutes(DonationSetting::current()->transfer_expiration_minutes);

            $donasi = Donasi::create([
                'user_id' => Auth::id(),
                'program_id' => $request->program_id,
                'bank_id' => $request->bank_id,
                'nama' => $request->nama,
                'email' => $request->email,
                'phone' => $request->phone,
                'pesan' => $request->pesan,
                'nominal' => $request->nominal,
                'kode_unik' => $kodeUnik,
                'status' => 'pending',
                'expires_at' => $expiresAt,
            ]);

            return redirect()->route('donasi.payment', $donasi->kode_unik);
        } catch (\Exception $e) {
            Log::error('Donasi store error: '.$e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    // ========== HALAMAN PEMBAYARAN ==========
    public function payment($kode_unik)
    {
        $donasi = Donasi::with(['program', 'bank'])->where('kode_unik', $kode_unik)->firstOrFail();

        if ($donasi->isExpired() && $donasi->status == 'pending') {
            $donasi->status = 'expired';
            $donasi->save();
        }

        return view('home.donation-payment', compact('donasi'));
    }

    // ========== UPLOAD BUKTI TRANSFER ==========
    public function uploadBukti(Request $request, $kode_unik)
    {
        try {
            $donasi = Donasi::where('kode_unik', $kode_unik)->firstOrFail();

            if ($donasi->isExpired()) {
                $donasi->status = 'expired';
                $donasi->save();

                return redirect()->route('donasi.payment', $kode_unik)->with('error', 'Donasi sudah kadaluarsa!');
            }

            $request->validate([
                'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            if ($request->hasFile('bukti_transfer')) {
                $file = $request->file('bukti_transfer');
                $fileName = time().'_'.$donasi->kode_unik.'.'.$file->getClientOriginalExtension();
                $uploadPath = public_path('uploads/bukti');
                if (! file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                $file->move($uploadPath, $fileName);
                $donasi->bukti_transfer = $fileName;
                $donasi->save();
            }

            return redirect()->route('donasi.waiting', $kode_unik)->with('success', 'Bukti transfer berhasil diupload!');
        } catch (\Exception $e) {
            Log::error('Upload bukti error: '.$e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    // ========== HALAMAN MENUNGGU KONFIRMASI ==========
    public function waiting($kode_unik)
    {
        $donasi = Donasi::where('kode_unik', $kode_unik)->firstOrFail();

        return view('home.donation-waiting', compact('donasi'));
    }

    // ========== GENERATE INVOICE PDF (KWITANSI) ==========
    public function generateInvoice($id)
    {
        $donasi = Donasi::with(['program', 'bank'])->findOrFail($id);

        if ($donasi->status != 'confirmed') {
            return redirect()->back()->with('error', 'Kwitansi hanya tersedia untuk donasi yang sudah terkonfirmasi.');
        }

        $data = [
            'donasi' => $donasi,
            'tanggal' => $donasi->created_at->format('d F Y'),
            'nomor_invoice' => 'INV-'.$donasi->kode_unik.'-'.$donasi->id,
        ];

        $pdf = Pdf::loadView('pdf.donation-invoice', $data);

        return $pdf->download('kwitansi-donasi-'.$donasi->kode_unik.'.pdf');
    }

    // ========== EXPORT EXCEL DONASI TERKONFIRMASI ==========
    public function exportExcelConfirmed(Request $request)
    {
        $query = Donasi::with(['program', 'bank', 'confirmedBy'])
            ->where('status', 'confirmed');

        if ($request->program) {
            $query->where('program_id', $request->program);
        }

        $donasis = $query->orderBy('confirmed_at', 'desc')->get();
        $programName = $request->program ? ProgramDonasi::find($request->program)->judul : 'Semua Program';

        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();

        // SET UKURAN KOLOM
        $columnWidths = [
            'A' => 4,   // No
            'B' => 14,  // Kode Unik
            'C' => 20,  // Nama Donatur
            'D' => 25,  // Program
            'E' => 14,  // Nominal
            'F' => 14,  // Bank
            'G' => 16,  // No. Rekening
            'H' => 14,  // Atas Nama
            'I' => 16,  // Waktu Donasi
            'J' => 16,  // Dikonfirmasi
            'K' => 16,  // Admin
            'L' => 25,  // Pesan
            'M' => 25,  // Catatan Admin
        ];

        foreach ($columnWidths as $col => $width) {
            $sheet->getColumnDimension($col)->setWidth($width);
        }

        // HEADER
        $headers = [
            'A1' => 'No',
            'B1' => 'Kode Unik',
            'C1' => 'Nama Donatur',
            'D1' => 'Program Donasi',
            'E1' => 'Nominal',
            'F1' => 'Bank',
            'G1' => 'No. Rekening',
            'H1' => 'Atas Nama',
            'I1' => 'Waktu Donasi',
            'J1' => 'Dikonfirmasi',
            'K1' => 'Admin',
            'L1' => 'Pesan',
            'M1' => 'Catatan Admin',
        ];

        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }

        // STYLE HEADER
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => '183D57'],
                'size' => 10,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '8AD337'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '183D57'],
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ];

        $sheet->getStyle('A1:M1')->applyFromArray($headerStyle);

        // DATA
        $row = 2;
        foreach ($donasis as $index => $donasi) {
            $sheet->setCellValue('A'.$row, $index + 1);
            $sheet->setCellValue('B'.$row, $donasi->kode_unik);
            $sheet->setCellValue('C'.$row, $donasi->nama);
            $sheet->setCellValue('D'.$row, $donasi->program ? $donasi->program->judul : '-');
            $sheet->setCellValue('E'.$row, $donasi->nominal);
            $sheet->setCellValue('F'.$row, $donasi->bank ? $donasi->bank->nama_bank : '-');
            $sheet->setCellValue('G'.$row, $donasi->bank ? $donasi->bank->nomor_rekening : '-');
            $sheet->setCellValue('H'.$row, $donasi->bank ? $donasi->bank->atas_nama : '-');
            $sheet->setCellValue('I'.$row, $donasi->created_at->format('d/m/Y H:i'));
            $sheet->setCellValue('J'.$row, $donasi->confirmed_at ? $donasi->confirmed_at->format('d/m/Y H:i') : '-');
            $sheet->setCellValue('K'.$row, $donasi->confirmedBy ? $donasi->confirmedBy->name : '-');
            $sheet->setCellValue('L'.$row, $donasi->pesan ?? '-');
            $sheet->setCellValue('M'.$row, $donasi->admin_note ?? '-');

            $sheet->getStyle('E'.$row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('A'.$row.':M'.$row)->getFont()->setSize(9);

            if ($row % 2 == 0) {
                $sheet->getStyle('A'.$row.':M'.$row)->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('F8FAF8');
            }

            $row++;
        }

        // TOTAL
        if ($donasis->count() > 0) {
            $totalRow = $row;
            $sheet->setCellValue('A'.$totalRow, '');
            $sheet->setCellValue('B'.$totalRow, '');
            $sheet->setCellValue('C'.$totalRow, '');
            $sheet->setCellValue('D'.$totalRow, 'TOTAL');
            $sheet->setCellValue('E'.$totalRow, $donasis->sum('nominal'));
            $sheet->getStyle('E'.$totalRow)->getNumberFormat()->setFormatCode('#,##0');

            $totalStyle = [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                    'size' => 10,
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '183D57'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_RIGHT,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ];
            $sheet->getStyle('A'.$totalRow.':E'.$totalRow)->applyFromArray($totalStyle);
            $sheet->getStyle('F'.$totalRow.':M'.$totalRow)->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()->setRGB('183D57');
        }

        // INFO
        $infoRow = $row + 2;
        $sheet->setCellValue('A'.$infoRow, 'Program: '.$programName);
        $sheet->setCellValue('A'.($infoRow + 1), 'Total Donatur: '.number_format($donasis->count()).' orang');
        $sheet->setCellValue('A'.($infoRow + 2), 'Dicetak pada: '.now()->format('d/m/Y H:i'));
        $sheet->getStyle('A'.$infoRow.':A'.($infoRow + 2))->getFont()->setSize(9)->setItalic(true);

        // OUTPUT
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Donasi_Terkonfirmasi_'.date('Ymd_His').'.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$fileName.'"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }

    // ========== EXPORT PDF DONASI TERKONFIRMASI ==========
    public function exportPdfConfirmed(Request $request)
    {
        $query = Donasi::with(['program', 'bank', 'confirmedBy'])
            ->where('status', 'confirmed');

        if ($request->program) {
            $query->where('program_id', $request->program);
        }

        $donasis = $query->orderBy('confirmed_at', 'desc')->get();
        $programName = $request->program ? ProgramDonasi::find($request->program)->judul : 'Semua Program';
        $totalNominal = $donasis->sum('nominal');

        $data = [
            'donasis' => $donasis,
            'programName' => $programName,
            'totalNominal' => $totalNominal,
            'totalDonatur' => $donasis->count(),
            'tanggal_cetak' => now()->format('d F Y H:i'),
        ];

        $pdf = Pdf::loadView('pdf.donasi-terkonfirmasi', $data);
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('Donasi_Terkonfirmasi_'.date('Ymd_His').'.pdf');
    }
}
