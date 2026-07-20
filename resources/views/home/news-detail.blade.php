@extends('layouts.app')

@section('title', $berita->judul . ' - Energi Bahagia')

@section('content')
    <!-- Hero Section Detail Berita -->
    <section class="relative hero-pattern text-white py-16 overflow-hidden">
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
                <span class="text-white">Detail Berita</span>
            </div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 font-playfair leading-tight">
                {{ $berita->judul }}
            </h1>
        </div>
    </section>

    <!-- Breadcrumb -->
    <div class="bg-gray-100 py-3 border-b border-gray-200">
        <div class="container mx-auto px-6">
            <div class="flex items-center gap-2 text-sm flex-wrap">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-[#8AD337] transition-colors">
                    <i class="fas fa-home"></i> Beranda
                </a>
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                <a href="{{ route('news') }}" class="text-gray-500 hover:text-[#8AD337] transition-colors">Berita</a>
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                <span class="text-[#183D57] font-medium line-clamp-1">{{ Str::limit($berita->judul, 50) }}</span>
            </div>
        </div>
    </div>

    <!-- Detail Berita -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="max-w-5xl mx-auto">

                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <!-- Gambar Besar - FULL WIDTH & TINGGI -->
                    @if ($berita->gambar && file_exists(public_path('uploads/berita/' . $berita->gambar)))
                        <div class="relative w-full">
                            <img src="{{ asset('uploads/berita/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                                class="w-full h-[400px] md:h-[500px] lg:h-[550px] object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8">
                                <div
                                    class="inline-block bg-[#8AD337] text-[#183D57] px-5 py-2.5 rounded-full text-sm font-semibold shadow-lg">
                                    <i class="far fa-calendar-alt mr-2"></i>
                                    {{ $berita->tanggal_publish ? $berita->tanggal_publish->format('d F Y') : '-' }}
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Placeholder jika tidak ada gambar -->
                        <div
                            class="relative w-full bg-gradient-to-r from-[#183D57] to-[#2a5a7a] h-[400px] md:h-[500px] flex items-center justify-center">
                            <div class="text-center text-white">
                                <i class="fas fa-newspaper text-6xl mb-4 opacity-50"></i>
                                <p class="text-xl font-semibold">{{ $berita->judul }}</p>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8">
                                <div
                                    class="inline-block bg-[#8AD337] text-[#183D57] px-5 py-2.5 rounded-full text-sm font-semibold shadow-lg">
                                    <i class="far fa-calendar-alt mr-2"></i>
                                    {{ $berita->tanggal_publish ? $berita->tanggal_publish->format('d F Y') : '-' }}
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="p-6 md:p-10">
                        <!-- Informasi Penulis & Statistik -->
                        <div class="flex flex-wrap items-center gap-4 mb-6 pb-4 border-b border-gray-200">

                            @if ($berita->kategori)
                                <div class="flex items-center gap-2 bg-gray-100 px-3 py-1.5 rounded-full">
                                    <i class="fas fa-tag text-[#8AD337] text-sm"></i>
                                    <span class="text-gray-600 text-sm">{{ $berita->kategori }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Konten Berita -->
                        <div class="prose prose-lg max-w-none">
                            <div class="text-gray-700 leading-relaxed space-y-4">
                                {!! nl2br(e($berita->konten)) !!}
                            </div>
                        </div>
                        <div class="mt-8 text-center">
                            <a href="/gallery"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold shadow-sm transition-all duration-300 hover:scale-105 hover:shadow-md"
                            style="background-color: #8EDB2D; color: #17456E;">
                                <i class="fas fa-camera"></i>
                                Dokumentasi Foto Kegiatan
                            </a>
                        </div>

                        <!-- Share Section -->
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                               
                                <a href="{{ route('news') }}"
                                    class="inline-flex items-center gap-2 text-[#8AD337] font-semibold hover:text-[#183D57] transition-colors">
                                    <i class="fas fa-arrow-left"></i>
                                    Kembali ke Daftar Berita
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Berita Lainnya -->
                @if (isset($relatedBeritas) && $relatedBeritas->count() > 0)
                    <div class="mt-12">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-bold text-[#183D57] font-playfair">Berita Lainnya</h3>
                            <a href="{{ route('news') }}" class="text-[#8AD337] hover:text-[#183D57] text-sm font-medium">
                                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                        <div class="grid md:grid-cols-2 gap-6">
                            @foreach ($relatedBeritas as $related)
                                <a href="{{ route('berita.detail', $related->slug) }}"
                                    class="group flex items-center gap-4 p-4 bg-white rounded-xl hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-100">
                                    @if ($related->gambar && file_exists(public_path('uploads/berita/' . $related->gambar)))
                                        <img src="{{ asset('uploads/berita/' . $related->gambar) }}"
                                            class="w-20 h-20 object-cover rounded-lg group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400 text-2xl"></i>
                                        </div>
                                    @endif
                                    <div class="flex-1">
                                        <p class="text-xs text-[#8AD337] font-medium mb-1">
                                            <i class="far fa-calendar-alt mr-1"></i>
                                            {{ $related->tanggal_publish->format('d M Y') }}
                                        </p>
                                        <h4
                                            class="font-semibold text-[#183D57] group-hover:text-[#8AD337] transition-colors line-clamp-2">
                                            {{ $related->judul }}
                                        </h4>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
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
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 font-playfair">Ingin Mendapatkan Update Terbaru?</h2>
            <p class="text-lg mb-8 text-white/90 max-w-2xl mx-auto">
                Ikuti terus berita dan kegiatan terbaru dari Yayasan Energi Bahagia Indonesia
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="#"
                    class="group bg-[#8AD337] text-[#183D57] px-8 py-3 rounded-full font-bold hover:shadow-2xl transition-all duration-300 transform hover:scale-105 inline-flex items-center justify-center gap-2">
                    <i class="fab fa-instagram"></i>
                    Follow Instagram
                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="#"
                    class="group border-2 border-white text-white px-8 py-3 rounded-full font-bold hover:bg-[#8AD337] hover:text-[#183D57] hover:border-[#8AD337] transition-all duration-300 transform hover:scale-105 inline-flex items-center justify-center gap-2">
                    <i class="fab fa-facebook-f"></i>
                    Like Facebook
                </a>
            </div>
        </div>
    </section>

    <style>
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .prose {
            line-height: 1.8;
        }

        .prose p {
            margin-bottom: 1.2rem;
        }
    </style>
@endsection
