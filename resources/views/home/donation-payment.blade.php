@extends('layouts.app')

@section('title', 'Pembayaran Donasi - Energi Bahagia')

@section('content')
    @php
        $isTransferExpired = $donasi->isExpired() || $donasi->status === 'expired';
        $expiresAtMs = $donasi->expires_at->timestamp * 1000;
    @endphp

    <section class="py-20 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto">

                @if (session('error'))
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl">{{ session('error') }}
                    </div>
                @endif

                @if ($isTransferExpired)
                    <div class="bg-red-100 border border-red-400 text-red-700 rounded-xl p-6 text-center">
                        <i class="fas fa-clock text-5xl mb-3"></i>
                        <h3 class="text-xl font-bold mb-2">Donasi Telah Kadaluarsa!</h3>
                        <p>Waktu pembayaran Anda sudah habis. Silakan lakukan donasi ulang.</p>
                        <a href="{{ route('programs') }}"
                            class="inline-block mt-4 bg-[#8AD337] text-[#183D57] px-6 py-2 rounded-full font-semibold">Kembali
                            ke Program Donasi</a>
                    </div>
                @else
                    <!-- Informasi Transfer -->
                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden mb-6">
                        <div class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] px-6 py-5">
                            <h3 class="text-xl font-bold text-white">Informasi Transfer</h3>
                            <p class="text-white/80 text-sm">Lakukan transfer sesuai nominal berikut</p>
                        </div>

                        <div class="p-6 md:p-8">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="text-center p-4 bg-gray-50 rounded-xl">
                                    <p class="text-gray-500 text-sm mb-1">Nominal yang harus ditransfer</p>
                                    <p class="text-3xl font-bold text-[#8AD337]">Rp
                                        {{ number_format($donasi->nominal, 0, ',', '.') }}</p>
                                </div>
                                <div class="text-center p-4 bg-gray-50 rounded-xl">
                                    <p class="text-gray-500 text-sm mb-1">Batas Waktu Transfer</p>
                                    <p class="text-2xl font-bold text-red-500" id="countdownText">
                                        --:--:--</p>
                                    <p class="text-xs text-gray-400 mt-1">Sisa waktu</p>
                                </div>
                            </div>

                            <div class="mt-6 p-4 bg-[#8AD337]/10 rounded-xl border border-[#8AD337]/30">
                                <div class="flex items-start gap-3">
                                    <i class="fas fa-university text-[#8AD337] text-xl mt-0.5"></i>
                                    <div>
                                        <p class="font-semibold text-[#183D57]">Transfer ke:</p>
                                        <p class="font-bold text-gray-800">{{ $donasi->bank->nama_bank }}</p>
                                        <p class="text-gray-600">No. Rekening:
                                            <strong>{{ $donasi->bank->nomor_rekening }}</strong>
                                        </p>
                                        <p class="text-gray-600">Atas Nama: <strong>{{ $donasi->bank->atas_nama }}</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6">
                                <p class="text-gray-500 text-sm mb-2">Kode Unik Donasi (untuk verifikasi)</p>
                                <div class="bg-gray-100 p-3 rounded-xl text-center">
                                    <span class="font-mono text-lg font-bold text-[#183D57]">{{ $donasi->kode_unik }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Upload Bukti Transfer -->
                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                        <div class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] px-6 py-5">
                            <h3 class="text-xl font-bold text-white">Upload Bukti Transfer</h3>
                            <p class="text-white/80 text-sm">Setelah transfer, upload bukti pembayaran Anda</p>
                        </div>

                        <div class="p-6 md:p-8">
                            <div id="expiredUploadNotice"
                                class="hidden mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                                <p class="font-semibold">Waktu transfer sudah habis.</p>
                                <p>Upload bukti transfer dinonaktifkan. Silakan lakukan donasi ulang.</p>
                            </div>

                            <form action="{{ route('donasi.upload-bukti', $donasi->kode_unik) }}" method="POST"
                                enctype="multipart/form-data" id="uploadForm">
                                @csrf

                                <div class="mb-6">
                                    <label class="block text-[#183D57] font-semibold mb-2">Bukti Transfer</label>
                                    <input type="file" name="bukti_transfer" accept="image/*" required id="buktiTransferInput"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                                    <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                                </div>

                                <button type="submit" id="uploadButton"
                                    class="w-full bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] py-3 rounded-xl font-bold hover:shadow-lg transition disabled:cursor-not-allowed disabled:from-gray-300 disabled:to-gray-300 disabled:text-gray-500">
                                    <i class="fas fa-upload mr-2"></i>
                                    Upload Bukti Transfer
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <script>
        // Countdown timer tanpa reload halaman
        const expiresAt = {{ $expiresAtMs }};
        let countdownInterval = null;

        function disableUploadForm() {
            const uploadForm = document.getElementById('uploadForm');
            const buktiTransferInput = document.getElementById('buktiTransferInput');
            const uploadButton = document.getElementById('uploadButton');
            const expiredUploadNotice = document.getElementById('expiredUploadNotice');

            if (expiredUploadNotice) {
                expiredUploadNotice.classList.remove('hidden');
            }

            if (buktiTransferInput) {
                buktiTransferInput.disabled = true;
            }

            if (uploadButton) {
                uploadButton.disabled = true;
                uploadButton.innerHTML = '<i class="fas fa-clock mr-2"></i> Waktu Transfer Habis';
            }

            if (uploadForm) {
                uploadForm.addEventListener('submit', function(event) {
                    event.preventDefault();
                });
            }
        }

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = expiresAt - now;

            if (distance <= 0) {
                document.getElementById('countdownText').innerHTML = "00:00:00";
                clearInterval(countdownInterval);
                disableUploadForm();
                return;
            }

            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Format dengan leading zero
            const formattedHours = hours.toString().padStart(2, '0');
            const formattedMinutes = minutes.toString().padStart(2, '0');
            const formattedSeconds = seconds.toString().padStart(2, '0');

            document.getElementById('countdownText').innerHTML = formattedHours + ":" + formattedMinutes + ":" +
                formattedSeconds;
        }

        // Jalankan setiap 1 detik
        countdownInterval = setInterval(updateCountdown, 1000);
        updateCountdown();

        // Cegah submit berulang
        document.getElementById('uploadForm')?.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';
        });
    </script>
@endsection
