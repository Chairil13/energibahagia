<?php

namespace App\Http\Controllers;

use App\Models\KategoriProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class KategoriProgramController extends Controller
{
    // Index - Tampilkan semua kategori
    public function index()
    {
        $kategoris = KategoriProgram::orderBy('urutan', 'asc')->paginate(10);
        return view('admin.kategori-program.index', compact('kategoris'));
    }

    // Create - Form tambah kategori
    public function create()
    {
        return view('admin.kategori-program.create');
    }

    // Store - Simpan kategori baru
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_kategori' => 'required|string|max:255|unique:kategori_programs',
                'deskripsi' => 'nullable|string',
                'icon' => 'nullable|string|max:100',
                'warna' => 'nullable|string|max:20',
                'urutan' => 'nullable|integer',
                'is_active' => 'nullable|boolean',
            ]);

            KategoriProgram::create([
                'nama_kategori' => $request->nama_kategori,
                'slug' => Str::slug($request->nama_kategori),
                'deskripsi' => $request->deskripsi,
                'icon' => $request->icon,
                'warna' => $request->warna ?? '#8AD337',
                'urutan' => $request->urutan ?? 0,
                'is_active' => $request->has('is_active'),
            ]);

            return redirect()->route('admin.kategori-program.index')->with('success', 'Kategori berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Kategori store error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Edit - Form edit kategori
    public function edit($id)
    {
        $kategori = KategoriProgram::findOrFail($id);
        return view('admin.kategori-program.edit', compact('kategori'));
    }

    // Update - Update kategori
    public function update(Request $request, $id)
    {
        try {
            $kategori = KategoriProgram::findOrFail($id);

            $request->validate([
                'nama_kategori' => 'required|string|max:255|unique:kategori_programs,nama_kategori,' . $id,
                'deskripsi' => 'nullable|string',
                'icon' => 'nullable|string|max:100',
                'warna' => 'nullable|string|max:20',
                'urutan' => 'nullable|integer',
                'is_active' => 'nullable|boolean',
            ]);

            $kategori->update([
                'nama_kategori' => $request->nama_kategori,
                'slug' => Str::slug($request->nama_kategori),
                'deskripsi' => $request->deskripsi,
                'icon' => $request->icon,
                'warna' => $request->warna ?? '#8AD337',
                'urutan' => $request->urutan ?? 0,
                'is_active' => $request->has('is_active'),
            ]);

            return redirect()->route('admin.kategori-program.index')->with('success', 'Kategori berhasil diupdate!');
        } catch (\Exception $e) {
            Log::error('Kategori update error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Destroy - Hapus kategori
    public function destroy($id)
    {
        try {
            $kategori = KategoriProgram::findOrFail($id);

            // Cek apakah kategori memiliki program
            if ($kategori->programs()->count() > 0) {
                return redirect()->back()->with('error', 'Kategori tidak dapat dihapus karena masih memiliki program donasi!');
            }

            $kategori->delete();
            return redirect()->route('admin.kategori-program.index')->with('success', 'Kategori berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Kategori delete error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
