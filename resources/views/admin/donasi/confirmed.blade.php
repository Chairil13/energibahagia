@extends('layouts.admin')

@section('title', 'Donasi Terkonfirmasi - Admin Panel')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#183D57]">Donasi Terkonfirmasi</h1>
        <p class="text-gray-500">Donasi yang sudah dikonfirmasi</p>
    </div>

    <!-- Tab Navigation -->
    <div class="flex gap-2 mb-6">
        <a href="{{ route('admin.donasi.index') }}"
            class="px-5 py-2.5 rounded-xl font-semibold transition-all duration-300 bg-gray-100 text-gray-600 hover:bg-gray-200">
            <i class="fas fa-clock mr-2"></i> Menunggu Konfirmasi
        </a>
        <a href="{{ route('admin.donasi.confirmed') }}"
            class="px-5 py-2.5 rounded-xl font-semibold transition-all duration-300 bg-gradient-to-r from-[#8AD337] to-[#6fb32e] text-[#183D57] shadow-md">
            <i class="fas fa-check-circle mr-2"></i> Sudah Dikonfirmasi
        </a>
        <a href="{{ route('admin.donasi.cancelled') }}"
            class="px-5 py-2.5 rounded-xl font-semibold transition-all duration-300 bg-gray-100 text-gray-600 hover:bg-gray-200">
            <i class="fas fa-times-circle mr-2"></i> Ditolak
        </a>
    </div>

    <!-- Statistik Cards -->
    <!-- <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition-all duration-300 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Total Donasi Terkumpul</p>
                    <p class="text-3xl font-bold text-[#183D57]">Rp {{ number_format($totalConfirmed, 0, ',', '.') }}</p>
                    @if ($selectedProgram)
                        <p class="text-xs text-[#8AD337] mt-1">
                            <i class="fas fa-filter mr-1"></i> {{ $selectedProgram->judul }}
                        </p>
                    @endif
                </div>
                <div
                    class="w-14 h-14 bg-[#8AD337]/20 rounded-2xl flex items-center justify-center group-hover:bg-[#8AD337] transition-all duration-300">
                    <i
                        class="fas fa-money-bill-wave text-2xl text-[#8AD337] group-hover:text-white transition-all duration-300"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition-all duration-300 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Total Donatur</p>
                    <p class="text-3xl font-bold text-[#183D57]">{{ number_format($totalDonatur) }}</p>
                    <p class="text-xs text-gray-400 mt-1">Donatur aktif</p>
                </div>
                <div
                    class="w-14 h-14 bg-[#8AD337]/20 rounded-2xl flex items-center justify-center group-hover:bg-[#8AD337] transition-all duration-300">
                    <i class="fas fa-users text-2xl text-[#8AD337] group-hover:text-white transition-all duration-300"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition-all duration-300 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Program Tersalurkan</p>
                    <p class="text-3xl font-bold text-[#183D57]">{{ number_format($totalProgram) }}</p>
                    <p class="text-xs text-gray-400 mt-1">Program donasi aktif</p>
                </div>
                <div
                    class="w-14 h-14 bg-[#8AD337]/20 rounded-2xl flex items-center justify-center group-hover:bg-[#8AD337] transition-all duration-300">
                    <i
                        class="fas fa-hand-holding-heart text-2xl text-[#8AD337] group-hover:text-white transition-all duration-300"></i>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Statistik Per Bank -->
    <div class="bg-white rounded-2xl shadow-md p-6 mb-8">
        <div class="flex items-center justify-between mb-5">
            <h3 class="font-bold text-[#183D57] text-lg flex items-center gap-2">
                <i class="fas fa-chart-pie text-[#8AD337]"></i>
                Statistik Donasi Per Bank
            </h3>
            @if ($selectedProgram)
                <span class="text-xs bg-[#8AD337]/20 text-[#183D57] px-3 py-1.5 rounded-full">
                    <i class="fas fa-filter mr-1"></i> {{ $selectedProgram->judul }}
                </span>
            @endif
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach ($banks as $bank)
                @php
                    $stat = $bankStats[$bank->id] ?? ['total' => 0, 'count' => 0];
                @endphp
                <div
                    class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 text-center border border-gray-100 hover:border-[#8AD337]/30 hover:shadow-md transition-all duration-300 group">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform duration-300"
                        style="background: {{ $bank->warna }}20">
                        <i class="fas {{ $bank->icon }} text-xl" style="color: {{ $bank->warna }}"></i>
                    </div>
                    <p class="font-semibold text-gray-800 text-sm">{{ $bank->nama_bank }}</p>
                    <p class="text-[#8AD337] font-bold text-base mt-1">Rp {{ number_format($stat['total'], 0, ',', '.') }}
                    </p>
                    <p class="text-xs text-gray-400 mt-1">
                        <i class="fas fa-receipt mr-1"></i> {{ number_format($stat['count']) }} donasi
                    </p>
                </div>
            @endforeach
        </div>

        @if ($selectedProgram)
            <div class="mt-5 pt-4 border-t border-gray-100 flex justify-center">
                <div class="bg-gray-50 rounded-full px-4 py-2">
                    <p class="text-sm text-gray-600">
                        <i class="fas fa-chart-line text-[#8AD337] mr-2"></i>
                        Menampilkan donasi untuk program <strong
                            class="text-[#183D57]">{{ $selectedProgram->judul }}</strong>
                        <a href="{{ route('admin.donasi.confirmed') }}" class="text-[#8AD337] hover:underline ml-2">
                            <i class="fas fa-times-circle"></i> Hapus Filter
                        </a>
                    </p>
                </div>
            </div>
        @endif
    </div>

    <!-- Filter Program & Export Buttons -->
    <div class="bg-white rounded-2xl shadow-sm p-4 mb-6">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.donasi.confirmed') }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 {{ !$selectedProgramId ? 'bg-[#8AD337] text-[#183D57] shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    <i class="fas fa-th-large mr-1"></i> Semua Program
                </a>
                @foreach ($programs as $program)
                    <a href="{{ route('admin.donasi.confirmed', ['program' => $program->id]) }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 {{ $selectedProgramId == $program->id ? 'bg-[#8AD337] text-[#183D57] shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                        {{ $program->judul }}
                    </a>
                @endforeach
            </div>

            <!-- TOMBOL EXPORT -->
            <div class="flex items-center gap-2 flex-wrap">
                <div class="bg-gray-100 rounded-lg px-3 py-1.5">
                    <i class="fas fa-database text-gray-400 mr-1"></i>
                    <span class="text-sm text-gray-600">Total Data: {{ $donasis->total() }}</span>
                </div>

                <a href="{{ route('admin.donasi.export-excel', ['program' => $selectedProgramId]) }}"
                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium transition-all duration-300 flex items-center gap-2 shadow-sm hover:shadow-md">
                    <i class="fas fa-file-excel"></i>
                    <span>Export Excel</span>
                </a>

                <a href="{{ route('admin.donasi.export-pdf', ['program' => $selectedProgramId]) }}" target="_blank"
                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition-all duration-300 flex items-center gap-2 shadow-sm hover:shadow-md">
                    <i class="fas fa-file-pdf"></i>
                    <span>Export PDF</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Tabel Donasi -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Donatur
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Program
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Doa/Harapan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nominal
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Bank
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Dikonfirmasi</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Admin
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($donasis as $index => $donasi)
                        <tr class="hover:bg-gray-50 transition-all duration-200">
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $donasis->firstItem() + $index }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 bg-gradient-to-r from-[#183D57] to-[#2a5a7a] rounded-full flex items-center justify-center">
                                        <span class="text-white text-xs font-bold">{{ substr($donasi->nama, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $donasi->nama }}</p>
                                        <p class="text-xs text-gray-400">{{ $donasi->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded-lg text-xs font-medium">
                                    {{ $donasi->program->judul ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="max-w-xs text-sm text-gray-600 break-words italic">
                                    {{ $donasi->pesan ? Str::limit($donasi->pesan, 80) : '-' }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-[#8AD337]">Rp
                                    {{ number_format($donasi->nominal, 0, ',', '.') }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded flex items-center justify-center"
                                        style="background: {{ $donasi->bank->warna ?? '#183D57' }}20">
                                        <i class="fas {{ $donasi->bank->icon ?? 'fa-university' }} text-xs"
                                            style="color: {{ $donasi->bank->warna ?? '#183D57' }}"></i>
                                    </div>
                                    <span class="text-sm text-gray-600">{{ $donasi->bank->nama_bank ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                <i class="far fa-calendar-alt text-gray-400 mr-1"></i>
                                {{ $donasi->confirmed_at ? $donasi->confirmed_at->format('d/m/Y H:i') : '-' }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1">
                                    <div class="w-6 h-6 bg-gray-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user-check text-gray-500 text-xs"></i>
                                    </div>
                                    <span class="text-sm text-gray-600">{{ $donasi->confirmedBy->name ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <button onclick="openDetailModal({{ $donasi->id }})"
                                    class="text-blue-500 hover:text-blue-700 transition-all duration-200 p-2 hover:bg-blue-50 rounded-lg">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-inbox text-3xl text-gray-400"></i>
                                    </div>
                                    <p class="text-gray-500 font-medium">Tidak ada donasi untuk program yang dipilih</p>
                                    <a href="{{ route('admin.donasi.confirmed') }}"
                                        class="mt-3 text-[#8AD337] hover:underline text-sm">
                                        <i class="fas fa-arrow-left mr-1"></i> Lihat semua donasi
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($donasis->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $donasis->links() }}
            </div>
        @endif
    </div>

    <!-- Modal Detail -->
    <div id="detailModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto animate-fadeInUp">
            <div
                class="bg-gradient-to-r from-[#183D57] to-[#2a5a7a] px-6 py-4 rounded-t-2xl flex justify-between items-center sticky top-0">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-receipt text-white text-lg"></i>
                    </div>
                    <h3 class="text-white font-bold text-lg">Detail Donasi</h3>
                </div>
                <button onclick="closeDetailModal()"
                    class="text-white/70 hover:text-white transition-all duration-200 p-2 hover:bg-white/10 rounded-lg">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="p-6" id="detailContent"></div>
        </div>
    </div>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.3s ease-out;
        }
    </style>

    <script>
        function openDetailModal(id) {
            fetch(`/admin/donasi/${id}`)
                .then(response => response.json())
                .then(data => {
                    const content = `
                        <div class="space-y-5">
                            <div class="bg-gradient-to-r from-blue-50 to-white rounded-xl p-5 border border-blue-100">
                                <h4 class="font-bold text-[#183D57] mb-3 flex items-center gap-2">
                                    <i class="fas fa-user-circle text-[#8AD337] text-lg"></i>
                                    Informasi Donatur
                                </h4>
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <p class="text-xs text-gray-400">Nama Lengkap</p>
                                        <p class="font-medium text-gray-800">${data.nama}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400">Email</p>
                                        <p class="text-gray-600 text-sm break-all">${data.email}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400">Nomor Telepon</p>
                                        <p class="text-gray-800">${data.phone}</p>
                                    </div>
                                    ${data.pesan ? `
                                        <div class="col-span-2">
                                            <p class="text-xs text-gray-400">Doa / Pesan</p>
                                            <p class="text-gray-600 italic">"${data.pesan}"</p>
                                        </div>
                                        ` : ''}
                                </div>
                            </div>

                            <div class="bg-gradient-to-r from-green-50 to-white rounded-xl p-5 border border-green-100">
                                <h4 class="font-bold text-[#183D57] mb-3 flex items-center gap-2">
                                    <i class="fas fa-hand-holding-heart text-[#8AD337] text-lg"></i>
                                    Informasi Donasi
                                </h4>
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <p class="text-xs text-gray-400">Program Donasi</p>
                                        <p class="font-medium text-gray-800">${data.program?.judul || '-'}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400">Nominal Donasi</p>
                                        <p class="font-bold text-[#8AD337] text-lg">Rp ${new Intl.NumberFormat('id-ID').format(data.nominal)}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400">Bank Tujuan</p>
                                        <p class="text-gray-800">${data.bank?.nama_bank || '-'}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400">No. Rekening Tujuan</p>
                                        <p class="text-gray-600 text-sm">${data.bank?.nomor_rekening || '-'} a.n ${data.bank?.atas_nama || '-'}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400">Kode Unik</p>
                                        <p class="font-mono font-bold text-[#183D57]">${data.kode_unik}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400">Waktu Donasi</p>
                                        <p class="text-gray-600">${new Date(data.created_at).toLocaleString('id-ID')}</p>
                                    </div>
                                    ${data.confirmed_at ? `
                                        <div>
                                            <p class="text-xs text-gray-400">Dikonfirmasi</p>
                                            <p class="text-gray-600">${new Date(data.confirmed_at).toLocaleString('id-ID')}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-400">Dikonfirmasi Oleh</p>
                                            <p class="text-gray-600">${data.confirmed_by?.name || '-'}</p>
                                        </div>
                                        ` : ''}
                                    ${data.admin_note ? `
                                        <div class="col-span-2">
                                            <p class="text-xs text-gray-400">Catatan Admin</p>
                                            <p class="text-gray-600 bg-yellow-50 p-2 rounded-lg">${data.admin_note}</p>
                                        </div>
                                        ` : ''}
                                </div>
                            </div>

                            ${data.bukti_transfer ? `
                                <div class="bg-gradient-to-r from-gray-50 to-white rounded-xl p-5 border border-gray-200">
                                    <h4 class="font-bold text-[#183D57] mb-3 flex items-center gap-2">
                                        <i class="fas fa-image text-[#8AD337] text-lg"></i>
                                        Bukti Transfer
                                    </h4>
                                    <div class="text-center">
                                        <img src="/uploads/bukti/${data.bukti_transfer}" class="max-w-full rounded-lg border shadow-sm mx-auto cursor-pointer" onclick="window.open(this.src, '_blank')">
                                        <p class="text-xs text-gray-400 mt-2">Klik gambar untuk memperbesar</p>
                                    </div>
                                </div>
                                ` : ''}
                        </div>
                    `;
                    document.getElementById('detailContent').innerHTML = content;
                    document.getElementById('detailModal').classList.remove('hidden');
                    document.getElementById('detailModal').classList.add('flex');
                });
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
            document.getElementById('detailModal').classList.remove('flex');
        }
    </script>
@endsection
