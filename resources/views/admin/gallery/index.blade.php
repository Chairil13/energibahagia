@extends('layouts.admin')

@section('title', 'Gallery - Admin Panel')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#183D57]">Galeri Foto</h1>
            <p class="text-gray-500">Kelola galeri foto kegiatan</p>
        </div>
        <a href="{{ route('admin.gallery.create') }}"
            class="px-5 py-2.5 bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] rounded-xl font-semibold hover:shadow-lg transition-all duration-300 flex items-center gap-2">
            <i class="fas fa-plus"></i> Tambah Gallery
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($galleries as $gallery)
            <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 group">
                <!-- Gambar -->
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ $gallery->gambar_utama_url }}" alt="{{ $gallery->judul }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 right-3">
                        <span
                            class="px-3 py-1 rounded-full text-xs font-semibold {{ $gallery->status == 'active' ? 'bg-green-500 text-white' : 'bg-gray-500 text-white' }}">
                            {{ $gallery->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </div>
                    <div class="absolute bottom-3 left-3 bg-black/50 text-white px-3 py-1 rounded-lg text-sm">
                        <i class="fas fa-images mr-1"></i> {{ $gallery->photos_count }} Foto
                    </div>
                </div>

                <!-- Content -->
                <div class="p-5">
                    <h3 class="font-bold text-[#183D57] text-lg mb-1 truncate">{{ $gallery->judul }}</h3>
                    <p class="text-gray-500 text-sm line-clamp-2">{{ $gallery->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                    <p class="text-xs text-gray-400 mt-2">
                        <i class="far fa-calendar-alt mr-1"></i>
                        {{ $gallery->created_at->format('d F Y') }}
                    </p>
                    <div class="flex gap-2 mt-4">
                        <a href="{{ route('admin.gallery.show', $gallery->id) }}"
                            class="flex-1 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-sm font-medium text-center transition-all duration-200">
                            <i class="fas fa-eye mr-1"></i> Detail
                        </a>
                       <a href="{{ route('admin.gallery.edit', $gallery->id) }}"
                            class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg text-sm font-medium transition-all duration-200">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button onclick="deleteGallery({{ $gallery->id }})"
                            class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-medium transition-all duration-200">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="bg-white rounded-2xl shadow-md p-12 text-center">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-images text-4xl text-gray-400"></i>
                    </div>
                    <p class="text-gray-500 font-medium">Belum ada gallery</p>
                    <a href="{{ route('admin.gallery.create') }}" class="mt-3 text-[#8AD337] hover:underline inline-block">
                        <i class="fas fa-plus mr-1"></i> Buat Gallery Sekarang
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Form Delete -->
    <form id="deleteForm" action="" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function deleteGallery(id) {
            if (confirm('Apakah Anda yakin ingin menghapus gallery ini?')) {
                const form = document.getElementById('deleteForm');
                form.action = `{{ url('admin/gallery') }}/${id}`;
                form.submit();
            }
        }
    </script>
@endsection
