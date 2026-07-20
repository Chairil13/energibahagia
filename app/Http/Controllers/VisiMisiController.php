<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visiMisi = VisiMisi::first();
        if (!$visiMisi) {
            $visiMisi = VisiMisi::create([
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
        return view('admin.visi-misi', compact('visiMisi'));
    }

    public function update(Request $request, $id)
    {
        try {
            $visiMisi = VisiMisi::findOrFail($id);

            $request->validate([
                'badge_text' => 'nullable|string|max:255',
                'title' => 'nullable|string|max:255',
                'visi' => 'nullable|string',
                'misi' => 'nullable|array',
                'misi.*' => 'nullable|string',
            ]);

            $visiMisi->badge_text = $request->badge_text;
            $visiMisi->title = $request->title;
            $visiMisi->visi = $request->visi;
            $visiMisi->misi = $request->misi ?? [];
            $visiMisi->save();

            return redirect()->route('admin.visi-misi')->with('success', 'Visi & Misi berhasil diupdate!');
        } catch (\Exception $e) {
            Log::error('Visi Misi update error: ' . $e->getMessage());
            return redirect()->route('admin.visi-misi')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
