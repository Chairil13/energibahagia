@extends('layouts.admin')

@section('title', 'Kelola User - Admin Panel')

@section('content')
    <!-- Page Title -->
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#183D57]">Kelola User</h1>
            <p class="text-gray-500">Mengelola data donatur dan administrator</p>
        </div>
        <button onclick="openAddModal()"
            class="bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] px-5 py-2 rounded-xl font-semibold hover:shadow-lg transition-all duration-300 flex items-center gap-2">
            <i class="fas fa-plus"></i>
            Tambah User
        </button>
    </div>

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
            <p class="font-semibold mb-2">User gagal disimpan:</p>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Filter & Search -->
    <div class="bg-white rounded-2xl shadow-sm p-4 mb-6">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex flex-wrap gap-2">
                <button class="filter-btn px-4 py-2 rounded-lg text-sm font-medium transition-all active" data-filter="all">
                    Semua
                </button>
                <button class="filter-btn px-4 py-2 rounded-lg text-sm font-medium transition-all" data-filter="donatur">
                    Donatur
                </button>
                <button class="filter-btn px-4 py-2 rounded-lg text-sm font-medium transition-all" data-filter="admin">
                    Admin
                </button>
                <button class="filter-btn px-4 py-2 rounded-lg text-sm font-medium transition-all" data-filter="active">
                    Aktif
                </button>
                <button class="filter-btn px-4 py-2 rounded-lg text-sm font-medium transition-all" data-filter="inactive">
                    Tidak Aktif
                </button>
            </div>

            <div class="relative">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" id="searchInput" placeholder="Cari nama atau email..."
                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20 w-64">
            </div>
        </div>
    </div>

    <!-- Tabel User -->
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Telepon</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bergabung</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200" id="userTableBody">
                    @foreach ($users as $index => $user)
                        <tr class="hover:bg-gray-50" data-role="{{ $user->role }}"
                            data-status="{{ $user->is_active ? 'active' : 'inactive' }}"
                            data-name="{{ strtolower($user->name) }}" data-email="{{ strtolower($user->email) }}">
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 bg-gradient-to-r from-[#183D57] to-[#2a5a7a] rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-white text-xs"></i>
                                    </div>
                                    <span class="font-medium text-gray-800">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $user->phone ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-2 py-1 rounded-full text-xs font-semibold {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-green-100 text-green-700' }}">
                                    {{ $user->role === 'admin' ? 'Admin' : 'Donatur' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-2 py-1 rounded-full text-xs font-semibold {{ $user->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $user->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $user->created_at ? $user->created_at->format('Y-m-d') : '-' }}</td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <button onclick="openEditModal({{ $user->id }})"
                                        class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="openDeleteModal({{ $user->id }}, '{{ $user->name }}')"
                                        class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah/Edit User -->
    <div id="userModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4">
            <div
                class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] px-6 py-4 rounded-t-2xl flex justify-between items-center">
                <h3 class="text-white font-bold text-lg" id="modalTitle">Tambah User</h3>
                <button onclick="closeModal()" class="text-white hover:text-[#8AD337] transition">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <form id="userForm" class="p-6" action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <input type="hidden" id="userId" name="user_id">
                <input type="hidden" name="_method" id="methodField" value="POST">

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2 text-sm">Nama Lengkap <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2 text-sm">Email <span
                            class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2 text-sm">Nomor Telepon <span
                            class="text-red-500">*</span></label>
                    <input type="tel" id="phone" name="phone" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2 text-sm">Password <span class="text-red-500"
                            id="passwordRequired">*</span></label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                            class="w-full px-4 py-2 pr-11 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                        <button type="button" id="togglePasswordButton" onclick="togglePasswordVisibility()"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#183D57] transition"
                            aria-label="Lihat password">
                            <i id="togglePasswordIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                    <p class="text-xs text-gray-400 mt-1" id="passwordHint">Minimal 8 karakter. Kosongkan jika tidak ingin
                        mengubah.</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2 text-sm">Role</label>
                    <select id="role" name="role"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                        <option value="donatur">Donatur</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2 text-sm">Status</label>
                    <select id="status" name="status"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>

                <div class="flex gap-3 mt-6">
                    <button type="submit"
                        class="flex-1 bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] py-2 rounded-xl font-semibold hover:shadow-lg transition">
                        Simpan
                    </button>
                    <button type="button" onclick="closeModal()"
                        class="flex-1 bg-gray-200 text-gray-600 py-2 rounded-xl font-semibold hover:bg-gray-300 transition">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Hapus User -->
    <div id="deleteModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm mx-4">
            <div class="bg-red-500 px-6 py-4 rounded-t-2xl">
                <h3 class="text-white font-bold text-lg">Konfirmasi Hapus</h3>
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus user <strong
                        id="deleteUserName"></strong>?</p>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex gap-3">
                        <button type="submit"
                            class="flex-1 bg-red-500 text-white py-2 rounded-xl font-semibold hover:bg-red-600 transition">
                            Hapus
                        </button>
                        <button type="button" onclick="closeDeleteModal()"
                            class="flex-1 bg-gray-200 text-gray-600 py-2 rounded-xl font-semibold hover:bg-gray-300 transition">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .filter-btn.active {
            background: #8AD337;
            color: #183D57;
        }

        .filter-btn:not(.active) {
            background: #f3f4f6;
            color: #6b7280;
        }

        .filter-btn:not(.active):hover {
            background: #e5e7eb;
        }
    </style>

    <script>
        let currentFilter = 'all';
        let currentSearch = '';

        function filterTable() {
            const rows = document.querySelectorAll('#userTableBody tr');
            let visibleCount = 0;

            rows.forEach(row => {
                const role = row.getAttribute('data-role');
                const status = row.getAttribute('data-status');
                const name = row.getAttribute('data-name');
                const email = row.getAttribute('data-email');

                let show = true;

                // Filter role
                if (currentFilter === 'donatur' && role !== 'donatur') show = false;
                if (currentFilter === 'admin' && role !== 'admin') show = false;
                if (currentFilter === 'active' && status !== 'active') show = false;
                if (currentFilter === 'inactive' && status !== 'inactive') show = false;

                // Filter search
                if (currentSearch) {
                    const searchLower = currentSearch.toLowerCase();
                    if (!name.includes(searchLower) && !email.includes(searchLower)) {
                        show = false;
                    }
                }

                row.style.display = show ? '' : 'none';
                if (show) visibleCount++;
            });

            // Update nomor urut
            let counter = 1;
            rows.forEach(row => {
                if (row.style.display !== 'none') {
                    row.querySelector('td:first-child').innerText = counter++;
                }
            });

            const paginationInfo = document.getElementById('paginationInfo');

            if (paginationInfo) {
                paginationInfo.innerHTML = `Menampilkan ${visibleCount} dari ${visibleCount} data`;
            }
        }

        // Filter handlers
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentFilter = this.dataset.filter;
                filterTable();
            });
        });

        // Search handler
        document.getElementById('searchInput').addEventListener('input', function(e) {
            currentSearch = e.target.value;
            filterTable();
        });

        // Modal functions
        function openAddModal() {
            document.getElementById('modalTitle').innerText = 'Tambah User';
            document.getElementById('userId').value = '';
            document.getElementById('methodField').value = 'POST';
            document.getElementById('name').value = '';
            document.getElementById('email').value = '';
            document.getElementById('phone').value = '';
            document.getElementById('password').value = '';
            document.getElementById('password').type = 'password';
            document.getElementById('togglePasswordIcon').className = 'fas fa-eye';
            document.getElementById('togglePasswordButton').setAttribute('aria-label', 'Lihat password');
            document.getElementById('password').required = true;
            document.getElementById('passwordRequired').style.display = 'inline';
            document.getElementById('passwordHint').innerHTML = 'Minimal 8 karakter';
            document.getElementById('role').value = 'donatur';
            document.getElementById('status').value = '1';
            document.getElementById('userForm').action = '{{ route('admin.users.store') }}';
            document.getElementById('userModal').classList.remove('hidden');
            document.getElementById('userModal').classList.add('flex');
        }

        function openEditModal(id) {
            // Fetch user data via AJAX
            fetch(`/admin/users/${id}/edit`)
                .then(response => response.json())
                .then(user => {
                    document.getElementById('modalTitle').innerText = 'Edit User';
                    document.getElementById('userId').value = user.id;
                    document.getElementById('methodField').value = 'PUT';
                    document.getElementById('name').value = user.name || '';
                    document.getElementById('email').value = user.email || '';
                    document.getElementById('phone').value = user.phone || '';
                    document.getElementById('password').value = '';
                    document.getElementById('password').type = 'password';
                    document.getElementById('togglePasswordIcon').className = 'fas fa-eye';
                    document.getElementById('togglePasswordButton').setAttribute('aria-label', 'Lihat password');
                    document.getElementById('password').required = false;
                    document.getElementById('passwordRequired').style.display = 'none';
                    document.getElementById('passwordHint').innerHTML = 'Kosongkan jika tidak ingin mengubah password';
                    document.getElementById('role').value = user.role || 'donatur';
                    document.getElementById('status').value = user.is_active == 1 ? '1' : '0';
                    document.getElementById('userForm').action = `/admin/users/${id}`;
                    document.getElementById('userModal').classList.remove('hidden');
                    document.getElementById('userModal').classList.add('flex');
                });
        }

        function closeModal() {
            document.getElementById('userModal').classList.add('hidden');
            document.getElementById('userModal').classList.remove('flex');
        }

        function openDeleteModal(id, name) {
            document.getElementById('deleteUserName').innerText = name;
            document.getElementById('deleteForm').action = `/admin/users/${id}`;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.getElementById('deleteModal').classList.remove('flex');
        }

        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePasswordIcon');
            const toggleButton = document.getElementById('togglePasswordButton');
            const isHidden = passwordInput.type === 'password';

            passwordInput.type = isHidden ? 'text' : 'password';
            toggleIcon.className = isHidden ? 'fas fa-eye-slash' : 'fas fa-eye';
            toggleButton.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Lihat password');
        }
    </script>
@endsection
