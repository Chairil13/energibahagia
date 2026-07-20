@extends('layouts.admin')

@section('title', 'Konfirmasi Donasi - Admin Panel')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#183D57]">Konfirmasi Donasi</h1>
        <p class="text-gray-500">Donasi yang menunggu konfirmasi</p>
    </div>

    <div class="flex gap-2 mb-6 flex-wrap">
        <a href="{{ route('admin.donasi.index') }}"
            class="px-4 py-2 bg-[#8AD337] text-[#183D57] rounded-xl font-semibold">Menunggu Konfirmasi</a>
        <a href="{{ route('admin.donasi.confirmed') }}"
            class="px-4 py-2 bg-gray-200 text-gray-600 rounded-xl font-semibold hover:bg-gray-300 transition">Sudah
            Dikonfirmasi</a>
        <a href="{{ route('admin.donasi.cancelled') }}"
            class="px-4 py-2 bg-gray-200 text-gray-600 rounded-xl font-semibold hover:bg-gray-300 transition">Ditolak</a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-xl">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl">{{ session('error') }}</div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm p-5 mb-6">
        <form action="{{ route('admin.donasi.settings.update') }}" method="POST"
            class="flex flex-col md:flex-row md:items-end gap-4">
            @csrf
            @method('PATCH')

            <div class="flex-1">
                <label for="transfer_expiration_minutes" class="block text-[#183D57] font-semibold mb-2">
                    Batas Waktu Transfer
                </label>
                <div class="flex items-center gap-3">
                    <input type="number" min="1" max="10080" name="transfer_expiration_minutes"
                        id="transfer_expiration_minutes"
                        value="{{ old('transfer_expiration_minutes', $donationSetting->transfer_expiration_minutes) }}"
                        class="w-full md:max-w-xs px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#8AD337] focus:ring-2 focus:ring-[#8AD337]/20">
                    <span class="text-sm text-gray-500">menit</span>
                </div>
                @error('transfer_expiration_minutes')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-400 mt-2">
                    Berlaku untuk donasi baru. Saat waktu habis, upload bukti transfer otomatis dinonaktifkan.
                </p>
            </div>

            <button type="submit"
                class="bg-[#8AD337] text-[#183D57] px-5 py-3 rounded-xl font-semibold hover:bg-[#7BC02E] transition">
                <i class="fas fa-save mr-2"></i> Simpan Batas Waktu
            </button>
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Donatur</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Program</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Doa/Harapan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nominal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bank</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bukti</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($donasis as $index => $donasi)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $donasi->nama }}</p>
                                    <p class="text-xs text-gray-400">{{ $donasi->email }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $donasi->program->judul ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <p class="max-w-xs break-words italic">
                                    {{ $donasi->pesan ? Str::limit($donasi->pesan, 80) : '-' }}
                                </p>
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-[#8AD337]">Rp
                                {{ number_format($donasi->nominal, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $donasi->bank->nama_bank ?? '-' }}</td>
                            <td class="px-6 py-4">
                                @if ($donasi->bukti_transfer)
                                    <a href="{{ asset('uploads/bukti/' . $donasi->bukti_transfer) }}" target="_blank"
                                        class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-image"></i> Lihat
                                    </a>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $donasi->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <button
                                        onclick="openConfirmModal({
                                            id: {{ $donasi->id }},
                                            kodeUnik: @js($donasi->kode_unik),
                                            nama: @js($donasi->nama),
                                            nominal: {{ $donasi->nominal }},
                                            email: @js($donasi->email),
                                            phone: @js($donasi->phone),
                                            pesan: @js($donasi->pesan),
                                            program: @js($donasi->program->judul ?? '-'),
                                            bank: @js($donasi->bank->nama_bank ?? '-'),
                                            nomorRekening: @js($donasi->bank->nomor_rekening ?? '-'),
                                            atasNama: @js($donasi->bank->atas_nama ?? '-'),
                                            waktuDonasi: @js($donasi->created_at->format('d F Y H:i') . ' WIB'),
                                            buktiTransfer: @js($donasi->bukti_transfer ? asset('uploads/bukti/' . $donasi->bukti_transfer) : '-')
                                        })"
                                        class="bg-green-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-green-600 transition">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button
                                        onclick="openCancelModal({{ $donasi->id }}, @js($donasi->nama), {{ $donasi->nominal }}, @js($donasi->pesan), @js($donasi->email), @js(blank($donasi->user_id)))"
                                        class="bg-red-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-red-600 transition">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-10 text-center text-gray-400">Tidak ada donasi yang menunggu
                                konfirmasi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $donasis->links() }}
        </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div id="confirmModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4">
            <div class="bg-gradient-to-r from-[#8AD337] to-[#6fb32e] px-6 py-4 rounded-t-2xl">
                <h3 class="text-white font-bold text-lg">Konfirmasi Donasi</h3>
            </div>
            <form id="confirmForm" method="POST" class="p-6">
                @csrf
                <div class="mb-4">
                    <p class="text-gray-600 mb-2">Konfirmasi donasi dari:</p>
                    <p class="font-semibold text-[#183D57]" id="confirmNama"></p>
                    <p class="font-bold text-[#8AD337] text-xl mt-1" id="confirmNominal"></p>
                </div>
                <div class="mb-4 rounded-xl bg-gray-50 px-4 py-3">
                    <p class="text-xs font-semibold uppercase text-gray-400">Doa/Harapan</p>
                    <p class="mt-1 text-sm italic text-gray-600" id="confirmPesan"></p>
                </div>
                <div class="mb-4 grid gap-2 text-sm">
                    <a href="#" id="confirmEmailLink"
                        class="rounded-xl bg-blue-50 px-3 py-2 text-blue-700 hover:bg-blue-100 transition">
                        <span class="flex items-center gap-2">
                        <i class="fas fa-envelope w-5"></i>
                        <span id="confirmEmail"></span>
                        </span>
                        <p class="mt-2 text-xs text-blue-500">
                            Klik email ini untuk membuka pesan konfirmasi berisi detail donasi.
                        </p>
                    </a>
                </div>
                <div class="flex gap-3">
                    <button type="submit"
                        class="flex-1 bg-[#8AD337] text-[#183D57] py-2 rounded-xl font-semibold hover:shadow-lg transition">
                        <i class="fas fa-check mr-2"></i> Konfirmasi
                    </button>
                    <button type="button" onclick="closeConfirmModal()"
                        class="flex-1 bg-gray-200 text-gray-600 py-2 rounded-xl font-semibold hover:bg-gray-300 transition">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tolak Donasi -->
    <div id="cancelModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4">
            <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4 rounded-t-2xl">
                <h3 class="text-white font-bold text-lg">Tolak Donasi</h3>
            </div>
            <form id="cancelForm" method="POST" class="p-6">
                @csrf
                @method('DELETE')
                <div class="mb-4">
                    <div class="flex items-center gap-3 p-3 bg-red-50 rounded-xl border border-red-200">
                        <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
                        <div>
                            <p class="text-gray-600 text-sm">Anda akan menolak donasi dari:</p>
                            <p class="font-semibold text-[#183D57]" id="cancelNama"></p>
                            <p class="font-bold text-red-600 text-lg mt-1" id="cancelNominal"></p>
                            <p class="text-xs font-semibold uppercase text-gray-400 mt-3">Doa/Harapan</p>
                            <p class="text-sm italic text-gray-600" id="cancelPesan"></p>
                        </div>
                    </div>
                </div>
                <div id="cancelEmailBox" class="mb-4 hidden rounded-xl bg-blue-50 px-4 py-3 text-blue-700">
                    <p class="text-xs font-semibold uppercase text-blue-400" id="cancelEmailLabel">Email Donatur</p>
                    <a href="#" class="mt-1 block break-all text-sm font-semibold underline underline-offset-2"
                        id="cancelEmailLink">
                        <span id="cancelEmail"></span>
                    </a>
                </div>
                <div id="cancelReasonBox" class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2 text-sm">Alasan Penolakan (Opsional)</label>
                    <textarea name="cancel_reason" id="cancelReason" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-red-500"
                        placeholder="Berikan alasan penolakan donasi..."></textarea>
                </div>
                <div class="flex gap-3">
                    <button type="submit"
                        class="flex-1 bg-red-500 text-white py-2 rounded-xl font-semibold hover:bg-red-600 transition">
                        <i class="fas fa-times mr-2"></i> Tolak Donasi
                    </button>
                    <button type="button" onclick="closeCancelModal()"
                        class="flex-1 bg-gray-200 text-gray-600 py-2 rounded-xl font-semibold hover:bg-gray-300 transition">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function buildCancellationMessage(nama, nominal) {
            return 'Halo ' + nama + ', donasi Anda sebesar Rp ' + new Intl.NumberFormat('id-ID').format(nominal) +
                ' ditolak oleh admin Energi Bahagia.\n\nAlasan penolakan: Donasi ditolak oleh admin.\n\nSilakan hubungi admin jika Anda merasa ada kekeliruan.';
        }

        function buildConfirmationMessage(donasi) {
            const nominalFormatted = new Intl.NumberFormat('id-ID').format(donasi.nominal);

            return [
                'Halo ' + donasi.nama + ',',
                '',
                'Donasi Anda telah kami konfirmasi.',
                'Terima kasih atas kebaikan dan dukungan Anda untuk program Energi Bahagia.',
                '',
                '==============================',
                'DETAIL DONASI',
                '==============================',
                'Kode Unik          : ' + donasi.kodeUnik,
                'Program Donasi     : ' + donasi.program,
                'Nominal Donasi     : Rp ' + nominalFormatted,
                'Bank Tujuan        : ' + donasi.bank,
                'No. Rekening       : ' + donasi.nomorRekening,
                'Atas Nama          : ' + donasi.atasNama,
                'Waktu Donasi       : ' + donasi.waktuDonasi,
                '',
                '==============================',
                'DATA DIRI',
                '==============================',
                'Nama Lengkap       : ' + donasi.nama,
                'Email              : ' + donasi.email,
                'Nomor Telepon      : ' + donasi.phone,
                donasi.pesan ? 'Doa / Pesan        : "' + donasi.pesan + '"' : null,
                '',
                'Semoga kebaikan Anda membawa manfaat luas bagi penerima program.',
                '',
                'Salam hangat,',
                'Energi Bahagia',
                '',
                'Email ini dikirim setelah donasi Anda diverifikasi oleh admin.'
            ].filter(Boolean).join('\n');
        }

        function openConfirmModal(donasi) {
            const emailSubject = 'Donasi Anda Telah Dikonfirmasi - Energi Bahagia';
            const confirmationMessage = buildConfirmationMessage(donasi);

            document.getElementById('confirmNama').innerText = donasi.nama;
            document.getElementById('confirmNominal').innerHTML = 'Rp ' + new Intl.NumberFormat('id-ID').format(donasi
                .nominal);
            document.getElementById('confirmPesan').innerText = donasi.pesan || '-';
            document.getElementById('confirmEmail').innerText = donasi.email || '-';
            document.getElementById('confirmEmailLink').href = donasi.email ? 'mailto:' + donasi.email + '?subject=' +
                encodeURIComponent(emailSubject) + '&body=' + encodeURIComponent(confirmationMessage) : '#';
            document.getElementById('confirmForm').action = '/admin/donasi/' + donasi.id + '/confirm';
            document.getElementById('confirmModal').classList.remove('hidden');
            document.getElementById('confirmModal').classList.add('flex');
        }

        function closeConfirmModal() {
            document.getElementById('confirmModal').classList.add('hidden');
            document.getElementById('confirmModal').classList.remove('flex');
        }

        function openCancelModal(id, nama, nominal, pesan, email, isGuest) {
            document.getElementById('cancelNama').innerText = nama;
            document.getElementById('cancelNominal').innerHTML = 'Rp ' + new Intl.NumberFormat('id-ID').format(nominal);
            document.getElementById('cancelPesan').innerText = pesan || '-';
            document.getElementById('cancelForm').action = '/admin/donasi/' + id + '/cancel';

            const emailBox = document.getElementById('cancelEmailBox');
            const reasonBox = document.getElementById('cancelReasonBox');
            const reasonInput = document.getElementById('cancelReason');
            const emailSubject = 'Donasi Anda Ditolak - Energi Bahagia';
            const cancellationMessage = buildCancellationMessage(nama, nominal);

            reasonInput.value = '';
            document.getElementById('cancelEmail').innerText = email || '-';
            document.getElementById('cancelEmailLabel').innerText = isGuest ? 'Email Donatur Guest' : 'Email Donatur';
            document.getElementById('cancelEmailLink').href = email ? 'mailto:' + email + '?subject=' +
                encodeURIComponent(emailSubject) + '&body=' + encodeURIComponent(cancellationMessage) : '#';
            emailBox.classList.remove('hidden');

            if (isGuest) {
                reasonBox.classList.add('hidden');
            } else {
                reasonBox.classList.remove('hidden');
            }

            document.getElementById('cancelModal').classList.remove('hidden');
            document.getElementById('cancelModal').classList.add('flex');
        }

        function closeCancelModal() {
            document.getElementById('cancelModal').classList.add('hidden');
            document.getElementById('cancelModal').classList.remove('flex');
        }
    </script>
@endsection
