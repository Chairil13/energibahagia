@extends('layouts.app')

@section('title', 'Dashboard Donatur - Energi Bahagia')

@section('content')
    <section class="py-10 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="max-w-7xl mx-auto">

                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-2xl sm:text-3xl font-bold text-[#183D57]">Dashboard Donatur</h1>
                    <p class="text-gray-500 mt-1">Selamat datang kembali, <span
                            class="font-semibold text-[#183D57]">{{ Auth::user()->name ?? 'Donatur' }}</span>!</p>
                </div>

                <!-- Statistik Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 md:gap-6 mb-10">
                    <!-- Total Donasi -->
                    <div class="bg-white rounded-2xl shadow-md p-6 text-center hover:shadow-lg transition duration-300">
                        <div class="w-14 h-14 bg-[#8AD337]/20 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-hand-holding-heart text-2xl text-[#8AD337]"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-[#183D57]">Rp {{ number_format($totalDonasi ?? 0, 0, ',', '.') }}
                        </h3>
                        <p class="text-gray-500 text-sm">Total Donasi</p>
                    </div>

                    <!-- Program Diikuti -->
                    <div class="bg-white rounded-2xl shadow-md p-6 text-center hover:shadow-lg transition duration-300">
                        <div class="w-14 h-14 bg-[#8AD337]/20 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-chart-line text-2xl text-[#8AD337]"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-[#183D57]">{{ $jumlahDonasi ?? 0 }}</h3>
                        <p class="text-gray-500 text-sm">Program Diikuti</p>
                    </div>

                    <!-- Menunggu Konfirmasi -->
                    <div class="bg-white rounded-2xl shadow-md p-6 text-center hover:shadow-lg transition duration-300">
                        <div class="w-14 h-14 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-clock text-2xl text-yellow-600"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-yellow-600">{{ $donasiPending ?? 0 }}</h3>
                        <p class="text-gray-500 text-sm">Menunggu Konfirmasi</p>
                    </div>

                    <!-- Donasi Ditolak -->
                    <div class="bg-white rounded-2xl shadow-md p-6 text-center hover:shadow-lg transition duration-300">
                        <div class="w-14 h-14 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-times-circle text-2xl text-red-600"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-red-600">{{ $donasiDitolak ?? 0 }}</h3>
                        <p class="text-gray-500 text-sm">Donasi Ditolak</p>
                    </div>

                    <!-- Donasi Terbaru -->
                    <div class="bg-white rounded-2xl shadow-md p-6 text-center hover:shadow-lg transition duration-300">
                        <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-calendar-check text-2xl text-blue-600"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-blue-600">
                            {{ isset($donasiTerbaru) ? $donasiTerbaru->count() : 0 }}</h3>
                        <p class="text-gray-500 text-sm">Donasi Terbaru</p>
                    </div>
                </div>

                <!-- Dua Kolom -->
                <div class="grid lg:grid-cols-3 gap-6">
                    <!-- Kolom Kiri: Donasi Terbaru -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                            <div
                                class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] px-6 py-4 flex justify-between items-center">
                                <h3 class="text-white font-bold text-lg">
                                    <i class="fas fa-history mr-2"></i> Donasi Terbaru
                                </h3>
                                <a href="{{ route('donation.history') }}"
                                    class="text-[#8AD337] hover:text-white transition text-sm">
                                    Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>

                            <div class="p-6">
                                @if (isset($donasiTerbaru) && $donasiTerbaru->count() > 0)
                                    <div class="space-y-4">
                                        @foreach ($donasiTerbaru as $item)
                                            <div
                                                class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                                                <div class="flex items-center gap-4">
                                                    <div
                                                        class="w-12 h-12 bg-[#8AD337]/20 rounded-full flex items-center justify-center flex-shrink-0">
                                                        <i class="fas fa-hand-holding-heart text-[#8AD337]"></i>
                                                    </div>
                                                    <div>
                                                        <p class="font-semibold text-gray-800">
                                                            {{ $item->program ? $item->program->judul : 'Program Tidak Ditemukan' }}
                                                        </p>
                                                        <p class="text-xs text-gray-500">
                                                            <i class="far fa-calendar-alt mr-1"></i>
                                                            {{ $item->created_at->format('d F Y H:i') }} WIB
                                                        </p>
                                                        @if($item->status == 'cancelled' && $item->admin_note)
                                                            <p class="text-xs text-red-500 mt-1">
                                                                <i class="fas fa-info-circle mr-1"></i>
                                                                Alasan: {{ Str::limit($item->admin_note, 50) }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <p class="font-bold 
                                                        @if($item->status == 'confirmed') text-[#8AD337]
                                                        @elseif($item->status == 'cancelled') text-red-500
                                                        @elseif($item->status == 'pending') text-yellow-500
                                                        @else text-gray-500 @endif">
                                                        Rp {{ number_format($item->nominal, 0, ',', '.') }}
                                                    </p>
                                                    @if ($item->status == 'confirmed')
                                                        <span
                                                            class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">
                                                            <i class="fas fa-check-circle mr-1"></i>Terkonfirmasi
                                                        </span>
                                                    @elseif($item->status == 'pending')
                                                        <span
                                                            class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full">
                                                            <i class="fas fa-hourglass-half mr-1"></i>Menunggu
                                                        </span>
                                                    @elseif($item->status == 'cancelled')
                                                        <span
                                                            class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded-full">
                                                            <i class="fas fa-times-circle mr-1"></i>Ditolak
                                                        </span>
                                                    @else
                                                        <span
                                                            class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded-full">
                                                            <i class="fas fa-hourglass-end mr-1"></i>Kadaluarsa
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-10">
                                        <i class="fas fa-inbox text-5xl text-gray-300 mb-3"></i>
                                        <p class="text-gray-500">Belum ada donasi</p>
                                        <a href="{{ route('programs') }}"
                                            class="inline-block mt-4 bg-[#8AD337] text-[#183D57] px-6 py-2 rounded-full font-semibold hover:shadow-lg transition">
                                            <i class="fas fa-hand-holding-heart mr-2"></i>Mulai Donasi
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Tips & Informasi -->
                    <div class="space-y-6">
                        <div class="bg-gradient-to-r from-[#8AD337]/10 to-[#183D57]/10 rounded-2xl p-6">
                            <div class="flex items-start gap-4">
                                <i class="fas fa-lightbulb text-3xl text-[#8AD337]"></i>
                                <div>
                                    <h4 class="font-bold text-[#183D57]">Tips Donasi</h4>
                                    <p class="text-gray-600 text-sm mt-2">
                                        Donasi Anda akan langsung disalurkan kepada yang membutuhkan. Setiap donasi akan
                                        mendapatkan bukti transaksi dan laporan penyaluran.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Statistik Singkat -->
                        <div class="bg-white rounded-2xl shadow-md p-6">
                            <h4 class="font-bold text-[#183D57] mb-3">Ringkasan Donasi</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Total Donasi</span>
                                    <span class="font-semibold text-[#183D57]">Rp {{ number_format($totalDonasi ?? 0, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Program Diikuti</span>
                                    <span class="font-semibold text-[#183D57]">{{ $jumlahDonasi ?? 0 }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Menunggu Konfirmasi</span>
                                    <span class="font-semibold text-yellow-600">{{ $donasiPending ?? 0 }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Ditolak</span>
                                    <span class="font-semibold text-red-600">{{ $donasiDitolak ?? 0 }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-[#183D57] rounded-2xl p-6 text-center">
                            <i class="fas fa-hand-holding-heart text-4xl text-[#8AD337] mb-3"></i>
                            <h4 class="font-bold text-white mb-2">Ingin Berdonasi Lagi?</h4>
                            <p class="text-white/80 text-sm mb-4">Bantu lebih banyak orang yang membutuhkan</p>
                            <a href="{{ route('programs') }}"
                                class="inline-block bg-[#8AD337] text-[#183D57] px-6 py-2 rounded-full font-semibold hover:shadow-lg transition w-full">
                                <i class="fas fa-heart mr-2"></i>Donasi Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection