@extends('layouts.admin')

@section('title', 'Kelola Program Donasi - Admin Panel')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#183D57]">Kelola Program Donasi</h1>
            <p class="text-gray-500">Mengelola program donasi</p>
        </div>
        <a href="{{ route('admin.program.create') }}"
            class="bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] px-5 py-2 rounded-xl font-semibold hover:shadow-lg transition flex items-center gap-2">
            <i class="fas fa-plus"></i>
            Tambah Program
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Gambar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Target</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Terkumpul</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Progress</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($programs as $index => $program)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                @if ($program->gambar && file_exists(public_path('uploads/program/' . $program->gambar)))
                                    <img src="{{ asset('uploads/program/' . $program->gambar) }}"
                                        class="w-12 h-12 object-cover rounded-lg">
                                @else
                                    <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $program->judul }}</p>
                                    <p class="text-xs text-gray-400">{{ Str::limit($program->deskripsi_singkat, 50) }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold"
                                    style="background: {{ $program->kategori->warna }}20; color: {{ $program->kategori->warna }}">
                                    {{ $program->kategori->nama_kategori }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">Rp
                                {{ number_format($program->target_dana, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">Rp
                                {{ number_format($program->dana_terkumpul, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-20 bg-gray-200 rounded-full h-2">
                                        <div class="bg-[#8AD337] h-2 rounded-full"
                                            style="width: {{ $program->progress }}%"></div>
                                    </div>
                                    <span class="text-sm text-gray-600">{{ $program->progress }}%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if ($program->status == 'Aktif')
                                    <span
                                        class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Aktif</span>
                                @elseif($program->status == 'Selesai')
                                    <span
                                        class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">Selesai</span>
                                @else
                                    <span
                                        class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">Ditutup</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.program.edit', $program->id) }}"
                                        class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="deleteProgram({{ $program->id }}, '{{ $program->judul }}')"
                                        class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-10 text-center text-gray-400">Belum ada program donasi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $programs->links() }}
        </div>
    </div>

    <!-- Modal Hapus -->
    <div id="deleteModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm mx-4">
            <div class="bg-red-500 px-6 py-4 rounded-t-2xl">
                <h3 class="text-white font-bold text-lg">Konfirmasi Hapus</h3>
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus program <strong id="deleteTitle"></strong>?
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
        function deleteProgram(id, title) {
            document.getElementById('deleteTitle').innerText = title;
            document.getElementById('deleteForm').action = `/admin/program/${id}`;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.getElementById('deleteModal').classList.remove('flex');
        }
    </script>
@endsection
