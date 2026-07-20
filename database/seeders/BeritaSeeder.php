<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        Berita::create([
            'judul' => 'Penyaluran Bantuan Pendidikan untuk 100 Pelajar di Jakarta',
            'slug' => 'penyaluran-bantuan-pendidikan',
            'deskripsi_singkat' => 'Yayasan Energi Bahagia Indonesia kembali menyalurkan bantuan pendidikan berupa beasiswa dan perlengkapan sekolah kepada 100 pelajar kurang mampu.',
            'konten' => 'Yayasan Energi Bahagia Indonesia kembali menyalurkan bantuan pendidikan berupa beasiswa dan perlengkapan sekolah kepada 100 pelajar kurang mampu di wilayah Jakarta Selatan. Program ini merupakan bagian dari komitmen kami untuk meningkatkan akses pendidikan bagi anak-anak Indonesia.',
            'penulis' => 'Admin',
            'tanggal_publish' => now(),
            'kategori' => 'Pendidikan',
            'status' => 'publish',
            'views' => 0,
        ]);
    }
}
