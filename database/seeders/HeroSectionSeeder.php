<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use Illuminate\Database\Seeder;

class HeroSectionSeeder extends Seeder
{
    public function run(): void
    {
        HeroSection::create([
            'badge_text' => 'Platform Donasi Terpercaya',
            'title_first' => 'Bersama Wujudkan',
            'title_highlight' => 'Energi Bahagia',
            'title_last' => 'untuk Semua',
            'description' => 'Mari berbagi kebaikan dan menciptakan kebahagiaan melalui program donasi yang terpercaya.',
            'button_primary_text' => 'Mulai Donasi',
            'button_primary_link' => '/program',
            'button_secondary_text' => 'Pelajari',
            'button_secondary_link' => '/profile',
            'hero_image' => null,
            'is_active' => true,
        ]);
    }
}
