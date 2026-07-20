<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HeroSectionController extends Controller
{
    public function index()
    {
        $hero = HeroSection::first();
        if (!$hero) {
            $hero = HeroSection::create([
                'badge_text' => 'Platform Donasi Terpercaya',
                'title_first' => 'Bersama Wujudkan',
                'title_highlight' => 'Energi Bahagia',
                'title_last' => 'untuk Semua',
                'description' => 'Mari berbagi kebaikan dan menciptakan kebahagiaan melalui program donasi yang terpercaya.',
                'button_primary_text' => 'Mulai Donasi',
                'button_primary_link' => '/program',
                'button_secondary_text' => 'Pelajari',
                'button_secondary_link' => '/profile',
                'is_active' => true,
            ]);
        }
        return view('admin.hero', compact('hero'));
    }

    public function update(Request $request, $id)
    {
        try {
            $hero = HeroSection::findOrFail($id);

            // Validasi
            $request->validate([
                'badge_text' => 'nullable|string|max:255',
                'title_first' => 'nullable|string|max:255',
                'title_highlight' => 'nullable|string|max:255',
                'title_last' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'button_primary_text' => 'nullable|string|max:255',
                'button_primary_link' => 'nullable|string|max:255',
                'button_secondary_text' => 'nullable|string|max:255',
                'button_secondary_link' => 'nullable|string|max:255',
                'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            // Handle image upload
            if ($request->hasFile('hero_image')) {
                $file = $request->file('hero_image');

                // Buat nama file unik
                $extension = $file->getClientOriginalExtension();
                $imageName = time() . '_' . uniqid() . '.' . $extension;

                // Tentukan path
                $uploadPath = public_path('uploads/hero');

                // Buat folder jika belum ada
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                // Hapus gambar lama
                if ($hero->hero_image && file_exists($uploadPath . '/' . $hero->hero_image)) {
                    unlink($uploadPath . '/' . $hero->hero_image);
                }

                // Upload gambar
                $file->move($uploadPath, $imageName);

                // Simpan hanya nama file
                $hero->hero_image = $imageName;

                // Debug: log info
                Log::info('Image uploaded: ' . $imageName . ' to ' . $uploadPath);
            }

            // Update data lainnya
            $hero->badge_text = $request->badge_text;
            $hero->title_first = $request->title_first;
            $hero->title_highlight = $request->title_highlight;
            $hero->title_last = $request->title_last;
            $hero->description = $request->description;
            $hero->button_primary_text = $request->button_primary_text;
            $hero->button_primary_link = $request->button_primary_link;
            $hero->button_secondary_text = $request->button_secondary_text;
            $hero->button_secondary_link = $request->button_secondary_link;
            $hero->save();

            return redirect()->route('admin.hero')->with('success', 'Hero section berhasil diupdate!');
        } catch (\Exception $e) {
            Log::error('Hero update error: ' . $e->getMessage());
            return redirect()->route('admin.hero')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
