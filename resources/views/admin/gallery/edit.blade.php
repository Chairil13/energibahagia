@extends('layouts.admin')

@section('title', 'Edit Gallery - Admin Panel')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#183D57]">Edit Gallery</h1>
            <p class="text-gray-500">Edit gallery dan kelola foto</p>
        </div>
        <a href="{{ route('admin.gallery.index') }}"
            class="px-4 py-2 bg-gray-200 text-gray-600 rounded-xl font-semibold hover:bg-gray-300 transition-all duration-300 flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Informasi Gallery - EDIT -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-md overflow-hidden sticky top-6">
                <!-- Gambar Utama dengan Preview -->
                <div class="relative overflow-hidden h-48 bg-gray-100">
                    @if($gallery->gambar_utama && file_exists(public_path('uploads/gallery/' . $gallery->gambar_utama)))
                        <img src="{{ asset('uploads/gallery/' . $gallery->gambar_utama) }}" 
                             alt="{{ $gallery->judul }}" 
                             id="previewGambarUtama"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <i class="fas fa-image text-5xl"></i>
                        </div>
                    @endif
                    <div class="absolute bottom-2 right-2">
                        <label for="gambarUtamaInput" class="cursor-pointer bg-black/60 hover:bg-black/80 text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition-all duration-200">
                            <i class="fas fa-camera mr-1"></i> Ganti Gambar
                        </label>
                        <input type="file" id="gambarUtamaInput" name="gambar_utama" form="formUpdateGallery"
                            accept="image/*" class="hidden" onchange="previewGambarUtama(this)">
                    </div>
                </div>

                <form id="formUpdateGallery" action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="p-5 space-y-4">
                        <!-- Judul -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Judul Gallery</label>
                            <input type="text" name="judul" value="{{ old('judul', $gallery->judul) }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#8AD337] focus:border-transparent @error('judul') border-red-500 @enderror"
                                placeholder="Masukkan judul gallery..." required>
                            @error('judul')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Deskripsi</label>
                            <textarea name="deskripsi" rows="3"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#8AD337] focus:border-transparent"
                                placeholder="Masukkan deskripsi gallery...">{{ old('deskripsi', $gallery->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Status</label>
                            <select name="status"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#8AD337] focus:border-transparent">
                                <option value="active" {{ old('status', $gallery->status) == 'active' ? 'selected' : '' }}>✅ Aktif</option>
                                <option value="inactive" {{ old('status', $gallery->status) == 'inactive' ? 'selected' : '' }}>❌ Tidak Aktif</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Urutan -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Urutan</label>
                            <input type="number" name="urutan" value="{{ old('urutan', $gallery->urutan) }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#8AD337] focus:border-transparent"
                                placeholder="Masukkan urutan...">
                            @error('urutan')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Info Gallery -->
                        <div class="bg-gray-50 rounded-xl p-3 text-xs">
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <span class="text-gray-400">Total Foto</span>
                                    <p class="font-semibold text-[#183D57]">{{ $gallery->photos->count() }} foto</p>
                                </div>
                                <div>
                                    <span class="text-gray-400">Dibuat</span>
                                    <p class="font-semibold text-[#183D57]">{{ $gallery->created_at->format('d M Y') }}</p>
                                </div>
                                <div class="col-span-2">
                                    <span class="text-gray-400">Slug</span>
                                    <p class="font-semibold text-[#183D57] text-xs">{{ $gallery->slug }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-3 pt-2">
                            <button type="submit"
                                class="flex-1 px-6 py-3 bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] font-semibold rounded-xl hover:shadow-lg transition-all duration-300">
                                <i class="fas fa-save mr-2"></i> Update Gallery
                            </button>
                            <a href="{{ route('admin.gallery.show', $gallery->id) }}"
                                class="px-6 py-3 bg-gray-200 text-gray-600 font-semibold rounded-xl hover:bg-gray-300 transition-all duration-300">
                                Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Upload Foto & List Foto -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Upload Foto -->
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h3 class="font-bold text-[#183D57] text-lg mb-4 flex items-center gap-2">
                    <i class="fas fa-upload text-[#8AD337]"></i>
                    Upload Foto Baru
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

            <!-- List Foto dengan Edit Keterangan -->
            <div class="bg-white rounded-2xl shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-[#183D57] text-lg flex items-center gap-2">
                        <i class="fas fa-images text-[#8AD337]"></i>
                        Daftar Foto ({{ $gallery->photos->count() }})
                    </h3>
                    <span class="text-xs text-gray-400">Klik foto untuk edit keterangan</span>
                </div>

                @if ($gallery->photos->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($gallery->photos as $photo)
                            <div class="relative group border rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
                                <img src="{{ $photo->foto_url }}" alt="{{ $photo->keterangan ?? 'Foto' }}"
                                    class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                                
                                <!-- Overlay Hover -->
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-2">
                                    <button onclick="editKeterangan({{ $photo->id }}, '{{ $photo->keterangan }}')"
                                        class="w-8 h-8 bg-blue-500 hover:bg-blue-600 rounded-full flex items-center justify-center text-white transition-all duration-200">
                                        <i class="fas fa-edit text-xs"></i>
                                    </button>
                                    <button onclick="deletePhoto({{ $photo->id }})"
                                        class="w-8 h-8 bg-red-500 hover:bg-red-600 rounded-full flex items-center justify-center text-white transition-all duration-200">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </div>

                                <!-- Keterangan -->
                                <div class="absolute bottom-0 left-0 right-0 bg-black/60 text-white text-xs p-2 truncate">
                                    {{ $photo->keterangan ?? 'Tidak ada keterangan' }}
                                </div>

                                <!-- Nomor Urut -->
                                <div class="absolute top-2 left-2 bg-black/60 text-white text-xs px-2 py-1 rounded-full">
                                    #{{ $photo->urutan }}
                                </div>
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

    <!-- Modal Edit Keterangan Foto -->
    <div id="editKeteranganModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md animate-fadeInUp">
            <div class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] px-6 py-4 rounded-t-2xl flex justify-between items-center">
                <h3 class="text-white font-bold text-lg">Edit Keterangan Foto</h3>
                <button onclick="closeEditKeterangan()"
                    class="text-white/70 hover:text-white transition-all duration-200 p-2 hover:bg-white/10 rounded-lg">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="p-6">
                <form id="editKeteranganForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan Foto</label>
                            <input type="text" id="keteranganInput" name="keterangan"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#8AD337] focus:border-transparent"
                                placeholder="Masukkan keterangan foto...">
                        </div>
                        <div class="flex gap-3">
                            <button type="submit"
                                class="flex-1 px-6 py-2.5 bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] font-semibold rounded-xl hover:shadow-lg transition-all duration-300">
                                <i class="fas fa-save mr-2"></i> Simpan
                            </button>
                            <button type="button" onclick="closeEditKeterangan()"
                                class="px-6 py-2.5 bg-gray-200 text-gray-600 font-semibold rounded-xl hover:bg-gray-300 transition-all duration-300">
                                Batal
                            </button>
                        </div>
                    </div>
                </form>
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

    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeInUp {
            animation: fadeInUp 0.3s ease-out;
        }
    </style>

    <script>
        // Preview Gambar Utama
        function previewGambarUtama(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewGambarUtama').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Preview Upload Foto
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

        // Edit Keterangan Foto
        function editKeterangan(id, keterangan) {
            const modal = document.getElementById('editKeteranganModal');
            const form = document.getElementById('editKeteranganForm');
            const input = document.getElementById('keteranganInput');
            
            form.action = `{{ url('admin/gallery/photo') }}/${id}/update-keterangan`;
            input.value = keterangan || '';
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeEditKeterangan() {
            const modal = document.getElementById('editKeteranganModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Delete Gallery
        function deleteGallery(id) {
            if (confirm('Apakah Anda yakin ingin menghapus gallery ini?')) {
                const form = document.getElementById('deleteForm');
                form.action = `{{ url('admin/gallery') }}/${id}`;
                form.submit();
            }
        }

        // Delete Photo
        function deletePhoto(id) {
            if (confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
                const form = document.getElementById('deletePhotoForm');
                form.action = `{{ url('admin/gallery/photo') }}/${id}`;
                form.submit();
            }
        }

        // Close modal on backdrop click
        document.getElementById('editKeteranganModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditKeterangan();
            }
        });
    </script>
@endsection
