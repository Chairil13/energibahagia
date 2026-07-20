@extends('layouts.app')

@section('title', 'Login & Register - Energi Bahagia')

@section('content')
    <!-- Login Section -->
    <section class="py-20 bg-gray-50 min-h-screen flex items-center">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">

                <!-- Box Utama -->
                <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">

                    <!-- Logo dan Judul -->
                    <div class="text-center mb-6">
                        <div class="flex justify-center mb-4">
                            <img src="{{ asset('images/logo.png') }}" alt="Energi Bahagia" class="h-16 w-auto">
                        </div>
                        <h1 class="text-2xl font-bold text-[#183D57] mb-1">Selamat Datang</h1>
                        <p class="text-gray-500 text-sm">Donatur Energi Bahagia</p>
                    </div>

                    <!-- Alert Success/Error -->
                    @if (session('success'))
                        <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <!-- Tab Navigation -->
                    <div class="flex justify-center gap-8 mb-6 border-b border-gray-200">
                        <button id="loginTab"
                            class="tab-btn pb-2 px-2 font-semibold text-base transition-all duration-300 active">
                            Login
                        </button>
                        <button id="registerTab"
                            class="tab-btn pb-2 px-2 font-semibold text-base transition-all duration-300">
                            Daftar
                        </button>
                    </div>

                    <!-- ==================== FORM LOGIN ==================== -->
                    <div id="loginForm" class="tab-content">
                        <div class="max-w-md mx-auto">
                            <form action="{{ route('login.post') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2 text-sm">Email <span
                                            class="text-red-500">*</span></label>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        placeholder="Masukkan email Anda"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20 transition-all">
                                </div>

                                <div class="mb-3">
                                    <label class="block text-gray-700 font-medium mb-2 text-sm">Kata Sandi <span
                                            class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <input type="password" name="password" id="password"
                                            placeholder="Masukkan kata sandi"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20 transition-all pr-12">
                                        <button type="button" id="togglePassword"
                                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#8AD337] transition">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="flex justify-between items-center mb-6">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox" name="remember"
                                            class="w-4 h-4 text-[#8AD337] rounded focus:ring-[#8AD337] border-gray-300">
                                        <span class="text-xs text-gray-600">Ingat saya</span>
                                    </label>
                                    <a href="#"
                                        class="text-xs text-[#8AD337] hover:text-[#183D57] transition-colors">Lupa
                                        Password?</a>
                                </div>

                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] py-3 rounded-xl font-bold text-base hover:shadow-lg transition-all duration-300 hover:scale-[1.02]">
                                    Login
                                </button>
                            </form>

                            <div class="mt-6 text-center">
                                <p class="text-xs text-gray-500">
                                    Dengan menjadi donatur, Anda telah berkontribusi untuk masa depan yang lebih baik.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- ==================== FORM REGISTER ==================== -->
                    <div id="registerForm" class="tab-content hidden">
                        <div class="max-h-[550px] overflow-y-auto pr-3 custom-scroll">
                            <form action="{{ route('register.post') }}" method="POST">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                    <!-- Kolom Kiri -->
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-gray-700 font-medium mb-2 text-sm">Nama Lengkap <span
                                                    class="text-red-500">*</span></label>
                                            <input type="text" name="name" value="{{ old('name') }}"
                                                placeholder="Masukkan nama lengkap"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20 transition-all">
                                        </div>

                                        <div>
                                            <label class="block text-gray-700 font-medium mb-2 text-sm">Email <span
                                                    class="text-red-500">*</span></label>
                                            <input type="email" name="email" value="{{ old('email') }}"
                                                placeholder="Masukkan email"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20 transition-all">
                                        </div>

                                        <div>
                                            <label class="block text-gray-700 font-medium mb-2 text-sm">Nomor Telepon <span
                                                    class="text-red-500">*</span></label>
                                            <input type="tel" name="phone" value="{{ old('phone') }}"
                                                placeholder="Masukkan nomor telepon"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20 transition-all">
                                        </div>

                                        <div>
                                            <label class="block text-gray-700 font-medium mb-2 text-sm">Alamat</label>
                                            <textarea name="address" rows="2" placeholder="Masukkan alamat lengkap"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20 transition-all resize-none">{{ old('address') }}</textarea>
                                        </div>

                                        <div>
                                            <label class="block text-gray-700 font-medium mb-2 text-sm">Kota</label>
                                            <input type="text" name="city" value="{{ old('city') }}"
                                                placeholder="Masukkan kota"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20 transition-all">
                                        </div>

                                        <div>
                                            <label class="block text-gray-700 font-medium mb-2 text-sm">Provinsi</label>
                                            <input type="text" name="province" value="{{ old('province') }}"
                                                placeholder="Masukkan provinsi"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20 transition-all">
                                        </div>

                                        <div>
                                            <label class="block text-gray-700 font-medium mb-2 text-sm">Kode Pos</label>
                                            <input type="text" name="postal_code" value="{{ old('postal_code') }}"
                                                placeholder="Masukkan kode pos"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20 transition-all">
                                        </div>
                                    </div>

                                    <!-- Kolom Kanan -->
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-gray-700 font-medium mb-2 text-sm">Nomor Identitas
                                                (KTP/SIM) <span class="text-gray-400 text-xs">(opsional)</span></label>
                                            <input type="text" name="identity_number"
                                                value="{{ old('identity_number') }}"
                                                placeholder="Masukkan nomor KTP/SIM (boleh kosong)"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20 transition-all">
                                        </div>

                                        <div>
                                            <label class="block text-gray-700 font-medium mb-2 text-sm">Tanggal
                                                Lahir</label>
                                            <input type="date" name="birth_date" value="{{ old('birth_date') }}"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20 transition-all">
                                        </div>

                                        <div>
                                            <label class="block text-gray-700 font-medium mb-2 text-sm">Jenis
                                                Kelamin</label>
                                            <div class="flex gap-6">
                                                <label class="flex items-center gap-2 cursor-pointer">
                                                    <input type="radio" name="gender" value="L"
                                                        {{ old('gender') == 'L' ? 'checked' : '' }}
                                                        class="w-4 h-4 text-[#8AD337] focus:ring-[#8AD337]">
                                                    <span class="text-sm text-gray-600">Laki-laki</span>
                                                </label>
                                                <label class="flex items-center gap-2 cursor-pointer">
                                                    <input type="radio" name="gender" value="P"
                                                        {{ old('gender') == 'P' ? 'checked' : '' }}
                                                        class="w-4 h-4 text-[#8AD337] focus:ring-[#8AD337]">
                                                    <span class="text-sm text-gray-600">Perempuan</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-gray-700 font-medium mb-2 text-sm">Pekerjaan</label>
                                            <input type="text" name="occupation" value="{{ old('occupation') }}"
                                                placeholder="Masukkan pekerjaan"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20 transition-all">
                                        </div>

                                        <div>
                                            <label class="block text-gray-700 font-medium mb-2 text-sm">Kontak
                                                Darurat</label>
                                            <input type="tel" name="emergency_contact"
                                                value="{{ old('emergency_contact') }}"
                                                placeholder="Nomor telepon darurat"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20 transition-all">
                                        </div>

                                        <div>
                                            <label class="block text-gray-700 font-medium mb-2 text-sm">Nama Kontak
                                                Darurat</label>
                                            <input type="text" name="emergency_name"
                                                value="{{ old('emergency_name') }}" placeholder="Nama kontak darurat"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20 transition-all">
                                        </div>

                                        <div>
                                            <label class="block text-gray-700 font-medium mb-2 text-sm">Kata Sandi <span
                                                    class="text-red-500">*</span></label>
                                            <div class="relative">
                                                <input type="password" name="password" id="regPassword"
                                                    placeholder="Minimal 8 karakter"
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20 transition-all pr-12">
                                                <button type="button" id="toggleRegPassword"
                                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#8AD337] transition">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-gray-700 font-medium mb-2 text-sm">Konfirmasi Kata
                                                Sandi <span class="text-red-500">*</span></label>
                                            <div class="relative">
                                                <input type="password" name="password_confirmation" id="confirmPassword"
                                                    placeholder="Konfirmasi kata sandi"
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20 transition-all pr-12">
                                                <button type="button" id="toggleConfirmPassword"
                                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#8AD337] transition">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="role" value="donatur">

                                <button type="submit"
                                    class="w-full mt-6 bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] py-3 rounded-xl font-bold text-base hover:shadow-lg transition-all duration-300 hover:scale-[1.02]">
                                    Daftar
                                </button>
                            </form>

                            <div class="mt-6 text-center">
                                <p class="text-xs text-gray-500">
                                    Dengan mendaftar, Anda setuju untuk menjadi donatur dan berkontribusi untuk masa depan
                                    yang lebih baik.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .tab-btn.active {
            color: #8AD337;
            border-bottom: 2px solid #8AD337;
        }

        .tab-btn:not(.active) {
            color: #9CA3AF;
        }

        .tab-btn:not(.active):hover {
            color: #183D57;
        }

        .custom-scroll {
            scrollbar-width: thin;
            scrollbar-color: #8AD337 #e5e7eb;
        }

        .custom-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: #e5e7eb;
            border-radius: 10px;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background: #8AD337;
            border-radius: 10px;
        }

        .custom-scroll::-webkit-scrollbar-thumb:hover {
            background: #183D57;
        }
    </style>

    <script>
        const loginTab = document.getElementById('loginTab');
        const registerTab = document.getElementById('registerTab');
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');

        function setActiveTab(tab) {
            if (tab === 'login') {
                loginTab.classList.add('active');
                registerTab.classList.remove('active');
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
            } else {
                registerTab.classList.add('active');
                loginTab.classList.remove('active');
                registerForm.classList.remove('hidden');
                loginForm.classList.add('hidden');
            }
        }

        // --- MODIFIED LOGIC START ---
        // Check if there are validation errors. If yes, stay on the REGISTER tab.
        // Otherwise, default to the LOGIN tab.
        if ({{ $errors->any() ? 1 : 0 }}) {
            setActiveTab('register');
        } else {
            setActiveTab('login'); // Default to Login
        }
        // --- MODIFIED LOGIC END ---

        loginTab.addEventListener('click', () => setActiveTab('login'));
        registerTab.addEventListener('click', () => setActiveTab('register'));

        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        if (togglePassword) {
            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        }

        const toggleRegPassword = document.getElementById('toggleRegPassword');
        const regPassword = document.getElementById('regPassword');
        if (toggleRegPassword) {
            toggleRegPassword.addEventListener('click', function() {
                const type = regPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                regPassword.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        }

        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPassword = document.getElementById('confirmPassword');
        if (toggleConfirmPassword) {
            toggleConfirmPassword.addEventListener('click', function() {
                const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPassword.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        }
    </script>
@endsection
