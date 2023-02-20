<!DOCTYPE html>
<html>
<head>
    <title>Struk Pembayaran</title>
    <style>
        /* CSS untuk struk pembayaran */
        .container {
            margin: auto;
            width: 350px;
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        td {
            border-bottom: 1px solid #ddd;
        }

        .total {
            text-align: right;
        }

        .signature {
            margin-top: 30px;
            text-align: center;
        }

        .signature p {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Struk Pembayaran</h1>
    <table>
        <tr>
            <th colspan="2">Kode Booking</th>
            <td>{{ $kodeBooking }}</td>
        </tr>
        <tr>
            <th colspan="2">Kos</th>
            <td>{{ $namaKos }}</td>
        </tr>
        <tr>
            <th colspan="2"></th>
            <td>{{ $alamatKos }}</td>
        </tr>
        <tr>
            <th colspan="2">Penyewa</th>
            <td>{{ $namaPenyewa }}</td>
        </tr>
        <tr>
            <th colspan="2">Penyewa Tambahan</th>
            <td>
                @if(count($penyewaTambahan) > 0)
                    @foreach($penyewaTambahan as $pt)
                        <p>{{ $pt->nama }}, KTP: {{ $pt->ktp }}</p>
                    @endforeach
                @else
                    -
                @endif
            </td>
        </tr>
        <tr>
            <th colspan="2">Tanggal Mulai</th>
            <td>{{ date('d/m/Y', strtotime($tanggalMulai)) }}</td>
        </tr>
        <tr>
            <th colspan="2">Tanggal Selesai</th>
            <td>{{ date('d/m/Y', strtotime($tanggalSelesai)) }}</td>
        </tr>
        <tr>
            <th colspan="2">Durasi</th>
            <td>{{ $durasi }} Bulan</td>
        </tr>
        <tr>
            <th colspan="2">Total Biaya</th>
            <td class="total">{{ $totalBiaya }}</td>
        </tr>
    </table>
    <div class="signature">
        <p>_________________________</p>
        <p>MJKOS</p>
    </div>
</div>
</body>
</html>
