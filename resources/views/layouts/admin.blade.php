<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - Energi Bahagia</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Alpine.js untuk dropdown -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        /* Warna Admin */
        :root {
            --primary-dark: #183D57;
            --primary-green: #8AD337;
            --sidebar-width: 280px;
        }

        .sidebar {
            width: var(--sidebar-width);
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #183D57 0%, #0f2f42 100%);
        }

        .sidebar-link {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .sidebar-link:hover {
            background: rgba(138, 211, 55, 0.1);
            color: #8AD337;
            transform: translateX(5px);
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, rgba(138, 211, 55, 0.15), rgba(24, 61, 87, 0.05));
            color: #8AD337;
            border-right: 3px solid #8AD337;
        }

        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: #8AD337;
        }

        .dropdown-menu {
            display: none;
        }

        .dropdown-menu.open {
            display: block;
        }

        .dropdown-toggle .fa-chevron-down {
            transition: transform 0.3s ease;
        }

        .dropdown-toggle.open .fa-chevron-down {
            transform: rotate(180deg);
        }

        .main-content {
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 1000;
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #183D57, #8AD337);
            border-radius: 4px;
        }

        /* Card hover effect */
        .stat-card {
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* Dropdown animation */
        .dropdown-enter {
            transition: all 0.2s ease;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-100">

    <!-- Sidebar -->
    <aside class="sidebar fixed left-0 top-0 h-full shadow-2xl overflow-y-auto">
        <!-- Logo Section -->
        <div class="p-6 border-b border-white/10">
            <div class="flex items-center gap-3">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-[#8AD337] to-[#6fb32e] rounded-xl flex items-center justify-center">
                    <i class="fas fa-hands-helping text-[#183D57] text-xl"></i>
                </div>
                <div>
                    <h1 class="text-white font-bold text-lg">Energi Bahagia</h1>
                    <p class="text-white/50 text-xs">Admin Panel</p>
                </div>
            </div>
        </div>

        <!-- Navigation dengan Dropdown -->
        <nav class="p-4" x-data="sidebarNavigation()">
            <!-- MAIN NAVIGATION -->
            <div class="mb-6">
                <p class="text-white/40 text-xs uppercase tracking-wider mb-3 px-3 font-semibold">Main Navigation</p>

                @php
                    $isContentMenuActive = request()->routeIs(
                        'admin.hero',
                        'admin.profile-hero',
                        'admin.sejarah',
                        'admin.visi-misi',
                        'admin.program.*',
                        'admin.berita.*',
                        'admin.kategori-program.*',
                        'admin.gallery.*',
                        'admin.kontak'
                    );
                    $isDataMenuActive = request()->routeIs(
                        'admin.users',
                        'admin.users.*',
                        'admin.donasi.*',
                        'admin.bank.*'
                    );
                @endphp

                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}"
                    class="sidebar-link flex items-center gap-3 px-3 py-3 rounded-lg text-white/70 hover:text-[#8AD337] transition-all {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span>Dashboard</span>
                </a>

                <!-- Kelola Konten (Dropdown) -->
                <div x-data="{ open: {{ $isContentMenuActive ? 'true' : 'false' }} }">
                    <button @click="open = !open"
                        class="dropdown-toggle w-full sidebar-link flex items-center justify-between gap-3 px-3 py-3 rounded-lg text-white/70 hover:text-[#8AD337] transition-all"
                        :class="{ 'open': open }">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-layer-group w-5"></i>
                            <span>Kelola Konten</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': open }"></i>
                    </button>

                    <div class="dropdown-menu ml-6 mt-1 space-y-1" :class="{ 'open': open }">
                        <a href="{{ route('admin.hero') }}"
                            class="flex items-center gap-3 px-3 py-2 rounded-lg text-white/60 hover:text-[#8AD337] hover:bg-white/5 transition-all text-sm {{ request()->routeIs('admin.hero') ? 'text-[#8AD337] bg-white/5' : '' }}">
                            <i class="fas fa-image w-4"></i>
                            <span>Hero Section</span>
                        </a>
                        <a href="{{ route('admin.profile-hero') }}"
                            class="flex items-center gap-3 px-3 py-2 rounded-lg text-white/60 hover:text-[#8AD337] hover:bg-white/5 transition-all text-sm {{ request()->routeIs('admin.profile-hero') ? 'text-[#8AD337] bg-white/5' : '' }}">
                            <i class="fas fa-user-circle w-4"></i>
                            <span>Profile Hero</span>
                        </a>
                        <a href="{{ route('admin.sejarah') }}"
                            class="flex items-center gap-3 px-3 py-2 rounded-lg text-white/60 hover:text-[#8AD337] hover:bg-white/5 transition-all text-sm {{ request()->routeIs('admin.sejarah') ? 'text-[#8AD337] bg-white/5' : '' }}">
                            <i class="fas fa-user-circle w-4"></i>
                            <span>Sejarah Lembaga</span>
                        </a>
                        <a href="{{ route('admin.visi-misi') }}"
                            class="flex items-center gap-3 px-3 py-2 rounded-lg text-white/60 hover:text-[#8AD337] hover:bg-white/5 transition-all text-sm {{ request()->routeIs('admin.visi-misi') ? 'text-[#8AD337] bg-white/5' : '' }}">
                            <i class="fas fa-bullseye w-4"></i>
                            <span>Visi & Misi</span>
                        </a>
                        <a href="{{ route('admin.program.index') }}"
                            class="flex items-center gap-3 px-3 py-2 rounded-lg text-white/60 hover:text-[#8AD337] hover:bg-white/5 transition-all text-sm {{ request()->routeIs('admin.program.*') ? 'text-[#8AD337] bg-white/5' : '' }}">
                            <i class="fas fa-hand-holding-heart w-4"></i>
                            <span>Kelola Program</span>
                        </a>

                        <a href="{{ route('admin.berita.index') }}"
                            class="flex items-center gap-3 px-3 py-2 rounded-lg text-white/60 hover:text-[#8AD337] hover:bg-white/5 transition-all text-sm {{ request()->routeIs('admin.berita.*') ? 'text-[#8AD337] bg-white/5' : '' }}">
                            <i class="fas fa-newspaper w-4"></i>
                            <span>Kelola Berita</span>
                        </a>
                        <a href="{{ route('admin.kategori-program.index') }}"
                            class="flex items-center gap-3 px-3 py-2 rounded-lg text-white/60 hover:text-[#8AD337] hover:bg-white/5 transition-all text-sm {{ request()->routeIs('admin.kategori-program.*') ? 'text-[#8AD337] bg-white/5' : '' }}">
                            <i class="fas fa-tags w-4"></i>
                            <span>Kategori Program</span>
                        </a>
                        <a href="{{ route('admin.gallery.index') }}"
                            class="flex items-center gap-3 px-3 py-2 rounded-lg text-white/60 hover:text-[#8AD337] hover:bg-white/5 transition-all text-sm {{ request()->routeIs('admin.gallery.*') ? 'text-[#8AD337] bg-white/5' : '' }}">
                            <i class="fas fa-images w-4"></i>
                            <span>Gallery</span>
                        </a>
                        <a href="{{ route('admin.kontak') }}"
                            class="flex items-center gap-3 px-3 py-2 rounded-lg text-white/60 hover:text-[#8AD337] hover:bg-white/5 transition-all text-sm {{ request()->routeIs('admin.kontak') ? 'text-[#8AD337] bg-white/5' : '' }}">
                            <i class="fas fa-phone-alt w-5"></i>
                            <span>Kontak</span>
                        </a>
                    </div>
                </div>

                <!-- Kelola Data (Dropdown) -->
                <div x-data="{ open: {{ $isDataMenuActive ? 'true' : 'false' }} }">
                    <button @click="open = !open"
                        class="dropdown-toggle w-full sidebar-link flex items-center justify-between gap-3 px-3 py-3 rounded-lg text-white/70 hover:text-[#8AD337] transition-all"
                        :class="{ 'open': open }">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-database w-5"></i>
                            <span>Kelola Data</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': open }"></i>
                    </button>

                    <div class="dropdown-menu ml-6 mt-1 space-y-1" :class="{ 'open': open }">
                        <a href="{{ route('admin.users') }}"
                            class="flex items-center gap-3 px-3 py-2 rounded-lg text-white/60 hover:text-[#8AD337] hover:bg-white/5 transition-all text-sm {{ request()->routeIs('admin.users') ? 'text-[#8AD337] bg-white/5' : '' }}">
                            <i class="fas fa-users w-4"></i>
                            <span>Kelola User</span>
                        </a>
                        <a href="{{ route('admin.donasi.index') }}"
                            class="flex items-center gap-3 px-3 py-2 rounded-lg text-white/60 hover:text-[#8AD337] hover:bg-white/5 transition-all text-sm {{ request()->routeIs('admin.donasi.*') ? 'text-[#8AD337] bg-white/5' : '' }}">
                            <i class="fas fa-money-bill-wave w-4"></i>
                            <span>Kelola Donasi</span>
                        </a>

                        <a href="{{ route('admin.bank.index') }}"
                            class="flex items-center gap-3 px-3 py-2 rounded-lg text-white/60 hover:text-[#8AD337] hover:bg-white/5 transition-all text-sm {{ request()->routeIs('admin.bank.*') ? 'text-[#8AD337] bg-white/5' : '' }}">
                            <i class="fas fa-university w-4"></i>
                            <span>Kelola Bank</span>
                        </a>
                    </div>

                </div>
            </div>

            <!-- User Info Bottom -->
            <div class="pt-4 mt-4 border-t border-white/10">
                <div class="flex items-center gap-3 px-3 py-3">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-[#8AD337] to-[#6fb32e] rounded-full flex items-center justify-center">
                        <span class="text-[#183D57] font-bold text-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </span>
                    </div>
                    <div class="flex-1">
                        <p class="text-white text-sm font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-white/40 text-xs">{{ Auth::user()->role }}</p>
                    </div>
                </div>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content min-h-screen">
        <!-- Top Navbar -->
        <nav class="bg-white shadow-sm sticky top-0 z-50">
            <div class="px-6 py-4 flex justify-between items-center">
                <!-- Mobile Menu Button -->
                <button id="mobileMenuBtn" class="md:hidden text-2xl text-[#183D57]">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Page Title di Top Navbar -->
                <div class="hidden md:block">
                    <h2 class="text-lg font-semibold text-[#183D57]">
                        @yield('page-title', 'Dashboard')
                    </h2>
                    <p class="text-xs text-gray-500">@yield('page-description', 'Selamat datang di panel admin Energi Bahagia')</p>
                </div>

                <!-- Right Side -->
                <div class="flex items-center gap-4 ml-auto">
                    <!-- Logo -->
                    <a href="{{ route('home') }}" class="hidden md:block">
                        <img src="{{ asset('images/logo.png') }}" alt="Energi Bahagia" class="h-10 w-auto">
                    </a>
                    <!-- Notifikasi -->
                    <div class="relative" x-data="{
                        open: false,
                        notifications: [],
                        unreadCount: 0,
                    
                        async fetchNotifications() {
                            const response = await fetch('{{ route('admin.notifications') }}');
                            const data = await response.json();
                    
                            // Ambil notifikasi yang sudah dibaca dari localStorage
                            const readNotifications = JSON.parse(localStorage.getItem('read_notifications') || '[]');
                    
                            // Filter notifikasi yang belum dibaca
                            this.notifications = data.filter(n => !readNotifications.includes(n.id));
                            this.unreadCount = this.notifications.length;
                    
                            // Update badge di tab browser (opsional)
                            if (this.unreadCount > 0) {
                                document.title = '(' + this.unreadCount + ') Admin Panel - Energi Bahagia';
                            } else {
                                document.title = 'Admin Panel - Energi Bahagia';
                            }
                        },
                    
                        markAsRead(notifId, link) {
                            // Simpan ke localStorage sebagai sudah dibaca
                            let readNotifications = JSON.parse(localStorage.getItem('read_notifications') || '[]');
                            if (!readNotifications.includes(notifId)) {
                                readNotifications.push(notifId);
                                localStorage.setItem('read_notifications', JSON.stringify(readNotifications));
                            }
                    
                            // Update tampilan
                            this.notifications = this.notifications.filter(n => n.id !== notifId);
                            this.unreadCount = this.notifications.length;
                    
                            // Redirect ke link
                            window.location.href = link;
                        },
                    
                        markAllAsRead() {
                            // Tandai semua notifikasi sebagai sudah dibaca
                            const allIds = this.notifications.map(n => n.id);
                            let readNotifications = JSON.parse(localStorage.getItem('read_notifications') || '[]');
                            readNotifications = [...new Set([...readNotifications, ...allIds])];
                            localStorage.setItem('read_notifications', JSON.stringify(readNotifications));
                    
                            this.notifications = [];
                            this.unreadCount = 0;
                            this.open = false;
                    
                            // Update title
                            document.title = 'Admin Panel - Energi Bahagia';
                        }
                    
                    }" x-init="fetchNotifications();
                    setInterval(() => fetchNotifications(), 30000)">

                        <button @click="open = !open" class="relative">
                            <i class="fas fa-bell text-gray-500 text-xl hover:text-[#8AD337] transition"></i>
                            <span x-show="unreadCount > 0" x-text="unreadCount"
                                class="absolute -top-1 -right-1 min-w-[16px] h-4 bg-red-500 text-white text-[10px] rounded-full flex items-center justify-center px-1"></span>
                        </button>

                        <!-- Dropdown Notifikasi -->
                        <div x-show="open" @click.away="open = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-2"
                            class="absolute right-0 mt-2 w-96 bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden z-50"
                            style="display: none;">

                            <div
                                class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] px-4 py-3 flex justify-between items-center">
                                <p class="text-white font-semibold">Notifikasi</p>
                                <div class="flex gap-2">
                                    <button x-show="unreadCount > 0" @click="markAllAsRead"
                                        class="text-white/60 text-xs hover:text-white transition">
                                        Tandai semua sudah dibaca
                                    </button>
                                    <span x-show="unreadCount > 0" x-text="unreadCount + ' baru'"
                                        class="text-white/60 text-xs"></span>
                                </div>
                            </div>

                            <div class="max-h-96 overflow-y-auto" x-show="notifications.length > 0">
                                <template x-for="notif in notifications" :key="notif.id">
                                    <a href="#" @click.prevent="markAsRead(notif.id, notif.link)"
                                        class="block px-4 py-3 border-b border-gray-100 hover:bg-gray-50 transition group cursor-pointer">
                                        <div class="flex items-start gap-3">
                                            <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0"
                                                :class="{
                                                    'bg-yellow-100': notif.type === 'donasi',
                                                    'bg-green-100': notif.type === 'program',
                                                    'bg-blue-100': notif.type === 'berita'
                                                }">
                                                <i class="text-lg"
                                                    :class="{
                                                        'fas fa-money-bill-wave text-yellow-600': notif
                                                            .type === 'donasi',
                                                        'fas fa-hand-holding-heart text-green-600': notif
                                                            .type === 'program',
                                                        'fas fa-newspaper text-blue-600': notif.type === 'berita'
                                                    }"></i>
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-sm text-gray-800 font-medium" x-text="notif.title"></p>
                                                <p class="text-xs text-gray-500 mt-1" x-text="notif.message"></p>
                                                <p class="text-xs text-gray-400 mt-1" x-text="notif.time"></p>
                                            </div>
                                            <div class="w-2 h-2 bg-[#8AD337] rounded-full" x-show="!notif.read"></div>
                                        </div>
                                    </a>
                                </template>
                            </div>

                            <div x-show="notifications.length === 0" class="px-6 py-8 text-center">
                                <i class="fas fa-bell-slash text-4xl text-gray-300 mb-3"></i>
                                <p class="text-gray-500 text-sm">Tidak ada notifikasi baru</p>
                                <p class="text-gray-400 text-xs mt-1">Semua sudah dibaca</p>
                            </div>

                            <div class="px-4 py-2 border-t border-gray-100 text-center"
                                x-show="notifications.length > 0">
                                <button @click="markAllAsRead" class="text-xs text-[#8AD337] hover:underline">
                                    Tandai semua sudah dibaca
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- User Dropdown di Top Navbar -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 bg-gradient-to-r from-[#183D57] to-[#2a5a7a] rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <span class="hidden md:inline text-gray-700">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-gray-400 text-xs transition-transform"
                                :class="{ 'rotate-180': open }"></i>
                        </button>

                        <!-- Dropdown Menu User -->
                        <div x-show="open" @click.away="open = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-2"
                            class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden z-50"
                            style="display: none;">
                            <div class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] px-4 py-3">
                                <p class="text-white text-sm font-semibold">{{ Auth::user()->name }}</p>
                                <p class="text-white/70 text-xs">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="py-2">
                                <a href="{{ route('admin.profile') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-[#8AD337]/10 hover:text-[#8AD337] transition-all">
                                    <i class="fas fa-user-circle w-5"></i>
                                    <span>Profil Saya</span>
                                </a>
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
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="p-6">
            @yield('content')
        </div>
    </main>

    <script>
        // Sidebar navigation dengan dropdown state persistence
        function sidebarNavigation() {
            return {
                init() {
                    // Keep dropdown states from Alpine
                }
            }
        }

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const sidebar = document.querySelector('.sidebar');

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', () => {
                sidebar.classList.toggle('mobile-open');
            });
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth < 768) {
                if (!sidebar.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
                    sidebar.classList.remove('mobile-open');
                }
            }
        });

        // Active link highlighting for dropdown items
        document.querySelectorAll('.dropdown-menu a').forEach(link => {
            if (link.classList.contains('text-[#8AD337]')) {
                const parentButton = link.closest('div[x-data]').querySelector('.dropdown-toggle');
                if (parentButton) {
                    parentButton.classList.add('text-[#8AD337]');
                }
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
