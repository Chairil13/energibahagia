@extends('layouts.admin')

@section('title', 'Kelola Kategori Program - Admin Panel')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#183D57]">Kelola Kategori Program</h1>
            <p class="text-gray-500">Mengelola kategori program donasi</p>
        </div>
        <a href="{{ route('admin.kategori-program.create') }}"
            class="bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] px-5 py-2 rounded-xl font-semibold hover:shadow-lg transition flex items-center gap-2">
            <i class="fas fa-plus"></i>
            Tambah Kategori
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-xl">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl">{{ session('error') }}</div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Icon</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Slug</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Urutan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($kategoris as $index => $kategori)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                <div class="w-10 h-10 rounded-lg flex items-center justify-center"
                                    style="background: {{ $kategori->warna }}20; color: {{ $kategori->warna }}">
                                    <i class="fas {{ $kategori->icon ?: 'fa-tag' }} text-xl"></i>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-medium text-gray-800">{{ $kategori->nama_kategori }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $kategori->slug }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">{{ $kategori->deskripsi ?: '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $kategori->urutan }}</td>
                            <td class="px-6 py-4">
                                @if ($kategori->is_active)
                                    <span
                                        class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Aktif</span>
                                @else
                                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">Tidak
                                        Aktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.kategori-program.edit', $kategori->id) }}"
                                        class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button
                                        onclick="deleteKategori({{ $kategori->id }}, '{{ $kategori->nama_kategori }}')"
                                        class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-10 text-center text-gray-400">Belum ada kategori program</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $kategoris->links() }}
        </div>
    </div>

    <!-- Modal Hapus -->
    <div id="deleteModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm mx-4">
            <div class="bg-red-500 px-6 py-4 rounded-t-2xl">
                <h3 class="text-white font-bold text-lg">Konfirmasi Hapus</h3>
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus kategori <strong id="deleteTitle"></strong>?
                </p>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex gap-3">
                        <button type="submit"
                            class="flex-1 bg-red-500 text-white py-2 rounded-xl font-semibold hover:bg-red-600 transition">Hapus</button>
                        <button type="button" onclick="closeDeleteModal()"
                            class="flex-1 bg-gray-200 text-gray-600 py-2 rounded-xl font-semibold hover:bg-gray-300 transition">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function deleteKategori(id, name) {
            document.getElementById('deleteTitle').innerText = name;
            document.getElementById('deleteForm').action = `/admin/kategori-program/${id}`;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.getElementById('deleteModal').classList.remove('flex');
        }
    </script>
@endsection
