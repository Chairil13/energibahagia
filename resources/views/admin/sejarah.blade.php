@extends('layouts.admin')

@section('title', 'Kelola Sejarah Lembaga - Admin Panel')

@section('content')
    <!-- Alert Success -->
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#183D57]">Kelola Sejarah Lembaga</h1>
        <p class="text-gray-500">Mengatur konten sejarah lembaga di halaman Profile</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <div class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] px-6 py-4">
            <h3 class="text-white font-bold text-lg">Edit Sejarah Lembaga</h3>
        </div>

        <form action="{{ route('admin.sejarah.update', $sejarah->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Badge Text</label>
                        <input type="text" name="badge_text" value="{{ old('badge_text', $sejarah->badge_text) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                        <p class="text-xs text-gray-400 mt-1">Text kecil di atas judul (contoh: PERJALANAN KAMI)</p>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Judul</label>
                        <input type="text" name="title" value="{{ old('title', $sejarah->title) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                        <p class="text-xs text-gray-400 mt-1">Judul section (contoh: Sejarah Lembaga)</p>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Nama Lembaga</label>
                        <input type="text" name="institution_name"
                            value="{{ old('institution_name', $sejarah->institution_name) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                        <p class="text-xs text-gray-400 mt-1">Nama lembaga yang akan ditebalkan</p>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Konten Sejarah</label>
                        <textarea name="content" rows="8"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">{{ old('content', $sejarah->content) }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">Isi teks sejarah lembaga (tanpa nama lembaga, karena akan
                            ditambahkan otomatis)</p>
                    </div>
                </div>
            </div>

            <div class="flex gap-3 mt-6 pt-4 border-t border-gray-200">
                <button type="submit"
                    class="bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] px-6 py-2 rounded-xl font-semibold hover:shadow-lg transition transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Perubahan
                </button>
                <a href="{{ route('profile') }}" target="_blank"
                    class="bg-gray-200 text-gray-600 px-6 py-2 rounded-xl font-semibold hover:bg-gray-300 transition">
                    <i class="fas fa-external-link-alt mr-2"></i>
                    Lihat Preview
                </a>
            </div>
        </form>
    </div>

    <!-- Preview Section -->
    <div class="mt-8">
        <h3 class="text-lg font-bold text-[#183D57] mb-4 flex items-center gap-2">
            <i class="fas fa-eye"></i>
            Preview Sejarah Lembaga
        </h3>
        <div class="bg-gradient-to-r from-gray-100 to-gray-200 rounded-2xl p-6 border-2 border-dashed border-gray-300">
            <div class="text-center">
                <div class="inline-block px-3 py-1 bg-[#8AD337]/20 rounded-full text-xs font-semibold text-[#8AD337] mb-3">
                    {{ $sejarah->badge_text }}
                </div>
                <h2 class="text-2xl font-bold text-[#183D57] mb-4">{{ $sejarah->title }}</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-[#8AD337] to-[#183D57] mx-auto rounded-full mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    <strong class="text-[#183D57]">{{ $sejarah->institution_name }}</strong>
                    {{ $sejarah->content }}
                </p>
            </div>
        </div>
    </div>
@endsection
