<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Kwitansi Donasi - Energi Bahagia</title>
    <style>
        @page {
            margin: 20px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333333;
            background-color: #ffffff;
            font-size: 11px;
            line-height: 1.4;
        }

        .outer-card {
            border: 2px solid #7cb342;
            border-radius: 14px;
            padding: 20px 25px;
            margin: 0 auto;
            width: 100%;
            background-color: #ffffff;
        }

        /* HEADER */
        .header-container {
            text-align: center;
            margin-bottom: 10px;
        }

        .header-logo {
            margin-bottom: 6px;
        }

        .header-logo img {
            height: 48px;
            width: auto;
        }

        .header-title {
            font-size: 20px;
            font-weight: bold;
            color: #183D57;
            letter-spacing: 1px;
            text-align: center;
            margin-bottom: 2px;
        }

        .title-line {
            height: 2px;
            background-color: #7cb342;
            width: 100%;
            margin: 4px 0 6px 0;
        }

        .header-tagline {
            font-style: italic;
            color: #555555;
            font-size: 11px;
            text-align: center;
            margin-bottom: 15px;
        }

        /* INFO BOX */
        .info-box {
            background-color: #f8faf8;
            border-radius: 10px;
            padding: 10px 16px;
            margin-bottom: 18px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 4px 0;
            font-size: 11px;
            vertical-align: middle;
        }

        .info-label {
            color: #666666;
            width: 160px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 9px;
            font-weight: 600;
        }

        .info-colon {
            width: 15px;
            color: #666666;
        }

        .info-value {
            color: #183D57;
            font-weight: bold;
            font-size: 11px;
        }

        .status-lunas {
            color: #7cb342;
            font-weight: bold;
        }

        /* SECTION HEADER */
        .section-header {
            color: #183D57;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding-bottom: 4px;
            margin-top: 15px;
            margin-bottom: 8px;
            border-bottom: 1.5px solid #7cb342;
        }

        /* DATA TABLE */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .data-table tr td {
            padding: 6px 0;
            font-size: 11px;
            border-bottom: 1px dashed #e8e8e8;
            vertical-align: middle;
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .data-label {
            color: #555555;
            width: 160px;
        }

        .data-colon {
            width: 15px;
            color: #555555;
        }

        .data-value {
            color: #183D57;
            font-weight: 600;
        }

        /* HIGHLIGHT NOMINAL */
        .nominal-row td {
            border-top: 1.5px solid #7cb342 !important;
            border-bottom: 1.5px solid #7cb342 !important;
            padding: 8px 0 !important;
        }

        .nominal-value {
            color: #7cb342;
            font-size: 15px;
            font-weight: bold;
        }

        /* SIGNATURE & THANK YOU BOX */
        .signature-box {
            border: 1.5px solid #7cb342;
            border-radius: 10px;
            padding: 14px;
            margin-top: 20px;
            background-color: #ffffff;
        }

        .signature-table {
            width: 100%;
            border-collapse: collapse;
        }

        .signature-left {
            width: 48%;
            vertical-align: middle;
            padding-right: 15px;
            border-right: 1px solid #e0e0e0;
        }

        .thankyou-text {
            font-style: italic;
            color: #444444;
            font-size: 11px;
            line-height: 1.5;
            text-align: center;
        }

        .signature-right {
            width: 52%;
            vertical-align: top;
            text-align: center;
            padding-left: 15px;
        }

        .sig-title {
            color: #333333;
            font-size: 11px;
        }

        .sig-org {
            color: #183D57;
            font-weight: bold;
            font-size: 11px;
            margin-top: 2px;
            margin-bottom: 4px;
        }

        .sig-images-wrapper {
            height: 75px;
            text-align: center;
            margin: 4px 0;
        }

        .sig-cap {
            height: 70px;
            width: auto;
            vertical-align: middle;
            margin-right: -20px;
        }

        .sig-ttd {
            height: 55px;
            width: auto;
            vertical-align: middle;
        }

        .sig-footer {
            color: #555555;
            font-size: 10px;
            margin-top: 2px;
        }
    </style>
</head>

<body>
    @php
        $logoPath = public_path('images/logo.png');
        $logoData = file_exists($logoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath)) : '';

        $capPath = public_path('images/cap yayasan.png');
        $capData = file_exists($capPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($capPath)) : '';

        $ttdPath = public_path('images/ttd.png');
        $ttdData = file_exists($ttdPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($ttdPath)) : '';
    @endphp

    <div class="outer-card">
        <!-- HEADER -->
        <div class="header-container">
            @if ($logoData)
                <div class="header-logo">
                    <img src="{{ $logoData }}" alt="Energi Bahagia Logo">
                </div>
            @endif
            <div class="header-title">KWITANSI DONASI</div>
            <div class="title-line"></div>
            <div class="header-tagline">Berbagi Kebaikan untuk Negeri</div>
        </div>

        <!-- INFO BOX -->
        <div class="info-box">
            <table class="info-table">
                <tr>
                    <td class="info-label">NOMOR KWITANSI</td>
                    <td class="info-colon">:</td>
                    <td class="info-value">{{ $nomor_invoice }}</td>
                </tr>
                <tr>
                    <td class="info-label">TANGGAL</td>
                    <td class="info-colon">:</td>
                    <td class="info-value">{{ $tanggal }}</td>
                </tr>
                <tr>
                    <td class="info-label">STATUS</td>
                    <td class="info-colon">:</td>
                    <td class="info-value status-lunas">LUNAS</td>
                </tr>
            </table>
        </div>

        <!-- DETAIL DONASI -->
        <div class="section-header">DETAIL DONASI</div>
        <table class="data-table">
            <tr>
                <td class="data-label">Kode Unik</td>
                <td class="data-colon">:</td>
                <td class="data-value">{{ $donasi->kode_unik }}</td>
            </tr>
            <tr>
                <td class="data-label">Program</td>
                <td class="data-colon">:</td>
                <td class="data-value">{{ $donasi->program ? $donasi->program->judul : '-' }}</td>
            </tr>
            <tr class="nominal-row">
                <td class="data-label" style="font-weight: bold;">Nominal Donasi</td>
                <td class="data-colon" style="font-weight: bold;">:</td>
                <td class="nominal-value">Rp {{ number_format($donasi->nominal, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="data-label">Bank Tujuan</td>
                <td class="data-colon">:</td>
                <td class="data-value">{{ $donasi->bank ? $donasi->bank->nama_bank : '-' }}</td>
            </tr>
            <tr>
                <td class="data-label">No. Rekening</td>
                <td class="data-colon">:</td>
                <td class="data-value">{{ $donasi->bank ? $donasi->bank->nomor_rekening : '-' }}</td>
            </tr>
            <tr>
                <td class="data-label">Atas Nama</td>
                <td class="data-colon">:</td>
                <td class="data-value">{{ $donasi->bank ? $donasi->bank->atas_nama : '-' }}</td>
            </tr>
            <tr>
                <td class="data-label">Waktu</td>
                <td class="data-colon">:</td>
                <td class="data-value">{{ $donasi->created_at->format('d/m/Y H:i') }} WIB</td>
            </tr>
        </table>

        <!-- DATA DIRI -->
        <div class="section-header">DATA DIRI</div>
        <table class="data-table">
            <tr>
                <td class="data-label">Nama</td>
                <td class="data-colon">:</td>
                <td class="data-value">{{ $donasi->nama }}</td>
            </tr>
            <tr>
                <td class="data-label">Email</td>
                <td class="data-colon">:</td>
                <td class="data-value">{{ $donasi->email }}</td>
            </tr>
            <tr>
                <td class="data-label">Telepon</td>
                <td class="data-colon">:</td>
                <td class="data-value">{{ $donasi->phone }}</td>
            </tr>
            @if ($donasi->pesan)
                <tr>
                    <td class="data-label">Doa / Pesan</td>
                    <td class="data-colon">:</td>
                    <td class="data-value" style="font-style: italic; color: #555555;">"{{ $donasi->pesan }}"</td>
                </tr>
            @endif
        </table>

        <!-- FOOTER SIGNATURE & THANK YOU -->
        <div class="signature-box">
            <table class="signature-table">
                <tr>
                    <td class="signature-left">
                        <div class="thankyou-text">
                            Terima kasih atas kebaikan<br>
                            dan kepercayaan Anda.<br>
                            Semoga Allah membalas<br>
                            setiap kebaikan dengan<br>
                            pahala yang berlipat ganda.<br>
                            Aamiin.
                        </div>
                    </td>
                    <td class="signature-right">
                        <div class="sig-title">Hormat kami,</div>
                        <div class="sig-org">Yayasan Energi Bahagia Indonesia</div>
                        <div class="sig-images-wrapper">
                            @if ($capData)
                                <img src="{{ $capData }}" class="sig-cap" alt="Cap Yayasan">
                            @endif
                            @if ($ttdData)
                                <img src="{{ $ttdData }}" class="sig-ttd" alt="TTD">
                            @endif
                        </div>
                        <div class="sig-footer">Pengurus Yayasan</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>

