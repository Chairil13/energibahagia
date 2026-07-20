<?php

namespace Database\Seeders;

use App\Models\VisiMisi;
use Illuminate\Database\Seeder;

class VisiMisiSeeder extends Seeder
{
    public function run(): void
    {
        VisiMisi::create([
            'badge_text' => 'ARAH & TUJUAN',
            'title' => 'Visi & Misi',
            'visi' => 'Menjadi Lembaga terpercaya dan profesional dalam mengelola dana sosial masyarakat melalui program pemberdayaan berkelanjutan',
            'misi' => [
                'Berperan Aktif dalam upaya pengentasan kemiskinan dan kemandirian masyarakat',
                'Aksi nyata dalam kegiatan penanggulangan kebencanaan',
                'Ikut Serta dalam meningkatkan kualitas Pendidikan, Kesehatan dan lingkungan',
                'Kolaborasi aktif dengan berbagai elemen masyarakat',
            ],
            'is_active' => true,
        ]);
    }
}
