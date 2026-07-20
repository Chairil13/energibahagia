@extends('layouts.app')

@section('title', 'Cara Donasi - Energi Bahagia')

@section('content')
    <!-- Hero Section -->
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
                <i class="fas fa-question-circle mr-2 text-[#8AD337]"></i>
                <span class="text-white">PANDUAN DONASI</span>
            </div>
            <h1 class="text-5xl md:text-7xl font-bold mb-4 font-playfair">
                <span class="bg-gradient-to-r from-[#8AD337] to-white bg-clip-text text-transparent">
                    Cara Donasi
                </span>
            </h1>
            <p class="text-xl text-white/90 max-w-2xl mx-auto">
                Ikuti langkah-langkah mudah berikut untuk berdonasi dan berkontribusi dalam kebaikan
            </p>
        </div>
    </section>

    <!-- Langkah-langkah Donasi -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <span class="badge-premium">PANDUAN LENGKAP</span>
                <h2 class="text-3xl md:text-4xl font-bold text-[#183D57] mt-3 font-playfair">Mudah & Cepat</h2>
                <p class="text-gray-600 max-w-2xl mx-auto mt-2">Hanya 4 langkah sederhana untuk mulai berdonasi</p>
                <div class="w-24 h-1 bg-gradient-to-r from-[#8AD337] to-[#183D57] mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="grid md:grid-cols-4 gap-6">
                <!-- Langkah 1 -->
                <div class="text-center group">
                    <div class="relative">
                        <div
                            class="w-24 h-24 bg-gradient-to-r from-[#8AD337] to-[#6fb32e] rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-all duration-300">
                            <span class="text-3xl font-bold text-white">1</span>
                        </div>
                        <div
                            class="hidden md:block absolute top-1/2 -right-4 w-8 h-0.5 bg-gradient-to-r from-[#8AD337] to-[#183D57] group-last:hidden">
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-[#183D57] mb-2">Pilih Program</h3>
                    <p class="text-gray-500 text-sm">Pilih program donasi yang sesuai dengan keinginan Anda</p>
                </div>

                <!-- Langkah 2 -->
                <div class="text-center group">
                    <div class="relative">
                        <div
                            class="w-24 h-24 bg-gradient-to-r from-[#8AD337] to-[#6fb32e] rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-all duration-300">
                            <span class="text-3xl font-bold text-white">2</span>
                        </div>
                        <div
                            class="hidden md:block absolute top-1/2 -right-4 w-8 h-0.5 bg-gradient-to-r from-[#8AD337] to-[#183D57] group-last:hidden">
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-[#183D57] mb-2">Isi Formulir</h3>
                    <p class="text-gray-500 text-sm">Isi data diri dan nominal donasi yang diinginkan</p>
                </div>

                <!-- Langkah 3 -->
                <div class="text-center group">
                    <div class="relative">
                        <div
                            class="w-24 h-24 bg-gradient-to-r from-[#8AD337] to-[#6fb32e] rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-all duration-300">
                            <span class="text-3xl font-bold text-white">3</span>
                        </div>
                        <div
                            class="hidden md:block absolute top-1/2 -right-4 w-8 h-0.5 bg-gradient-to-r from-[#8AD337] to-[#183D57] group-last:hidden">
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-[#183D57] mb-2">Lakukan Transfer</h3>
                    <p class="text-gray-500 text-sm">Transfer sesuai nominal ke rekening yang tersedia</p>
                </div>

                <!-- Langkah 4 -->
                <div class="text-center">
                    <div
                        class="w-24 h-24 bg-gradient-to-r from-[#8AD337] to-[#6fb32e] rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-all duration-300">
                        <span class="text-3xl font-bold text-white">4</span>
                    </div>
                    <h3 class="text-xl font-bold text-[#183D57] mb-2">Konfirmasi</h3>
                    <p class="text-gray-500 text-sm">Upload bukti transfer dan tunggu konfirmasi</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Metode Pembayaran -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <span class="badge-premium">METODE PEMBAYARAN</span>
                <h2 class="text-3xl md:text-4xl font-bold text-[#183D57] mt-3 font-playfair">Transfer Bank</h2>
                <p class="text-gray-600 max-w-2xl mx-auto mt-2">Kami menerima transfer melalui berbagai bank berikut</p>
                <div class="w-24 h-1 bg-gradient-to-r from-[#8AD337] to-[#183D57] mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-5xl mx-auto">
                @php
                    use App\Models\Bank;
                    $banks = Bank::where('is_active', true)->orderBy('urutan', 'asc')->get();
                @endphp

                @foreach ($banks as $bank)
                    <div
                        class="bg-white rounded-2xl shadow-lg p-6 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group">
                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform"
                            style="background: {{ $bank->warna }}20">
                            <i class="fas {{ $bank->icon }} text-3xl" style="color: {{ $bank->warna }}"></i>
                        </div>
                        <h3 class="text-xl font-bold text-[#183D57] mb-2">{{ $bank->nama_bank }}</h3>
                        <p class="text-gray-600 text-sm">No. Rekening</p>
                        <p class="text-lg font-bold text-[#8AD337] font-mono">{{ $bank->nomor_rekening }}</p>
                        <p class="text-gray-500 text-sm mt-2">a.n {{ $bank->atas_nama }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Informasi Penting -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-12">
                    <span class="badge-premium">INFORMASI PENTING</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-[#183D57] mt-3 font-playfair">Hal yang Perlu Diperhatikan
                    </h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-[#8AD337] to-[#183D57] mx-auto mt-4 rounded-full"></div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="flex gap-4 p-5 bg-gray-50 rounded-2xl hover:shadow-md transition">
                        <div class="w-12 h-12 bg-[#8AD337]/20 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-clock text-[#8AD337] text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#183D57] mb-1">Batas Waktu Transfer</h4>
                            <p class="text-gray-500 text-sm">Setelah mengisi formulir donasi, Anda memiliki waktu 1 jam
                                untuk melakukan transfer. Donasi akan kadaluarsa jika melebihi batas waktu.</p>
                        </div>
                    </div>

                    <div class="flex gap-4 p-5 bg-gray-50 rounded-2xl hover:shadow-md transition">
                        <div class="w-12 h-12 bg-[#8AD337]/20 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-image text-[#8AD337] text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#183D57] mb-1">Upload Bukti Transfer</h4>
                            <p class="text-gray-500 text-sm">Setelah transfer, segera upload bukti transfer untuk
                                mempercepat proses verifikasi donasi Anda.</p>
                        </div>
                    </div>

                    <div class="flex gap-4 p-5 bg-gray-50 rounded-2xl hover:shadow-md transition">
                        <div class="w-12 h-12 bg-[#8AD337]/20 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-check-circle text-[#8AD337] text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#183D57] mb-1">Konfirmasi Donasi</h4>
                            <p class="text-gray-500 text-sm">Donasi akan dikonfirmasi maksimal 1x24 jam setelah bukti
                                transfer diupload. Anda akan menerima email notifikasi.</p>
                        </div>
                    </div>

                    <div class="flex gap-4 p-5 bg-gray-50 rounded-2xl hover:shadow-md transition">
                        <div class="w-12 h-12 bg-[#8AD337]/20 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-receipt text-[#8AD337] text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#183D57] mb-1">Bukti Donasi</h4>
                            <p class="text-gray-500 text-sm">Donatur akan mendapatkan bukti donasi resmi yang dapat diunduh
                                setelah donasi dikonfirmasi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Sederhana -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto">
                <div class="text-center mb-12">
                    <span class="badge-premium">FAQ</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-[#183D57] mt-3 font-playfair">Pertanyaan Umum</h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-[#8AD337] to-[#183D57] mx-auto mt-4 rounded-full"></div>
                </div>

                <div class="space-y-4">
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                        <button
                            class="faq-question w-full text-left p-5 flex justify-between items-center hover:bg-gray-50 transition">
                            <span class="font-semibold text-[#183D57]">Apakah donasi bisa dilakukan kapan saja?</span>
                            <i class="fas fa-chevron-down text-[#8AD337] transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden px-5 pb-5 text-gray-500 text-sm border-t border-gray-100">
                            Ya, donasi dapat dilakukan kapan saja selama program donasi masih aktif dan belum mencapai
                            target.
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                        <button
                            class="faq-question w-full text-left p-5 flex justify-between items-center hover:bg-gray-50 transition">
                            <span class="font-semibold text-[#183D57]">Apakah ada biaya admin?</span>
                            <i class="fas fa-chevron-down text-[#8AD337] transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden px-5 pb-5 text-gray-500 text-sm border-t border-gray-100">
                            Tidak ada biaya admin. 100% donasi Anda akan disalurkan kepada penerima manfaat.
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                        <button
                            class="faq-question w-full text-left p-5 flex justify-between items-center hover:bg-gray-50 transition">
                            <span class="font-semibold text-[#183D57]">Bagaimana cara mendapatkan bukti donasi?</span>
                            <i class="fas fa-chevron-down text-[#8AD337] transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden px-5 pb-5 text-gray-500 text-sm border-t border-gray-100">
                            Setelah donasi dikonfirmasi, Anda dapat mengunduh bukti donasi melalui halaman riwayat donasi.
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                        <button
                            class="faq-question w-full text-left p-5 flex justify-between items-center hover:bg-gray-50 transition">
                            <span class="font-semibold text-[#183D57]">Apakah donasi bisa dibatalkan?</span>
                            <i class="fas fa-chevron-down text-[#8AD337] transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden px-5 pb-5 text-gray-500 text-sm border-t border-gray-100">
                            Donasi yang sudah dikonfirmasi tidak dapat dibatalkan. Untuk donasi yang masih pending, silakan
                            hubungi admin.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-20 overflow-hidden">
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
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 font-playfair">Siap Berdonasi?</h2>
            <p class="text-lg mb-8 text-white/90 max-w-2xl mx-auto">
                Mulai langkah kecil Anda untuk berbagi kebaikan
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('programs') }}"
                    class="group bg-[#8AD337] text-[#183D57] px-8 py-3 rounded-full font-bold hover:shadow-2xl transition-all duration-300 transform hover:scale-105 inline-flex items-center justify-center gap-2">
                    <i class="fas fa-hand-holding-heart mr-2"></i>
                    Donasi Sekarang
                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="{{ route('contact') }}"
                    class="group border-2 border-white text-white px-8 py-3 rounded-full font-bold hover:bg-[#8AD337] hover:text-[#183D57] hover:border-[#8AD337] transition-all duration-300 transform hover:scale-105 inline-flex items-center justify-center gap-2">
                    <i class="fas fa-headset mr-2"></i>
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    <script>
        // FAQ Accordion
        document.querySelectorAll('.faq-question').forEach(button => {
            button.addEventListener('click', () => {
                const answer = button.nextElementSibling;
                const icon = button.querySelector('i');

                answer.classList.toggle('hidden');
                icon.classList.toggle('fa-chevron-down');
                icon.classList.toggle('fa-chevron-up');
            });
        });
    </script>
@endsection
