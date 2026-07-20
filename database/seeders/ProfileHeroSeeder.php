<?php

namespace Database\Seeders;

use App\Models\ProfileHero;
use Illuminate\Database\Seeder;

class ProfileHeroSeeder extends Seeder
{
    public function run(): void
    {
        ProfileHero::create([
            'badge_text' => 'Tentang Kami',
            'title_first' => 'Tentang',
            'title_highlight' => 'Energi Bahagia',
            'description' => 'Lembaga sosial yang berdedikasi untuk menebar kebaikan dan energi positif kepada mereka yang membutuhkan, dengan transparansi dan dampak berkelanjutan.',
            'button_primary_text' => 'Jelajahi Profil',
            'button_primary_link' => '#sejarah',
            'button_secondary_text' => 'Hubungi Kami',
            'button_secondary_link' => '/kontak',
            'is_active' => true,
        ]);
    }
}
