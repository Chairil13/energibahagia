@extends('layouts.admin')

@section('title', 'Kelola Berita - Admin Panel')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#183D57]">Kelola Berita</h1>
            <p class="text-gray-500">Mengelola berita dan kegiatan</p>
        </div>
        <a href="{{ route('admin.berita.create') }}"
            class="bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] px-5 py-2 rounded-xl font-semibold hover:shadow-lg transition flex items-center gap-2">
            <i class="fas fa-plus"></i>
            Tambah Berita
        </a>
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

    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Gambar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Penulis</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($beritas as $index => $berita)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                @if ($berita->gambar && file_exists(public_path('uploads/berita/' . $berita->gambar)))
                                    <img src="{{ asset('uploads/berita/' . $berita->gambar) }}"
                                        class="w-12 h-12 object-cover rounded-lg">
                                @else
                                    <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $berita->judul }}</p>
                                    <p class="text-xs text-gray-400">{{ Str::limit($berita->deskripsi_singkat, 50) }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $berita->penulis }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $berita->tanggal_publish ? $berita->tanggal_publish->format('d M Y') : '-' }}</td>
                            <td class="px-6 py-4">
                                @if ($berita->status == 'publish')
                                    <span
                                        class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Published</span>
                                @else
                                    <span
                                        class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">Draft</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('berita.detail', $berita->slug) }}" target="_blank"
                                        class="text-green-500 hover:text-green-700">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.berita.edit', $berita->id) }}"
                                        class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="deleteBerita({{ $berita->id }}, '{{ $berita->judul }}')"
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
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $beritas->links() }}
        </div>
    </div>

    <!-- Modal Hapus -->
    <div id="deleteModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm mx-4">
            <div class="bg-red-500 px-6 py-4 rounded-t-2xl">
                <h3 class="text-white font-bold text-lg">Konfirmasi Hapus</h3>
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus berita <strong id="deleteTitle"></strong>?
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
        function deleteBerita(id, title) {
            document.getElementById('deleteTitle').innerText = title;
            document.getElementById('deleteForm').action = `/admin/berita/${id}`;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.getElementById('deleteModal').classList.remove('flex');
        }
    </script>
@endsection
