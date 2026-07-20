@extends('layouts.admin')

@section('title', 'Kelola Bank - Admin Panel')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#183D57]">Kelola Bank</h1>
            <p class="text-gray-500">Mengelola data bank untuk donasi</p>
        </div>
        <a href="{{ route('admin.bank.create') }}"
            class="bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] px-5 py-2 rounded-xl font-semibold hover:shadow-lg transition flex items-center gap-2">
            <i class="fas fa-plus"></i>
            Tambah Bank
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Bank</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Rekening</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Atas Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Urutan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($banks as $index => $bank)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                <div class="w-10 h-10 rounded-lg flex items-center justify-center"
                                    style="background: {{ $bank->warna }}20; color: {{ $bank->warna }}">
                                    <i class="fas {{ $bank->icon }} text-xl"></i>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-medium text-gray-800">{{ $bank->nama_bank }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $bank->kode }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $bank->nomor_rekening }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $bank->atas_nama }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $bank->urutan }}</td>
                            <td class="px-6 py-4">
                                @if ($bank->is_active)
                                    <span
                                        class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Aktif</span>
                                @else
                                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">Tidak
                                        Aktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.bank.edit', $bank->id) }}"
                                        class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="deleteBank({{ $bank->id }}, '{{ $bank->nama_bank }}')"
                                        class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-10 text-center text-gray-400">Belum ada bank</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $banks->links() }}
        </div>
    </div>

    <!-- Modal Hapus -->
    <div id="deleteModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm mx-4">
            <div class="bg-red-500 px-6 py-4 rounded-t-2xl">
                <h3 class="text-white font-bold text-lg">Konfirmasi Hapus</h3>
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus bank <strong id="deleteTitle"></strong>?</p>
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
        function deleteBank(id, name) {
            document.getElementById('deleteTitle').innerText = name;
            document.getElementById('deleteForm').action = `/admin/bank/${id}`;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.getElementById('deleteModal').classList.remove('flex');
        }
    </script>
@endsection
