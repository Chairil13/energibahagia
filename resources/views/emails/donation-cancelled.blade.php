<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Donasi Ditolak - Energi Bahagia</title>
</head>

<body style="margin: 0; padding: 24px; background: #f3f6f8; font-family: Arial, sans-serif; color: #183D57;">
    <div style="max-width: 640px; margin: 0 auto; background: #ffffff; border-radius: 16px; overflow: hidden;">
        <div style="background: #ef4444; padding: 28px; text-align: center;">
            <h1 style="margin: 0; color: #ffffff; font-size: 24px;">Donasi Ditolak</h1>
            <p style="margin: 8px 0 0; color: #fee2e2; font-size: 14px;">
                Bukti transfer donasi Anda belum dapat kami terima.
            </p>
        </div>

        <div style="padding: 28px;">
            <p style="font-size: 16px; line-height: 1.6; margin: 0 0 18px;">
                Halo <strong>{{ $donasi->nama }}</strong>,
            </p>

            <p style="font-size: 14px; line-height: 1.7; color: #4b5563; margin: 0 0 22px;">
                Donasi Anda untuk program berikut telah ditolak oleh admin Energi Bahagia.
            </p>

            <div style="background: #fef2f2; border-left: 4px solid #ef4444; padding: 14px 16px; border-radius: 10px; margin-bottom: 22px;">
                <p style="margin: 0 0 6px; font-weight: bold; color: #991b1b;">Alasan Penolakan</p>
                <p style="margin: 0; color: #7f1d1d; line-height: 1.6;">{{ $donasi->admin_note ?? 'Donasi ditolak oleh admin.' }}</p>
            </div>

            <div style="background: #f8fafc; border: 1px solid #e5e7eb; border-radius: 14px; padding: 18px; margin-bottom: 22px;">
                <h2 style="font-size: 16px; margin: 0 0 12px; color: #183D57;">Detail Donasi</h2>
                <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                    <tr>
                        <td style="padding: 9px 0; color: #64748b;">Program</td>
                        <td style="padding: 9px 0; text-align: right; font-weight: bold;">{{ $donasi->program->judul ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 9px 0; color: #64748b; border-top: 1px solid #e5e7eb;">Nominal</td>
                        <td style="padding: 9px 0; text-align: right; border-top: 1px solid #e5e7eb; color: #ef4444; font-weight: bold;">
                            Rp {{ number_format($donasi->nominal, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 9px 0; color: #64748b; border-top: 1px solid #e5e7eb;">Bank</td>
                        <td style="padding: 9px 0; text-align: right; border-top: 1px solid #e5e7eb;">
                            {{ $donasi->bank->nama_bank ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 9px 0; color: #64748b; border-top: 1px solid #e5e7eb;">Kode Donasi</td>
                        <td style="padding: 9px 0; text-align: right; border-top: 1px solid #e5e7eb; font-family: monospace;">
                            {{ $donasi->kode_unik }}
                        </td>
                    </tr>
                </table>
            </div>

            <p style="font-size: 14px; line-height: 1.7; color: #4b5563; margin: 0 0 22px;">
                Jika Anda merasa ada kekeliruan, silakan hubungi admin Energi Bahagia dan sertakan kode donasi di atas.
            </p>

            <p style="font-size: 12px; color: #94a3b8; text-align: center; margin: 0;">
                Email ini dikirim otomatis karena donasi dibuat tanpa akun login.
            </p>
        </div>
    </div>
</body>

</html>
