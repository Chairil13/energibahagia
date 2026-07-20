<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Kwitansi Donasi - Energi Bahagia</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .invoice-container {
            max-width: 520px;
            width: 100%;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 18px 20px 15px;
            position: relative;
        }

        /* Border dekoratif */
        .border-decorative {
            border: 1.5px solid #8AD337;
            border-radius: 8px;
            padding: 15px 18px;
            position: relative;
            background: white;
        }

        .border-decorative::before {
            content: '';
            position: absolute;
            top: -3px;
            left: -3px;
            right: -3px;
            bottom: -3px;
            border: 1px solid #183D57;
            border-radius: 10px;
            opacity: 0.1;
            z-index: -1;
        }

        /* Header */
        .header {
            text-align: center;
            padding-bottom: 10px;
            border-bottom: 2px solid #8AD337;
            margin-bottom: 12px;
        }

        .header-title {
            font-size: 13px;
            font-weight: 700;
            color: #183D57;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .header-title span {
            color: #8AD337;
        }

        .header h1 {
            font-size: 16px;
            font-weight: 700;
            color: #183D57;
            margin: 2px 0 2px;
            letter-spacing: 1px;
        }

        .header .tagline {
            font-size: 9px;
            color: #999;
            font-style: italic;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            background: linear-gradient(135deg, #8AD337, #6fb32e);
            color: #183D57;
            padding: 2px 14px;
            border-radius: 15px;
            font-size: 9px;
            font-weight: 700;
            margin-top: 3px;
            letter-spacing: 0.5px;
        }

        /* Info Invoice */
        .invoice-info {
            display: flex;
            justify-content: space-between;
            background: #f8faf8;
            padding: 6px 12px;
            border-radius: 6px;
            margin-bottom: 12px;
            border-left: 3px solid #8AD337;
        }

        .invoice-info-item .label {
            font-size: 7px;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .invoice-info-item .value {
            font-size: 10px;
            font-weight: 700;
            color: #183D57;
            margin-top: 1px;
        }

        /* Section Title */
        .section-title {
            font-size: 10px;
            font-weight: 700;
            color: #183D57;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
            padding-bottom: 3px;
            border-bottom: 1px solid #f0f0f0;
        }

        .section-title .icon {
            color: #8AD337;
            font-size: 11px;
        }

        /* Detail Grid */
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2px 12px;
            background: #fafcfa;
            border-radius: 6px;
            padding: 6px 12px;
            margin-bottom: 10px;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 3px 0;
            border-bottom: 1px dashed #eee;
        }

        .detail-item.full-width {
            grid-column: 1 / -1;
        }

        .detail-item .label {
            color: #888;
            font-size: 9px;
        }

        .detail-item .value {
            font-weight: 600;
            color: #183D57;
            font-size: 9px;
            text-align: right;
        }

        .detail-item .value.highlight {
            color: #8AD337;
            font-size: 14px;
            font-weight: 800;
        }

        .detail-item .value.mono {
            font-family: 'Courier New', monospace;
            background: #f0f4f0;
            padding: 1px 6px;
            border-radius: 3px;
            font-size: 9px;
        }

        /* Data Diri Grid */
        .personal-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2px 12px;
            background: #fafcfa;
            border-radius: 6px;
            padding: 6px 12px;
            margin-bottom: 10px;
        }

        .personal-item {
            display: flex;
            justify-content: space-between;
            padding: 3px 0;
            border-bottom: 1px dashed #eee;
        }

        .personal-item.full-width {
            grid-column: 1 / -1;
        }

        .personal-item .label {
            color: #888;
            font-size: 9px;
        }

        .personal-item .value {
            font-weight: 600;
            color: #183D57;
            font-size: 9px;
            text-align: right;
        }

        /* Pesan */
        .message-box {
            background: #f8faf8;
            border-radius: 6px;
            padding: 6px 12px;
            margin-bottom: 10px;
            border-left: 3px solid #8AD337;
            font-style: italic;
            color: #555;
            font-size: 9px;
        }

        .message-box .label-message {
            font-weight: 600;
            color: #183D57;
            font-style: normal;
            display: block;
            margin-bottom: 2px;
            font-size: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Catatan Admin */
        .admin-note {
            background: #f0f7ff;
            border-radius: 6px;
            padding: 6px 12px;
            margin-bottom: 10px;
            border-left: 3px solid #4a90d9;
        }

        .admin-note .label-admin {
            font-weight: 600;
            color: #4a90d9;
            font-size: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .admin-note .text {
            color: #333;
            font-size: 9px;
            margin-top: 1px;
        }

        /* Bukti Transfer */
        .proof-container {
            background: #fafcfa;
            border-radius: 6px;
            padding: 6px;
            text-align: center;
            margin-bottom: 10px;
            border: 1px dashed #ddd;
        }

        .proof-container .proof-label {
            font-size: 8px;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 4px;
            display: block;
        }

        .proof-container img {
            max-width: 100%;
            max-height: 100px;
            border-radius: 4px;
            border: 1px solid #e0e0e0;
        }

        /* Footer */
        .footer {
            margin-top: 12px;
            padding-top: 10px;
            border-top: 2px solid #8AD337;
            text-align: center;
        }

        .footer .motivation {
            font-size: 9px;
            color: #183D57;
            font-style: italic;
            line-height: 1.5;
            padding: 6px 12px;
            background: #f8faf8;
            border-radius: 6px;
            margin-bottom: 8px;
        }

        .footer .motivation .arabic {
            font-size: 12px;
            font-weight: 600;
            color: #183D57;
            display: block;
            margin-bottom: 2px;
        }

        .footer .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 7px;
            color: #aaa;
            padding-top: 5px;
        }

        .footer .footer-bottom .org-name {
            font-weight: 600;
            color: #183D57;
            font-size: 8px;
        }

        .footer .footer-bottom .org-name span {
            color: #8AD337;
        }

        .qr-placeholder {
            display: inline-block;
            background: #f0f4f0;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 6px;
            color: #888;
            letter-spacing: 0.5px;
        }

        /* Print */
        @media print {
            body {
                background: white;
                padding: 10px;
                min-height: auto;
            }

            .invoice-container {
                box-shadow: none;
                padding: 10px;
            }

            .border-decorative {
                padding: 10px 12px;
            }
        }

        @media (max-width: 500px) {
            .invoice-container {
                padding: 10px;
            }

            .border-decorative {
                padding: 10px;
            }

            .detail-grid,
            .personal-grid {
                grid-template-columns: 1fr;
                padding: 5px 8px;
            }

            .invoice-info {
                flex-direction: column;
                gap: 3px;
            }

            .header h1 {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="border-decorative">
            <!-- HEADER -->
            <div class="header">
                <div class="header-title">Energi <span>Bahagia</span></div>
                <h1>KWITANSI DONASI</h1>
                <p class="tagline">"Berbagi Kebahagiaan untuk Negeri"</p>
                <span class="status-badge">✓ TERKONFIRMASI</span>
            </div>

            <!-- INVOICE INFO -->
            <div class="invoice-info">
                <div class="invoice-info-item">
                    <span class="label">Nomor Kwitansi</span>
                    <span class="value">{{ $nomor_invoice }}</span>
                </div>
                <div class="invoice-info-item">
                    <span class="label">Tanggal</span>
                    <span class="value">{{ $tanggal }}</span>
                </div>
                <div class="invoice-info-item">
                    <span class="label">Status</span>
                    <span class="value" style="color: #8AD337;">✓ LUNAS</span>
                </div>
            </div>

            <!-- DETAIL DONASI -->
            <div class="section-title">
                <span class="icon">📋</span> Detail Donasi
            </div>
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="label">Kode Unik</span>
                    <span class="value mono">{{ $donasi->kode_unik }}</span>
                </div>
                <div class="detail-item">
                    <span class="label">Program</span>
                    <span class="value">{{ $donasi->program ? $donasi->program->judul : '-' }}</span>
                </div>
                <div class="detail-item full-width" style="border-bottom: 2px solid #8AD337; padding: 4px 0;">
                    <span class="label" style="font-size: 10px; font-weight: 600;">Nominal Donasi</span>
                    <span class="value highlight">Rp {{ number_format($donasi->nominal, 0, ',', '.') }}</span>
                </div>
                <div class="detail-item">
                    <span class="label">Bank Tujuan</span>
                    <span class="value">{{ $donasi->bank ? $donasi->bank->nama_bank : '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="label">No. Rekening</span>
                    <span class="value">{{ $donasi->bank ? $donasi->bank->nomor_rekening : '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="label">Atas Nama</span>
                    <span class="value">{{ $donasi->bank ? $donasi->bank->atas_nama : '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="label">Waktu</span>
                    <span class="value">{{ $donasi->created_at->format('d/m/Y H:i') }} WIB</span>
                </div>
            </div>

            <!-- DATA DIRI -->
            <div class="section-title">
                <span class="icon">👤</span> Data Diri
            </div>
            <div class="personal-grid">
                <div class="personal-item">
                    <span class="label">Nama</span>
                    <span class="value">{{ $donasi->nama }}</span>
                </div>
                <div class="personal-item">
                    <span class="label">Email</span>
                    <span class="value">{{ $donasi->email }}</span>
                </div>
                <div class="personal-item">
                    <span class="label">Telepon</span>
                    <span class="value">{{ $donasi->phone }}</span>
                </div>
                @if ($donasi->pesan)
                    <div class="personal-item full-width">
                        <span class="label">Doa / Pesan</span>
                        <span class="value"
                            style="font-style: italic; color: #555; font-size: 8px;">"{{ $donasi->pesan }}"</span>
                    </div>
                @endif
            </div>

            <!-- PESAN / DOA -->
            @if ($donasi->pesan)
                <div class="message-box">
                    <span class="label-message">🙏 Doa & Pesan</span>
                    "{{ $donasi->pesan }}"
                </div>
            @endif

            <!-- CATATAN ADMIN -->
            @if ($donasi->admin_note)
                <div class="admin-note">
                    <div class="label-admin">📌 Catatan Admin</div>
                    <div class="text">{{ $donasi->admin_note }}</div>
                </div>
            @endif

            <!-- BUKTI TRANSFER -->
            @if ($donasi->bukti_transfer)
                <div class="proof-container">
                    <span class="proof-label">📷 Bukti Transfer</span>
                    <img src="{{ public_path('uploads/bukti/' . $donasi->bukti_transfer) }}" alt="Bukti Transfer">
                </div>
            @endif

            <!-- FOOTER -->
            <div class="footer">
                <div class="motivation">
                    <span class="arabic">"وَمَا تُقَدِّمُوا لِأَنفُسِكُم مِّنْ خَيْرٍ تَجِدُوهُ عِندَ اللَّهِ"</span>
                    "Apa saja kebaikan yang kamu perbuat untuk dirimu, niscaya kamu akan mendapatkannya di sisi Allah"
                    <br><small style="color: #999; font-size: 7px;">(QS. Al-Baqarah: 110)</small>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; padding: 4px 0;">
                    <div style="font-size: 8px; color: #183D57; font-weight: 600;">
                        🌟 <span style="color: #8AD337;">Energi</span> Bahagia
                    </div>
                    <div style="text-align: right;">
                        <div style="font-size: 6px; color: #aaa;">Verifikasi di</div>
                        <div style="font-size: 7px; color: #183D57; font-weight: 600;">energibahagia.com</div>
                    </div>
                </div>

                <div class="footer-bottom">
                    <span class="org-name">🌟 <span>Energi</span> Bahagia</span>
                    <span>© {{ date('Y') }} • LAZNAS</span>
                    <span class="qr-placeholder">🔷 SCAN</span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
