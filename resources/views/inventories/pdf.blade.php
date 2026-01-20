<!DOCTYPE html>
<html>

<head>
    <title>Buku Inventaris - Koperasi Merah Putih</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header h2,
        .header h3 {
            margin: 0;
            text-transform: uppercase;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 9pt;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            margin-top: 30px;
            width: 100%;
        }

        .footer table {
            border: none;
        }

        .footer td {
            border: none;
            width: 50%;
        }

        .footer-sign {
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>KOPERASI MERAH PUTIH</h2>
        <h3>DESA SRANAK - BOJONEGORO</h3>
        <p>Alamat: Desa Sranak, Kec. Trucuk, Kab. Bojonegoro, Jawa Timur</p>
        <hr style="margin-top: 10px;">
        <h3 style="margin-top: 10px;">BUKU INVENTARIS BARANG</h3>
    </div>

    <table>
        <thead>
            <tr>
                <th width="30">No</th>
                <th>Nama Barang</th>
                <th width="80">Tanggal</th>
                <th width="80">Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total Harga</th>
                <th width="60">Umur (T/E)</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inventories as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                    <td class="text-center">{{ $item->jumlah }}</td>
                    <td class="text-right">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($item->jumlah_rupiah, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $item->umur_teknis }}/{{ $item->umur_ekonomis }}</td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" class="text-right">TOTAL KESELURUHAN</th>
                <th class="text-right">Rp {{ number_format($inventories->sum('jumlah_rupiah'), 0, ',', '.') }}</th>
                <th colspan="2"></th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <table style="width: 100%;">
            <tr>
                <td class="text-center">
                    Mengetahui,<br>
                    Ketua Koperasi<br><br><br><br>
                    ( ................................ )
                </td>
                <td class="text-center">
                    Sranak, {{ date('d F Y') }}<br>
                    Sekretaris/Bendahara<br><br><br><br>
                    ( ................................ )
                </td>
            </tr>
        </table>
    </div>
</body>

</html>