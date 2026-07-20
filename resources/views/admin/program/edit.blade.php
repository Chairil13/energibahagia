@extends('layouts.admin')

@section('title', 'Edit Program Donasi - Admin Panel')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#183D57]">Edit Program Donasi</h1>
        <p class="text-gray-500">Mengedit program donasi</p>
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

    <form action="{{ route('admin.program.update', $program->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Judul Program <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="judul" value="{{ old('judul', $program->judul) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Deskripsi Singkat <span
                                class="text-red-500">*</span></label>
                        <textarea name="deskripsi_singkat" rows="3" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">{{ old('deskripsi_singkat', $program->deskripsi_singkat) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Deskripsi Lengkap <span
                                class="text-red-500">*</span></label>
                        <textarea name="deskripsi_lengkap" rows="10" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">{{ old('deskripsi_lengkap', $program->deskripsi_lengkap) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Kategori <span
                                class="text-red-500">*</span></label>
                        <select name="id_kategori" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ old('id_kategori', $program->id_kategori) == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Gambar Program</label>
                        @if ($program->gambar && file_exists(public_path('uploads/program/' . $program->gambar)))
                            <div class="mb-3">
                                <img src="{{ asset('uploads/program/' . $program->gambar) }}"
                                    class="h-32 w-auto rounded-lg border">
                                <p class="text-xs text-gray-500 mt-1">Gambar saat ini</p>
                            </div>
                        @endif
                        <input type="file" name="gambar" accept="image/*"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">
                        <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengubah gambar</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Target Dana <span
                                class="text-red-500">*</span></label>
                        <input type="number" name="target_dana" value="{{ old('target_dana', $program->target_dana) }}"
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Penerima</label>
                        <input type="number" name="penerima" value="{{ old('penerima', $program->penerima) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">
                    </div>

                    <div class="grid grid-cols-2 gap-3 mb-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2 text-sm">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai"
                                value="{{ old('tanggal_mulai', $program->tanggal_mulai ? $program->tanggal_mulai->format('Y-m-d') : '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2 text-sm">Tanggal Berakhir</label>
                            <input type="date" name="tanggal_berakhir"
                                value="{{ old('tanggal_berakhir', $program->tanggal_berakhir ? $program->tanggal_berakhir->format('Y-m-d') : '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Status</label>
                        <select name="status"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">
                            <option value="Aktif" {{ $program->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Selesai" {{ $program->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="Ditutup" {{ $program->status == 'Ditutup' ? 'selected' : '' }}>Ditutup</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1"
                                {{ $program->is_featured ? 'checked' : '' }} class="w-4 h-4 text-[#8AD337] rounded">
                            <span class="text-sm text-gray-700">Jadikan Program Unggulan</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex gap-3 mt-6">
            <button type="submit"
                class="bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] px-6 py-2 rounded-xl font-semibold hover:shadow-lg transition">
                <i class="fas fa-save mr-2"></i>
                Update Program
            </button>
            <a href="{{ route('admin.program.index') }}"
                class="bg-gray-200 text-gray-600 px-6 py-2 rounded-xl font-semibold hover:bg-gray-300 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>
    </form>
@endsection
