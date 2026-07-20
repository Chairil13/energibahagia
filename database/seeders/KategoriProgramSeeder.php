<?php

namespace Database\Seeders;

use App\Models\KategoriProgram;
use Illuminate\Database\Seeder;

class KategoriProgramSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            ['nama_kategori' => 'Pendidikan', 'icon' => 'fa-graduation-cap', 'warna' => '#8AD337', 'urutan' => 1, 'deskripsi' => 'Program donasi untuk pendidikan'],
            ['nama_kategori' => 'Kesehatan', 'icon' => 'fa-heartbeat', 'warna' => '#FF6B6B', 'urutan' => 2, 'deskripsi' => 'Program donasi untuk kesehatan'],
            ['nama_kategori' => 'Sosial', 'icon' => 'fa-hand-holding-heart', 'warna' => '#4ECDC4', 'urutan' => 3, 'deskripsi' => 'Program donasi untuk sosial kemasyarakatan'],
            ['nama_kategori' => 'Lingkungan', 'icon' => 'fa-tree', 'warna' => '#45B7D1', 'urutan' => 4, 'deskripsi' => 'Program donasi untuk lingkungan hidup'],
            ['nama_kategori' => 'Ekonomi', 'icon' => 'fa-chart-line', 'warna' => '#F7B731', 'urutan' => 5, 'deskripsi' => 'Program donasi untuk pemberdayaan ekonomi'],
            ['nama_kategori' => 'Kemanusiaan', 'icon' => 'fa-people-arrows', 'warna' => '#E74C3C', 'urutan' => 6, 'deskripsi' => 'Program donasi untuk bantuan kemanusiaan'],
        ];

        foreach ($kategoris as $kategori) {
            KategoriProgram::create($kategori);
        }
    }
}
