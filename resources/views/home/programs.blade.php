@extends('layouts.app')

@section('title', 'Program Donasi - Energi Bahagia')

@section('content')
    <!-- Hero Section Program -->
    <section class="relative hero-pattern text-white py-20 overflow-hidden">
        <div class="absolute inset-0 bg-black/30"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#183D57]/30 to-[#8AD337]/30 mix-blend-overlay"></div>

        <div class="absolute top-20 left-10 w-72 h-72 bg-[#8AD337] rounded-full filter blur-3xl opacity-20 animate-pulse">
        </div>
        <div
            class="absolute bottom-20 right-10 w-96 h-96 bg-[#183D57] rounded-full filter blur-3xl opacity-20 animate-pulse delay-1000">
        </div>

        <div class="container mx-auto px-6 relative z-10 text-center">
            <div
                class="inline-block px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-sm font-semibold mb-6 border border-[#8AD337]/30">
                <i class="fas fa-hand-holding-heart mr-2 text-[#8AD337]"></i>
                <span class="text-white">PROGRAM DONASI</span>
            </div>
            <h1 class="text-5xl md:text-7xl font-bold mb-4 font-playfair">
                <span class="bg-gradient-to-r from-[#8AD337] to-white bg-clip-text text-transparent">
                    Donasi Untuk
                </span>
                <br>Masa Depan Mereka
            </h1>
            <p class="text-xl text-white/90 max-w-2xl mx-auto">
                Setiap donasi Anda adalah harapan baru bagi mereka yang membutuhkan.
                Pilih program donasi yang sesuai dengan hati Anda.
            </p>
        </div>
    </section>

    <!-- Filter & Search Section -->
    <section class="py-10 bg-white border-b border-gray-100 sticky top-[72px] z-40 shadow-sm">
        <div class="container mx-auto px-6">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <!-- Filter Kategori -->
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('programs') }}"
                        class="px-5 py-2 {{ !request()->get('kategori') ? 'bg-[#8AD337] text-[#183D57]' : 'bg-gray-100 text-gray-600' }} rounded-full text-sm font-semibold hover:shadow-md transition-all">
                        Semua Program
                    </a>
                    @foreach ($kategoris as $kategori)
                        <a href="{{ route('programs', array_filter(['kategori' => $kategori->slug, 'search' => request('search')])) }}"
                            class="px-5 py-2 {{ request()->get('kategori') == $kategori->slug ? 'bg-[#8AD337] text-[#183D57]' : 'bg-gray-100 text-gray-600' }} rounded-full text-sm font-medium hover:bg-[#8AD337] hover:text-[#183D57] transition-all">
                            {{ $kategori->nama_kategori }}
                        </a>
                    @endforeach
                </div>

                <!-- Search Box -->
                <div class="flex items-center">
                    <div class="relative">
                        <form action="{{ route('programs') }}" method="GET">
                            @if (request()->filled('kategori'))
                                <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                            @endif
                            <input type="text" name="search" placeholder="Cari program donasi..."
                                value="{{ request()->get('search') }}"
                                class="w-64 md:w-80 px-4 py-2 pr-10 border border-gray-300 rounded-full focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20 transition-all">
                            <button type="submit"
                                class="absolute right-2 top-1/2 -translate-y-1/2 bg-[#8AD337] text-[#183D57] px-3 py-1 rounded-full text-sm font-semibold hover:bg-[#183D57] hover:text-white transition-all">
                                Cari
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Program Unggulan Section -->
    <section class="py-12 bg-gradient-to-r from-[#8AD337]/5 to-[#183D57]/5">
        <div class="container mx-auto px-6">
            <div class="text-center mb-10">
                <span class="badge-premium">PROGRAM UNGGULAN</span>
                <h2 class="text-3xl md:text-4xl font-bold text-[#183D57] mt-3 font-playfair">Program Donasi Aktif</h2>
                <p class="text-gray-600 mt-2">Pilih program donasi yang sesuai dengan hati Anda. Setiap kontribusi berarti
                    bagi mereka.</p>
            </div>
        </div>
    </section>

    <!-- Daftar Program Donasi -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($programs as $program)
                    <!-- Program dari Database -->
                    <div
                        class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 group">
                        <div class="relative h-56 overflow-hidden">
                            @if ($program->gambar && file_exists(public_path('uploads/program/' . $program->gambar)))
                                <img src="{{ asset('uploads/program/' . $program->gambar) }}" alt="{{ $program->judul }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <img src="https://placehold.co/600x400/png?text={{ urlencode($program->judul) }}"
                                    alt="{{ $program->judul }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @endif
                            <div
                                class="absolute top-3 right-3 bg-[#8AD337] text-[#183D57] px-3 py-1 rounded-full text-xs font-bold">
                                {{ $program->kategori->nama_kategori ?? 'Program' }}
                            </div>
                        </div>
                        <div class="p-5">
                            <h3 class="text-xl font-bold text-[#183D57] mb-2 group-hover:text-[#8AD337] transition-colors">
                                {{ $program->judul }}
                            </h3>
                            <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $program->deskripsi_singkat }}</p>

                            <div class="mb-4">
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-500">Terkumpul</span>
                                    <span class="font-bold text-[#8AD337]">{{ $program->progress }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-[#8AD337] h-2 rounded-full" style="width: {{ $program->progress }}%">
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-between items-center mb-4 text-sm">
                                <div>
                                    <p class="text-gray-400 text-xs">Terkumpul</p>
                                    <p class="font-bold text-[#183D57]">Rp
                                        {{ number_format($program->dana_terkumpul, 0, ',', '.') }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs">Target</p>
                                    <p class="font-bold text-[#183D57]">Rp
                                        {{ number_format($program->target_dana, 0, ',', '.') }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs">Penerima</p>
                                    <p class="font-bold text-[#183D57]">{{ number_format($program->penerima) }} Orang</p>
                                </div>
                            </div>

                            <a href="{{ route('donation.detail', $program->slug) }}"
                                class="block text-center bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] py-3 rounded-xl font-bold hover:shadow-lg transition-all duration-300 hover:scale-105">
                                Donasi Sekarang
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-20">
                        <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">
                            @if (request()->filled('search'))
                                Program dengan kata kunci "{{ request('search') }}" tidak ditemukan.
                            @else
                                Belum ada program donasi
                            @endif
                        </p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-12">
                {{ $programs->links() }}
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-20 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-[#183D57] to-[#2a5a7a]"></div>
        <div class="absolute inset-0 bg-black opacity-20"></div>

        <div class="absolute top-0 left-0 w-full h-full">
            <div
                class="absolute top-10 left-10 w-64 h-64 bg-[#8AD337] rounded-full filter blur-3xl opacity-20 animate-pulse">
            </div>
            <div
                class="absolute bottom-10 right-10 w-80 h-80 bg-[#8AD337] rounded-full filter blur-3xl opacity-20 animate-pulse delay-1000">
            </div>
        </div>

        <div class="container mx-auto px-6 text-center relative z-10">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-4 font-playfair">Masih Ragu Untuk Berdonasi?</h2>
            <p class="text-xl mb-8 text-white/90 max-w-2xl mx-auto">
                Hubungi tim kami untuk konsultasi tentang program donasi yang tepat untuk Anda.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('contact') }}"
                    class="group bg-[#8AD337] text-[#183D57] px-8 py-4 rounded-full font-bold hover:bg-[#7BC42F] transition-all duration-300 transform hover:scale-105 inline-flex items-center justify-center gap-2">
                    <i class="fas fa-headset"></i>
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection
