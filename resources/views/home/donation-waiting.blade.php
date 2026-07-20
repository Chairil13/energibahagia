@extends('layouts.app')

@section('title',
    $donasi->status == 'confirmed'
    ? 'Donasi Berhasil - Energi Bahagia'
    : 'Menunggu Konfirmasi - Energi
    Bahagia')

@section('content')
    <section class="py-20 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto">

                <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

                    @if ($donasi->status == 'confirmed')
                        <!-- Header Sukses -->
                        <div class="bg-gradient-to-r from-[#8AD337] to-[#6fb32e] px-6 py-8 text-center">
                            <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-check-circle text-white text-4xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-white">Donasi Berhasil!</h3>
                            <p class="text-white/80 mt-2">Terima kasih atas donasi Anda</p>
                        </div>

                        <!-- Konten Sukses -->
                        <div class="p-6 md:p-8">
                            <!-- Pesan Terima Kasih -->
                            <div class="text-center mb-8 pb-6 border-b border-gray-200">
                                <i class="fas fa-heart text-[#8AD337] text-4xl mb-3"></i>
                                <p class="text-gray-700 text-lg font-medium">
                                    "Kebaikan anda sangat berarti bagi mereka yang membutuhkan"
                                </p>
                                <p class="text-gray-500 mt-2">
                                    Terima kasih atas kepedulian dan kebaikan anda.
                                </p>
                            </div>

                            <!-- Alert Sukses -->
                            <div class="mb-6 p-4 bg-green-100 rounded-xl border border-green-300">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-check-circle text-green-500 text-xl"></i>
                                    <div>
                                        <p class="font-semibold text-green-800">Donasi Telah Dikonfirmasi!</p>
                                        <p class="text-green-700 text-sm">Donasi Anda telah berhasil dikonfirmasi oleh admin
                                            pada {{ $donasi->confirmed_at->format('d F Y H:i') }} WIB.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Detail Donasi -->
                            <div class="mb-6">
                                <h4 class="text-lg font-bold text-[#183D57] mb-4 flex items-center gap-2">
                                    <i class="fas fa-receipt text-[#8AD337]"></i>
                                    Detail Donasi
                                </h4>

                                <div class="bg-gray-50 rounded-xl p-4 space-y-3">
                                    <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                        <span class="text-gray-500">Kode Unik Donasi</span>
                                        <span class="font-mono font-bold text-[#183D57]">{{ $donasi->kode_unik }}</span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                        <span class="text-gray-500">Program Donasi</span>
                                        <span class="font-semibold text-gray-800">{{ $donasi->program->judul }}</span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                        <span class="text-gray-500">Nominal Donasi</span>
                                        <span class="font-bold text-[#8AD337] text-lg">Rp
                                            {{ number_format($donasi->nominal, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                        <span class="text-gray-500">Bank Tujuan</span>
                                        <span class="font-semibold text-gray-800">{{ $donasi->bank->nama_bank }}</span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                        <span class="text-gray-500">No. Rekening Tujuan</span>
                                        <span class="font-semibold text-gray-800">{{ $donasi->bank->nomor_rekening }} a.n
                                            {{ $donasi->bank->atas_nama }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-500">Waktu Konfirmasi</span>
                                        <span class="text-gray-600">{{ $donasi->confirmed_at->format('d F Y, H:i') }}
                                            WIB</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Diri Donatur -->
                            <div class="mb-6">
                                <h4 class="text-lg font-bold text-[#183D57] mb-4 flex items-center gap-2">
                                    <i class="fas fa-user text-[#8AD337]"></i>
                                    Data Diri
                                </h4>

                                <div class="bg-gray-50 rounded-xl p-4 space-y-3">
                                    <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                        <span class="text-gray-500">Nama Lengkap</span>
                                        <span class="font-semibold text-gray-800">{{ $donasi->nama }}</span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                        <span class="text-gray-500">Email</span>
                                        <span class="text-gray-600">{{ $donasi->email }}</span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                        <span class="text-gray-500">Nomor Telepon</span>
                                        <span class="text-gray-600">{{ $donasi->phone }}</span>
                                    </div>
                                    @if ($donasi->pesan)
                                        <div class="flex justify-between items-start">
                                            <span class="text-gray-500">Doa / Pesan</span>
                                            <span
                                                class="text-gray-600 text-right max-w-[60%] italic">"{{ $donasi->pesan }}"</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Catatan Admin -->
                            @if ($donasi->admin_note)
                                <div class="mb-8 p-4 bg-blue-50 rounded-xl border border-blue-200">
                                    <div class="flex items-start gap-3">
                                        <i class="fas fa-sticky-note text-blue-500 text-xl mt-0.5"></i>
                                        <div>
                                            <p class="font-semibold text-blue-800">Catatan dari Admin</p>
                                            <p class="text-blue-700 text-sm mt-1">{{ $donasi->admin_note }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Tombol Aksi -->
                            <div class="flex flex-col gap-3">
                                <a href="{{ route('programs') }}"
                                    class="bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition text-center">
                                    <i class="fas fa-hand-holding-heart mr-2"></i>
                                    Donasi Lagi
                                </a>
                                <a href="{{ route('home') }}"
                                    class="text-[#8AD337] hover:text-[#183D57] transition text-center">
                                    <i class="fas fa-home mr-2"></i>
                                    Ke Halaman Utama
                                </a>
                            </div>
                        </div>
                    @elseif($donasi->status == 'expired')
                        <!-- Header Kadaluarsa -->
                        <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-8 text-center">
                            <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-clock text-white text-4xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-white">Donasi Kadaluarsa</h3>
                            <p class="text-white/80 mt-2">Waktu pembayaran telah habis</p>
                        </div>

                        <div class="p-6 md:p-8 text-center">
                            <i class="fas fa-exclamation-triangle text-red-500 text-5xl mb-4"></i>
                            <p class="text-gray-600 mb-4">Donasi Anda sudah kadaluarsa karena tidak melakukan pembayaran
                                tepat waktu.</p>
                            <a href="{{ route('programs') }}"
                                class="inline-block bg-[#8AD337] text-[#183D57] px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition">
                                <i class="fas fa-hand-holding-heart mr-2"></i>
                                Donasi Lagi
                            </a>
                        </div>
                    @else
                        <!-- Header Menunggu -->
                        <div class="bg-gradient-to-r from-[#8AD337] to-[#6fb32e] px-6 py-8 text-center">
                            <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-hourglass-half text-white text-4xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-white">Menunggu Konfirmasi</h3>
                            <p class="text-white/80 mt-2">Bukti transfer Anda sedang kami verifikasi</p>
                        </div>

                        <!-- Konten Menunggu -->
                        <div class="p-6 md:p-8">
                            <!-- Pesan Terima Kasih -->
                            <div class="text-center mb-8 pb-6 border-b border-gray-200">
                                <i class="fas fa-heart text-[#8AD337] text-4xl mb-3"></i>
                                <p class="text-gray-700 text-lg font-medium">
                                    "Kebaikan anda sangat berarti bagi mereka yang membutuhkan"
                                </p>
                                <p class="text-gray-500 mt-2">
                                    Terima kasih atas kepedulian dan kebaikan anda.
                                </p>
                            </div>

                            <!-- Detail Donasi -->
                            <div class="mb-6">
                                <h4 class="text-lg font-bold text-[#183D57] mb-4 flex items-center gap-2">
                                    <i class="fas fa-receipt text-[#8AD337]"></i>
                                    Detail Donasi
                                </h4>

                                <div class="bg-gray-50 rounded-xl p-4 space-y-3">
                                    <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                        <span class="text-gray-500">Kode Unik Donasi</span>
                                        <span class="font-mono font-bold text-[#183D57]">{{ $donasi->kode_unik }}</span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                        <span class="text-gray-500">Program Donasi</span>
                                        <span class="font-semibold text-gray-800">{{ $donasi->program->judul }}</span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                        <span class="text-gray-500">Nominal Donasi</span>
                                        <span class="font-bold text-[#8AD337] text-lg">Rp
                                            {{ number_format($donasi->nominal, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                        <span class="text-gray-500">Bank Tujuan</span>
                                        <span class="font-semibold text-gray-800">{{ $donasi->bank->nama_bank }}</span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                        <span class="text-gray-500">No. Rekening Tujuan</span>
                                        <span class="font-semibold text-gray-800">{{ $donasi->bank->nomor_rekening }} a.n
                                            {{ $donasi->bank->atas_nama }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-500">Waktu Donasi</span>
                                        <span class="text-gray-600">{{ $donasi->created_at->format('d F Y, H:i') }}
                                            WIB</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Diri Donatur -->
                            <div class="mb-6">
                                <h4 class="text-lg font-bold text-[#183D57] mb-4 flex items-center gap-2">
                                    <i class="fas fa-user text-[#8AD337]"></i>
                                    Data Diri
                                </h4>

                                <div class="bg-gray-50 rounded-xl p-4 space-y-3">
                                    <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                        <span class="text-gray-500">Nama Lengkap</span>
                                        <span class="font-semibold text-gray-800">{{ $donasi->nama }}</span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                        <span class="text-gray-500">Email</span>
                                        <span class="text-gray-600">{{ $donasi->email }}</span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                        <span class="text-gray-500">Nomor Telepon</span>
                                        <span class="text-gray-600">{{ $donasi->phone }}</span>
                                    </div>
                                    @if ($donasi->pesan)
                                        <div class="flex justify-between items-start">
                                            <span class="text-gray-500">Doa / Pesan</span>
                                            <span
                                                class="text-gray-600 text-right max-w-[60%] italic">"{{ $donasi->pesan }}"</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Status Informasi -->
                            <div class="mb-8 p-4 bg-yellow-50 rounded-xl border border-yellow-200">
                                <div class="flex items-start gap-3">
                                    <i class="fas fa-info-circle text-yellow-500 text-xl mt-0.5"></i>
                                    <div>
                                        <p class="font-semibold text-yellow-800">Status Donasi</p>
                                        <p class="text-yellow-700 text-sm mt-1">
                                            Donasi Anda sedang dalam proses verifikasi. Tim kami akan mengonfirmasi dalam
                                            waktu
                                            maksimal 1x24 jam.
                                            Status donasi akan berubah menjadi "Terkonfirmasi" setelah verifikasi selesai.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Auto Refresh Script -->
                            <script>
                                // Cek status setiap 10 detik
                                setInterval(function() {
                                    fetch(window.location.href)
                                        .then(response => response.text())
                                        .then(html => {
                                            // Jika status berubah, reload halaman
                                            if (html.includes('Donasi Telah Dikonfirmasi') || html.includes('Donasi Kadaluarsa')) {
                                                location.reload();
                                            }
                                        });
                                }, 10000);
                            </script>

                            <!-- Tombol Aksi -->
                            <div class="flex flex-col gap-3">
                                <a href="{{ route('programs') }}"
                                    class="bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition text-center">
                                    <i class="fas fa-hand-holding-heart mr-2"></i>
                                    Donasi Lagi
                                </a>
                                <a href="{{ route('home') }}"
                                    class="text-[#8AD337] hover:text-[#183D57] transition text-center">
                                    <i class="fas fa-home mr-2"></i>
                                    Ke Halaman Utama
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
