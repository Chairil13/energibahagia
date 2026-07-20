<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GalleryController extends Controller
{
    // ========== PUBLIC GALLERY INDEX (TANPA LOGIN) ==========
    public function publicIndex()
    {
        $galleries = Gallery::withCount('photos')
            ->where('status', 'active')
            ->orderBy('urutan', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(12); // 4 kolom x 3 baris

        return view('home.gallery', compact('galleries'));
    }

    // ========== GET PHOTOS FOR MODAL (PUBLIC) ==========
    public function getPhotos($id)
    {
        $gallery = Gallery::with('photos')->findOrFail($id);

        // Buat collection photos dengan gambar utama sebagai foto pertama
        $photos = collect();

        // Tambahkan gambar utama sebagai foto pertama
        if ($gallery->gambar_utama) {
            $photos->push((object) [
                'id' => 0,
                'foto_url' => asset('uploads/gallery/'.$gallery->gambar_utama),
                'keterangan' => 'Gambar Utama - '.$gallery->judul,
            ]);
        }

        // Tambahkan foto-foto lainnya
        foreach ($gallery->photos as $photo) {
            $photos->push((object) [
                'id' => $photo->id,
                'foto_url' => $photo->foto_url,
                'keterangan' => $photo->keterangan,
            ]);
        }

        return response()->json([
            'judul' => $gallery->judul,
            'deskripsi' => $gallery->deskripsi,
            'photos' => $photos,
        ]);
    }

    // ========== ADMIN INDEX ==========
    public function index()
    {
        $galleries = Gallery::withCount('photos')
            ->orderBy('urutan', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.gallery.index', compact('galleries'));
    }

    // ========== CREATE ==========
    public function create()
    {
        return view('admin.gallery.create');
    }

    // ========== STORE ==========
    public function store(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'status' => 'required|in:active,inactive',
                'urutan' => 'nullable|integer',
            ]);

            // Upload gambar utama
            $gambarUtama = null;
            if ($request->hasFile('gambar_utama')) {
                $file = $request->file('gambar_utama');
                $gambarUtama = time().'_cover.'.$file->getClientOriginalExtension();
                $file->move(public_path('uploads/gallery'), $gambarUtama);
            }

            $gallery = Gallery::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'gambar_utama' => $gambarUtama,
                'status' => $request->status,
                'urutan' => $request->urutan ?? 0,
            ]);

            return redirect()->route('admin.gallery.index')
                ->with('success', 'Gallery berhasil dibuat!');
        } catch (\Exception $e) {
            Log::error('Gallery store error: '.$e->getMessage());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: '.$e->getMessage())
                ->withInput();
        }
    }

    // ========== SHOW ==========
    public function show($id)
    {
        $gallery = Gallery::with('photos')->findOrFail($id);

        return view('admin.gallery.show', compact('gallery'));
    }

    // ========== EDIT ==========
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);

        return view('admin.gallery.edit', compact('gallery'));
    }

    // ========== UPDATE ==========
    public function update(Request $request, $id)
    {
        try {
            $gallery = Gallery::findOrFail($id);

            $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'status' => 'required|in:active,inactive',
                'urutan' => 'nullable|integer',
            ]);

            // Upload gambar utama baru
            if ($request->hasFile('gambar_utama')) {
                // Hapus gambar lama
                if ($gallery->gambar_utama && file_exists(public_path('uploads/gallery/'.$gallery->gambar_utama))) {
                    unlink(public_path('uploads/gallery/'.$gallery->gambar_utama));
                }

                $file = $request->file('gambar_utama');
                $gambarUtama = time().'_cover.'.$file->getClientOriginalExtension();
                $file->move(public_path('uploads/gallery'), $gambarUtama);
                $gallery->gambar_utama = $gambarUtama;
            }

            $gallery->judul = $request->judul;
            $gallery->deskripsi = $request->deskripsi;
            $gallery->status = $request->status;
            $gallery->urutan = $request->urutan ?? 0;
            $gallery->save();

            return redirect()->route('admin.gallery.index')
                ->with('success', 'Gallery berhasil diupdate!');
        } catch (\Exception $e) {
            Log::error('Gallery update error: '.$e->getMessage());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    // ========== DESTROY ==========
    public function destroy($id)
    {
        try {
            $gallery = Gallery::findOrFail($id);

            // Hapus semua foto
            foreach ($gallery->photos as $photo) {
                if (file_exists(public_path('uploads/gallery/photos/'.$photo->foto))) {
                    unlink(public_path('uploads/gallery/photos/'.$photo->foto));
                }
                $photo->delete();
            }

            // Hapus gambar utama
            if ($gallery->gambar_utama && file_exists(public_path('uploads/gallery/'.$gallery->gambar_utama))) {
                unlink(public_path('uploads/gallery/'.$gallery->gambar_utama));
            }

            $gallery->delete();

            return redirect()->route('admin.gallery.index')
                ->with('success', 'Gallery berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Gallery destroy error: '.$e->getMessage());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    // ========== TAMBAH FOTO ==========
    public function addPhotos(Request $request, $id)
    {
        try {
            $gallery = Gallery::findOrFail($id);

            $request->validate([
                'fotos.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
                'keterangan.*' => 'nullable|string|max:255',
            ]);

            $uploaded = 0;
            foreach ($request->file('fotos') as $key => $file) {
                $fileName = time().'_'.$key.'.'.$file->getClientOriginalExtension();
                $file->move(public_path('uploads/gallery/photos'), $fileName);

                GalleryPhoto::create([
                    'gallery_id' => $gallery->id,
                    'foto' => $fileName,
                    'keterangan' => $request->keterangan[$key] ?? null,
                    'urutan' => $gallery->photos()->count() + $key + 1,
                ]);

                $uploaded++;
            }

            return redirect()->route('admin.gallery.show', $gallery->id)
                ->with('success', $uploaded.' foto berhasil diupload!');
        } catch (\Exception $e) {
            Log::error('Add photos error: '.$e->getMessage());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    // ========== HAPUS FOTO ==========
    public function deletePhoto($photoId)
    {
        try {
            $photo = GalleryPhoto::findOrFail($photoId);
            $galleryId = $photo->gallery_id;

            // Hapus file
            if (file_exists(public_path('uploads/gallery/photos/'.$photo->foto))) {
                unlink(public_path('uploads/gallery/photos/'.$photo->foto));
            }

            $photo->delete();

            return redirect()->route('admin.gallery.show', $galleryId)
                ->with('success', 'Foto berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Delete photo error: '.$e->getMessage());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    // ========== UPDATE URUTAN FOTO ==========
    public function updatePhotoOrder(Request $request)
    {
        try {
            foreach ($request->orders as $order) {
                GalleryPhoto::where('id', $order['id'])
                    ->update(['urutan' => $order['urutan']]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // ========== UPDATE KETERANGAN FOTO ==========
    public function updatePhotoKeterangan(Request $request, $photoId)
    {
        try {
            $photo = GalleryPhoto::findOrFail($photoId);

            $request->validate([
                'keterangan' => 'nullable|string|max:255',
            ]);

            $photo->keterangan = $request->keterangan;
            $photo->save();

            return redirect()->route('admin.gallery.edit', $photo->gallery_id)
                ->with('success', 'Keterangan foto berhasil diupdate!');

        } catch (\Exception $e) {
            Log::error('Update keterangan error: '.$e->getMessage());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }
}
