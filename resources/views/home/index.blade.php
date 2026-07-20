@extends('layouts.app')

@section('title', 'Beranda - Energi Bahagia')

@section('content')
    @php
        use App\Models\HeroSection;
        $hero = HeroSection::first();
    @endphp

    <!-- Hero Section Premium - Data dari Database -->
    @if ($hero)
        <section class="relative hero-pattern text-white py-24 overflow-hidden">
            <div class="absolute inset-0 bg-black/30"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#183D57]/30 to-[#8AD337]/30 mix-blend-overlay"></div>

            <div
                class="absolute top-20 left-10 w-72 h-72 bg-[#8AD337] rounded-full filter blur-3xl opacity-20 animate-pulse">
            </div>
            <div
                class="absolute bottom-20 right-10 w-96 h-96 bg-[#183D57] rounded-full filter blur-3xl opacity-20 animate-pulse delay-1000">
            </div>

            <div class="container mx-auto px-6 relative z-10">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="md:w-1/2 mb-12 md:mb-0">
                        <div
                            class="inline-block px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-sm font-semibold mb-6 border border-[#8AD337]/30">
                            <i class="fas fa-star mr-2 text-[#8AD337]"></i>
                            <span class="text-white">{{ $hero->badge_text }}</span>
                        </div>

                        <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                            {{ $hero->title_first }}
                            <span class="bg-gradient-to-r from-[#8AD337] to-white bg-clip-text text-transparent">
                                {{ $hero->title_highlight }}
                            </span>
                            <br>{{ $hero->title_last }}
                        </h1>

                        <p class="text-xl mb-8 text-gray-200 max-w-lg">
                            {{ $hero->description }}
                        </p>

                        <div class="flex flex-wrap gap-4">
                            <a href="{{ $hero->button_primary_link }}"
                                class="group bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] px-8 py-4 rounded-full font-bold hover:shadow-2xl transition-all duration-300 transform hover:scale-105 flex items-center border-2 border-transparent hover:border-white">
                                {{ $hero->button_primary_text }}
                                <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
                            </a>
                            <a href="{{ $hero->button_secondary_link }}"
                                class="group border-2 border-white text-white px-8 py-4 rounded-full font-bold hover:bg-[#8AD337] hover:text-[#183D57] hover:border-[#8AD337] transition-all duration-300 flex items-center">
                                <i class="fas fa-play-circle mr-2"></i>
                                {{ $hero->button_secondary_text }}
                            </a>
                        </div>
                    </div>

                    <div class="md:w-1/2 flex justify-center relative">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-[#8AD337] to-[#183D57] rounded-full filter blur-3xl opacity-30">
                        </div>
                        @if ($hero->hero_image && file_exists(public_path('uploads/hero/' . $hero->hero_image)))
                            <img src="{{ asset('uploads/hero/' . $hero->hero_image) }}" alt="Hero Image"
                                class="rounded-3xl shadow-2xl w-full max-w-md h-auto object-cover floating border-4 border-[#8AD337]/30">
                        @else
                            <img src="https://placehold.co/600x400/png?text=Hero+Image" alt="Hero Image"
                                class="rounded-3xl shadow-2xl w-full max-w-md h-auto object-cover floating border-4 border-[#8AD337]/30">
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Program Unggulan -->
    @php
        use App\Models\ProgramDonasi;
        $programs = ProgramDonasi::where('status', 'Aktif')->orderBy('created_at', 'desc')->take(3)->get();
    @endphp

    @if ($programs->count() > 0)
        <section class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <span class="badge-premium">PROGRAM DONASI</span>
                    <h2 class="text-4xl md:text-5xl font-bold text-[#183D57] mb-4 mt-2 font-playfair">Program Terbaru Kami
                    </h2>
                    <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                        Pilih program donasi yang sesuai dengan hati Anda. Setiap kontribusi berarti bagi mereka.
                    </p>
                    <div class="divider-premium"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($programs as $program)
                        <!-- Program {{ $loop->iteration }} -->
                        <div
                            class="group bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-[#8AD337]/10">
                            <div class="relative overflow-hidden h-56">
                                @if ($program->gambar && file_exists(public_path('uploads/program/' . $program->gambar)))
                                    <img src="{{ asset('uploads/program/' . $program->gambar) }}"
                                        alt="{{ $program->judul }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                @else
                                    <img src="https://placehold.co/600x400/png?text={{ urlencode($program->judul) }}"
                                        alt="{{ $program->judul }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                @endif
                                <div
                                    class="absolute top-4 right-4 bg-gradient-to-r from-[#8AD337] to-[#183D57] text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                                    {{ $program->kategori->nama_kategori ?? 'Program' }}
                                </div>
                            </div>
                            <div class="p-8">
                                <h3 class="text-2xl font-bold text-[#183D57] mb-3">{{ $program->judul }}</h3>
                                <p class="text-gray-600 mb-6 line-clamp-2">{{ $program->deskripsi_singkat }}</p>

                                <div class="mb-6">
                                    <div class="flex justify-between text-sm mb-2">
                                        <span class="text-gray-600">Terkumpul</span>
                                        <span class="font-bold text-[#8AD337]">
                                            Rp {{ number_format($program->dana_terkumpul, 0, ',', '.') }} /
                                            Rp {{ number_format($program->target_dana, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-gradient-to-r from-[#8AD337] to-[#183D57] h-3 rounded-full"
                                            style="width: {{ $program->progress }}%"></div>
                                    </div>
                                </div>

                                <div class="flex justify-between items-center">
                                    <div class="flex items-center text-gray-500">
                                        <i class="fas fa-users mr-2 text-[#8AD337]"></i>
                                        <span class="text-sm">{{ number_format($program->penerima) }} Penerima</span>
                                    </div>
                                    <a href="{{ route('donation.detail', $program->slug) }}"
                                        class="bg-gradient-to-r from-[#8AD337] to-[#183D57] text-white px-6 py-3 rounded-xl hover:shadow-lg transition-all duration-300 text-sm font-medium group-hover:scale-105">
                                        Donasi Sekarang
                                        <i
                                            class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-12">
                    <a href="{{ route('programs') }}"
                        class="inline-flex items-center gap-2 text-[#183D57] font-semibold hover:text-[#8AD337] transition-colors">
                        Lihat Semua Program
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- Kategori Program Section - PILAR UTAMA PROGRAM -->
    @php
        use App\Models\KategoriProgram;
        $kategoris = KategoriProgram::where('is_active', true)->orderBy('urutan', 'asc')->get();
    @endphp

    @if ($kategoris->count() > 0)
        <section class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <span
                        class="inline-block px-4 py-2 bg-gradient-to-r from-[#8AD337]/10 to-[#183D57]/10 border border-[#8AD337]/30 rounded-full text-sm font-semibold text-[#183D57] mb-4">
                        PROGRAM KAMI
                    </span>
                    <h2 class="text-4xl md:text-5xl font-bold text-[#183D57] mb-4 mt-2 font-playfair">
                        {{ $kategoris->count() }} Pilar Utama Program
                    </h2>
                    <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                        Program-program kami berfokus pada {{ $kategoris->count() }} pilar utama untuk memberikan dampak
                        yang berkelanjutan.
                    </p>
                    <div class="w-24 h-1 bg-gradient-to-r from-[#8AD337] to-[#183D57] mx-auto mt-6 rounded-full"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-{{ $kategoris->count() }} gap-6">
                    @foreach ($kategoris as $kategori)
                        <!-- Pilar {{ $loop->iteration }}: {{ $kategori->nama_kategori }} -->
                        <div
                            class="bg-gradient-to-br from-white to-gray-50 rounded-3xl p-6 relative border border-[#8AD337]/20 group hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-[#8AD337]/20 to-[#183D57]/20 rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:scale-110 transition-transform duration-300">
                                <i class="fas {{ $kategori->icon ?? 'fa-tag' }} text-4xl"
                                    style="color: {{ $kategori->warna ?? '#183D57' }}"></i>
                            </div>
                            <h4 class="font-bold text-[#183D57] text-xl text-center mb-3">{{ $kategori->nama_kategori }}
                            </h4>
                            <p class="text-gray-600 text-center text-sm">
                                {{ $kategori->deskripsi ?? 'Memberikan kontribusi positif melalui program-program unggulan.' }}
                            </p>
                        </div>
                    @endforeach
                </div>

                <!-- Tombol Lihat Semua Program -->
                <div class="text-center mt-12">
                    <a href="{{ route('programs') }}"
                        class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-[#8AD337] to-[#183D57] text-white font-semibold rounded-full hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                        Lihat Semua Program
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- CTA Section -->
    <section class="relative py-32 overflow-hidden">
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
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 font-playfair">Siap Membantu Sesama?</h2>
            <p class="text-xl mb-10 text-white/90 max-w-2xl mx-auto">
                Bergabunglah dengan ribuan donatur lainnya untuk menebar kebaikan.
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                <a href="{{ route('programs') }}"
                    class="group bg-[#8AD337] text-[#183D57] px-10 py-5 rounded-full font-bold hover:shadow-2xl transition-all duration-300 transform hover:scale-105 text-lg inline-flex items-center justify-center border-2 border-white/30">
                    <i class="fas fa-heart mr-3"></i>
                    Donasi Sekarang
                    <i class="fas fa-arrow-right ml-3 group-hover:translate-x-2 transition-transform"></i>
                </a>
                <a href="{{ route('contact') }}"
                    class="group border-2 border-white text-white px-10 py-5 rounded-full font-bold hover:bg-[#8AD337] hover:text-[#183D57] hover:border-[#8AD337] transition-all duration-300 transform hover:scale-105 text-lg inline-flex items-center justify-center">
                    <i class="fas fa-headset mr-3"></i>
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>
@endsection
