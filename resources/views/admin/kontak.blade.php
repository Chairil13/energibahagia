@extends('layouts.admin')

@section('title', 'Kelola Kontak - Admin Panel')

@section('content')
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
        <h1 class="text-2xl font-bold text-[#183D57]">Kelola Kontak</h1>
        <p class="text-gray-500">Mengatur informasi kontak di halaman Kontak</p>
    </div>

    <form action="{{ route('admin.kontak.update', $kontak->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Hero Section -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] px-6 py-4">
                <h3 class="text-white font-bold text-lg">Hero Section</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Badge Text</label>
                        <input type="text" name="hero_badge" value="{{ old('hero_badge', $kontak->hero_badge) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Judul Bagian 1</label>
                        <input type="text" name="hero_title_first"
                            value="{{ old('hero_title_first', $kontak->hero_title_first) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Judul Highlight</label>
                        <input type="text" name="hero_title_highlight"
                            value="{{ old('hero_title_highlight', $kontak->hero_title_highlight) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Deskripsi</label>
                        <textarea name="hero_description" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">{{ old('hero_description', $kontak->hero_description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kantor Pusat -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] px-6 py-4">
                <h3 class="text-white font-bold text-lg">Kantor Pusat</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Alamat</label>
                        <textarea name="office_address" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">{{ old('office_address', $kontak->office_address) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Link Google Maps</label>
                        <input type="text" name="office_map_link"
                            value="{{ old('office_map_link', $kontak->office_map_link) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">
                    </div>
                </div>
            </div>
        </div>

        <!-- Telepon -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] px-6 py-4">
                <h3 class="text-white font-bold text-lg">Telepon</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Nomor Kantor</label>
                        <input type="text" name="phone_kantor" value="{{ old('phone_kantor', $kontak->phone_kantor) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Hotline Donasi</label>
                        <input type="text" name="phone_hotline"
                            value="{{ old('phone_hotline', $kontak->phone_hotline) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Darurat</label>
                        <input type="text" name="phone_darurat"
                            value="{{ old('phone_darurat', $kontak->phone_darurat) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">
                    </div>
                </div>
            </div>
        </div>

        <!-- Email -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] px-6 py-4">
                <h3 class="text-white font-bold text-lg">Email</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Email Umum</label>
                        <input type="email" name="email_umum" value="{{ old('email_umum', $kontak->email_umum) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Email Donasi</label>
                        <input type="email" name="email_donasi" value="{{ old('email_donasi', $kontak->email_donasi) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Email Humas</label>
                        <input type="email" name="email_humas" value="{{ old('email_humas', $kontak->email_humas) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">
                    </div>
                </div>
            </div>
        </div>

        <!-- Media Sosial -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] px-6 py-4">
                <h3 class="text-white font-bold text-lg">Media Sosial & WhatsApp</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Facebook</label>
                        <input type="text" name="social_facebook"
                            value="{{ old('social_facebook', $kontak->social_facebook) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Instagram</label>
                        <input type="text" name="social_instagram"
                            value="{{ old('social_instagram', $kontak->social_instagram) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Twitter</label>
                        <input type="text" name="social_twitter"
                            value="{{ old('social_twitter', $kontak->social_twitter) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">YouTube</label>
                        <input type="text" name="social_youtube"
                            value="{{ old('social_youtube', $kontak->social_youtube) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">LinkedIn</label>
                        <input type="text" name="social_linkedin"
                            value="{{ old('social_linkedin', $kontak->social_linkedin) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Nomor WhatsApp</label>
                        <input type="text" name="whatsapp_number"
                            value="{{ old('whatsapp_number', $kontak->whatsapp_number) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337]">
                        <p class="text-xs text-gray-400 mt-1">Contoh: 6281234567890 (tanpa + atau 0 di awal)</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit"
                class="bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] px-6 py-2 rounded-xl font-semibold hover:shadow-lg transition transform hover:scale-105">
                <i class="fas fa-save mr-2"></i>
                Simpan Perubahan
            </button>
            <a href="{{ route('contact') }}" target="_blank"
                class="bg-gray-200 text-gray-600 px-6 py-2 rounded-xl font-semibold hover:bg-gray-300 transition">
                <i class="fas fa-external-link-alt mr-2"></i>
                Lihat Preview
            </a>
        </div>
    </form>
@endsection
