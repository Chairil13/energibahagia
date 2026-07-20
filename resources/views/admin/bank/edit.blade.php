@extends('layouts.admin')

@section('title', 'Edit Bank - Admin Panel')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#183D57]">Edit Bank</h1>
        <p class="text-gray-500">Mengedit data bank</p>
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

    <form action="{{ route('admin.bank.update', $bank->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Nama Bank <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nama_bank" value="{{ old('nama_bank', $bank->nama_bank) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Kode Bank <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="kode" value="{{ old('kode', $bank->kode) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Nomor Rekening <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nomor_rekening"
                            value="{{ old('nomor_rekening', $bank->nomor_rekening) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Atas Nama <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="atas_nama" value="{{ old('atas_nama', $bank->atas_nama) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Icon Bank</label>
                        <div class="flex gap-3">
                            <div id="iconPreview"
                                class="w-12 h-12 bg-[#8AD337]/20 rounded-lg flex items-center justify-center">
                                <i class="fas {{ $bank->icon }} text-2xl text-[#8AD337]"></i>
                            </div>
                            <input type="text" name="icon" id="icon" value="{{ old('icon', $bank->icon) }}"
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Warna Bank</label>
                        <div class="flex gap-3">
                            <div id="colorPreview" class="w-12 h-12 rounded-lg border"
                                style="background: {{ old('warna', $bank->warna) }}"></div>
                            <input type="color" name="warna" id="warna" value="{{ old('warna', $bank->warna) }}"
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2 text-sm">Urutan</label>
                        <input type="number" name="urutan" value="{{ old('urutan', $bank->urutan) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                    </div>

                    <div class="mb-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ $bank->is_active ? 'checked' : '' }}
                                class="w-4 h-4 text-[#8AD337] rounded">
                            <span class="text-sm text-gray-700">Aktifkan Bank</span>
                        </label>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="font-semibold text-[#183D57] mb-3">Preview</h3>
                    <div id="livePreview" class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center"
                            style="background: {{ $bank->warna }}20">
                            <i class="fas {{ $bank->icon }} text-xl" style="color: {{ $bank->warna }}"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800" id="previewNama">{{ $bank->nama_bank }}</p>
                            <p class="text-xs text-gray-500" id="previewRekening">{{ $bank->nomor_rekening }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex gap-3 mt-6">
            <button type="submit"
                class="bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] px-6 py-2 rounded-xl font-semibold hover:shadow-lg transition">
                <i class="fas fa-save mr-2"></i>
                Update Bank
            </button>
            <a href="{{ route('admin.bank.index') }}"
                class="bg-gray-200 text-gray-600 px-6 py-2 rounded-xl font-semibold hover:bg-gray-300 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>
    </form>

    <script>
        const iconInput = document.getElementById('icon');
        const warnaInput = document.getElementById('warna');
        const namaInput = document.querySelector('input[name="nama_bank"]');
        const rekeningInput = document.querySelector('input[name="nomor_rekening"]');
        const livePreview = document.getElementById('livePreview');
        const iconPreview = document.getElementById('iconPreview');
        const colorPreview = document.getElementById('colorPreview');
        const previewNama = document.getElementById('previewNama');
        const previewRekening = document.getElementById('previewRekening');

        function updatePreview() {
            let iconClass = iconInput.value || 'fa-university';
            let warna = warnaInput.value || '#183D57';
            let nama = namaInput.value || '{{ $bank->nama_bank }}';
            let rekening = rekeningInput.value || '{{ $bank->nomor_rekening }}';

            livePreview.querySelector('div:first-child').style.background = warna + '20';
            livePreview.querySelector('i').className = 'fas ' + iconClass;
            livePreview.querySelector('i').style.color = warna;

            iconPreview.querySelector('i').className = 'fas ' + iconClass;
            iconPreview.querySelector('i').style.color = warna;

            colorPreview.style.background = warna;

            previewNama.innerText = nama;
            previewRekening.innerText = rekening;
        }

        iconInput.addEventListener('input', updatePreview);
        warnaInput.addEventListener('input', updatePreview);
        namaInput.addEventListener('input', updatePreview);
        rekeningInput.addEventListener('input', updatePreview);
    </script>
@endsection
