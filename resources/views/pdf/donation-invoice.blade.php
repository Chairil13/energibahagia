<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Kwitansi Donasi - Energi Bahagia</title>
    <style>
        @page {
            margin: 10mm 12mm;
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
            border-radius: 12px;
            padding: 18px 22px;
            margin: 0;
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
            height: 46px;
            width: auto;
        }

        .header-title {
            font-size: 19px;
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
            font-size: 10.5px;
            text-align: center;
            margin-bottom: 14px;
        }

        /* INFO BOX */
        .info-box {
            background-color: #f8faf8;
            border-radius: 8px;
            padding: 10px 14px;
            margin-bottom: 16px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .info-table td {
            padding: 3px 0;
            font-size: 10.5px;
            vertical-align: middle;
        }

        .info-label {
            color: #666666;
            width: 140px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 9px;
            font-weight: 600;
        }

        .info-colon {
            width: 12px;
            color: #666666;
        }

        .info-value {
            color: #183D57;
            font-weight: bold;
            font-size: 10.5px;
        }

        .status-lunas {
            color: #7cb342;
            font-weight: bold;
        }

        /* SECTION HEADER */
        .section-header {
            color: #183D57;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding-bottom: 4px;
            margin-top: 12px;
            margin-bottom: 6px;
            border-bottom: 1.5px solid #7cb342;
        }

        /* DATA TABLE */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-bottom: 12px;
        }

        .data-table tr td {
            padding: 5px 0;
            font-size: 10.5px;
            border-bottom: 1px dashed #e8e8e8;
            vertical-align: middle;
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .data-label {
            color: #555555;
            width: 140px;
        }

        .data-colon {
            width: 12px;
            color: #555555;
        }

        .data-value {
            color: #183D57;
            font-weight: 600;
            word-wrap: break-word;
        }

        /* HIGHLIGHT NOMINAL */
        .nominal-row td {
            border-top: 1.5px solid #7cb342 !important;
            border-bottom: 1.5px solid #7cb342 !important;
            padding: 7px 0 !important;
        }

        .nominal-value {
            color: #7cb342;
            font-size: 14.5px;
            font-weight: bold;
        }

        /* SIGNATURE & THANK YOU BOX */
        .signature-box {
            border: 1.5px solid #7cb342;
            border-radius: 8px;
            padding: 12px 14px;
            margin-top: 16px;
            background-color: #ffffff;
        }

        .signature-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .signature-left {
            width: 48%;
            vertical-align: middle;
            padding-right: 12px;
            border-right: 1px solid #e0e0e0;
        }

        .thankyou-text {
            font-style: italic;
            color: #444444;
            font-size: 10.5px;
            line-height: 1.45;
            text-align: center;
        }

        .signature-right {
            width: 52%;
            vertical-align: top;
            text-align: center;
            padding-left: 12px;
        }

        .sig-title {
            color: #333333;
            font-size: 10.5px;
        }

        .sig-org {
            color: #183D57;
            font-weight: bold;
            font-size: 10.5px;
            margin-top: 2px;
            margin-bottom: 2px;
        }

        .sig-images-wrapper {
            height: 70px;
            text-align: center;
            margin: 2px 0;
        }

        .sig-cap {
            height: 65px;
            width: auto;
            vertical-align: middle;
            margin-right: -18px;
        }

        .sig-ttd {
            height: 52px;
            width: auto;
            vertical-align: middle;
        }

        .sig-footer {
            color: #555555;
            font-size: 9.5px;
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
