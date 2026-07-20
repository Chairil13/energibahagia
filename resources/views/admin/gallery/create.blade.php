@extends('layouts.admin')

@section('title', 'Tambah Gallery - Admin Panel')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#183D57]">Tambah Gallery</h1>
        <p class="text-gray-500">Buat gallery foto baru</p>
    </div>

    <div class="bg-white rounded-2xl shadow-md p-6 max-w-2xl">
        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-4">
                <!-- Judul -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Gallery <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#8AD337] focus:border-transparent @error('judul') border-red-500 @enderror"
                        placeholder="Masukkan judul gallery..." required>
                    @error('judul')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="4"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#8AD337] focus:border-transparent"
                        placeholder="Masukkan deskripsi gallery...">{{ old('deskripsi') }}</textarea>
                </div>

                <!-- Gambar Utama -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Utama</label>
                    <div
                        class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-[#8AD337] transition-all duration-300">
                        <input type="file" name="gambar_utama" accept="image/*" class="hidden" id="gambarUtama"
                            onchange="previewImage(this)">
                        <label for="gambarUtama" class="cursor-pointer">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                            <p class="text-gray-500">Klik untuk upload gambar utama</p>
                            <p class="text-xs text-gray-400">Format: JPG, PNG, WEBP (Max 2MB)</p>
                        </label>
                        <img id="preview" class="hidden mt-3 max-h-48 mx-auto rounded-lg shadow-md" alt="Preview">
                    </div>
                    @error('gambar_utama')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#8AD337] focus:border-transparent">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

                <!-- Urutan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                    <input type="number" name="urutan" value="{{ old('urutan', 0) }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#8AD337] focus:border-transparent">
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 pt-4">
                    <button type="submit"
                        class="flex-1 px-6 py-3 bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] font-semibold rounded-xl hover:shadow-lg transition-all duration-300">
                        <i class="fas fa-save mr-2"></i> Simpan
                    </button>
                    <a href="{{ route('admin.gallery.index') }}"
                        class="px-6 py-3 bg-gray-200 text-gray-600 font-semibold rounded-xl hover:bg-gray-300 transition-all duration-300">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
