@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')

@section('content')
    <!-- Page Title -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#183D57]">Dashboard</h1>
        <p class="text-gray-500 mt-1">Selamat datang kembali, {{ Auth::user()->name }}!</p>
    </div>

    @php
        use App\Models\User;
        use App\Models\ProgramDonasi;
        use App\Models\Donasi;
        use App\Models\Berita;

        $totalDonatur = User::where('role', 'donatur')->count();
        $totalAdmin = User::where('role', 'admin')->count();
        $totalProgram = ProgramDonasi::count();
        $programAktif = ProgramDonasi::where('status', 'Aktif')->count();
        $totalDonasi = Donasi::where('status', 'confirmed')->sum('nominal');
        $totalDonasiCount = Donasi::where('status', 'confirmed')->count();
        $totalBerita = Berita::where('status', 'publish')->count();
        $donasiPending = Donasi::where('status', 'pending')->count();

        $donasiPerBulan = Donasi::where('status', 'confirmed')
            ->selectRaw('EXTRACT(MONTH FROM created_at) as bulan, SUM(nominal) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get();

        $bulanNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $found = $donasiPerBulan->firstWhere('bulan', $i);
            $chartData[] = $found ? (int) $found->total : 0;
        }

        // Data untuk tabel
        $programAktifList = ProgramDonasi::with('kategori')
            ->where('status', 'Aktif')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $donasiTerbaru = Donasi::with(['program', 'user'])
            ->where('status', 'confirmed')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $donasiPendingList = Donasi::with(['program', 'bank'])
            ->where('status', 'pending')
            ->whereNotNull('bukti_transfer')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
    @endphp

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Total Donatur Card -->
        <div class="relative overflow-hidden bg-gradient-to-br from-[#183D57] to-[#1a4a6a] rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-all duration-500 hover:scale-[1.02]">
            <!-- Decorative elements -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/4"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/4"></div>
            <div class="absolute top-1/2 right-1/4 w-32 h-32 bg-[#8AD337]/10 rounded-full blur-2xl"></div>
            
            <div class="relative z-10 flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-white/60 text-sm font-medium uppercase tracking-wider mb-1">Total Donatur</p>
                    <p class="text-5xl font-bold text-white mb-2">{{ number_format($totalDonatur) }}</p>
                    <div class="flex items-center gap-4">
                        <span class="inline-flex items-center px-3 py-1 bg-white/10 rounded-full text-white/80 text-sm">
                            <i class="fas fa-user-shield mr-2 text-[#8AD337]"></i>
                            {{ $totalAdmin }} Admin
                        </span>
                        <span class="inline-flex items-center px-3 py-1 bg-white/10 rounded-full text-white/80 text-sm">
                            <i class="fas fa-users mr-2 text-[#8AD337]"></i>
                            Donatur Aktif
                        </span>
                    </div>
                </div>
                <div class="w-20 h-20 bg-[#8AD337]/20 rounded-2xl flex items-center justify-center backdrop-blur-sm border border-white/10">
                    <i class="fas fa-users text-4xl text-[#8AD337]"></i>
                </div>
            </div>
            
            <div class="relative z-10 mt-6 pt-4 border-t border-white/10">
                <div class="flex items-center gap-2 text-white/60 text-sm">
                    <i class="fas fa-chart-line text-[#8AD337]"></i>
                    <span>Total donatur terdaftar</span>
                </div>
            </div>
        </div>

        <!-- Total Donasi Card -->
        <div class="relative overflow-hidden bg-gradient-to-br from-[#8AD337] to-[#6fb82a] rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-all duration-500 hover:scale-[1.02]">
            <!-- Decorative elements -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/4"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/4"></div>
            <div class="absolute top-1/2 right-1/4 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
            
            <div class="relative z-10 flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-white/70 text-sm font-medium uppercase tracking-wider mb-1">Total Donasi</p>
                    <p class="text-5xl font-bold text-white mb-2">Rp {{ number_format($totalDonasi, 0, ',', '.') }}</p>
                    <div class="flex items-center gap-4">
                        <span class="inline-flex items-center px-3 py-1 bg-white/20 rounded-full text-white text-sm font-medium">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ number_format($totalDonasiCount) }} Sukses
                        </span>
                        <span class="inline-flex items-center px-3 py-1 bg-white/20 rounded-full text-white text-sm font-medium">
                            <i class="fas fa-clock mr-2"></i>
                            {{ $donasiPending }} Pending
                        </span>
                    </div>
                </div>
                <div class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm border border-white/20">
                    <i class="fas fa-hand-holding-usd text-4xl text-white"></i>
                </div>
            </div>
            
            <div class="relative z-10 mt-6 pt-4 border-t border-white/20">
                <div class="flex items-center gap-2 text-white/80 text-sm">
                    <i class="fas fa-arrow-up"></i>
                    <span>Total pendapatan terkumpul</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts & Recent Donations -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Chart -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="font-bold text-[#183D57] text-lg">Grafik Donasi Bulanan</h3>
                    <p class="text-sm text-gray-400">Tahun {{ date('Y') }}</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 bg-[#8AD337] rounded-full"></span>
                    <span class="text-xs text-gray-500">Total Donasi</span>
                </div>
            </div>
            <div class="h-72">
                <canvas id="donasiChart" style="width:100%; height:100%"></canvas>
            </div>
        </div>

        <!-- Recent Donations -->
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-bold text-[#183D57] text-lg">Donasi Terbaru</h3>
                <a href="{{ route('admin.donasi.confirmed') }}" class="text-[#8AD337] hover:text-[#183D57] text-sm font-medium">
                    Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="space-y-4 max-h-72 overflow-y-auto pr-2 custom-scrollbar">
                @forelse($donasiTerbaru as $donasi)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-[#8AD337]/10 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-[#8AD337]"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800 text-sm">{{ $donasi->nama }}</p>
                                <p class="text-xs text-gray-400">{{ $donasi->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div>
                            <span class="text-[#8AD337] font-bold text-sm">Rp {{ number_format($donasi->nominal, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-400">
                        <i class="fas fa-inbox text-4xl mb-3 block"></i>
                        <p>Belum ada donasi masuk</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Active Programs -->
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-8 hover:shadow-lg transition-all duration-300 border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-gray-50/50">
            <div>
                <h3 class="font-bold text-[#183D57] text-lg">Program Donasi Aktif</h3>
                <p class="text-xs text-gray-400">Menampilkan {{ $programAktifList->count() }} program terbaru</p>
            </div>
            <a href="{{ route('admin.program.index') }}" class="text-[#8AD337] hover:text-[#183D57] text-sm font-medium">
                Kelola Program <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        <div class="overflow-x-auto">
            @if($programAktifList->count() > 0)
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Target</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terkumpul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Donatur</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($programAktifList as $program)
                            @php
                                $progress = $program->target_dana > 0 ? round(($program->dana_terkumpul / $program->target_dana) * 100, 1) : 0;
                            @endphp
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <p class="text-sm font-medium text-gray-800">{{ Str::limit($program->judul, 30) }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-600">{{ $program->kategori->nama_kategori ?? '-' }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">Rp {{ number_format($program->target_dana, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Rp {{ number_format($program->dana_terkumpul, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-24 bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-[#8AD337] h-2.5 rounded-full transition-all duration-500" style="width: {{ min($progress, 100) }}%"></div>
                                        </div>
                                        <span class="text-sm font-medium text-gray-700">{{ $progress }}%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ number_format($program->jumlah_donatur) }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">
                                        <i class="fas fa-circle text-[8px] mr-1 text-green-500"></i> Aktif
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-12 text-gray-400">
                    <i class="fas fa-inbox text-5xl mb-3 block"></i>
                    <p class="text-lg">Belum ada program donasi aktif</p>
                    <p class="text-sm">Buat program donasi baru untuk mulai menggalang dana</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Pending Donations -->
    @if($donasiPendingList->count() > 0)
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300 border border-yellow-100">
            <div class="px-6 py-4 border-b border-yellow-200 flex justify-between items-center bg-yellow-50/30">
                <div>
                    <h3 class="font-bold text-yellow-700 text-lg">
                        <i class="fas fa-clock mr-2"></i> Donasi Menunggu Konfirmasi
                    </h3>
                    <p class="text-xs text-yellow-600">{{ $donasiPendingList->count() }} donasi perlu diverifikasi</p>
                </div>
                <a href="{{ route('admin.donasi.index') }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-yellow-600 transition shadow-sm">
                    <i class="fas fa-check-circle mr-1"></i> Konfirmasi Sekarang
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Donatur</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nominal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bank</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($donasiPendingList as $donasi)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $donasi->nama }}</p>
                                        <p class="text-xs text-gray-400">{{ $donasi->email }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ Str::limit($donasi->program->judul ?? '-', 25) }}</td>
                                <td class="px-6 py-4 text-sm font-bold text-yellow-600">Rp {{ number_format($donasi->nominal, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $donasi->bank->nama_bank ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $donasi->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.donasi.index') }}" 
                                       class="inline-flex items-center bg-[#8AD337] text-[#183D57] px-4 py-1.5 rounded-lg text-xs font-semibold hover:bg-[#7BC02E] transition shadow-sm">
                                        <i class="fas fa-check mr-1"></i> Verifikasi
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection

@push('styles')
<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #8AD337;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #7BC02E;
    }
</style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const canvas = document.getElementById('donasiChart');
            if (canvas) {
                const ctx = canvas.getContext('2d');
                const chartData = @json($chartData);

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
                        datasets: [{
                            label: 'Total Donasi (Rp)',
                            data: chartData,
                            borderColor: '#8AD337',
                            backgroundColor: 'rgba(138, 211, 55, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#8AD337',
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 2,
                            pointRadius: 5,
                            pointHoverRadius: 8,
                            pointHoverBackgroundColor: '#183D57'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgba(255,255,255,0.95)',
                                titleColor: '#183D57',
                                bodyColor: '#183D57',
                                borderColor: '#8AD337',
                                borderWidth: 2,
                                padding: 12,
                                cornerRadius: 12,
                                callbacks: {
                                    label: function(context) {
                                        let value = context.raw;
                                        return 'Total: Rp ' + new Intl.NumberFormat('id-ID').format(value);
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0,0,0,0.05)'
                                },
                                ticks: {
                                    callback: function(value) {
                                        if (value >= 1000000000) {
                                            return 'Rp ' + (value / 1000000000).toFixed(1) + 'M';
                                        } else if (value >= 1000000) {
                                            return 'Rp ' + (value / 1000000).toFixed(1) + 'Jt';
                                        }
                                        return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
@endpush
