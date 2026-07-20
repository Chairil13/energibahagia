<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Donasi Terkonfirmasi - Energi Bahagia</title>
</head>

<body style="margin: 0; padding: 24px; background: #f3f6f8; font-family: Arial, sans-serif; color: #183D57;">
    <div style="max-width: 640px; margin: 0 auto; background: #ffffff; border-radius: 18px; overflow: hidden; box-shadow: 0 12px 32px rgba(24, 61, 87, 0.12);">
        <div style="background: linear-gradient(135deg, #8AD337, #6fb32e); padding: 28px; text-align: center; color: #ffffff;">
            <div style="width: 34px; height: 34px; line-height: 34px; border-radius: 999px; background: #ffffff; color: #6fb32e; margin: 0 auto 12px; font-size: 20px; font-weight: bold;">
                &#10003;
            </div>
            <h1 style="margin: 0; color: #ffffff; font-size: 24px;">Donasi Terkonfirmasi</h1>
            <p style="margin: 8px 0 0; color: rgba(255, 255, 255, 0.9); font-size: 14px;">
                Terima kasih atas donasi Anda
            </p>
        </div>

        <div style="padding: 28px;">
            <p style="font-size: 16px; line-height: 1.6; margin: 0 0 18px;">
                Halo <strong>{{ $donasi->nama }}</strong>,
            </p>

            <p style="font-size: 14px; line-height: 1.7; color: #4b5563; margin: 0 0 24px;">
                Donasi Anda sudah diverifikasi oleh admin Energi Bahagia. Berikut detail donasi yang tercatat di sistem kami.
            </p>

            <div style="margin-bottom: 24px;">
                <h2 style="font-size: 16px; margin: 0 0 12px; color: #183D57;">
                    <span style="color: #8AD337;">&#9638;</span> Detail Donasi
                </h2>
                <table style="width: 100%; border-collapse: collapse; background: #f8fafc; border-radius: 12px; overflow: hidden; font-size: 14px;">
                    <tr>
                        <td style="padding: 12px; color: #64748b; border-bottom: 1px solid #e5e7eb;">Kode Unik</td>
                        <td style="padding: 12px; text-align: right; border-bottom: 1px solid #e5e7eb; font-family: monospace; font-weight: bold; color: #000000;">
                            {{ $donasi->kode_unik }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 12px; color: #64748b; border-bottom: 1px solid #e5e7eb;">Program Donasi</td>
                        <td style="padding: 12px; text-align: right; border-bottom: 1px solid #e5e7eb; font-weight: bold; color: #000000;">
                            {{ $donasi->program->judul ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 12px; color: #64748b; border-bottom: 1px solid #e5e7eb;">Nominal Donasi</td>
                        <td style="padding: 12px; text-align: right; border-bottom: 1px solid #e5e7eb; color: #6fb32e; font-size: 16px; font-weight: bold;">
                            Rp {{ number_format($donasi->nominal, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 12px; color: #64748b; border-bottom: 1px solid #e5e7eb;">Bank Tujuan</td>
                        <td style="padding: 12px; text-align: right; border-bottom: 1px solid #e5e7eb; font-weight: bold; color: #000000;">
                            {{ $donasi->bank->nama_bank ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 12px; color: #64748b; border-bottom: 1px solid #e5e7eb;">No. Rekening Tujuan</td>
                        <td style="padding: 12px; text-align: right; border-bottom: 1px solid #e5e7eb; font-weight: bold; color: #000000;">
                            {{ $donasi->bank->nomor_rekening ?? '-' }} a.n {{ $donasi->bank->atas_nama ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 12px; color: #64748b;">Waktu Donasi</td>
                        <td style="padding: 12px; text-align: right; color: #000000;">
                            {{ $donasi->created_at->format('d F Y H:i') }} WIB
                        </td>
                    </tr>
                </table>
            </div>

            <div style="margin-bottom: 24px;">
                <h2 style="font-size: 16px; margin: 0 0 12px; color: #183D57;">
                    <span style="color: #8AD337;">&#9829;</span> Data Diri
                </h2>
                <table style="width: 100%; border-collapse: collapse; background: #f8fafc; border-radius: 12px; overflow: hidden; font-size: 14px;">
                    <tr>
                        <td style="padding: 12px; color: #64748b; border-bottom: 1px solid #e5e7eb;">Nama Lengkap</td>
                        <td style="padding: 12px; text-align: right; border-bottom: 1px solid #e5e7eb; font-weight: bold; color: #000000;">
                            {{ $donasi->nama }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 12px; color: #64748b; border-bottom: 1px solid #e5e7eb;">Email</td>
                        <td style="padding: 12px; text-align: right; border-bottom: 1px solid #e5e7eb; color: #000000;">
                            {{ $donasi->email }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 12px; color: #64748b; {{ $donasi->pesan ? 'border-bottom: 1px solid #e5e7eb;' : '' }}">Nomor Telepon</td>
                        <td style="padding: 12px; text-align: right; {{ $donasi->pesan ? 'border-bottom: 1px solid #e5e7eb;' : '' }} color: #000000;">
                            {{ $donasi->phone }}
                        </td>
                    </tr>
                    @if ($donasi->pesan)
                        <tr>
                            <td style="padding: 12px; color: #64748b;">Doa / Pesan</td>
                            <td style="padding: 12px; text-align: right; color: #000000; font-style: italic;">
                                "{{ $donasi->pesan }}"
                            </td>
                        </tr>
                    @endif
                </table>
            </div>

            @if ($donasi->admin_note)
                <div style="background: #eef9e7; border-left: 4px solid #8AD337; padding: 14px 16px; border-radius: 10px; margin-bottom: 24px;">
                    <p style="margin: 0 0 6px; font-weight: bold; color: #183D57;">Catatan dari Admin</p>
                    <p style="margin: 0; color: #315025; line-height: 1.6;">{{ $donasi->admin_note }}</p>
                </div>
            @endif

            @if ($donasi->bukti_transfer)
                <div style="margin-bottom: 24px;">
                    <h2 style="font-size: 16px; margin: 0 0 12px; color: #183D57;">
                        <span style="color: #8AD337;">&#9635;</span> Bukti Transfer
                    </h2>
                    <div style="background: #f8fafc; border-radius: 12px; padding: 16px; text-align: center;">
                        <img src="{{ asset('uploads/bukti/'.$donasi->bukti_transfer) }}" alt="Bukti Transfer"
                            style="max-width: 100%; max-height: 280px; border-radius: 10px; display: inline-block;">
                    </div>
                </div>
            @endif

            <div style="text-align: center; margin: 28px 0 10px;">
                <a href="{{ route('programs') }}"
                    style="display: inline-block; background: #8AD337; color: #183D57; text-decoration: none; padding: 13px 24px; border-radius: 12px; font-weight: bold;">
                    Donasi Lagi
                </a>
            </div>

            <p style="font-size: 12px; color: #94a3b8; text-align: center; margin: 20px 0 0;">
                Email ini dikirim otomatis setelah admin mengonfirmasi donasi Anda.
            </p>
        </div>
    </div>
</body>

</html>
