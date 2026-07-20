<?php

namespace App\Exports;

use App\Models\Donasi;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;

class DonasiConfirmedExport implements FromQuery, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $programId;

    public function __construct($programId = null)
    {
        $this->programId = $programId;
    }

    public function query()
    {
        $query = Donasi::with(['program', 'bank', 'confirmedBy'])
            ->where('status', 'confirmed');

        if ($this->programId) {
            $query->where('program_id', $this->programId);
        }

        return $query->orderBy('confirmed_at', 'desc');
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode Unik',
            'Nama Donatur',
            'Email',
            'Telepon',
            'Program Donasi',
            'Nominal',
            'Bank',
            'No. Rekening',
            'Atas Nama',
            'Waktu Donasi',
            'Dikonfirmasi',
            'Admin',
            'Pesan',
            'Catatan Admin'
        ];
    }

    public function map($donasi): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $donasi->kode_unik,
            $donasi->nama,
            $donasi->email,
            $donasi->phone,
            $donasi->program ? $donasi->program->judul : '-',
            $donasi->nominal,
            $donasi->bank ? $donasi->bank->nama_bank : '-',
            $donasi->bank ? $donasi->bank->nomor_rekening : '-',
            $donasi->bank ? $donasi->bank->atas_nama : '-',
            $donasi->created_at->format('d/m/Y H:i'),
            $donasi->confirmed_at ? $donasi->confirmed_at->format('d/m/Y H:i') : '-',
            $donasi->confirmedBy ? $donasi->confirmedBy->name : '-',
            $donasi->pesan ?? '-',
            $donasi->admin_note ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Style header
        $sheet->getStyle('A1:O1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => '183D57'],
                'size' => 10
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '8AD337']
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '183D57']
                ]
            ]
        ]);

        // Set kolom lebih kecil
        $sheet->getColumnDimension('A')->setWidth(4);   // No
        $sheet->getColumnDimension('B')->setWidth(14);  // Kode Unik
        $sheet->getColumnDimension('C')->setWidth(20);  // Nama
        $sheet->getColumnDimension('D')->setWidth(25);  // Email
        $sheet->getColumnDimension('E')->setWidth(14);  // Telepon
        $sheet->getColumnDimension('F')->setWidth(25);  // Program
        $sheet->getColumnDimension('G')->setWidth(14);  // Nominal
        $sheet->getColumnDimension('H')->setWidth(14);  // Bank
        $sheet->getColumnDimension('I')->setWidth(16);  // No Rekening
        $sheet->getColumnDimension('J')->setWidth(14);  // Atas Nama
        $sheet->getColumnDimension('K')->setWidth(16);  // Waktu
        $sheet->getColumnDimension('L')->setWidth(16);  // Dikonfirmasi
        $sheet->getColumnDimension('M')->setWidth(16);  // Admin
        $sheet->getColumnDimension('N')->setWidth(25);  // Pesan
        $sheet->getColumnDimension('O')->setWidth(25);  // Catatan

        // Style data
        $sheet->getStyle('A2:O' . ($sheet->getHighestRow()))->getFont()->setSize(9);

        // Alternating row
        $row = 2;
        while ($row <= $sheet->getHighestRow()) {
            if ($row % 2 == 0) {
                $sheet->getStyle('A' . $row . ':O' . $row)->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('F8FAF8');
            }
            $row++;
        }

        // Total row
        $lastRow = $sheet->getHighestRow() + 1;
        $sheet->setCellValue('A' . $lastRow, '');
        $sheet->setCellValue('B' . $lastRow, '');
        $sheet->setCellValue('C' . $lastRow, '');
        $sheet->setCellValue('D' . $lastRow, '');
        $sheet->setCellValue('E' . $lastRow, '');
        $sheet->setCellValue('F' . $lastRow, 'TOTAL');
        $sheet->setCellValue('G' . $lastRow, '=SUM(G2:G' . ($lastRow - 1) . ')');

        $sheet->getStyle('A' . $lastRow . ':G' . $lastRow)->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 10
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '183D57']
            ]
        ]);
        $sheet->getStyle('H' . $lastRow . ':O' . $lastRow)->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setRGB('183D57');
    }
}
