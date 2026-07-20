@extends('layouts.app')

@section('title', 'Berita & Kegiatan - Energi Bahagia')

@section('content')
    <!-- Hero Section Berita -->
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
                <i class="fas fa-newspaper mr-2 text-[#8AD337]"></i>
                <span class="text-white">Berita & Kegiatan</span>
            </div>
            <h1 class="text-5xl md:text-6xl font-bold mb-4 font-playfair">
                <span class="bg-gradient-to-r from-[#8AD337] to-white bg-clip-text text-transparent">
                    Berita & Kegiatan
                </span>
            </h1>
            <p class="text-xl text-white/90 max-w-2xl mx-auto">
                Rekap Berita & Kegiatan Yayasan Energi Bahagia Indonesia
            </p>
        </div>
    </section>

    <!-- Daftar Berita -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="max-w-5xl mx-auto space-y-8">

                @forelse($beritas as $berita)
                    <!-- Berita dari Database -->
                    <div
                        class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 group">
                        <div class="relative overflow-hidden h-80 md:h-96">
                            @if ($berita->gambar && file_exists(public_path('uploads/berita/' . $berita->gambar)))
                                <img src="{{ asset('uploads/berita/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <img src="https://placehold.co/1600x600/png?text={{ urlencode($berita->judul) }}"
                                    alt="{{ $berita->judul }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @endif
                            <div
                                class="absolute top-4 left-4 bg-[#8AD337] text-[#183D57] px-3 py-1 rounded-full text-xs font-semibold">
                                <i class="far fa-calendar-alt mr-1"></i>
                                {{ $berita->tanggal_publish ? $berita->tanggal_publish->format('d M Y') : '-' }}
                            </div>
                            @if ($berita->kategori)
                                <div class="absolute top-4 right-4 bg-black/50 text-white px-3 py-1 rounded-full text-xs">
                                    {{ $berita->kategori }}
                                </div>
                            @endif
                        </div>
                        <div class="p-8">
                            <div class="flex items-center gap-3 text-sm text-gray-400 mb-3">
                                {{-- <span><i class="fas fa-user mr-1"></i> {{ $berita->penulis }}</span> --}}
                                {{-- <span><i class="fas fa-eye mr-1"></i> {{ number_format($berita->views) }} views</span> --}}
                            </div>
                            <h3
                                class="text-2xl md:text-3xl font-bold text-[#183D57] mb-4 group-hover:text-[#8AD337] transition-colors">
                                {{ $berita->judul }}
                            </h3>
                            <p class="text-gray-600 mb-5 text-base leading-relaxed line-clamp-3">
                                {{ $berita->deskripsi_singkat }}
                            </p>
                            <a href="{{ route('berita.detail', $berita->slug) }}"
                                class="inline-flex items-center text-[#8AD337] font-semibold hover:text-[#183D57] transition-colors text-lg">
                                Baca Selengkapnya
                                <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 bg-white rounded-2xl">
                        <i class="fas fa-newspaper text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">Belum ada berita</p>
                    </div>
                @endforelse

            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-12">
                {{ $beritas->links() }}
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-24 overflow-hidden">
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
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 font-playfair">Ingin Mendapatkan Update Terbaru?</h2>
            <p class="text-xl mb-10 text-white/90 max-w-2xl mx-auto">
                Ikuti terus berita dan kegiatan terbaru dari Yayasan Energi Bahagia Indonesia
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                <a href="https://www.instagram.com/energibahagia/"
                    class="group bg-[#8AD337] text-[#183D57] px-10 py-5 rounded-full font-bold hover:shadow-2xl transition-all duration-300 transform hover:scale-105 text-lg inline-flex items-center justify-center border-2 border-white/30">
                    <i class="fab fa-instagram mr-3"></i>
                    Follow Instagram
                    <i class="fas fa-arrow-right ml-3 group-hover:translate-x-2 transition-transform"></i>
                </a>
                <a href="https://www.facebook.com/official.energibahagia/"
                    class="group border-2 border-white text-white px-10 py-5 rounded-full font-bold hover:bg-[#8AD337] hover:text-[#183D57] hover:border-[#8AD337] transition-all duration-300 transform hover:scale-105 text-lg inline-flex items-center justify-center">
                    <i class="fab fa-facebook-f mr-3"></i>
                    Like Facebook
                </a>
            </div>
        </div>
    </section>

    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection
