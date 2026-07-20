@extends('layouts.app')

@section('title', 'Detail Donasi - Energi Bahagia')

@section('content')
    <section class="py-20 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto">

                <div class="mb-6">
                    <a href="{{ route('donation.history') }}" class="text-[#8AD337] hover:text-[#183D57] transition">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Riwayat
                    </a>
                </div>

                <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                    <!-- Header Status -->
                    <div
                        class="px-6 py-4 text-white text-center
                    @if ($donasi->status == 'confirmed') bg-gradient-to-r from-[#8AD337] to-[#6fb32e]
                    @elseif($donasi->status == 'pending') bg-gradient-to-r from-yellow-500 to-yellow-600
                    @else bg-gradient-to-r from-red-500 to-red-600 @endif">
                        @if ($donasi->status == 'confirmed')
                            <i class="fas fa-check-circle text-3xl mb-2"></i>
                            <h2 class="text-xl font-bold">Donasi Terkonfirmasi</h2>
                            <p class="text-white/80 text-sm">Terima kasih atas donasi Anda</p>
                        @elseif($donasi->status == 'pending')
                            <i class="fas fa-clock text-3xl mb-2"></i>
                            <h2 class="text-xl font-bold">Menunggu Konfirmasi</h2>
                            <p class="text-white/80 text-sm">Donasi Anda sedang diverifikasi</p>
                        @else
                            <i class="fas fa-times-circle text-3xl mb-2"></i>
                            <h2 class="text-xl font-bold">Donasi Kadaluarsa</h2>
                            <p class="text-white/80 text-sm">Waktu pembayaran telah habis</p>
                        @endif
                    </div>

                    <div class="p-6 md:p-8">
                        <!-- Detail Donasi -->
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-[#183D57] mb-4 flex items-center gap-2">
                                <i class="fas fa-receipt text-[#8AD337]"></i> Detail Donasi
                            </h3>
                            <div class="bg-gray-50 rounded-xl p-4 space-y-3">
                                <div class="flex justify-between border-b border-gray-200 pb-2">
                                    <span class="text-gray-500">Kode Unik</span>
                                    <span class="font-mono font-bold">{{ $donasi->kode_unik }}</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-200 pb-2">
                                    <span class="text-gray-500">Program Donasi</span>
                                    <span
                                        class="font-semibold">{{ $donasi->program ? $donasi->program->judul : '-' }}</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-200 pb-2">
                                    <span class="text-gray-500">Nominal Donasi</span>
                                    <span class="font-bold text-[#8AD337] text-lg">Rp
                                        {{ number_format($donasi->nominal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-200 pb-2">
                                    <span class="text-gray-500">Bank Tujuan</span>
                                    <span class="font-semibold">{{ $donasi->bank ? $donasi->bank->nama_bank : '-' }}</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-200 pb-2">
                                    <span class="text-gray-500">No. Rekening Tujuan</span>
                                    <span class="font-semibold">{{ $donasi->bank ? $donasi->bank->nomor_rekening : '-' }}
                                        a.n {{ $donasi->bank ? $donasi->bank->atas_nama : '-' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Waktu Donasi</span>
                                    <span>{{ $donasi->created_at->format('d F Y H:i') }} WIB</span>
                                </div>
                            </div>
                        </div>

                        <!-- Data Diri -->
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-[#183D57] mb-4 flex items-center gap-2">
                                <i class="fas fa-user text-[#8AD337]"></i> Data Diri
                            </h3>
                            <div class="bg-gray-50 rounded-xl p-4 space-y-3">
                                <div class="flex justify-between border-b border-gray-200 pb-2">
                                    <span class="text-gray-500">Nama Lengkap</span>
                                    <span class="font-semibold">{{ $donasi->nama }}</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-200 pb-2">
                                    <span class="text-gray-500">Email</span>
                                    <span>{{ $donasi->email }}</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-200 pb-2">
                                    <span class="text-gray-500">Nomor Telepon</span>
                                    <span>{{ $donasi->phone }}</span>
                                </div>
                                @if ($donasi->pesan)
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Doa / Pesan</span>
                                        <span class="italic">"{{ $donasi->pesan }}"</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Catatan Admin -->
                        @if ($donasi->admin_note)
                            <div class="mb-6 p-4 bg-blue-50 rounded-xl border border-blue-200">
                                <div class="flex items-start gap-3">
                                    <i class="fas fa-sticky-note text-blue-500"></i>
                                    <div>
                                        <p class="font-semibold text-blue-800">Catatan dari Admin</p>
                                        <p class="text-blue-700 text-sm">{{ $donasi->admin_note }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Bukti Transfer -->
                        @if ($donasi->bukti_transfer)
                            <div class="mb-6">
                                <h3 class="text-lg font-bold text-[#183D57] mb-4 flex items-center gap-2">
                                    <i class="fas fa-image text-[#8AD337]"></i> Bukti Transfer
                                </h3>
                                <div class="bg-gray-50 rounded-xl p-4 text-center">
                                    <img src="{{ asset('uploads/bukti/' . $donasi->bukti_transfer) }}" alt="Bukti Transfer"
                                        class="max-w-full rounded-lg mx-auto max-h-64">
                                </div>
                            </div>
                        @endif

                        <!-- Tombol Aksi dengan PDF -->
                        <div class="flex flex-wrap gap-3">
                            @if ($donasi->status == 'confirmed')
                                <!-- Tombol Download PDF hanya untuk donasi yang sudah terkonfirmasi -->
                                <a href="{{ route('donation.invoice', $donasi->id) }}" target="_blank"
                                    class="flex-1 min-w-[140px] bg-gradient-to-r from-blue-500 to-blue-600 text-white text-center py-3 rounded-xl font-semibold hover:shadow-lg transition">
                                    <i class="fas fa-file-pdf mr-2"></i> Download Kwitansi
                                </a>
                            @endif

                            <a href="{{ route('programs') }}"
                                class="flex-1 min-w-[140px] bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] text-center py-3 rounded-xl font-semibold hover:shadow-lg transition">
                                <i class="fas fa-hand-holding-heart mr-2"></i> Donasi Lagi
                            </a>

                            <a href="{{ route('donation.history') }}"
                                class="flex-1 min-w-[140px] bg-gray-200 text-gray-600 text-center py-3 rounded-xl font-semibold hover:bg-gray-300 transition">
                                <i class="fas fa-history mr-2"></i> Riwayat
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
