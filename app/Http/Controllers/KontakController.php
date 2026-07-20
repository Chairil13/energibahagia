<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KontakController extends Controller
{
    public function index()
    {
        $kontak = Kontak::first();
        if (!$kontak) {
            $kontak = Kontak::create([
                'hero_badge' => 'HUBUNGI KAMI',
                'hero_title_first' => 'Mari',
                'hero_title_highlight' => 'Terhubung Dengan Kami',
                'hero_description' => 'Kami siap mendengar pertanyaan, saran, atau cerita Anda. Silakan hubungi kami melalui berbagai saluran berikut.',
                'office_address' => 'Jl. Kebaikan No. 123, Kelurahan Bahagia, Jakarta Selatan, DKI Jakarta 12345',
                'office_map_link' => '#',
                'phone_kantor' => '+62 21 1234 5678',
                'phone_hotline' => '+62 812 3456 7890',
                'phone_darurat' => '+62 811 2222 3333',
                'email_umum' => 'info@energibahagia.id',
                'email_donasi' => 'donasi@energibahagia.id',
                'email_humas' => 'humas@energibahagia.id',
                'social_facebook' => 'https://facebook.com/energibahagia',
                'social_instagram' => 'https://instagram.com/energi_bahagia',
                'social_twitter' => 'https://twitter.com/energibahagia',
                'social_youtube' => 'https://youtube.com/energibahagia',
                'social_linkedin' => 'https://linkedin.com/company/energibahagia',
                'whatsapp_number' => '6281234567890',
                'is_active' => true,
            ]);
        }
        return view('admin.kontak', compact('kontak'));
    }

    public function update(Request $request, $id)
    {
        try {
            $kontak = Kontak::findOrFail($id);

            $request->validate([
                'hero_badge' => 'nullable|string|max:255',
                'hero_title_first' => 'nullable|string|max:255',
                'hero_title_highlight' => 'nullable|string|max:255',
                'hero_description' => 'nullable|string',
                'office_address' => 'nullable|string',
                'office_map_link' => 'nullable|string|max:255',
                'phone_kantor' => 'nullable|string|max:20',
                'phone_hotline' => 'nullable|string|max:20',
                'phone_darurat' => 'nullable|string|max:20',
                'email_umum' => 'nullable|email|max:255',
                'email_donasi' => 'nullable|email|max:255',
                'email_humas' => 'nullable|email|max:255',
                'social_facebook' => 'nullable|string|max:255',
                'social_instagram' => 'nullable|string|max:255',
                'social_twitter' => 'nullable|string|max:255',
                'social_youtube' => 'nullable|string|max:255',
                'social_linkedin' => 'nullable|string|max:255',
                'whatsapp_number' => 'nullable|string|max:20',
            ]);

            $kontak->update($request->all());

            return redirect()->route('admin.kontak')->with('success', 'Kontak berhasil diupdate!');
        } catch (\Exception $e) {
            Log::error('Kontak update error: ' . $e->getMessage());
            return redirect()->route('admin.kontak')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
