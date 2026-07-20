@extends('layouts.app')

@section('title', 'Galeri Foto - Energi Bahagia')

@section('content')
    <!-- Hero Section Gallery -->
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
                <i class="fas fa-images mr-2 text-[#8AD337]"></i>
                <span class="text-white">Galeri Foto</span>
            </div>
            <h1 class="text-5xl md:text-6xl font-bold mb-4 font-playfair">
                <span class="bg-gradient-to-r from-[#8AD337] to-white bg-clip-text text-transparent">
                    Galeri Foto
                </span>
            </h1>
            <p class="text-xl text-white/90 max-w-2xl mx-auto">
                Dokumentasi kegiatan Yayasan Energi Bahagia Indonesia
            </p>
        </div>
    </section>

    <!-- Daftar Gallery -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <!-- Grid 4 Kolom -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @forelse($galleries as $gallery)
                    <!-- Card Gallery -->
                    <div class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 cursor-pointer"
                        onclick="openGalleryModal({{ $gallery->id }})">
                        <div class="relative overflow-hidden h-56">
                            @if ($gallery->gambar_utama && file_exists(public_path('uploads/gallery/' . $gallery->gambar_utama)))
                                <img src="{{ asset('uploads/gallery/' . $gallery->gambar_utama) }}"
                                    alt="{{ $gallery->judul }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <img src="https://placehold.co/600x400/183D57/FFFFFF?text={{ urlencode($gallery->judul) }}"
                                    alt="{{ $gallery->judul }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @endif
                            <!-- Badge Jumlah Foto -->
                            <div
                                class="absolute bottom-3 left-3 bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">
                                <i class="fas fa-images mr-1"></i>
                                {{ $gallery->photos_count }} Foto
                            </div>
                            <!-- Overlay Hover -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <div class="text-white text-center">
                                    <i class="fas fa-search-plus text-3xl mb-2"></i>
                                    <p class="text-sm font-semibold">Lihat Detail</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3
                                class="font-bold text-[#183D57] text-base mb-1 line-clamp-1 group-hover:text-[#8AD337] transition-colors">
                                {{ $gallery->judul }}
                            </h3>
                            <p class="text-gray-500 text-sm line-clamp-2">
                                {{ $gallery->deskripsi ?? 'Tidak ada deskripsi' }}
                            </p>
                            <div class="flex items-center justify-between mt-3 text-xs text-gray-400">
                                <span>
                                    <i class="far fa-calendar-alt mr-1"></i>
                                    {{ $gallery->created_at->format('d M Y') }}
                                </span>
                                <span class="text-[#8AD337] font-semibold">
                                    {{ $gallery->photos_count }} Foto
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20 bg-white rounded-2xl">
                        <i class="fas fa-images text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">Belum ada gallery</p>
                    </div>
                @endforelse

            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-12">
                {{ $galleries->links() }}
            </div>
        </div>
    </section>

    <!-- Modal Gallery Detail -->
    <div id="galleryModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl max-h-[90vh] overflow-hidden animate-fadeInUp">
            <!-- Header Modal -->
            <div class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] px-6 py-4 flex justify-between items-center">
                <div>
                    <h3 class="text-white font-bold text-xl" id="modalTitle">Judul Gallery</h3>
                    <p class="text-white/70 text-sm" id="modalDescription">Deskripsi gallery</p>
                </div>
                <button onclick="closeGalleryModal()"
                    class="text-white/70 hover:text-white transition-all duration-200 p-2 hover:bg-white/10 rounded-lg">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <!-- Body Modal - Slider Foto -->
            <div class="p-6 overflow-y-auto max-h-[70vh]">
                <!-- Slider Container -->
                <div class="relative">
                    <!-- Foto Slide -->
                    <div class="relative bg-gray-100 rounded-xl overflow-hidden" style="min-height: 400px;">
                        <img id="modalImage" src="" alt="Foto"
                            class="w-full h-full max-h-[500px] object-contain">
                        <!-- Tombol Navigasi -->
                        <button onclick="prevPhoto()"
                            class="absolute left-2 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white w-10 h-10 rounded-full flex items-center justify-center transition-all duration-200">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button onclick="nextPhoto()"
                            class="absolute right-2 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white w-10 h-10 rounded-full flex items-center justify-center transition-all duration-200">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                        <!-- Counter -->
                        <div
                            class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-black/60 text-white px-4 py-1 rounded-full text-sm">
                            <span id="photoCounter">1 / 1</span>
                        </div>
                        <!-- Keterangan Foto -->
                        <div class="absolute bottom-16 left-1/2 -translate-x-1/2 bg-black/60 text-white px-4 py-2 rounded-lg text-sm max-w-md text-center"
                            id="photoCaption">
                            Keterangan foto
                        </div>
                    </div>
                </div>
                <!-- Thumbnail -->
                <div class="flex gap-2 mt-4 overflow-x-auto pb-2" id="thumbnailContainer">
                    <!-- Thumbnail akan diisi oleh JS -->
                </div>
            </div>
        </div>
    </div>

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
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 font-playfair">Ingin Berbagi Kebahagiaan?</h2>
            <p class="text-xl mb-10 text-white/90 max-w-2xl mx-auto">
                Mari bergabung dan menjadi bagian dari kegiatan sosial Yayasan Energi Bahagia Indonesia
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                <a href="{{ route('programs') }}"
                    class="group bg-[#8AD337] text-[#183D57] px-10 py-5 rounded-full font-bold hover:shadow-2xl transition-all duration-300 transform hover:scale-105 text-lg inline-flex items-center justify-center border-2 border-white/30">
                    <i class="fas fa-hand-holding-heart mr-3"></i>
                    Donasi Sekarang
                    <i class="fas fa-arrow-right ml-3 group-hover:translate-x-2 transition-transform"></i>
                </a>
                <a href="{{ route('contact') }}"
                    class="group border-2 border-white text-white px-10 py-5 rounded-full font-bold hover:bg-[#8AD337] hover:text-[#183D57] hover:border-[#8AD337] transition-all duration-300 transform hover:scale-105 text-lg inline-flex items-center justify-center">
                    <i class="fas fa-phone mr-3"></i>
                    Hubungi Kami
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

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.3s ease-out;
        }

        #thumbnailContainer::-webkit-scrollbar {
            height: 4px;
        }

        #thumbnailContainer::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        #thumbnailContainer::-webkit-scrollbar-thumb {
            background: #8AD337;
            border-radius: 10px;
        }
    </style>

    <script>
        let currentPhotos = [];
        let currentIndex = 0;
        let currentGalleryId = null;

        function openGalleryModal(galleryId) {
            currentGalleryId = galleryId;
            fetch(`/gallery/${galleryId}/photos`)
                .then(response => response.json())
                .then(data => {
                    // Pastikan data.photos adalah array
                    let allPhotos = [];

                    // Cek apakah ada gambar utama dari data
                    if (data.gambar_utama) {
                        allPhotos.push({
                            id: 0,
                            foto_url: data.gambar_utama,
                            keterangan: 'Gambar Utama - ' + data.judul
                        });
                    }

                    // Tambahkan foto-foto lainnya
                    if (data.photos && data.photos.length > 0) {
                        data.photos.forEach(photo => {
                            allPhotos.push(photo);
                        });
                    }

                    // Jika tidak ada foto sama sekali, tampilkan placeholder
                    if (allPhotos.length === 0) {
                        allPhotos.push({
                            id: 0,
                            foto_url: 'https://placehold.co/800x600/183D57/FFFFFF?text=Tidak+Ada+Foto',
                            keterangan: 'Tidak ada foto'
                        });
                    }

                    currentPhotos = allPhotos;
                    currentIndex = 0;

                    document.getElementById('modalTitle').textContent = data.judul;
                    document.getElementById('modalDescription').textContent = data.deskripsi || '';

                    if (currentPhotos.length > 0) {
                        updatePhoto(currentIndex);
                    }

                    const container = document.getElementById('thumbnailContainer');
                    container.innerHTML = '';
                    currentPhotos.forEach((photo, index) => {
                        const thumb = document.createElement('img');
                        thumb.src = photo.foto_url;
                        thumb.alt = photo.keterangan || 'Foto';
                        thumb.className =
                            `w-20 h-20 object-cover rounded-lg cursor-pointer border-2 transition-all duration-200 ${index === 0 ? 'border-[#8AD337]' : 'border-transparent'}`;
                        thumb.onclick = () => {
                            currentIndex = index;
                            updatePhoto(index);
                        };
                        container.appendChild(thumb);
                    });

                    document.getElementById('galleryModal').classList.remove('hidden');
                    document.getElementById('galleryModal').classList.add('flex');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memuat data gallery');
                });
        }

        function closeGalleryModal() {
            document.getElementById('galleryModal').classList.add('hidden');
            document.getElementById('galleryModal').classList.remove('flex');
        }

        function updatePhoto(index) {
            const photo = currentPhotos[index];
            if (!photo) return;

            document.getElementById('modalImage').src = photo.foto_url;
            document.getElementById('photoCounter').textContent = `${index + 1} / ${currentPhotos.length}`;
            document.getElementById('photoCaption').textContent = photo.keterangan || '';

            const thumbs = document.querySelectorAll('#thumbnailContainer img');
            thumbs.forEach((thumb, i) => {
                thumb.className =
                    `w-20 h-20 object-cover rounded-lg cursor-pointer border-2 transition-all duration-200 ${i === index ? 'border-[#8AD337]' : 'border-transparent'}`;
            });

            if (thumbs[index]) {
                thumbs[index].scrollIntoView({
                    behavior: 'smooth',
                    inline: 'center',
                    block: 'nearest'
                });
            }
        }

        function prevPhoto() {
            if (currentPhotos.length === 0) return;
            currentIndex = (currentIndex - 1 + currentPhotos.length) % currentPhotos.length;
            updatePhoto(currentIndex);
        }

        function nextPhoto() {
            if (currentPhotos.length === 0) return;
            currentIndex = (currentIndex + 1) % currentPhotos.length;
            updatePhoto(currentIndex);
        }

        document.addEventListener('keydown', function(e) {
            if (!document.getElementById('galleryModal').classList.contains('flex')) return;

            if (e.key === 'ArrowLeft') {
                prevPhoto();
            } else if (e.key === 'ArrowRight') {
                nextPhoto();
            } else if (e.key === 'Escape') {
                closeGalleryModal();
            }
        });

        document.getElementById('galleryModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeGalleryModal();
            }
        });
    </script>
@endsection
