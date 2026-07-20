@extends('layouts.admin')

@section('title', 'Detail Gallery - Admin Panel')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#183D57]">{{ $gallery->judul }}</h1>
            <p class="text-gray-500">Detail gallery dan kelola foto</p>
        </div>
        <a href="{{ route('admin.gallery.index') }}"
            class="px-4 py-2 bg-gray-200 text-gray-600 rounded-xl font-semibold hover:bg-gray-300 transition-all duration-300 flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Informasi Gallery -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-md overflow-hidden sticky top-6">
                <img src="{{ $gallery->gambar_utama_url }}" alt="{{ $gallery->judul }}" class="w-full h-48 object-cover">
                <div class="p-5">
                    <h3 class="font-bold text-[#183D57] text-lg">{{ $gallery->judul }}</h3>
                    <p class="text-gray-600 text-sm mt-2">{{ $gallery->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                    <div class="mt-4 space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Status</span>
                            <span
                                class="font-semibold {{ $gallery->status == 'active' ? 'text-green-500' : 'text-gray-500' }}">
                                {{ $gallery->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Total Foto</span>
                            <span class="font-semibold">{{ $gallery->photos->count() }} foto</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Dibuat</span>
                            <span class="font-semibold">{{ $gallery->created_at->format('d F Y') }}</span>
                        </div>
                    </div>
                    <div class="flex gap-2 mt-4">
                       <a href="{{ route('admin.gallery.edit', $gallery->id) }}"
    class="flex-1 px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg text-sm font-medium text-center transition-all duration-200">
    <i class="fas fa-edit"></i> Edit
</a>
                        <button onclick="deleteGallery({{ $gallery->id }})"
                            class="flex-1 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-medium transition-all duration-200">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upload Foto & List Foto -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Upload Foto -->
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h3 class="font-bold text-[#183D57] text-lg mb-4 flex items-center gap-2">
                    <i class="fas fa-upload text-[#8AD337]"></i>
                    Upload Foto
                </h3>
                <form action="{{ route('admin.gallery.add-photos', $gallery->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div
                        class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-[#8AD337] transition-all duration-300">
                        <input type="file" name="fotos[]" accept="image/*" multiple class="hidden" id="fotosInput"
                            onchange="previewPhotos(this)">
                        <label for="fotosInput" class="cursor-pointer">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                            <p class="text-gray-500">Klik untuk upload banyak foto</p>
                            <p class="text-xs text-gray-400">Format: JPG, PNG, WEBP (Max 2MB per foto)</p>
                            <p class="text-xs text-[#8AD337] mt-1">Bisa upload hingga 20 foto sekaligus</p>
                        </label>
                        <div id="photoPreview" class="grid grid-cols-4 gap-2 mt-3"></div>
                    </div>
                    <div id="keteranganInputs" class="mt-3 space-y-2"></div>
                    <button type="submit"
                        class="mt-4 px-6 py-2.5 bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] font-semibold rounded-xl hover:shadow-lg transition-all duration-300">
                        <i class="fas fa-upload mr-2"></i> Upload Foto
                    </button>
                </form>
            </div>

            <!-- List Foto -->
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h3 class="font-bold text-[#183D57] text-lg mb-4 flex items-center gap-2">
                    <i class="fas fa-images text-[#8AD337]"></i>
                    Daftar Foto ({{ $gallery->photos->count() }})
                </h3>

                @if ($gallery->photos->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($gallery->photos as $photo)
                            <div
                                class="relative group border rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
                                <img src="{{ $photo->foto_url }}" alt="{{ $photo->keterangan ?? 'Foto' }}"
                                    class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                                <div
                                    class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-2">
                                    <button onclick="deletePhoto({{ $photo->id }})"
                                        class="w-8 h-8 bg-red-500 hover:bg-red-600 rounded-full flex items-center justify-center text-white transition-all duration-200">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </div>
                                @if ($photo->keterangan)
                                    <div
                                        class="absolute bottom-0 left-0 right-0 bg-black/60 text-white text-xs p-2 truncate">
                                        {{ $photo->keterangan }}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-images text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">Belum ada foto</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Form Delete -->
    <form id="deleteForm" action="" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <form id="deletePhotoForm" action="" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function previewPhotos(input) {
            const container = document.getElementById('photoPreview');
            const keteranganContainer = document.getElementById('keteranganInputs');
            container.innerHTML = '';
            keteranganContainer.innerHTML = '';

            if (input.files) {
                Array.from(input.files).forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative';
                        div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-24 object-cover rounded-lg border">
                        <span class="absolute -top-2 -right-2 w-5 h-5 bg-[#8AD337] rounded-full flex items-center justify-center text-white text-xs font-bold">${index + 1}</span>
                    `;
                        container.appendChild(div);
                    };
                    reader.readAsDataURL(file);

                    // Input keterangan
                    const divKeterangan = document.createElement('div');
                    divKeterangan.className = 'flex items-center gap-2';
                    divKeterangan.innerHTML = `
                    <span class="text-sm font-medium text-gray-600 w-24">Foto ${index + 1}</span>
                    <input type="text" name="keterangan[]" placeholder="Keterangan foto..." class="flex-1 px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-[#8AD337] focus:border-transparent">
                `;
                    keteranganContainer.appendChild(divKeterangan);
                });
            }
        }

        function deleteGallery(id) {
            if (confirm('Apakah Anda yakin ingin menghapus gallery ini?')) {
                const form = document.getElementById('deleteForm');
                form.action = `{{ url('admin/gallery') }}/${id}`;
                form.submit();
            }
        }

        function deletePhoto(id) {
            if (confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
                const form = document.getElementById('deletePhotoForm');
                form.action = `{{ url('admin/gallery/photo') }}/${id}`;
                form.submit();
            }
        }
    </script>
@endsection
