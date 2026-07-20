@extends('layouts.admin')

@section('title', 'Kelola Hero Section - Admin Panel')

@section('content')
    <!-- Alert Success -->
    @if (session('success'))
        <div
            class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-xl flex items-center justify-between">
            <span>{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">×</button>
        </div>
    @endif

    <!-- Alert Error -->
    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl flex items-center justify-between">
            <span>{{ session('error') }}</span>
            <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900">×</button>
        </div>
    @endif

    <!-- Alert Validation Errors -->
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
        <h1 class="text-2xl font-bold text-[#183D57]">Kelola Hero Section</h1>
        <p class="text-gray-500">Mengatur tampilan hero section di halaman utama</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <div class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] px-6 py-4">
            <h3 class="text-white font-bold text-lg">Edit Hero Section</h3>
        </div>

        <form action="{{ route('admin.hero.update', $hero->id) }}" method="POST" enctype="multipart/form-data"
            class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Badge Text</label>
                        <input type="text" name="badge_text" value="{{ old('badge_text', $hero->badge_text) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                        <p class="text-xs text-gray-400 mt-1">Text kecil di atas judul (contoh: Platform Donasi Terpercaya)
                        </p>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Judul Bagian 1</label>
                        <input type="text" name="title_first" value="{{ old('title_first', $hero->title_first) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Judul Highlight (Warna Hijau)</label>
                        <input type="text" name="title_highlight"
                            value="{{ old('title_highlight', $hero->title_highlight) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Judul Bagian 3</label>
                        <input type="text" name="title_last" value="{{ old('title_last', $hero->title_last) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Deskripsi</label>
                        <textarea name="description" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">{{ old('description', $hero->description) }}</textarea>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Tombol Utama (Text)</label>
                        <input type="text" name="button_primary_text"
                            value="{{ old('button_primary_text', $hero->button_primary_text) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Tombol Utama (Link)</label>
                        <input type="text" name="button_primary_link"
                            value="{{ old('button_primary_link', $hero->button_primary_link) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                        <p class="text-xs text-gray-400 mt-1">Contoh: /program, /donasi, https://...</p>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Tombol Kedua (Text)</label>
                        <input type="text" name="button_secondary_text"
                            value="{{ old('button_secondary_text', $hero->button_secondary_text) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Tombol Kedua (Link)</label>
                        <input type="text" name="button_secondary_link"
                            value="{{ old('button_secondary_link', $hero->button_secondary_link) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                        <p class="text-xs text-gray-400 mt-1">Contoh: /profile, /kontak, https://...</p>
                    </div>

                    <!-- Bagian Gambar Hero di Form -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Gambar Hero</label>

                        @php
                            $imagePath = public_path('uploads/hero/' . $hero->hero_image);
                        @endphp

                        <div id="heroImagePreviewWrapper"
                            class="{{ $hero->hero_image && file_exists($imagePath) ? '' : 'hidden' }} mb-3 p-2 bg-gray-100 rounded-lg">
                            <p id="heroImagePreviewLabel" class="text-xs text-gray-500 mb-2">Gambar saat ini:</p>
                            <img id="heroImagePreview"
                                src="{{ $hero->hero_image && file_exists($imagePath) ? asset('uploads/hero/' . $hero->hero_image) : '' }}"
                                alt="Preview Gambar Hero" class="h-32 w-auto rounded-lg border shadow-sm">
                            <p id="heroImagePreviewName" class="text-xs text-gray-400 mt-1">{{ $hero->hero_image }}</p>
                        </div>

                        <input id="heroImageInput" type="file" name="hero_image" accept="image/*"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                        <p class="text-xs text-gray-400 mt-1">Ukuran maksimal 2MB. Format: JPG, PNG, GIF, WEBP</p>
                    </div>
                </div>
            </div>

            <div class="flex gap-3 mt-6 pt-4 border-t border-gray-200">
                <button type="submit"
                    class="bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] px-6 py-2 rounded-xl font-semibold hover:shadow-lg transition transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Perubahan
                </button>
                <a href="{{ route('home') }}" target="_blank"
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
            Preview Hero Section
        </h3>
        <div class="bg-gradient-to-r from-gray-100 to-gray-200 rounded-2xl p-6 border-2 border-dashed border-gray-300">
            <div class="flex flex-col md:flex-row items-center gap-6">
                <div class="flex-1">
                    <div
                        class="inline-block px-3 py-1 bg-[#8AD337]/20 rounded-full text-xs font-semibold text-[#8AD337] mb-3">
                        {{ $hero->badge_text }}
                    </div>
                    <h2 class="text-2xl font-bold text-[#183D57]">
                        {{ $hero->title_first }}
                        <span class="text-[#8AD337]">{{ $hero->title_highlight }}</span>
                        {{ $hero->title_last }}
                    </h2>
                    <p class="text-gray-500 text-sm mt-2">{{ Str::limit($hero->description, 100) }}</p>
                    <div class="flex gap-3 mt-4">
                        <span class="bg-[#8AD337] text-[#183D57] px-4 py-1 rounded-full text-xs font-semibold">
                            {{ $hero->button_primary_text }}
                        </span>
                        <span class="border border-[#8AD337] text-[#8AD337] px-4 py-1 rounded-full text-xs font-semibold">
                            {{ $hero->button_secondary_text }}
                        </span>
                    </div>
                </div>
                @if ($hero->hero_image && file_exists(public_path('uploads/hero/' . $hero->hero_image)))
                    <div
                        class="w-32 h-32 bg-gray-200 rounded-lg flex items-center justify-center overflow-hidden shadow-md">
                        <img src="{{ asset('uploads/hero/' . $hero->hero_image) }}" alt="Preview"
                            class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="w-32 h-32 bg-gray-200 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-image text-3xl text-gray-400"></i>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        button:active {
            transform: scale(0.98);
        }
    </style>

    <script>
        const heroImageInput = document.getElementById('heroImageInput');
        const heroImagePreviewWrapper = document.getElementById('heroImagePreviewWrapper');
        const heroImagePreview = document.getElementById('heroImagePreview');
        const heroImagePreviewLabel = document.getElementById('heroImagePreviewLabel');
        const heroImagePreviewName = document.getElementById('heroImagePreviewName');
        let heroImagePreviewUrl = null;

        heroImageInput?.addEventListener('change', (event) => {
            const [file] = event.target.files;

            if (!file) {
                return;
            }

            if (heroImagePreviewUrl) {
                URL.revokeObjectURL(heroImagePreviewUrl);
            }

            heroImagePreviewUrl = URL.createObjectURL(file);
            heroImagePreview.src = heroImagePreviewUrl;
            heroImagePreviewLabel.textContent = 'Preview gambar baru:';
            heroImagePreviewName.textContent = file.name;
            heroImagePreviewWrapper.classList.remove('hidden');
        });
    </script>
@endsection
