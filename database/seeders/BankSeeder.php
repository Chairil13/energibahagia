<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    public function run(): void
    {
        $banks = [
            [
                'nama_bank' => 'Bank Negara Indonesia (BNI)',
                'kode' => 'BNI',
                'nomor_rekening' => '1234567890',
                'atas_nama' => 'Yayasan Energi Bahagia',
                'icon' => 'fa-university',
                'warna' => '#183D57',
                'urutan' => 1,
                'is_active' => true,
            ],
            [
                'nama_bank' => 'Bank Central Asia (BCA)',
                'kode' => 'BCA',
                'nomor_rekening' => '1234567891',
                'atas_nama' => 'Yayasan Energi Bahagia',
                'icon' => 'fa-university',
                'warna' => '#0055A4',
                'urutan' => 2,
                'is_active' => true,
            ],
            [
                'nama_bank' => 'Bank Mandiri',
                'kode' => 'MANDIRI',
                'nomor_rekening' => '1234567892',
                'atas_nama' => 'Yayasan Energi Bahagia',
                'icon' => 'fa-university',
                'warna' => '#FF8C00',
                'urutan' => 3,
                'is_active' => true,
            ],
            [
                'nama_bank' => 'Bank Syariah Indonesia (BSI)',
                'kode' => 'BSI',
                'nomor_rekening' => '1234567893',
                'atas_nama' => 'Yayasan Energi Bahagia',
                'icon' => 'fa-university',
                'warna' => '#2E7D32',
                'urutan' => 4,
                'is_active' => true,
            ],
            [
                'nama_bank' => 'Bank Muamalat',
                'kode' => 'MUAMALAT',
                'nomor_rekening' => '1234567894',
                'atas_nama' => 'Yayasan Energi Bahagia',
                'icon' => 'fa-university',
                'warna' => '#4CAF50',
                'urutan' => 5,
                'is_active' => true,
            ],
            [
                'nama_bank' => 'Bank Rakyat Indonesia (BRI)',
                'kode' => 'BRI',
                'nomor_rekening' => '1234567895',
                'atas_nama' => 'Yayasan Energi Bahagia',
                'icon' => 'fa-university',
                'warna' => '#2196F3',
                'urutan' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($banks as $bank) {
            Bank::create($bank);
        }
    }
}
