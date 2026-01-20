<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>KTA Premium</title>
    <style>
        @page {
            size: A5 landscape;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #ffffff;
        }

        .container {
            width: 100%;
            height: 100%;
        }

        /* Bagian Atas Merah */
        .header-bg {
            background-color: #b71c1c;
            background: linear-gradient(135deg, #d32f2f 0%, #b71c1c 50%, #8b0000 100%);
            border-bottom: 6px solid #ffc107;
            padding: 15px 30px;
            color: #ffffff;
            height: 130px;
        }

        .title-main {
            font-size: 28px;
            font-weight: 900;
            margin: 0;
            text-transform: uppercase;
        }

        .title-sub {
            font-size: 16px;
            font-weight: bold;
            margin: 3px 0;
        }

        .title-addr {
            font-size: 11px;
            margin: 0;
        }

        .motto {
            font-size: 13px;
            font-style: italic;
            color: #ffca28;
            font-weight: bold;
            margin-top: 5px;
        }

        /* Bagian Konten */
        .content-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .content-area {
            padding: 30px 45px;
            vertical-align: top;
        }

        .name-tag {
            font-size: 26px;
            font-weight: bold;
            color: #b71c1c;
            border-bottom: 3px solid #b71c1c;
            display: inline-block;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .data-table td {
            padding: 7px 0;
            font-size: 14px;
            vertical-align: top;
        }

        .label {
            color: #555;
            width: 150px;
        }

        .value {
            font-weight: bold;
            color: #000;
        }

        /* Foto Area */
        .photo-column {
            width: 200px;
            padding: 30px 45px 30px 0;
            vertical-align: top;
            text-align: right;
        }

        .photo-frame {
            width: 145px;
            height: 185px;
            border: 4px solid #fff;
            background-color: #eeeeee;
            display: inline-block;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        /* Footer Area */
        .footer-cell {
            padding: 10px 45px;
            border-top: 1px solid #dddddd;
            font-size: 10px;
            color: #888888;
        }
    </style>
</head>

<body>
    <table class="container" border="0" cellspacing="0" cellpadding="0">
        <!-- BARIS HEADER -->
        <tr>
            <td colspan="2" class="header-bg">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="90" align="left">
                            <img src="{{ $logoMerah }}" width="75">
                        </td>
                        <td align="center" style="color: #ffffff;">
                            <div class="title-main">KARTU ANGGOTA</div>
                            <div class="title-sub">KOPERASI MERAH PUTIH DESA SRANAK</div>
                            <div class="title-addr">KECAMATAN TRUCUK, BOJONEGORO, JAWA TIMUR</div>
                            <div class="motto">"Merah Putih, Mandiri dan Sejahtera"</div>
                        </td>
                        <td width="90" align="right">
                            <img src="{{ $logoSim }}" width="75">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- BARIS KONTEN (NAMA & DATA) -->
        <tr>
            <td class="content-area">
                <div class="name-tag">{{ strtoupper($member->nama) }}</div>
                <table class="data-table" width="100%">
                    <tr>
                        <td class="label">ID ANGGOTA</td>
                        <td class="value">MP-{{ str_pad($member->id, 5, '0', STR_PAD_LEFT) }}</td>
                    </tr>
                    <tr>
                        <td class="label">JENIS KELAMIN</td>
                        <td class="value">{{ $member->jenis_kelamin == 'L' ? 'LAKI-LAKI' : 'PEREMPUAN' }}</td>
                    </tr>
                    <tr>
                        <td class="label">ALAMAT</td>
                        <td class="value">{{ strtoupper($member->tempat_tinggal ?? '-') }}</td>
                    </tr>
                    <tr>
                        <td class="label">TANGGAL BERGABUNG</td>
                        <td class="value">
                            {{ $member->tanggal_masuk ? date('d-m-Y', strtotime($member->tanggal_masuk)) : '-' }}</td>
                    </tr>
                </table>
            </td>
            <td class="photo-column">
                <div class="photo-frame">
                    @if ($photoBase64)
                        <img src="{{ $photoBase64 }}" width="100%" height="100%">
                    @else
                        <div style="text-align: center; padding-top: 80px; color: #ccc;">FOTO</div>
                    @endif
                </div>
            </td>
        </tr>

        <!-- BARIS FOOTER -->
        <tr>
            <td colspan="2" class="footer-cell">
                Kartu ini merupakan identitas resmi Anggota Koperasi Merah Putih Desa Sranak. Segala hak dan kewajiban
                diatur dalam AD/ART Koperasi.
            </td>
        </tr>
    </table>
</body>

</html>