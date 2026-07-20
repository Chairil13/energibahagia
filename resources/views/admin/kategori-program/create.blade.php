@extends('layouts.admin')

@section('title', 'Tambah Kategori Program - Admin Panel')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#183D57]">Tambah Kategori Program</h1>
        <p class="text-gray-500">Menambahkan kategori program donasi baru</p>
    </div>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kategori-program.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Nama Kategori <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                        <p class="text-xs text-gray-400 mt-1">Contoh: Pendidikan, Kesehatan, Sosial, Ekonomi, Lingkungan</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Deskripsi Kategori</label>
                        <textarea name="deskripsi" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">{{ old('deskripsi') }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">Deskripsi singkat tentang kategori ini</p>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Icon Kategori</label>
                        <div class="flex gap-3">
                            <div id="iconPreview"
                                class="w-12 h-12 bg-[#8AD337]/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-tag text-2xl text-[#8AD337]"></i>
                            </div>
                            <input type="text" name="icon" id="icon" value="{{ old('icon', 'fa-tag') }}"
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Contoh: fa-hand-holding-heart, fa-graduation-cap,
                            fa-heartbeat, fa-tree, fa-chart-line</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Warna Kategori</label>
                        <div class="flex gap-3">
                            <div id="colorPreview" class="w-12 h-12 rounded-lg border"
                                style="background: {{ old('warna', '#8AD337') }}"></div>
                            <input type="color" name="warna" id="warna" value="{{ old('warna', '#8AD337') }}"
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Urutan</label>
                        <input type="number" name="urutan" value="{{ old('urutan', 0) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                        <p class="text-xs text-gray-400 mt-1">Semakin kecil angka, semakin atas tampilannya</p>
                    </div>

                    <div class="mb-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" checked
                                class="w-4 h-4 text-[#8AD337] rounded">
                            <span class="text-sm text-gray-700">Aktifkan Kategori</span>
                        </label>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="font-semibold text-[#183D57] mb-3">Preview Icon</h3>
                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                        <div id="livePreview" class="w-16 h-16 rounded-2xl flex items-center justify-center"
                            style="background: {{ old('warna', '#8AD337') }}20">
                            <i class="fas {{ old('icon', 'fa-tag') }} text-3xl"
                                style="color: {{ old('warna', '#8AD337') }}"></i>
                        </div>
                        <div>
                            <p class="font-medium text-[#183D57]">Preview</p>
                            <p class="text-sm text-gray-500" id="previewText">{{ old('nama_kategori') ?: 'Nama Kategori' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex gap-3 mt-6">
            <button type="submit"
                class="bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] px-6 py-2 rounded-xl font-semibold hover:shadow-lg transition">
                <i class="fas fa-save mr-2"></i>
                Simpan Kategori
            </button>
            <a href="{{ route('admin.kategori-program.index') }}"
                class="bg-gray-200 text-gray-600 px-6 py-2 rounded-xl font-semibold hover:bg-gray-300 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>
    </form>

    <script>
        // Live preview icon dan warna
        const iconInput = document.getElementById('icon');
        const warnaInput = document.getElementById('warna');
        const namaInput = document.querySelector('input[name="nama_kategori"]');
        const livePreview = document.getElementById('livePreview');
        const iconPreview = document.getElementById('iconPreview');
        const colorPreview = document.getElementById('colorPreview');
        const previewText = document.getElementById('previewText');

        function updatePreview() {
            let iconClass = iconInput.value || 'fa-tag';
            let warna = warnaInput.value || '#8AD337';
            let nama = namaInput.value || 'Nama Kategori';

            livePreview.style.background = warna + '20';
            livePreview.querySelector('i').className = 'fas ' + iconClass;
            livePreview.querySelector('i').style.color = warna;

            iconPreview.querySelector('i').className = 'fas ' + iconClass;
            iconPreview.querySelector('i').style.color = warna;

            colorPreview.style.background = warna;

            previewText.innerText = nama;
        }

        iconInput.addEventListener('input', updatePreview);
        warnaInput.addEventListener('input', updatePreview);
        namaInput.addEventListener('input', updatePreview);
    </script>
@endsection
