@extends('layouts.admin')

@section('title', 'Donasi Ditolak - Admin Panel')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#183D57]">Donasi Ditolak</h1>
        <p class="text-gray-500">Daftar donasi yang telah ditolak oleh admin</p>
    </div>

    <!-- Tab Navigation -->
    <div class="flex gap-2 mb-6 flex-wrap">
        <a href="{{ route('admin.donasi.index') }}"
            class="px-4 py-2 bg-gray-200 text-gray-600 rounded-xl font-semibold hover:bg-gray-300 transition">
            <i class="fas fa-clock mr-2"></i> Menunggu Konfirmasi
        </a>
        <a href="{{ route('admin.donasi.confirmed') }}"
            class="px-4 py-2 bg-gray-200 text-gray-600 rounded-xl font-semibold hover:bg-gray-300 transition">
            <i class="fas fa-check-circle mr-2"></i> Sudah Dikonfirmasi
        </a>
        <a href="{{ route('admin.donasi.cancelled') }}"
            class="px-4 py-2 bg-red-500 text-white rounded-xl font-semibold shadow-md">
            <i class="fas fa-times-circle mr-2"></i> Ditolak
        </a>
    </div>

    <!-- Statistik -->
    @php
        $totalCancelled = $donasis->total();
        $totalNominalCancelled = $donasis->sum('nominal');
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-red-500">
            <p class="text-gray-500 text-sm">Total Ditolak</p>
            <p class="text-2xl font-bold text-[#183D57]">{{ number_format($totalCancelled) }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-red-500">
            <p class="text-gray-500 text-sm">Total Nominal Ditolak</p>
            <p class="text-2xl font-bold text-red-500">Rp {{ number_format($totalNominalCancelled, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-red-500">
            <p class="text-gray-500 text-sm">Rata-rata Donasi</p>
            <p class="text-2xl font-bold text-[#183D57]">
                Rp {{ $totalCancelled > 0 ? number_format($totalNominalCancelled / $totalCancelled, 0, ',', '.') : '0' }}
            </p>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="bg-white rounded-xl shadow-sm p-4 mb-6">
        <form method="GET" action="{{ route('admin.donasi.cancelled') }}" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-[200px]">
                <input type="text" name="search" value="{{ request('search') }}" 
                    placeholder="Cari donatur atau program..." 
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-red-500">
            </div>
            <div>
                <button type="submit" class="px-6 py-2 bg-red-500 text-white rounded-xl hover:bg-red-600 transition">
                    <i class="fas fa-search mr-2"></i> Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.donasi.cancelled') }}" class="px-4 py-2 bg-gray-200 text-gray-600 rounded-xl hover:bg-gray-300 transition ml-2">
                        <i class="fas fa-times"></i> Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Tabel Donasi Ditolak -->
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Donatur</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Doa/Harapan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nominal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bank</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alasan Penolakan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ditolak Pada</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($donasis as $index => $donasi)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $donasi->nama }}</p>
                                    <p class="text-xs text-gray-400">{{ $donasi->email }}</p>
                                    <p class="text-xs text-gray-400">{{ $donasi->phone }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <span class="font-medium">{{ Str::limit($donasi->program->judul ?? '-', 30) }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="max-w-xs text-sm text-gray-600 break-words italic">
                                    {{ $donasi->pesan ? Str::limit($donasi->pesan, 80) : '-' }}
                                </p>
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-red-500">
                                Rp {{ number_format($donasi->nominal, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $donasi->bank->nama_bank ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="max-w-xs">
                                    <p class="text-sm text-gray-600 break-words">
                                        {{ $donasi->admin_note ?? 'Tidak ada alasan' }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                <div>
                                    <p>{{ $donasi->updated_at->format('d/m/Y') }}</p>
                                    <p class="text-xs">{{ $donasi->updated_at->format('H:i') }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <button onclick="showDetail({{ $donasi->id }})" 
                                        class="bg-blue-500 text-white px-3 py-1 rounded-lg text-xs hover:bg-blue-600 transition">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                    <button onclick="restoreDonation({{ $donasi->id }})"
                                        class="bg-green-500 text-white px-3 py-1 rounded-lg text-xs hover:bg-green-600 transition">
                                        <i class="fas fa-undo"></i> Kembalikan
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-check-circle text-4xl text-green-500"></i>
                                    </div>
                                    <p class="text-lg font-medium text-gray-600">Tidak ada donasi yang ditolak</p>
                                    <p class="text-sm text-gray-400 mt-1">Semua donasi dalam keadaan baik</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $donasis->appends(request()->query())->links() }}
        </div>
    </div>

    <!-- Modal Detail Donasi -->
    <div id="detailModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
            <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4 rounded-t-2xl sticky top-0 z-10">
                <div class="flex justify-between items-center">
                    <h3 class="text-white font-bold text-lg">
                        <i class="fas fa-times-circle mr-2"></i> Detail Donasi Ditolak
                    </h3>
                    <button onclick="closeDetail()" class="text-white hover:text-gray-200 transition">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <div class="p-6" id="detailContent">
                <div class="animate-pulse flex space-x-4">
                    <div class="flex-1 space-y-4 py-1">
                        <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                        <div class="h-4 bg-gray-200 rounded"></div>
                        <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Kembalikan Donasi -->
    <div id="restoreModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4">
            <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4 rounded-t-2xl">
                <h3 class="text-white font-bold text-lg">
                    <i class="fas fa-undo mr-2"></i> Kembalikan Donasi
                </h3>
            </div>
            <form id="restoreForm" method="POST" class="p-6">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <div class="flex items-center gap-3 p-3 bg-green-50 rounded-xl border border-green-200">
                        <i class="fas fa-info-circle text-green-500 text-xl"></i>
                        <div>
                            <p class="text-gray-600 text-sm">Anda akan mengembalikan donasi dari:</p>
                            <p class="font-semibold text-[#183D57]" id="restoreNama"></p>
                            <p class="font-bold text-green-600 text-lg mt-1" id="restoreNominal"></p>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2 text-sm">Catatan (Opsional)</label>
                    <textarea name="restore_note" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-green-500"
                        placeholder="Tambahkan catatan..."></textarea>
                </div>
                <div class="flex gap-3">
                    <button type="submit"
                        class="flex-1 bg-green-500 text-white py-2 rounded-xl font-semibold hover:bg-green-600 transition">
                        <i class="fas fa-undo mr-2"></i> Kembalikan ke Pending
                    </button>
                    <button type="button" onclick="closeRestore()"
                        class="flex-1 bg-gray-200 text-gray-600 py-2 rounded-xl font-semibold hover:bg-gray-300 transition">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Detail Donasi
    function showDetail(id) {
        const modal = document.getElementById('detailModal');
        const content = document.getElementById('detailContent');
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        // Fetch data
        fetch(`/admin/donasi/${id}`)
            .then(response => response.json())
            .then(data => {
                content.innerHTML = `
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gray-50 p-4 rounded-xl">
                                <p class="text-xs text-gray-500">Nama Donatur</p>
                                <p class="font-semibold text-[#183D57]">${data.nama}</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-xl">
                                <p class="text-xs text-gray-500">Email</p>
                                <p class="font-semibold text-[#183D57]">${data.email}</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-xl">
                                <p class="text-xs text-gray-500">Phone</p>
                                <p class="font-semibold text-[#183D57]">${data.phone}</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-xl">
                                <p class="text-xs text-gray-500">Program Donasi</p>
                                <p class="font-semibold text-[#183D57]">${data.program?.judul || '-'}</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-xl">
                                <p class="text-xs text-gray-500">Nominal</p>
                                <p class="font-bold text-red-500">Rp ${new Intl.NumberFormat('id-ID').format(data.nominal)}</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-xl">
                                <p class="text-xs text-gray-500">Bank</p>
                                <p class="font-semibold text-[#183D57]">${data.bank?.nama_bank || '-'}</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-xl">
                                <p class="text-xs text-gray-500">Status</p>
                                <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-medium">
                                    <i class="fas fa-times-circle mr-1"></i> Ditolak
                                </span>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-xl">
                                <p class="text-xs text-gray-500">Ditolak Pada</p>
                                <p class="font-semibold text-[#183D57]">${new Date(data.updated_at).toLocaleString('id-ID')}</p>
                            </div>
                        </div>
                        ${data.admin_note ? `
                        <div class="bg-red-50 p-4 rounded-xl border border-red-200">
                            <p class="text-xs text-gray-500 mb-1">Alasan Penolakan</p>
                            <p class="text-gray-700">${data.admin_note}</p>
                        </div>
                        ` : ''}
                        ${data.pesan ? `
                        <div class="bg-gray-50 p-4 rounded-xl">
                            <p class="text-xs text-gray-500 mb-1">Pesan Donatur</p>
                            <p class="text-gray-700">${data.pesan}</p>
                        </div>
                        ` : ''}
                        ${data.bukti_transfer ? `
                        <div class="bg-gray-50 p-4 rounded-xl">
                            <p class="text-xs text-gray-500 mb-2">Bukti Transfer</p>
                            <a href="/uploads/bukti/${data.bukti_transfer}" target="_blank" 
                               class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                                <i class="fas fa-image mr-2"></i> Lihat Bukti
                            </a>
                        </div>
                        ` : ''}
                    </div>
                `;
            })
            .catch(error => {
                content.innerHTML = `
                    <div class="text-center py-8 text-red-500">
                        <i class="fas fa-exclamation-circle text-4xl mb-3 block"></i>
                        <p>Gagal memuat data</p>
                    </div>
                `;
            });
    }

    function closeDetail() {
        document.getElementById('detailModal').classList.add('hidden');
        document.getElementById('detailModal').classList.remove('flex');
    }

    // Kembalikan Donasi
    function restoreDonation(id) {
        // Fetch data dulu
        fetch(`/admin/donasi/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('restoreNama').innerText = data.nama;
                document.getElementById('restoreNominal').innerHTML = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.nominal);
                document.getElementById('restoreForm').action = `/admin/donasi/${id}/restore`;
                document.getElementById('restoreModal').classList.remove('hidden');
                document.getElementById('restoreModal').classList.add('flex');
            });
    }

    function closeRestore() {
        document.getElementById('restoreModal').classList.add('hidden');
        document.getElementById('restoreModal').classList.remove('flex');
    }

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeDetail();
            closeRestore();
        }
    });

    // Close modal with click outside
    document.getElementById('detailModal').addEventListener('click', function(e) {
        if (e.target === this) closeDetail();
    });
    document.getElementById('restoreModal').addEventListener('click', function(e) {
        if (e.target === this) closeRestore();
    });
</script>
@endpush
