<nav class="bg-white/95 backdrop-blur-xl shadow-lg sticky top-0 z-50 border-b border-[#8AD337]/20">
    <div class="container mx-auto px-6 py-4">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Energi Bahagia Logo" class="h-14 md:h-16 w-auto">
                </a>
            </div>

            <!-- Menu Desktop -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}"
                    class="font-medium transition-all duration-300 relative group {{ request()->routeIs('home') ? 'text-[#8AD337] font-semibold' : 'text-[#183D57] hover:text-[#8AD337]' }}">
                    Beranda
                </a>
                <a href="{{ route('profile') }}"
                    class="font-medium transition-all duration-300 relative group {{ request()->routeIs('profile') ? 'text-[#8AD337] font-semibold' : 'text-[#183D57] hover:text-[#8AD337]' }}">
                    Profil
                </a>
                <a href="{{ route('news') }}"
                    class="font-medium transition-all duration-300 relative group {{ request()->routeIs('news') ? 'text-[#8AD337] font-semibold' : 'text-[#183D57] hover:text-[#8AD337]' }}">
                    Berita
                </a>
                <a href="{{ route('gallery') }}"
                    class="font-medium transition-all duration-300 relative group {{ request()->routeIs('gallery') ? 'text-[#8AD337] font-semibold' : 'text-[#183D57] hover:text-[#8AD337]' }}">
                    Galeri
                </a>
                <!-- Gallery -->
                <!-- Menu Gallery -->

                <a href="{{ route('programs') }}"
                    class="font-medium transition-all duration-300 relative group {{ request()->routeIs('programs') ? 'text-[#8AD337] font-semibold' : 'text-[#183D57] hover:text-[#8AD337]' }}">
                    Program
                </a>
                <a href="{{ route('contact') }}"
                    class="font-medium transition-all duration-300 relative group {{ request()->routeIs('contact') ? 'text-[#8AD337] font-semibold' : 'text-[#183D57] hover:text-[#8AD337]' }}">
                    Kontak
                </a>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center space-x-3">
                @guest
                    <a href="{{ route('login') }}"
                        class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] text-white px-4 md:px-6 py-2 md:py-3 rounded-full hover:shadow-xl transition-all duration-300 transform hover:scale-105 font-medium text-sm md:text-base flex items-center border border-[#8AD337]/20">
                        <i class="fas fa-sign-in-alt mr-1 md:mr-2 text-[#8AD337]"></i>
                        <span>Login</span>
                    </a>
                @else
                    <!-- Notifikasi Donatur -->
                    <div class="relative" x-data="{
                        open: false,
                        notifications: [],
                        unreadCount: 0,

                        async fetchNotifications() {
                            try {
                                const response = await fetch('{{ route('donatur.notifications') }}');
                                if (!response.ok) return;
                                const data = await response.json();

                                const readNotifications = JSON.parse(localStorage.getItem('donatur_read_notifications') || '[]');
                                this.notifications = data.filter(n => !readNotifications.includes(n.id));
                                this.unreadCount = this.notifications.length;
                            } catch (e) {
                                console.error(e);
                            }
                        },

                        markAsRead(notifId, link) {
                            let readNotifications = JSON.parse(localStorage.getItem('donatur_read_notifications') || '[]');
                            if (!readNotifications.includes(notifId)) {
                                readNotifications.push(notifId);
                                localStorage.setItem('donatur_read_notifications', JSON.stringify(readNotifications));
                            }

                            this.notifications = this.notifications.filter(n => n.id !== notifId);
                            this.unreadCount = this.notifications.length;

                            if (link) {
                                window.location.href = link;
                            }
                        },

                        markAllAsRead() {
                            const allIds = this.notifications.map(n => n.id);
                            let readNotifications = JSON.parse(localStorage.getItem('donatur_read_notifications') || '[]');
                            readNotifications = [...new Set([...readNotifications, ...allIds])];
                            localStorage.setItem('donatur_read_notifications', JSON.stringify(readNotifications));

                            this.notifications = [];
                            this.unreadCount = 0;
                            this.open = false;
                        }
                    }" x-init="fetchNotifications(); setInterval(() => fetchNotifications(), 30000)">

                        <button @click="open = !open" class="relative p-2 text-[#183D57] hover:text-[#8AD337] transition focus:outline-none rounded-full hover:bg-gray-100 mr-2">
                            <i class="fas fa-bell text-xl"></i>
                            <span x-show="unreadCount > 0" x-text="unreadCount"
                                class="absolute top-0 right-0 min-w-[18px] h-[18px] bg-red-500 text-white text-[11px] font-bold rounded-full flex items-center justify-center px-1 animate-pulse"
                                style="display: none;"></span>
                        </button>

                        <!-- Dropdown Notifikasi -->
                        <div x-show="open" @click.away="open = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                            x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                            class="absolute right-0 mt-2 w-80 sm:w-96 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden z-50"
                            style="display: none;">

                            <div class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] px-4 py-3 flex justify-between items-center">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-bell text-[#8AD337]"></i>
                                    <p class="text-white font-semibold text-sm">Notifikasi Donasi</p>
                                </div>
                                <button x-show="unreadCount > 0" @click="markAllAsRead"
                                    class="text-xs text-[#8AD337] hover:text-white transition underline">
                                    Tandai semua dibaca
                                </button>
                            </div>

                            <div class="max-h-80 overflow-y-auto divide-y divide-gray-100" x-show="notifications.length > 0">
                                <template x-for="notif in notifications" :key="notif.id">
                                    <a href="#" @click.prevent="markAsRead(notif.id, notif.link)"
                                        class="block px-4 py-3 hover:bg-gray-50 transition cursor-pointer">
                                        <div class="flex items-start gap-3">
                                            <div class="w-9 h-9 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"
                                                :class="{
                                                    'bg-green-100 text-green-600': notif.type === 'success',
                                                    'bg-red-100 text-red-600': notif.type === 'cancel'
                                                }">
                                                <i class="text-sm"
                                                    :class="{
                                                        'fas fa-check-circle': notif.type === 'success',
                                                        'fas fa-times-circle': notif.type === 'cancel'
                                                    }"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-xs font-bold text-gray-800" x-text="notif.title"></p>
                                                <p class="text-xs text-gray-600 mt-0.5 line-clamp-2 leading-relaxed" x-text="notif.message"></p>
                                                <span class="text-[10px] text-gray-400 mt-1 block" x-text="notif.time"></span>
                                            </div>
                                        </div>
                                    </a>
                                </template>
                            </div>

                            <div x-show="notifications.length === 0" class="px-6 py-8 text-center">
                                <i class="fas fa-bell-slash text-3xl text-gray-300 mb-2"></i>
                                <p class="text-gray-500 text-xs font-medium">Tidak ada notifikasi baru</p>
                            </div>
                        </div>
                    </div>

                    <!-- Dropdown User - Versi Hover -->
                    <div class="relative group">
                        <button
                            class="flex items-center gap-2 text-[#183D57] hover:text-[#8AD337] transition-all focus:outline-none">
                            <i class="fas fa-user-circle text-2xl"></i>
                            <span class="font-medium hidden md:inline">{{ Str::limit(Auth::user()->name, 15) }}</span>
                            <i class="fas fa-chevron-down text-xs transition-transform group-hover:rotate-180"></i>
                        </button>

                        <div
                            class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 border border-[#8AD337]/20 overflow-hidden">
                            <!-- Header Dropdown -->
                            <div class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] px-4 py-3">
                                <p class="text-white text-sm font-semibold">{{ Auth::user()->name }}</p>
                                <p class="text-white/70 text-xs">{{ Auth::user()->email }}</p>
                            </div>

                            <!-- Menu Dropdown -->
                            <div class="py-2">
                                <a href="{{ route('donatur.dashboard') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-[#8AD337]/10 hover:text-[#8AD337] transition-all">
                                    <i class="fas fa-tachometer-alt w-5"></i>
                                    <span>Dashboard Donatur</span>
                                </a>
                                <a href="{{ route('donation.history') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-[#8AD337]/10 hover:text-[#8AD337] transition-all">
                                    <i class="fas fa-history w-5"></i>
                                    <span>Riwayat Donasi</span>
                                </a>
                                <a href="{{ route('donatur.profile') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-[#8AD337]/10 hover:text-[#8AD337] transition-all">
                                    <i class="fas fa-user w-5"></i>
                                    <span>Profil Saya</span>
                                </a>

                                <div class="border-t border-gray-100 my-1"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 transition-all">
                                        <i class="fas fa-sign-out-alt w-5"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endguest

                <!-- Mobile Menu Button -->
                <button id="menuBtn" class="md:hidden text-2xl text-[#183D57] focus:outline-none ml-1">
                    <i class="fas fa-bars" id="menuIcon"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div id="mobileMenu"
            class="md:hidden mt-4 hidden bg-white rounded-2xl shadow-xl overflow-hidden border border-[#8AD337]/20 transition-all duration-300">
            <div class="flex flex-col p-4 space-y-3">
                <a href="{{ route('home') }}"
                    class="font-medium py-3 px-4 rounded-xl hover:bg-[#8AD337]/10 transition-all duration-300 flex items-center">
                    <i class="fas fa-home mr-3 text-[#183D57]"></i> Beranda
                </a>
                <a href="{{ route('profile') }}"
                    class="font-medium py-3 px-4 rounded-xl hover:bg-[#8AD337]/10 transition-all duration-300 flex items-center">
                    <i class="fas fa-user mr-3 text-[#183D57]"></i> Profil
                </a>
                <a href="{{ route('news') }}"
                    class="font-medium py-3 px-4 rounded-xl hover:bg-[#8AD337]/10 transition-all duration-300 flex items-center">
                    <i class="fas fa-newspaper mr-3 text-[#183D57]"></i> Berita
                </a>
                <a href="{{ route('programs') }}"
                    class="font-medium py-3 px-4 rounded-xl hover:bg-[#8AD337]/10 transition-all duration-300 flex items-center">
                    <i class="fas fa-hand-holding-heart mr-3 text-[#183D57]"></i> Program
                </a>

                <a href="{{ route('gallery') }}"
                    class="font-medium py-3 px-4 rounded-xl hover:bg-[#8AD337]/10 transition-all duration-300 flex items-center {{ request()->routeIs('gallery') ? 'text-[#8AD337] bg-[#8AD337]/10 font-semibold' : 'text-[#183D57]' }}">
                    <i class="fas fa-images mr-3 text-[#183D57]"></i> Galeri
                </a>
                <a href="{{ route('contact') }}"
                    class="font-medium py-3 px-4 rounded-xl hover:bg-[#8AD337]/10 transition-all duration-300 flex items-center">
                    <i class="fas fa-envelope mr-3 text-[#183D57]"></i> Kontak
                </a>

                @auth
                    <div class="border-t border-[#8AD337]/20 pt-3">
                        <a href="{{ route('donatur.dashboard') }}"
                            class="font-medium py-3 px-4 rounded-xl hover:bg-[#8AD337]/10 transition-all duration-300 flex items-center">
                            <i class="fas fa-tachometer-alt mr-3 text-[#183D57]"></i> Dashboard
                        </a>
                        <a href="{{ route('donation.history') }}"
                            class="font-medium py-3 px-4 rounded-xl hover:bg-[#8AD337]/10 transition-all duration-300 flex items-center">
                            <i class="fas fa-history mr-3 text-[#183D57]"></i> Riwayat Donasi
                        </a>
                    </div>

                    <div class="pt-2">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="flex items-center justify-center space-x-2 bg-red-500 text-white py-3 px-4 rounded-xl hover:shadow-xl transition-all duration-300 font-medium w-full">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="pt-3 border-t border-[#8AD337]/20">
                        <a href="{{ route('login') }}"
                            class="flex items-center justify-center space-x-2 bg-gradient-to-r from-[#183D57] to-[#2a5a7a] text-white py-3 px-4 rounded-xl hover:shadow-xl transition-all duration-300 font-medium">
                            <i class="fas fa-sign-in-alt text-[#8AD337]"></i>
                            <span>Login / Daftar</span>
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const menuIcon = document.getElementById('menuIcon');

    if (menuBtn) {
        menuBtn.addEventListener('click', function() {
            if (mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.remove('hidden');
                menuIcon.classList.remove('fa-bars');
                menuIcon.classList.add('fa-times');
            } else {
                mobileMenu.classList.add('hidden');
                menuIcon.classList.remove('fa-times');
                menuIcon.classList.add('fa-bars');
            }
        });
    }
</script>
