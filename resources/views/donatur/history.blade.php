@extends('layouts.app')

@section('title', 'Riwayat Donasi - Energi Bahagia')

@section('content')
    <section class="py-20 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-6">
            <div class="max-w-5xl mx-auto">

                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-[#183D57]">Riwayat Donasi</h1>
                    <p class="text-gray-500">Riwayat donasi yang telah Anda lakukan</p>
                </div>

                <!-- Filter Status -->
                <div class="bg-white rounded-2xl shadow-sm p-4 mb-6">
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('donation.history') }}"
                            class="px-4 py-2 rounded-full text-sm font-medium {{ !request()->get('status') ? 'bg-[#8AD337] text-[#183D57]' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                            Semua
                        </a>
                        <a href="{{ route('donation.history', ['status' => 'confirmed']) }}"
                            class="px-4 py-2 rounded-full text-sm font-medium {{ request()->get('status') == 'confirmed' ? 'bg-[#8AD337] text-[#183D57]' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                            <i class="fas fa-check-circle mr-1 text-green-500"></i> Terkonfirmasi
                        </a>
                        <a href="{{ route('donation.history', ['status' => 'pending']) }}"
                            class="px-4 py-2 rounded-full text-sm font-medium {{ request()->get('status') == 'pending' ? 'bg-[#8AD337] text-[#183D57]' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                            <i class="fas fa-clock mr-1 text-yellow-500"></i> Menunggu
                        </a>
                        <a href="{{ route('donation.history', ['status' => 'expired']) }}"
                            class="px-4 py-2 rounded-full text-sm font-medium {{ request()->get('status') == 'expired' ? 'bg-[#8AD337] text-[#183D57]' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                            <i class="fas fa-hourglass-end mr-1 text-gray-500"></i> Kadaluarsa
                        </a>
                        <a href="{{ route('donation.history', ['status' => 'cancelled']) }}"
                            class="px-4 py-2 rounded-full text-sm font-medium {{ request()->get('status') == 'cancelled' ? 'bg-red-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                            <i class="fas fa-times-circle mr-1 text-red-500"></i> Ditolak
                        </a>
                    </div>
                </div>

                <!-- Daftar Donasi -->
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    @if ($donasis->count() > 0)
                        <div class="divide-y divide-gray-200">
                            @foreach ($donasis as $donasi)
                                <div class="p-6 hover:bg-gray-50 transition">
                                    <div class="flex flex-col md:flex-row justify-between gap-4">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-3 mb-2">
                                                <div class="w-10 h-10 bg-[#8AD337]/20 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-hand-holding-heart text-[#8AD337]"></i>
                                                </div>
                                                <div>
                                                    <h3 class="font-bold text-[#183D57]">
                                                        {{ $donasi->program ? $donasi->program->judul : 'Program Tidak Ditemukan' }}
                                                    </h3>
                                                    <p class="text-xs text-gray-500">
                                                        {{ $donasi->created_at->format('d F Y H:i') }} WIB</p>
                                                </div>
                                            </div>
                                            <div class="ml-12 space-y-1">
                                                <p class="text-sm text-gray-600">
                                                    <span class="font-medium">Bank:</span>
                                                    {{ $donasi->bank ? $donasi->bank->nama_bank : '-' }}
                                                </p>
                                                <p class="text-sm text-gray-600">
                                                    <span class="font-medium">Kode Unik:</span>
                                                    <span class="font-mono">{{ $donasi->kode_unik }}</span>
                                                </p>
                                                @if($donasi->status == 'cancelled' && $donasi->admin_note)
                                                    <p class="text-sm text-red-600">
                                                        <span class="font-medium">Alasan Ditolak:</span>
                                                        {{ $donasi->admin_note }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-2xl font-bold 
                                                @if($donasi->status == 'confirmed') text-[#8AD337]
                                                @elseif($donasi->status == 'cancelled') text-red-500
                                                @elseif($donasi->status == 'pending') text-yellow-500
                                                @else text-gray-500 @endif">
                                                Rp {{ number_format($donasi->nominal, 0, ',', '.') }}
                                            </p>
                                            @if ($donasi->status == 'confirmed')
                                                <span class="inline-block mt-1 px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                                    <i class="fas fa-check-circle mr-1"></i> Terkonfirmasi
                                                </span>
                                            @elseif($donasi->status == 'pending')
                                                <span class="inline-block mt-1 px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">
                                                    <i class="fas fa-clock mr-1"></i> Menunggu
                                                </span>
                                            @elseif($donasi->status == 'cancelled')
                                                <span class="inline-block mt-1 px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">
                                                    <i class="fas fa-times-circle mr-1"></i> Ditolak
                                                </span>
                                            @else
                                                <span class="inline-block mt-1 px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-semibold">
                                                    <i class="fas fa-hourglass-end mr-1"></i> Kadaluarsa
                                                </span>
                                            @endif

                                            <div class="mt-3">
                                                <a href="{{ route('user.donation.detail', $donasi->id) }}"
                                                    class="text-[#8AD337] hover:text-[#183D57] text-sm font-medium">
                                                    Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="px-6 py-4 border-t border-gray-200">
                            {{ $donasis->links() }}
                        </div>
                    @else
                        <div class="text-center py-16">
                            <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500">Belum ada riwayat donasi</p>
                            <a href="{{ route('programs') }}"
                                class="inline-block mt-4 bg-[#8AD337] text-[#183D57] px-6 py-2 rounded-full font-semibold hover:shadow-lg transition">
                                Mulai Donasi
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection