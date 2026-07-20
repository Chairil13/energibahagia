@extends('layouts.app')

@section('title', $program->judul . ' - Donasi - Energi Bahagia')

@section('content')
    <!-- Hero Section Detail Donasi -->
    <section class="relative hero-pattern text-white py-16 overflow-hidden">
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
                <i class="fas fa-hand-holding-heart mr-2 text-[#8AD337]"></i>
                <span class="text-white">DONASI SEKARANG</span>
            </div>
            <h1 class="text-5xl md:text-6xl font-bold mb-4 font-playfair">
                <span class="bg-gradient-to-r from-[#8AD337] to-white bg-clip-text text-transparent">
                    Detail Donasi
                </span>
            </h1>
            <p class="text-xl text-white/90 max-w-2xl mx-auto">
                Setiap donasi Anda adalah harapan baru bagi mereka yang membutuhkan
            </p>
        </div>
    </section>

    <!-- Detail Donasi -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="max-w-5xl mx-auto">

                <!-- Program Donasi Card -->
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden mb-10">
                    <!-- Gambar Program -->
                    <div class="relative h-64 md:h-96 overflow-hidden">
                        @if ($program->gambar && file_exists(public_path('uploads/program/' . $program->gambar)))
                            <img src="{{ asset('uploads/program/' . $program->gambar) }}" alt="{{ $program->judul }}"
                                class="w-full h-full object-cover">
                        @else
                            <img src="https://placehold.co/1200x500/png?text={{ urlencode($program->judul) }}"
                                alt="{{ $program->judul }}" class="w-full h-full object-cover">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">{{ $program->judul }}</h2>
                            <p class="text-white/80">{{ $program->deskripsi_singkat }}</p>
                        </div>
                    </div>

                    <!-- Informasi Program -->
                    <div class="p-6 md:p-8">
                        <!-- Progress Bar -->
                        <div class="mb-6">
                            <div class="flex justify-between text-sm mb-2">
                                <span class="text-gray-600">Progress Donasi</span>
                                <span class="font-bold text-[#8AD337]">{{ $program->progress }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-[#8AD337] h-3 rounded-full" style="width: {{ $program->progress }}%"></div>
                            </div>
                        </div>

                        <!-- Statistik -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6 pb-6 border-b border-gray-100">
                            <div class="text-center">
                                <p class="text-gray-400 text-xs mb-1">Target Dana</p>
                                <p class="font-bold text-[#183D57] text-lg">Rp
                                    {{ number_format($program->target_dana, 0, ',', '.') }}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-gray-400 text-xs mb-1">Terkumpul</p>
                                <p class="font-bold text-[#8AD337] text-lg">Rp
                                    {{ number_format($program->dana_terkumpul, 0, ',', '.') }}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-gray-400 text-xs mb-1">Penerima</p>
                                <p class="font-bold text-[#183D57] text-lg">{{ number_format($program->penerima) }} Orang
                                </p>
                            </div>
                            <div class="text-center">
                                <p class="text-gray-400 text-xs mb-1">Donatur</p>
                                <p class="font-bold text-[#183D57] text-lg">{{ number_format($program->jumlah_donatur) }}
                                    Orang</p>
                            </div>
                        </div>

                        <!-- Deskripsi Program -->
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-[#183D57] mb-3">Deskripsi Program</h3>
                            <div class="text-gray-600 leading-relaxed space-y-4">
                                {!! nl2br(e($program->deskripsi_lengkap)) !!}
                            </div>
                        </div>

                        <!-- Info Tanggal -->
                        @if ($program->tanggal_mulai || $program->tanggal_berakhir)
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <div class="flex flex-wrap gap-4">
                                    @if ($program->tanggal_mulai)
                                        <div>
                                            <p class="text-gray-400 text-xs">Tanggal Mulai</p>
                                            <p class="font-medium text-[#183D57]">
                                                {{ $program->tanggal_mulai->format('d F Y') }}</p>
                                        </div>
                                    @endif
                                    @if ($program->tanggal_berakhir)
                                        <div>
                                            <p class="text-gray-400 text-xs">Tanggal Berakhir</p>
                                            <p class="font-medium text-[#183D57]">
                                                {{ $program->tanggal_berakhir->format('d F Y') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Informasi Donatur -->
                <div class="mb-6 bg-blue-50 border border-blue-200 rounded-2xl p-5">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 text-blue-600 mt-1"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12A9 9 0 1112 3a9 9 0 019 9z"/>
                            </svg>
                        </div>

                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-blue-800">
                                Ingin Memiliki Riwayat Donasi?
                            </h4>

                            <p class="mt-2 text-gray-700 leading-relaxed">
                                Anda tetap dapat melakukan donasi tanpa memiliki akun.
                                Namun, dengan mendaftar sebagai <strong>Donatur</strong>, Anda dapat
                                melihat riwayat donasi, memantau total donasi, mengelola profil,
                                serta mencetak bukti donasi kapan saja.
                            </p>

                            <div class="mt-4 flex flex-wrap gap-3">
                                <a href="{{ route('login') }}"
                                class="px-5 py-2 bg-[#183D57] hover:bg-[#2a5a7a] text-white rounded-lg transition duration-300">
                                    Daftar Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Donasi -->
                <div id="donationFormCard" class="bg-white rounded-3xl shadow-xl overflow-hidden scroll-mt-24">
                    <div class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] px-6 py-4">
                        <h3 class="text-xl font-bold text-white">Formulir Donasi</h3>
                        <p class="text-white/80 text-sm">Isi data diri Anda untuk melakukan donasi</p>
                    </div>

                    <div class="p-6 md:p-8">
                        @if ($errors->any())
                            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                                <p class="font-semibold mb-2">Mohon lengkapi data donasi terlebih dahulu.</p>
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('donasi.confirm', $program->id) }}" method="POST" id="donationForm">
                            @csrf
                            <input type="hidden" name="bank_id" id="selectedBank" value="">
                            <input type="hidden" id="nominalHidden" value="">

                            <!-- Nominal Donasi -->
                            <div class="mb-6">
                                <label class="block text-[#183D57] font-semibold mb-3">Nominal Donasi</label>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-3">
                                    <button type="button"
                                        class="nominal-btn px-4 py-3 border-2 border-gray-200 rounded-xl text-center hover:border-[#8AD337] hover:bg-[#8AD337]/10 transition-all font-semibold"
                                        data-nominal="10000">
                                        Rp 10.000
                                    </button>
                                    <button type="button"
                                        class="nominal-btn px-4 py-3 border-2 border-gray-200 rounded-xl text-center hover:border-[#8AD337] hover:bg-[#8AD337]/10 transition-all font-semibold"
                                        data-nominal="25000">
                                        Rp 25.000
                                    </button>
                                    <button type="button"
                                        class="nominal-btn px-4 py-3 border-2 border-gray-200 rounded-xl text-center hover:border-[#8AD337] hover:bg-[#8AD337]/10 transition-all font-semibold"
                                        data-nominal="50000">
                                        Rp 50.000
                                    </button>
                                    <button type="button"
                                        class="nominal-btn px-4 py-3 border-2 border-gray-200 rounded-xl text-center hover:border-[#8AD337] hover:bg-[#8AD337]/10 transition-all font-semibold"
                                        data-nominal="100000">
                                        Rp 100.000
                                    </button>
                                </div>
                                <div class="relative">
                                    Nominal Lainya
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></span>
                                    <input type="text" name="nominal" id="nominal"
                                        value="{{ old('nominal') }}" placeholder="Masukkan nominal lainnya"
                                        onkeyup="formatRupiah(this)" required
                                        class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                                    <input type="hidden" name="nominal_value" id="nominal_value"
                                        value="{{ old('nominal_value') }}">
                                </div>
                            </div>

                            <!-- Data Diri - Auto fill jika login -->
                            <div class="grid md:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <label class="block text-[#183D57] font-semibold mb-2">Nama Lengkap <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="nama" id="nama"
                                        value="{{ old('nama', Auth::check() ? Auth::user()->name : '') }}"
                                        placeholder="Masukkan nama lengkap" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                                </div>
                                <div>
                                    <label class="block text-[#183D57] font-semibold mb-2">Email <span
                                            class="text-red-500">*</span></label>
                                    <input type="email" name="email" id="email"
                                        value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}"
                                        placeholder="Masukkan email" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                                </div>
                                <div>
                                    <label class="block text-[#183D57] font-semibold mb-2">Nomor Telepon <span
                                            class="text-red-500">*</span></label>
                                    <input type="tel" name="phone" id="phone"
                                        value="{{ old('phone', Auth::check() ? Auth::user()->phone : '') }}"
                                        placeholder="Masukkan nomor telepon" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                                </div>
                                <div>
                                    <label class="block text-[#183D57] font-semibold mb-2">Alamat</label>
                                    <input type="text" name="alamat" id="alamat"
                                        value="{{ old('alamat', Auth::check() ? Auth::user()->address : '') }}"
                                        placeholder="Masukkan alamat"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                                </div>
                            </div>

                            <!-- Doa / Pesan -->
                            <div class="mb-6">
                                <label class="block text-[#183D57] font-semibold mb-2">Doa / Pesan (Opsional)</label>
                                <textarea name="pesan" rows="3" placeholder="Tuliskan doa atau pesan untuk para penerima manfaat..."
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">{{ old('pesan') }}</textarea>
                            </div>

                            <!-- Metode Pembayaran -->
                            @php
                                use App\Models\Bank;
                                $banks = Bank::where('is_active', true)->orderBy('urutan', 'asc')->get();
                            @endphp

                            <div class="mb-8">
                                <label class="block text-[#183D57] font-semibold mb-3">Metode Pembayaran</label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    @foreach ($banks as $bank)
                                        <label
                                            class="flex items-center gap-3 p-3 border border-gray-200 rounded-xl cursor-pointer hover:border-[#8AD337] transition-all has-[:checked]:border-[#8AD337] has-[:checked]:bg-[#8AD337]/5">
                                            <input type="radio" name="payment" value="{{ $bank->kode }}"
                                                class="w-4 h-4 text-[#8AD337] focus:ring-[#8AD337]"
                                                {{ old('payment') === $bank->kode ? 'checked' : '' }} required>
                                            <div class="w-10 h-10 rounded-lg flex items-center justify-center"
                                                style="background: {{ $bank->warna }}20">
                                                <i class="fas {{ $bank->icon }} text-xl"
                                                    style="color: {{ $bank->warna }}"></i>
                                            </div>
                                            <div class="flex-1">
                                                <p class="font-semibold text-gray-700">{{ $bank->nama_bank }}</p>
                                                <p class="text-xs text-gray-400">No. Rek: {{ $bank->nomor_rekening }} a.n
                                                    {{ $bank->atas_nama }}</p>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                           

                            <button type="submit"
                                class="w-full bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] py-4 rounded-xl font-bold text-lg hover:shadow-xl transition-all duration-300 hover:scale-[1.02]">
                                <i class="fas fa-hand-holding-heart mr-2"></i>
                                Donasi Sekarang
                            </button>

                            <p class="text-center text-gray-400 text-xs mt-4">
                                Dengan mengklik donasi, Anda menyetujui <a href="#"
                                    class="text-[#8AD337] hover:underline">Syarat dan Ketentuan</a> yang berlaku
                            </p>

                            @guest
                                <div class="mt-4 text-center">
                                    <p class="text-sm text-gray-500">
                                        Sudah punya akun? <a href="{{ route('login') }}"
                                            class="text-[#8AD337] font-semibold hover:underline">Login</a> untuk memudahkan
                                        pengisian data
                                    </p>
                                </div>
                            @endguest
                        </form>
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
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 font-playfair">Butuh Bantuan?</h2>
            <p class="text-lg mb-8 text-white/90">
                Hubungi tim kami jika mengalami kendala saat melakukan donasi
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="#"
                    class="group bg-[#8AD337] text-[#183D57] px-8 py-3 rounded-full font-bold hover:shadow-2xl transition-all duration-300 transform hover:scale-105 inline-flex items-center justify-center gap-2">
                    <i class="fab fa-whatsapp"></i> Chat Admin
                </a>
                <a href="{{ route('contact') }}"
                    class="group border-2 border-white text-white px-8 py-3 rounded-full font-bold hover:bg-[#8AD337] hover:text-[#183D57] hover:border-[#8AD337] transition-all duration-300 transform hover:scale-105 inline-flex items-center justify-center gap-2">
                    <i class="fas fa-envelope"></i> Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    <script>
        // Format Rupiah
        function formatRupiah(element) {
            let value = element.value.replace(/[^,\d]/g, '').toString();
            let split = value.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            element.value = rupiah ? 'Rp ' + rupiah : '';

            // Simpan nilai numeric ke hidden field
            let numericValue = value.replace(/\./g, '');
            document.getElementById('nominal_value').value = numericValue;
        }

        // Tombol nominal
        document.querySelectorAll('.nominal-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const nominal = this.dataset.nominal;
                const nominalInput = document.getElementById('nominal');
                const nominalHidden = document.getElementById('nominal_value');

                // Format ke Rupiah
                let rupiahFormat = new Intl.NumberFormat('id-ID').format(nominal);
                nominalInput.value = 'Rp ' + rupiahFormat;
                nominalHidden.value = nominal;

                // Hapus class active dari semua tombol
                document.querySelectorAll('.nominal-btn').forEach(b => {
                    b.classList.remove('border-[#8AD337]', 'bg-[#8AD337]/10');
                });
                // Tambah class active ke tombol yang diklik
                this.classList.add('border-[#8AD337]', 'bg-[#8AD337]/10');
            });
        });
        document.getElementById('donationForm').addEventListener('submit', function(e) {
            // Ambil bank yang dipilih
            const selectedPayment = document.querySelector('input[name="payment"]:checked');
            if (selectedPayment) {
                document.getElementById('selectedBank').value = selectedPayment.value;
            }

            // Ambil nominal
            const nominalInput = document.getElementById('nominal');
            let nominalValue = nominalInput.value.replace(/[^0-9]/g, '');
            document.getElementById('nominalHidden').value = nominalValue;
        });

        // Radio button sudah bisa dipilih karena menggunakan label yang membungkus input
        @auth
        console.log('User sudah login, data terisi otomatis');
        @else
            console.log('User belum login, silakan isi manual');
        @endauth

        @if ($errors->any())
            window.addEventListener('load', function() {
                const donationFormCard = document.getElementById('donationFormCard');

                if (donationFormCard) {
                    donationFormCard.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        @endif
    </script>
@endsection
