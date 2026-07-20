<?php

namespace App\Http\Controllers;

use App\Models\ProfileHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProfileHeroController extends Controller
{
    public function index()
    {
        $hero = ProfileHero::first();
        if (!$hero) {
            $hero = ProfileHero::create([
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
        return view('admin.profile-hero', compact('hero'));
    }

    public function update(Request $request, $id)
    {
        try {
            $hero = ProfileHero::findOrFail($id);

            // Validasi
            $request->validate([
                'badge_text' => 'nullable|string|max:255',
                'title_first' => 'nullable|string|max:255',
                'title_highlight' => 'nullable|string|max:255',
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
                $extension = $file->getClientOriginalExtension();
                $imageName = time() . '_' . uniqid() . '.' . $extension;

                $uploadPath = public_path('uploads/profile-hero');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                if ($hero->hero_image && file_exists($uploadPath . '/' . $hero->hero_image)) {
                    unlink($uploadPath . '/' . $hero->hero_image);
                }

                $file->move($uploadPath, $imageName);
                $hero->hero_image = $imageName;
            }

            // Update data
            $hero->badge_text = $request->badge_text;
            $hero->title_first = $request->title_first;
            $hero->title_highlight = $request->title_highlight;
            $hero->description = $request->description;
            $hero->button_primary_text = $request->button_primary_text;
            $hero->button_primary_link = $request->button_primary_link;
            $hero->button_secondary_text = $request->button_secondary_text;
            $hero->button_secondary_link = $request->button_secondary_link;
            $hero->save();

            return redirect()->route('admin.profile-hero')->with('success', 'Profile Hero berhasil diupdate!');
        } catch (\Exception $e) {
            Log::error('Profile Hero update error: ' . $e->getMessage());
            return redirect()->route('admin.profile-hero')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
