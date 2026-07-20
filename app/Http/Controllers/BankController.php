<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BankController extends Controller
{
    // Index - Tampilkan semua bank
    public function index()
    {
        $banks = Bank::orderBy('urutan', 'asc')->paginate(10);
        return view('admin.bank.index', compact('banks'));
    }

    // Create - Form tambah bank
    public function create()
    {
        return view('admin.bank.create');
    }

    // Store - Simpan bank baru
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_bank' => 'required|string|max:255',
                'kode' => 'required|string|max:50|unique:banks',
                'nomor_rekening' => 'required|string|max:50',
                'atas_nama' => 'required|string|max:255',
                'icon' => 'nullable|string|max:100',
                'warna' => 'nullable|string|max:20',
                'urutan' => 'nullable|integer',
                'is_active' => 'nullable|boolean',
            ]);

            Bank::create([
                'nama_bank' => $request->nama_bank,
                'kode' => strtoupper($request->kode),
                'nomor_rekening' => $request->nomor_rekening,
                'atas_nama' => $request->atas_nama,
                'icon' => $request->icon ?? 'fa-university',
                'warna' => $request->warna ?? '#183D57',
                'urutan' => $request->urutan ?? 0,
                'is_active' => $request->has('is_active'),
            ]);

            return redirect()->route('admin.bank.index')->with('success', 'Bank berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Bank store error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Edit - Form edit bank
    public function edit($id)
    {
        $bank = Bank::findOrFail($id);
        return view('admin.bank.edit', compact('bank'));
    }

    // Update - Update bank
    public function update(Request $request, $id)
    {
        try {
            $bank = Bank::findOrFail($id);

            $request->validate([
                'nama_bank' => 'required|string|max:255',
                'kode' => 'required|string|max:50|unique:banks,kode,' . $id,
                'nomor_rekening' => 'required|string|max:50',
                'atas_nama' => 'required|string|max:255',
                'icon' => 'nullable|string|max:100',
                'warna' => 'nullable|string|max:20',
                'urutan' => 'nullable|integer',
                'is_active' => 'nullable|boolean',
            ]);

            $bank->update([
                'nama_bank' => $request->nama_bank,
                'kode' => strtoupper($request->kode),
                'nomor_rekening' => $request->nomor_rekening,
                'atas_nama' => $request->atas_nama,
                'icon' => $request->icon ?? 'fa-university',
                'warna' => $request->warna ?? '#183D57',
                'urutan' => $request->urutan ?? 0,
                'is_active' => $request->has('is_active'),
            ]);

            return redirect()->route('admin.bank.index')->with('success', 'Bank berhasil diupdate!');
        } catch (\Exception $e) {
            Log::error('Bank update error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Destroy - Hapus bank
    public function destroy($id)
    {
        try {
            $bank = Bank::findOrFail($id);
            $bank->delete();
            return redirect()->route('admin.bank.index')->with('success', 'Bank berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Bank delete error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
