@extends('layouts.app')

@section('title', 'Kontak - Energi Bahagia')

@section('content')
    @php
        use App\Models\Kontak;
        $kontak = Kontak::first();
    @endphp

    @if ($kontak)
        <!-- Hero Section Kontak -->
        <section class="relative hero-pattern text-white py-20 overflow-hidden">
            <!-- ... background yang sama ... -->
            <div class="container mx-auto px-6 relative z-10 text-center">
                <div
                    class="inline-block px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-sm font-semibold mb-6 border border-[#8AD337]/30">
                    <i class="fas fa-phone-alt mr-2 text-[#8AD337]"></i>
                    <span class="text-white">{{ $kontak->hero_badge }}</span>
                </div>
                <h1 class="text-5xl md:text-7xl font-bold mb-4 font-playfair">
                    <span class="bg-gradient-to-r from-[#8AD337] to-white bg-clip-text text-transparent">
                        {{ $kontak->hero_title_first }}
                    </span>
                    <br>{{ $kontak->hero_title_highlight }}
                </h1>
                <p class="text-xl text-white/90 max-w-2xl mx-auto">
                    {{ $kontak->hero_description }}
                </p>
            </div>
        </section>

        <!-- Box Kontak 4 Kolom -->
        <section class="py-20 bg-gray-50">
            <div class="container mx-auto px-6">
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Box 1 - Kantor Pusat -->
                    <div
                        class="bg-white rounded-2xl shadow-lg p-6 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group">
                        <div
                            class="w-16 h-16 bg-[#8AD337]/20 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-[#8AD337] transition-all duration-300">
                            <i
                                class="fas fa-building text-[#183D57] text-2xl group-hover:text-white transition-all duration-300"></i>
                        </div>
                        <h3 class="text-xl font-bold text-[#183D57] mb-3">Kantor Pusat</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            {!! nl2br(e($kontak->office_address)) !!}
                        </p>
                        @if ($kontak->office_map_link && $kontak->office_map_link != '#')
                            <a href="{{ $kontak->office_map_link }}" target="_blank"
                                class="inline-flex items-center gap-1 text-[#8AD337] text-sm font-semibold mt-3 hover:text-[#183D57] transition-colors">
                                Petunjuk Arah
                                <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        @endif
                    </div>

                    <!-- Box 2 - Telepon -->
                    <div
                        class="bg-white rounded-2xl shadow-lg p-6 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group">
                        <div
                            class="w-16 h-16 bg-[#8AD337]/20 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-[#8AD337] transition-all duration-300">
                            <i
                                class="fas fa-phone-alt text-[#183D57] text-2xl group-hover:text-white transition-all duration-300"></i>
                        </div>
                        <h3 class="text-xl font-bold text-[#183D57] mb-3">Telepon</h3>
                        <div class="space-y-2">
                            @if ($kontak->phone_kantor)
                                <p class="text-gray-600 text-sm">
                                    <span class="font-semibold text-[#183D57]">Kantor:</span><br>
                                    <a href="tel:{{ $kontak->phone_kantor }}"
                                        class="hover:text-[#8AD337] transition-colors">{{ $kontak->phone_kantor }}</a>
                                </p>
                            @endif
                            @if ($kontak->phone_hotline)
                                <p class="text-gray-600 text-sm">
                                    <span class="font-semibold text-[#183D57]">Hotline Donasi:</span><br>
                                    <a href="tel:{{ $kontak->phone_hotline }}"
                                        class="hover:text-[#8AD337] transition-colors">{{ $kontak->phone_hotline }}</a>
                                </p>
                            @endif
                            @if ($kontak->phone_darurat)
                                <p class="text-gray-600 text-sm">
                                    <span class="font-semibold text-[#183D57]">Darurat:</span><br>
                                    <a href="tel:{{ $kontak->phone_darurat }}"
                                        class="hover:text-[#8AD337] transition-colors">{{ $kontak->phone_darurat }}</a>
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Box 3 - Email -->
                    <div
                        class="bg-white rounded-2xl shadow-lg p-6 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group">
                        <div
                            class="w-16 h-16 bg-[#8AD337]/20 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-[#8AD337] transition-all duration-300">
                            <i
                                class="fas fa-envelope text-[#183D57] text-2xl group-hover:text-white transition-all duration-300"></i>
                        </div>
                        <h3 class="text-xl font-bold text-[#183D57] mb-3">Email</h3>
                        <div class="space-y-2">
                            @if ($kontak->email_umum)
                                <p class="text-gray-600 text-sm">
                                    <span class="font-semibold text-[#183D57]">Umum:</span><br>
                                    <a href="mailto:{{ $kontak->email_umum }}"
                                        class="hover:text-[#8AD337] transition-colors">{{ $kontak->email_umum }}</a>
                                </p>
                            @endif
                            @if ($kontak->email_donasi)
                                <p class="text-gray-600 text-sm">
                                    <span class="font-semibold text-[#183D57]">Donasi:</span><br>
                                    <a href="mailto:{{ $kontak->email_donasi }}"
                                        class="hover:text-[#8AD337] transition-colors">{{ $kontak->email_donasi }}</a>
                                </p>
                            @endif
                            @if ($kontak->email_humas)
                                <p class="text-gray-600 text-sm">
                                    <span class="font-semibold text-[#183D57]">Humas:</span><br>
                                    <a href="mailto:{{ $kontak->email_humas }}"
                                        class="hover:text-[#8AD337] transition-colors">{{ $kontak->email_humas }}</a>
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Box 4 - Media Sosial -->
                    <div
                        class="bg-white rounded-2xl shadow-lg p-6 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group">
                        <div
                            class="w-16 h-16 bg-[#8AD337]/20 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-[#8AD337] transition-all duration-300">
                            <i
                                class="fas fa-share-alt text-[#183D57] text-2xl group-hover:text-white transition-all duration-300"></i>
                        </div>
                        <h3 class="text-xl font-bold text-[#183D57] mb-3">Media Sosial</h3>
                        <p class="text-gray-600 text-sm mb-3">
                            Ikuti kami untuk update terbaru dan kegiatan inspiratif.
                        </p>
                        <div class="flex justify-center gap-3 flex-wrap">
                            @if ($kontak->social_facebook)
                                <a href="{{ $kontak->social_facebook }}" target="_blank"
                                    class="w-10 h-10 bg-[#1877F2] text-white rounded-full flex items-center justify-center hover:scale-110 transition-all duration-300">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            @endif
                            @if ($kontak->social_instagram)
                                <a href="{{ $kontak->social_instagram }}" target="_blank"
                                    class="w-10 h-10 bg-gradient-to-r from-[#833AB4] to-[#E1306C] text-white rounded-full flex items-center justify-center hover:scale-110 transition-all duration-300">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            @endif
                            {{-- @if ($kontak->social_twitter)
                                <a href="{{ $kontak->social_twitter }}" target="_blank"
                                    class="w-10 h-10 bg-[#1DA1F2] text-white rounded-full flex items-center justify-center hover:scale-110 transition-all duration-300">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            @endif
                            @if ($kontak->social_youtube)
                                <a href="{{ $kontak->social_youtube }}" target="_blank"
                                    class="w-10 h-10 bg-[#FF0000] text-white rounded-full flex items-center justify-center hover:scale-110 transition-all duration-300">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            @endif
                            @if ($kontak->social_linkedin)
                                <a href="{{ $kontak->social_linkedin }}" target="_blank"
                                    class="w-10 h-10 bg-[#0077B5] text-white rounded-full flex items-center justify-center hover:scale-110 transition-all duration-300">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

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
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 font-playfair">Siap Bergabung Menjadi
                Bagian dari Energi Bahagia?</h2>
            <p class="text-lg md:text-xl mb-10 text-white/90 max-w-2xl mx-auto">
                Mari bersama-sama menebar kebaikan dan energi positif untuk masa depan yang lebih cerah.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-5">
                <a href="{{ route('programs') }}"
                    class="group bg-[#8AD337] text-[#183D57] px-10 py-4 rounded-full font-bold text-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 inline-flex items-center justify-center gap-2">
                    <i class="fas fa-hand-holding-heart"></i>
                    Donasi Sekarang
                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </a>
                
            </div>
        </div>
    </section>
@endsection
