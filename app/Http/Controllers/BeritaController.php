<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    // Index Berita untuk Admin
    public function index()
    {
        $beritas = Berita::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.berita.index', compact('beritas'));
    }

    // Create Berita
    public function create()
    {
        return view('admin.berita.create');
    }

    // Store Berita
    public function store(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi_singkat' => 'required|string',
                'konten' => 'required|string',
                'kategori' => 'nullable|string|max:100',
                'status' => 'required|in:draft,publish',
                'is_featured' => 'nullable|boolean',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            $berita = new Berita();
            $berita->judul = $request->judul;
            $berita->deskripsi_singkat = $request->deskripsi_singkat;
            $berita->konten = $request->konten;
            $berita->kategori = $request->kategori;
            $berita->status = $request->status;
            $berita->is_featured = $request->has('is_featured');
            $berita->penulis = auth()->user()->name ?? 'Admin';
            $berita->tanggal_publish = $request->status == 'publish' ? now() : null;
            $berita->slug = Str::slug($request->judul) . '-' . uniqid();

            // Upload gambar
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $uploadPath = public_path('uploads/berita');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                $file->move($uploadPath, $imageName);
                $berita->gambar = $imageName;
            }

            $berita->save();

            return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Berita store error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Edit Berita
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    // Update Berita
    public function update(Request $request, $id)
    {
        try {
            $berita = Berita::findOrFail($id);

            $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi_singkat' => 'required|string',
                'konten' => 'required|string',
                'kategori' => 'nullable|string|max:100',
                'status' => 'required|in:draft,publish',
                'is_featured' => 'nullable|boolean',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            $berita->judul = $request->judul;
            $berita->deskripsi_singkat = $request->deskripsi_singkat;
            $berita->konten = $request->konten;
            $berita->kategori = $request->kategori;
            $berita->status = $request->status;
            $berita->is_featured = $request->has('is_featured');

            if ($request->status == 'publish' && !$berita->tanggal_publish) {
                $berita->tanggal_publish = now();
            }

            // Upload gambar baru
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama
                if ($berita->gambar && file_exists(public_path('uploads/berita/' . $berita->gambar))) {
                    unlink(public_path('uploads/berita/' . $berita->gambar));
                }

                $file = $request->file('gambar');
                $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $uploadPath = public_path('uploads/berita');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                $file->move($uploadPath, $imageName);
                $berita->gambar = $imageName;
            }

            $berita->save();

            return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diupdate!');
        } catch (\Exception $e) {
            Log::error('Berita update error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Delete Berita
    public function destroy($id)
    {
        try {
            $berita = Berita::findOrFail($id);

            // Hapus gambar
            if ($berita->gambar && file_exists(public_path('uploads/berita/' . $berita->gambar))) {
                unlink(public_path('uploads/berita/' . $berita->gambar));
            }

            $berita->delete();

            return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Berita delete error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    // Public Index Berita (untuk halaman /berita)
    public function publicIndex()
    {
        $beritas = Berita::where('status', 'publish')
            ->orderBy('tanggal_publish', 'desc')
            ->paginate(10);
        return view('home.news', compact('beritas'));
    }

    // Public Show Detail Berita (untuk halaman /berita/{slug})
    public function publicShow($slug)
    {
        $berita = Berita::where('slug', $slug)
            ->where('status', 'publish')
            ->firstOrFail();

        // Increment views
        $berita->increment('views');

        // Berita terkait
        $relatedBeritas = Berita::where('status', 'publish')
            ->where('id', '!=', $berita->id)
            ->limit(3)
            ->get();

        return view('home.news-detail', compact('berita', 'relatedBeritas'));
    }
}
