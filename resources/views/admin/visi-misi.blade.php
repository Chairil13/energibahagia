@extends('layouts.admin')

@section('title', 'Kelola Visi & Misi - Admin Panel')

@section('content')
    <!-- Alert Success -->
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#183D57]">Kelola Visi & Misi</h1>
        <p class="text-gray-500">Mengatur konten Visi dan Misi di halaman Profile</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <div class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] px-6 py-4">
            <h3 class="text-white font-bold text-lg">Edit Visi & Misi</h3>
        </div>

        <form action="{{ route('admin.visi-misi.update', $visiMisi->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Badge Text</label>
                        <input type="text" name="badge_text" value="{{ old('badge_text', $visiMisi->badge_text) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                        <p class="text-xs text-gray-400 mt-1">Text kecil di atas judul (contoh: ARAH & TUJUAN)</p>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Judul</label>
                        <input type="text" name="title" value="{{ old('title', $visiMisi->title) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                        <p class="text-xs text-gray-400 mt-1">Judul section (contoh: Visi & Misi)</p>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Visi</label>
                        <textarea name="visi" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">{{ old('visi', $visiMisi->visi) }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">Teks Visi lembaga</p>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Misi (Maksimal 4)</label>
                        <div id="misi-list">
                            @php
                                $misiList = is_array($visiMisi->misi) ? $visiMisi->misi : [];
                            @endphp
                            @foreach ($misiList as $index => $misiItem)
                                <div class="misi-item mb-3 flex gap-2">
                                    <input type="text" name="misi[]" value="{{ $misiItem }}"
                                        class="flex-1 px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20"
                                        placeholder="Masukkan poin misi">
                                    <button type="button"
                                        class="remove-misi bg-red-500 text-white px-3 rounded-xl hover:bg-red-600 transition">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-misi"
                            class="mt-2 text-[#8AD337] hover:text-[#183D57] transition text-sm font-semibold">
                            <i class="fas fa-plus mr-1"></i> Tambah Poin Misi
                        </button>
                        <p class="text-xs text-gray-400 mt-2">Maksimal 4 poin misi</p>
                    </div>
                </div>
            </div>

            <div class="flex gap-3 mt-6 pt-4 border-t border-gray-200">
                <button type="submit"
                    class="bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] px-6 py-2 rounded-xl font-semibold hover:shadow-lg transition transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Perubahan
                </button>
                <a href="{{ route('profile') }}" target="_blank"
                    class="bg-gray-200 text-gray-600 px-6 py-2 rounded-xl font-semibold hover:bg-gray-300 transition">
                    <i class="fas fa-external-link-alt mr-2"></i>
                    Lihat Preview
                </a>
            </div>
        </form>
    </div>

    <!-- Preview Section -->
    <div class="mt-8">
        <h3 class="text-lg font-bold text-[#183D57] mb-4 flex items-center gap-2">
            <i class="fas fa-eye"></i>
            Preview Visi & Misi
        </h3>
        <div class="bg-gradient-to-r from-gray-100 to-gray-200 rounded-2xl p-6 border-2 border-dashed border-gray-300">
            <div class="text-center mb-8">
                <div class="inline-block px-3 py-1 bg-[#8AD337]/20 rounded-full text-xs font-semibold text-[#8AD337] mb-3">
                    {{ $visiMisi->badge_text }}
                </div>
                <h2 class="text-2xl font-bold text-[#183D57]">{{ $visiMisi->title }}</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-[#8AD337] to-[#183D57] mx-auto rounded-full mt-4"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Preview Visi -->
                <div class="bg-white rounded-2xl p-6 shadow-md">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-[#8AD337]/20 to-[#183D57]/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-eye text-2xl text-[#183D57]"></i>
                    </div>
                    <h3 class="text-xl font-bold text-[#183D57] text-center mb-3">Visi</h3>
                    <p class="text-gray-600 text-center">"{{ $visiMisi->visi }}"</p>
                </div>

                <!-- Preview Misi -->
                <div class="bg-white rounded-2xl p-6 shadow-md">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-[#8AD337]/20 to-[#183D57]/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-bullseye text-2xl text-[#183D57]"></i>
                    </div>
                    <h3 class="text-xl font-bold text-[#183D57] text-center mb-3">Misi</h3>
                    <ul class="space-y-2">
                        @foreach ($misiList as $misiItem)
                            <li class="flex items-start gap-2 text-gray-600 text-sm">
                                <i class="fas fa-check-circle text-[#8AD337] mt-0.5"></i>
                                <span>{{ $misiItem }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tambah poin misi
        document.getElementById('add-misi').addEventListener('click', function() {
            const misiList = document.getElementById('misi-list');
            const currentCount = misiList.children.length;

            if (currentCount >= 4) {
                alert('Maksimal 4 poin misi!');
                return;
            }

            const newItem = document.createElement('div');
            newItem.className = 'misi-item mb-3 flex gap-2';
            newItem.innerHTML = `
                <input type="text" name="misi[]" placeholder="Masukkan poin misi"
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                <button type="button" class="remove-misi bg-red-500 text-white px-3 rounded-xl hover:bg-red-600 transition">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            misiList.appendChild(newItem);

            // Tambah event listener untuk tombol hapus
            newItem.querySelector('.remove-misi').addEventListener('click', function() {
                newItem.remove();
            });
        });

        // Event listener untuk tombol hapus yang sudah ada
        document.querySelectorAll('.remove-misi').forEach(btn => {
            btn.addEventListener('click', function() {
                this.closest('.misi-item').remove();
            });
        });
    </script>
@endsection
