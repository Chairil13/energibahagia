@extends('layouts.admin')

@section('title', 'Tambah Berita - Admin Panel')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#183D57]">Tambah Berita</h1>
        <p class="text-gray-500">Menambahkan berita baru</p>
    </div>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Judul Berita <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="judul" value="{{ old('judul') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Deskripsi Singkat <span
                                class="text-red-500">*</span></label>
                        <textarea name="deskripsi_singkat" rows="3" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">{{ old('deskripsi_singkat') }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">Tampil di halaman daftar berita</p>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Konten Berita <span
                                class="text-red-500">*</span></label>
                        <textarea name="konten" id="konten" rows="15" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">{{ old('konten') }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">Konten lengkap berita</p>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Gambar</label>
                        <input type="file" name="gambar" accept="image/*"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">
                        <p class="text-xs text-gray-400 mt-1">Ukuran maksimal 2MB. Format: JPG, PNG, GIF, WEBP</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Kategori</label>
                        <input type="text" name="kategori" value="{{ old('kategori') }}"
                            placeholder="Contoh: Pendidikan, Kesehatan, Sosial"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Status</label>
                        <select name="status"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">
                            <option value="draft">Draft</option>
                            <option value="publish">Publish</option>
                        </select>
                    </div>

                    <div>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1" class="w-4 h-4 text-[#8AD337] rounded">
                            <span class="text-sm text-gray-700">Jadikan Berita Unggulan</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex gap-3 mt-6">
            <button type="submit"
                class="bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] px-6 py-2 rounded-xl font-semibold hover:shadow-lg transition">
                <i class="fas fa-save mr-2"></i>
                Simpan Berita
            </button>
            <a href="{{ route('admin.berita.index') }}"
                class="bg-gray-200 text-gray-600 px-6 py-2 rounded-xl font-semibold hover:bg-gray-300 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>
    </form>
@endsection
