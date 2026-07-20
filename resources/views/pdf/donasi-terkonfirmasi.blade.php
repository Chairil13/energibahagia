<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Donasi Terkonfirmasi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            padding: 10px 15px;
            font-size: 8px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #8AD337;
            padding-bottom: 8px;
            margin-bottom: 10px;
        }

        .header h1 {
            color: #183D57;
            font-size: 16px;
        }

        .header p {
            color: #666;
            font-size: 9px;
        }

        .info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            background: #f8faf8;
            padding: 6px 12px;
            border-radius: 4px;
        }

        .info-item {
            font-size: 8px;
        }

        .info-item .label {
            color: #999;
            font-weight: 600;
        }

        .info-item .value {
            font-weight: 700;
            color: #183D57;
            font-size: 9px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 7px;
        }

        table th {
            background: #8AD337;
            color: #183D57;
            font-weight: 700;
            padding: 4px 4px;
            text-align: left;
            border: 1px solid #183D57;
            font-size: 7px;
            white-space: nowrap;
        }

        table td {
            padding: 3px 4px;
            border: 1px solid #ddd;
            font-size: 7px;
            white-space: nowrap;
        }

        table tr:nth-child(even) {
            background: #f8faf8;
        }

        .footer {
            margin-top: 10px;
            padding-top: 8px;
            border-top: 2px solid #8AD337;
            text-align: center;
            font-size: 7px;
            color: #999;
        }

        .total-row {
            background: #183D57 !important;
            color: white;
            font-weight: 700;
        }

        .total-row td {
            color: white !important;
            border-color: #183D57;
            font-size: 8px;
        }

        /* Ukuran kolom lebih kecil */
        .col-no {
            width: 20px;
        }

        .col-kode {
            width: 80px;
        }

        .col-nama {
            width: 100px;
        }

        .col-program {
            width: 100px;
        }

        .col-nominal {
            width: 70px;
        }

        .col-bank {
            width: 70px;
        }

        .col-tanggal {
            width: 80px;
        }

        .col-admin {
            width: 70px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>🌟 LAPORAN DONASI TERKONFIRMASI</h1>
        <p>Energi Bahagia - Lembaga Amil Zakat Nasional</p>
    </div>

    <div class="info">
        <div class="info-item">
            <span class="label">Program</span><br>
            <span class="value">{{ $programName }}</span>
        </div>
        <div class="info-item">
            <span class="label">Donatur</span><br>
            <span class="value">{{ number_format($totalDonatur) }} org</span>
        </div>
        <div class="info-item">
            <span class="label">Total Nominal</span><br>
            <span class="value" style="color: #8AD337;">Rp {{ number_format($totalNominal, 0, ',', '.') }}</span>
        </div>
        <div class="info-item">
            <span class="label">Cetak</span><br>
            <span class="value">{{ $tanggal_cetak }}</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th class="col-no">No</th>
                <th class="col-kode">Kode Unik</th>
                <th class="col-nama">Nama Donatur</th>
                <th class="col-program">Program</th>
                <th class="col-nominal">Nominal</th>
                <th class="col-bank">Bank</th>
                <th class="col-tanggal">Dikonfirmasi</th>
                <th class="col-admin">Admin</th>
            </tr>
        </thead>
        <tbody>
            @forelse($donasis as $index => $donasi)
                <tr>
                    <td class="col-no">{{ $index + 1 }}</td>
                    <td class="col-kode">{{ $donasi->kode_unik }}</td>
                    <td class="col-nama">{{ $donasi->nama }}</td>
                    <td class="col-program">{{ Str::limit($donasi->program ? $donasi->program->judul : '-', 20) }}</td>
                    <td class="col-nominal" align="right">Rp {{ number_format($donasi->nominal, 0, ',', '.') }}</td>
                    <td class="col-bank">{{ $donasi->bank ? $donasi->bank->nama_bank : '-' }}</td>
                    <td class="col-tanggal">
                        {{ $donasi->confirmed_at ? $donasi->confirmed_at->format('d/m/Y H:i') : '-' }}</td>
                    <td class="col-admin">{{ $donasi->confirmedBy ? Str::limit($donasi->confirmedBy->name, 15) : '-' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" align="center">Tidak ada data donasi terkonfirmasi</td>
                </tr>
            @endforelse
            @if ($donasis->count() > 0)
                <tr class="total-row">
                    <td colspan="4" align="right"><strong>TOTAL</strong></td>
                    <td align="right"><strong>Rp {{ number_format($totalNominal, 0, ',', '.') }}</strong></td>
                    <td colspan="3"></td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak dari sistem Energi Bahagia © {{ date('Y') }} - Lembaga Amil Zakat Nasional</p>
    </div>
</body>

</html>
