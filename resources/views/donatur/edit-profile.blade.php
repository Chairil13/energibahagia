@extends('layouts.app')

@section('title', 'Edit Profil - Energi Bahagia')

@section('content')
    <section class="py-20 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto">

                <div class="mb-6">
                    <a href="{{ route('donatur.profile') }}"
                        class="text-[#8AD337] hover:text-[#183D57] transition inline-flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Profil
                    </a>
                </div>

                <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] px-6 py-4">
                        <h3 class="text-xl font-bold text-white">Edit Profil</h3>
                        <p class="text-white/80 text-sm">Perbarui informasi data diri Anda</p>
                    </div>

                    <div class="p-6 md:p-8">
                        @if (session('success'))
                            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-xl">
                                {{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl">
                                {{ session('error') }}</div>
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

                        <form action="{{ route('donatur.update.profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Kolom Kiri -->
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm">Nama Lengkap <span
                                                class="text-red-500">*</span></label>
                                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                                    </div>

                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm">Email <span
                                                class="text-red-500">*</span></label>
                                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                            required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                                    </div>

                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm">Nomor Telepon <span
                                                class="text-red-500">*</span></label>
                                        <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}"
                                            required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                                    </div>

                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm">Alamat</label>
                                        <textarea name="address" rows="2"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">{{ old('address', $user->address) }}</textarea>
                                    </div>

                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm">Kota</label>
                                        <input type="text" name="city" value="{{ old('city', $user->city) }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                                    </div>
                                </div>

                                <!-- Kolom Kanan -->
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm">Provinsi</label>
                                        <input type="text" name="province"
                                            value="{{ old('province', $user->province) }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                                    </div>

                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm">Kode Pos</label>
                                        <input type="text" name="postal_code"
                                            value="{{ old('postal_code', $user->postal_code) }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                                    </div>

                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm">Jenis Kelamin</label>
                                        <div class="flex gap-4">
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="radio" name="gender" value="L"
                                                    {{ $user->gender == 'L' ? 'checked' : '' }}
                                                    class="w-4 h-4 text-[#8AD337]">
                                                <span class="text-gray-700">Laki-laki</span>
                                            </label>
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="radio" name="gender" value="P"
                                                    {{ $user->gender == 'P' ? 'checked' : '' }}
                                                    class="w-4 h-4 text-[#8AD337]">
                                                <span class="text-gray-700">Perempuan</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm">Pekerjaan</label>
                                        <input type="text" name="occupation"
                                            value="{{ old('occupation', $user->occupation) }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                                    </div>

                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm">Kontak Darurat</label>
                                        <input type="text" name="emergency_contact"
                                            value="{{ old('emergency_contact', $user->emergency_contact) }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                                    </div>

                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm">Nama Kontak
                                            Darurat</label>
                                        <input type="text" name="emergency_name"
                                            value="{{ old('emergency_name', $user->emergency_name) }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                                    </div>
                                </div>
                            </div>

                            <!-- Foto Profil -->
                            <div class="mt-6">
                                <label class="block text-gray-700 font-medium mb-2 text-sm">Foto Profil</label>
                                @if ($user->profile_photo && file_exists(public_path('uploads/profile/' . $user->profile_photo)))
                                    <div class="mb-3">
                                        <img src="{{ asset('uploads/profile/' . $user->profile_photo) }}"
                                            class="w-20 h-20 rounded-full object-cover">
                                    </div>
                                @endif
                                <input type="file" name="profile_photo" accept="image/*"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                                <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                            </div>

                            <div class="flex gap-3 mt-8">
                                <button type="submit"
                                    class="flex-1 bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] py-3 rounded-xl font-semibold hover:shadow-lg transition">
                                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                                </button>
                                <a href="{{ route('donatur.profile') }}"
                                    class="flex-1 bg-gray-200 text-gray-600 py-3 rounded-xl font-semibold hover:bg-gray-300 transition text-center">
                                    Batal
                                </a>
                            </div>
                        </form>

                        <!-- Form Ganti Password -->
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <h4 class="text-lg font-bold text-[#183D57] mb-4">Ganti Password</h4>
                            <form action="{{ route('donatur.change.password') }}" method="POST">
                                @csrf
                                <div class="grid md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm">Password Saat
                                            Ini</label>
                                        <input type="password" name="current_password" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm">Password Baru</label>
                                        <input type="password" name="new_password" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm">Konfirmasi Password
                                            Baru</label>
                                        <input type="password" name="new_password_confirmation" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                                    </div>
                                    <div class="flex items-end">
                                        <button type="submit"
                                            class="w-full bg-gray-200 text-gray-600 py-3 rounded-xl font-semibold hover:bg-gray-300 transition">
                                            Ganti Password
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
