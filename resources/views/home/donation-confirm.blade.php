@extends('layouts.app')

@section('title', 'Konfirmasi Donasi - Energi Bahagia')

@section('content')
    <section class="py-20 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto">

                <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] px-6 py-5">
                        <h3 class="text-xl font-bold text-white">Konfirmasi Donasi</h3>
                        <p class="text-white/80 text-sm">Pastikan data Anda sudah benar</p>
                    </div>

                    <div class="p-6 md:p-8">
                        <form action="{{ route('donasi.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="program_id" value="{{ $program->id }}">
                            <input type="hidden" name="bank_id" value="{{ $bank->id }}">
                            <input type="hidden" name="nominal" value="{{ $nominal }}">

                            <!-- Informasi Donasi -->
                            <div class="mb-6 p-4 bg-gray-50 rounded-xl">
                                <h4 class="font-semibold text-[#183D57] mb-3">Informasi Donasi</h4>
                                <div class="grid grid-cols-2 gap-3 text-sm">
                                    <div>
                                        <p class="text-gray-500">Program Donasi</p>
                                        <p class="font-semibold text-gray-800">{{ $program->judul }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">Bank Tujuan</p>
                                        <p class="font-semibold text-gray-800">{{ $bank->nama_bank }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">Nominal Donasi</p>
                                        <p class="font-semibold text-[#8AD337] text-lg">Rp
                                            {{ number_format($nominal, 0, ',', '.') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">No. Rekening Tujuan</p>
                                        <p class="font-semibold text-gray-800">{{ $bank->nomor_rekening }} a.n
                                            {{ $bank->atas_nama }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Diri -->
                            <div class="grid md:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <label class="block text-[#183D57] font-semibold mb-2">Nama Lengkap <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="nama"
                                        value="{{ old('nama', $nama) }}" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                                </div>
                                <div>
                                    <label class="block text-[#183D57] font-semibold mb-2">Email <span
                                            class="text-red-500">*</span></label>
                                    <input type="email" name="email"
                                        value="{{ old('email', $email) }}" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                                </div>
                                <div>
                                    <label class="block text-[#183D57] font-semibold mb-2">Nomor Telepon <span
                                            class="text-red-500">*</span></label>
                                    <input type="tel" name="phone"
                                        value="{{ old('phone', $phone) }}" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                                </div>
                                <div>
                                    <label class="block text-[#183D57] font-semibold mb-2">Doa / Pesan (Opsional)</label>
                                    <textarea name="pesan" rows="1" placeholder="Tulis doa atau pesan..."
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">{{ old('pesan', $pesan) }}</textarea>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <button type="submit"
                                    class="flex-1 bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] py-3 rounded-xl font-bold hover:shadow-lg transition">
                                    Konfirmasi & Lanjutkan
                                </button>
                                <a href="{{ route('donation.detail', $program->slug) }}"
                                    class="flex-1 bg-gray-200 text-gray-600 py-3 rounded-xl font-semibold hover:bg-gray-300 transition text-center">
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
