@extends('layouts.app')

@section('title', 'Profil Donatur - Energi Bahagia')

@section('content')
    <section class="relative py-20 bg-gradient-to-br from-gray-50 to-white min-h-screen">
        <!-- Decorative Background -->
        <div class="absolute top-0 left-0 w-full h-64 bg-gradient-to-r from-[#8AD337]/10 to-[#183D57]/10"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-[#8AD337]/5 rounded-full blur-3xl"></div>
        <div class="absolute top-40 left-20 w-72 h-72 bg-[#183D57]/5 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-6xl mx-auto">

                <!-- Header with Animation -->
                <div class="mb-12 text-center animate-fadeInDown">
                    <div
                        class="inline-block px-4 py-2 bg-[#8AD337]/10 rounded-full text-sm font-semibold text-[#8AD337] mb-4">
                        <i class="fas fa-user-circle mr-2"></i> Profil Donatur
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold text-[#183D57] mb-3 font-playfair">Profil Saya</h1>
                    <p class="text-gray-500 max-w-2xl mx-auto">Kelola dan perbarui informasi data diri Anda</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-[#8AD337] to-[#183D57] mx-auto mt-4 rounded-full"></div>
                </div>

                <div class="grid lg:grid-cols-3 gap-8">

                    <!-- Sidebar Kiri - Kartu Profil Premium -->
                    <div class="lg:col-span-1">
                        <div
                            class="bg-white rounded-3xl shadow-2xl overflow-hidden sticky top-24 transform transition-all duration-500 hover:shadow-[0_20px_60px_-15px_rgba(138,211,55,0.3)]">
                            <!-- Banner Premium -->
                            <div class="relative h-32 bg-gradient-to-r from-[#8AD337] to-[#183D57]">
                                <div class="absolute inset-0 bg-black/20"></div>
                                <div class="absolute -bottom-12 left-0 right-0 text-center">
                                    <div class="relative inline-block group">
                                        @if ($user->profile_photo && file_exists(public_path('uploads/profile/' . $user->profile_photo)))
                                            <img src="{{ asset('uploads/profile/' . $user->profile_photo) }}"
                                                alt="{{ $user->name }}"
                                                class="w-28 h-28 rounded-full object-cover mx-auto border-4 border-white shadow-xl group-hover:scale-105 transition-transform duration-300">
                                        @else
                                            <div
                                                class="w-28 h-28 bg-gradient-to-r from-[#8AD337] to-[#6fb32e] rounded-full flex items-center justify-center mx-auto border-4 border-white shadow-xl group-hover:scale-105 transition-transform duration-300">
                                                <i class="fas fa-user text-4xl text-white"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Info User -->
                            <div class="text-center px-6 pt-16 pb-6">
                                <h3 class="text-2xl font-bold text-[#183D57]">{{ $user->name }}</h3>
                                <p class="text-gray-500 text-sm mt-1">{{ $user->email }}</p>
                                <div class="flex items-center justify-center gap-2 mt-3">
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-700 text-xs rounded-full">
                                        <i class="fas fa-check-circle"></i> Terverifikasi
                                    </span>
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1 bg-[#8AD337]/10 text-[#183D57] text-xs rounded-full">
                                        <i class="fas fa-hand-holding-heart"></i> Donatur Aktif
                                    </span>
                                </div>
                                <p class="text-xs text-gray-400 mt-4">
                                    <i class="far fa-calendar-alt mr-1"></i> Bergabung
                                    {{ $user->created_at->format('d F Y') }}
                                </p>
                            </div>

                            <!-- Tombol Edit -->
                            <div class="px-6 py-5 border-t border-gray-100">
                                <a href="{{ route('donatur.edit.profile') }}"
                                    class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] py-3 rounded-xl font-semibold hover:shadow-xl transition-all duration-300 hover:scale-[1.02] group">
                                    <i class="fas fa-edit group-hover:rotate-12 transition-transform"></i>
                                    Edit Profil
                                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan - Informasi Detail Premium -->
                    <div class="lg:col-span-2 space-y-6">

                        <!-- Kartu Informasi Pribadi Premium -->
                        <div
                            class="bg-white rounded-3xl shadow-xl overflow-hidden transform transition-all duration-300 hover:shadow-2xl">
                            <div class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] px-6 py-5">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-white font-bold text-xl">
                                            <i class="fas fa-id-card mr-3"></i> Informasi Pribadi
                                        </h3>
                                        <p class="text-white/60 text-sm mt-1">Data diri Anda</p>
                                    </div>
                                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-shield-alt text-white/60"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6">
                                <div class="grid md:grid-cols-2 gap-5">
                                    <!-- Nama Lengkap -->
                                    <div class="group">
                                        <div
                                            class="bg-gradient-to-r from-gray-50 to-white rounded-xl p-4 border border-gray-100 group-hover:border-[#8AD337]/30 transition-all">
                                            <div class="flex items-start gap-3">
                                                <div
                                                    class="w-10 h-10 bg-[#8AD337]/10 rounded-xl flex items-center justify-center group-hover:bg-[#8AD337] transition-all">
                                                    <i
                                                        class="fas fa-user text-[#8AD337] group-hover:text-white transition-all"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <p class="text-xs text-gray-400 uppercase tracking-wide">Nama Lengkap
                                                    </p>
                                                    <p class="text-gray-800 font-semibold mt-1">{{ $user->name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="group">
                                        <div
                                            class="bg-gradient-to-r from-gray-50 to-white rounded-xl p-4 border border-gray-100 group-hover:border-[#8AD337]/30 transition-all">
                                            <div class="flex items-start gap-3">
                                                <div
                                                    class="w-10 h-10 bg-[#8AD337]/10 rounded-xl flex items-center justify-center group-hover:bg-[#8AD337] transition-all">
                                                    <i
                                                        class="fas fa-envelope text-[#8AD337] group-hover:text-white transition-all"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <p class="text-xs text-gray-400 uppercase tracking-wide">Email</p>
                                                    <p class="text-gray-800 font-semibold mt-1">{{ $user->email }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Nomor Telepon -->
                                    <div class="group">
                                        <div
                                            class="bg-gradient-to-r from-gray-50 to-white rounded-xl p-4 border border-gray-100 group-hover:border-[#8AD337]/30 transition-all">
                                            <div class="flex items-start gap-3">
                                                <div
                                                    class="w-10 h-10 bg-[#8AD337]/10 rounded-xl flex items-center justify-center group-hover:bg-[#8AD337] transition-all">
                                                    <i
                                                        class="fas fa-phone-alt text-[#8AD337] group-hover:text-white transition-all"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <p class="text-xs text-gray-400 uppercase tracking-wide">Nomor Telepon
                                                    </p>
                                                    <p class="text-gray-800 font-semibold mt-1">{{ $user->phone ?? '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Jenis Kelamin -->
                                    <div class="group">
                                        <div
                                            class="bg-gradient-to-r from-gray-50 to-white rounded-xl p-4 border border-gray-100 group-hover:border-[#8AD337]/30 transition-all">
                                            <div class="flex items-start gap-3">
                                                <div
                                                    class="w-10 h-10 bg-[#8AD337]/10 rounded-xl flex items-center justify-center group-hover:bg-[#8AD337] transition-all">
                                                    <i
                                                        class="fas fa-venus-mars text-[#8AD337] group-hover:text-white transition-all"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <p class="text-xs text-gray-400 uppercase tracking-wide">Jenis Kelamin
                                                    </p>
                                                    <p class="text-gray-800 font-semibold mt-1">
                                                        @if ($user->gender == 'L')
                                                            Laki-laki
                                                        @elseif($user->gender == 'P')
                                                            Perempuan
                                                        @else
                                                            -
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pekerjaan -->
                                    <div class="group">
                                        <div
                                            class="bg-gradient-to-r from-gray-50 to-white rounded-xl p-4 border border-gray-100 group-hover:border-[#8AD337]/30 transition-all">
                                            <div class="flex items-start gap-3">
                                                <div
                                                    class="w-10 h-10 bg-[#8AD337]/10 rounded-xl flex items-center justify-center group-hover:bg-[#8AD337] transition-all">
                                                    <i
                                                        class="fas fa-briefcase text-[#8AD337] group-hover:text-white transition-all"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <p class="text-xs text-gray-400 uppercase tracking-wide">Pekerjaan</p>
                                                    <p class="text-gray-800 font-semibold mt-1">
                                                        {{ $user->occupation ?? '-' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Alamat -->
                                    <div class="group">
                                        <div
                                            class="bg-gradient-to-r from-gray-50 to-white rounded-xl p-4 border border-gray-100 group-hover:border-[#8AD337]/30 transition-all">
                                            <div class="flex items-start gap-3">
                                                <div
                                                    class="w-10 h-10 bg-[#8AD337]/10 rounded-xl flex items-center justify-center group-hover:bg-[#8AD337] transition-all">
                                                    <i
                                                        class="fas fa-map-marker-alt text-[#8AD337] group-hover:text-white transition-all"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <p class="text-xs text-gray-400 uppercase tracking-wide">Alamat</p>
                                                    <p class="text-gray-800 font-semibold mt-1">
                                                        {{ $user->address ?? '-' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kartu Alamat Lengkap Premium -->
                        <div
                            class="bg-white rounded-3xl shadow-xl overflow-hidden transform transition-all duration-300 hover:shadow-2xl">
                            <div class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] px-6 py-5">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-white font-bold text-xl">
                                            <i class="fas fa-location-dot mr-3"></i> Alamat Lengkap
                                        </h3>
                                        <p class="text-white/60 text-sm mt-1">Informasi lokasi Anda</p>
                                    </div>
                                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-map-pin text-white/60"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="grid md:grid-cols-3 gap-4">
                                    <div
                                        class="text-center p-4 bg-gradient-to-br from-gray-50 to-white rounded-xl border border-gray-100 hover:border-[#8AD337]/30 transition-all group">
                                        <div
                                            class="w-12 h-12 bg-[#8AD337]/10 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-[#8AD337] transition-all">
                                            <i
                                                class="fas fa-city text-[#8AD337] text-xl group-hover:text-white transition-all"></i>
                                        </div>
                                        <p class="text-xs text-gray-400 uppercase tracking-wide">Kota</p>
                                        <p class="text-gray-800 font-semibold mt-1">{{ $user->city ?? '-' }}</p>
                                    </div>
                                    <div
                                        class="text-center p-4 bg-gradient-to-br from-gray-50 to-white rounded-xl border border-gray-100 hover:border-[#8AD337]/30 transition-all group">
                                        <div
                                            class="w-12 h-12 bg-[#8AD337]/10 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-[#8AD337] transition-all">
                                            <i
                                                class="fas fa-globe text-[#8AD337] text-xl group-hover:text-white transition-all"></i>
                                        </div>
                                        <p class="text-xs text-gray-400 uppercase tracking-wide">Provinsi</p>
                                        <p class="text-gray-800 font-semibold mt-1">{{ $user->province ?? '-' }}</p>
                                    </div>
                                    <div
                                        class="text-center p-4 bg-gradient-to-br from-gray-50 to-white rounded-xl border border-gray-100 hover:border-[#8AD337]/30 transition-all group">
                                        <div
                                            class="w-12 h-12 bg-[#8AD337]/10 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-[#8AD337] transition-all">
                                            <i
                                                class="fas fa-mail-bulk text-[#8AD337] text-xl group-hover:text-white transition-all"></i>
                                        </div>
                                        <p class="text-xs text-gray-400 uppercase tracking-wide">Kode Pos</p>
                                        <p class="text-gray-800 font-semibold mt-1">{{ $user->postal_code ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kartu Kontak Darurat Premium -->
                        <div
                            class="bg-white rounded-3xl shadow-xl overflow-hidden transform transition-all duration-300 hover:shadow-2xl">
                            <div class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] px-6 py-5">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-white font-bold text-xl">
                                            <i class="fas fa-phone-alt mr-3"></i> Kontak Darurat
                                        </h3>
                                        <p class="text-white/60 text-sm mt-1">Informasi untuk keadaan darurat</p>
                                    </div>
                                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-shield-heart text-white/60"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="grid md:grid-cols-2 gap-5">
                                    <div class="group">
                                        <div
                                            class="bg-gradient-to-r from-red-50 to-white rounded-xl p-4 border border-red-100 group-hover:border-red-300 transition-all">
                                            <div class="flex items-start gap-3">
                                                <div
                                                    class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center group-hover:bg-red-500 transition-all">
                                                    <i
                                                        class="fas fa-phone-alt text-red-500 group-hover:text-white transition-all"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <p class="text-xs text-gray-400 uppercase tracking-wide">Nomor Kontak
                                                        Darurat</p>
                                                    <p class="text-gray-800 font-semibold mt-1">
                                                        {{ $user->emergency_contact ?? '-' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="group">
                                        <div
                                            class="bg-gradient-to-r from-blue-50 to-white rounded-xl p-4 border border-blue-100 group-hover:border-blue-300 transition-all">
                                            <div class="flex items-start gap-3">
                                                <div
                                                    class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center group-hover:bg-blue-500 transition-all">
                                                    <i
                                                        class="fas fa-user-friends text-blue-500 group-hover:text-white transition-all"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <p class="text-xs text-gray-400 uppercase tracking-wide">Nama Kontak
                                                        Darurat</p>
                                                    <p class="text-gray-800 font-semibold mt-1">
                                                        {{ $user->emergency_name ?? '-' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Motivasi Card -->
                        <div class="bg-gradient-to-r from-[#8AD337]/10 to-[#183D57]/10 rounded-3xl p-6 text-center">
                            <i class="fas fa-quote-left text-[#8AD337] text-3xl mb-3 opacity-50"></i>
                            <p class="text-gray-600 italic">
                                "Setiap donasi adalah harapan baru bagi mereka yang membutuhkan. Terima kasih telah menjadi
                                bagian dari perubahan."
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInDown {
            animation: fadeInDown 0.6s ease-out;
        }
    </style>
@endsection
