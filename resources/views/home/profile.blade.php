@extends('layouts.app')

@section('title', 'Profil - Energi Bahagia')

@section('content')
    @php
        use App\Models\ProfileHero;
        $profileHero = ProfileHero::first();
    @endphp

    @if ($profileHero)
        <!-- Hero Section Profile dengan Gambar di Tengah -->
        <section class="relative hero-pattern text-white py-16 overflow-hidden">
            <div class="absolute inset-0 bg-black/30"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#183D57]/30 to-[#8AD337]/30 mix-blend-overlay"></div>

            <div
                class="absolute top-20 left-10 w-72 h-72 bg-[#8AD337] rounded-full filter blur-3xl opacity-20 animate-pulse">
            </div>
            <div
                class="absolute bottom-20 right-10 w-96 h-96 bg-[#183D57] rounded-full filter blur-3xl opacity-20 animate-pulse delay-1000">
            </div>

            <div class="container mx-auto px-6 relative z-10">
                <!-- Teks di atas -->
                <div class="text-center max-w-3xl mx-auto mb-8">
                    <div
                        class="inline-block px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-sm font-semibold mb-6 border border-[#8AD337]/30">
                        <i class="fas fa-leaf mr-2 text-[#8AD337]"></i>
                        <span class="text-white">{{ $profileHero->badge_text }}</span>
                    </div>
                    <h1 class="text-5xl md:text-6xl font-bold mb-4 font-playfair">
                        <span class="bg-gradient-to-r from-[#8AD337] to-white bg-clip-text text-transparent">
                            {{ $profileHero->title_first }}
                        </span>
                        <br>{{ $profileHero->title_highlight }}
                    </h1>

                    <!-- Gambar -->
                    <div class="mb-10 w-full px-2">
                        <div
                            class="relative overflow-hidden rounded-2xl shadow-2xl border-2 border-white/30 hover:border-[#8AD337]/50 transition-all duration-500">
                            @if ($profileHero->hero_image && file_exists(public_path('uploads/profile-hero/' . $profileHero->hero_image)))
                                <img src="{{ asset('uploads/profile-hero/' . $profileHero->hero_image) }}"
                                    alt="{{ $profileHero->title_highlight }}"
                                    class="w-full hover:scale-105 transition-transform duration-700 ease-out"
                                    style="height: auto; min-height: 280px; max-height: 380px; object-fit: cover;">
                            @else
                                <img src="https://placehold.co/1400x380/png?text={{ urlencode($profileHero->title_highlight) }}"
                                    alt="{{ $profileHero->title_highlight }}"
                                    class="w-full hover:scale-105 transition-transform duration-700 ease-out"
                                    style="height: auto; min-height: 280px; max-height: 380px; object-fit: cover;">
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        </div>
                    </div>

                    <p class="text-lg text-white/90">
                        {{ $profileHero->description }}
                    </p>
                </div>

                <!-- Tombol di bawah gambar -->
                <div class="flex flex-wrap justify-center gap-4 mt-10">
                    <a href="{{ $profileHero->button_primary_link }}"
                        class="group bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] px-8 py-4 rounded-full font-bold hover:shadow-2xl transition-all duration-300 transform hover:scale-105 inline-flex items-center border-2 border-transparent hover:border-white">
                        <i class="fas fa-building mr-2"></i>
                        {{ $profileHero->button_primary_text }}
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
                    </a>
                    <a href="{{ $profileHero->button_secondary_link }}"
                        class="group border-2 border-white text-white px-8 py-4 rounded-full font-bold hover:bg-[#8AD337] hover:text-[#183D57] hover:border-[#8AD337] transition-all duration-300 transform hover:scale-105 inline-flex items-center">
                        <i class="fas fa-headset mr-2"></i>
                        {{ $profileHero->button_secondary_text }}
                    </a>
                </div>
            </div>
        </section>
    @endif
    <!-- Sejarah Lembaga -->
    @php
        use App\Models\SejarahLembaga;
        $sejarah = SejarahLembaga::first();
    @endphp

    @if ($sejarah)
        <section id="sejarah" class="py-20 bg-gray-50">
            <div class="container mx-auto px-6">
                <div class="text-center mb-12">
                    <span class="badge-premium">{{ $sejarah->badge_text }}</span>
                    <h2 class="text-4xl md:text-5xl font-bold text-[#183D57] mb-4 mt-2 font-playfair">{{ $sejarah->title }}
                    </h2>
                    <div class="divider-premium"></div>
                </div>

                <div class="max-w-4xl mx-auto text-center">
                    <p class="text-gray-700 leading-relaxed text-lg">
                        <strong class="text-[#183D57]">{{ $sejarah->institution_name }}</strong>
                        {{ $sejarah->content }}
                    </p>
                </div>
            </div>
        </section>
    @endif


    <!-- Visi & Misi -->
    @php
        use App\Models\VisiMisi;
        $visiMisi = VisiMisi::first();
    @endphp

    @if ($visiMisi)
        <section class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="text-center mb-12">
                    <span class="badge-premium">{{ $visiMisi->badge_text }}</span>
                    <h2 class="text-4xl md:text-5xl font-bold text-[#183D57] mb-4 mt-2 font-playfair">
                        {{ $visiMisi->title }}</h2>
                    <div class="divider-premium"></div>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Visi -->
                    <div class="value-card-premium group">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-[#8AD337]/20 to-[#183D57]/20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-eye text-4xl text-[#183D57]"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-[#183D57] text-center mb-4 font-playfair">Visi</h3>
                        <p class="text-gray-600 text-center text-lg leading-relaxed">
                            "{{ $visiMisi->visi }}"
                        </p>
                    </div>

                    <!-- Misi -->
                    <div class="value-card-premium group">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-[#8AD337]/20 to-[#183D57]/20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-bullseye text-4xl text-[#183D57]"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-[#183D57] text-center mb-4 font-playfair">Misi</h3>
                        <ul class="space-y-3 text-gray-600">
                            @php
                                $misiList = is_array($visiMisi->misi) ? $visiMisi->misi : [];
                            @endphp
                            @foreach ($misiList as $misiItem)
                                <li class="flex items-start gap-3">
                                    <i class="fas fa-check-circle text-[#8AD337] mt-1"></i>
                                    <span>{{ $misiItem }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    @endif

@endsection
