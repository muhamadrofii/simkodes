<!DOCTYPE html>
<html lang="id">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Penerima Subsidi - {{ $programName }}</title>
    
    <style type="text/css">
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #333333;
            line-height: 1.4;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table, th, td {
            border: 1px solid #bbbbbb;
        }

        th {
            background-color: #1e293b;
            color: #ffffff;
            font-weight: bold;
            text-align: center;
            padding: 6px 8px;
        }

        td {
            padding: 6px 8px;
            vertical-align: top;
        }

        .text-center {
            text-align: center;
        }

        .font-mono {
            font-family: monospace;
            font-size: 11px;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .header h2 {
            margin: 0 0 5px 0;
            font-size: 16px;
            color: #111111;
            text-transform: uppercase;
        }

        .header h3 {
            margin: 0 0 5px 0;
            font-size: 13px;
            color: #475569;
        }

        .header p {
            margin: 0;
            font-size: 11px;
            color: #64748b;
        }

        hr {
            border: 0;
            border-top: 2px solid #0f172a;
            margin-top: 5px;
            margin-bottom: 15px;
        }

        .footer {
            margin-top: 35px;
            text-align: right;
            font-size: 11px;
            color: #334155;
        }
    </style>
</head>

<body>
    {{-- Header / Kop Surat Laporan --}}
    <div class="header">
        <h2>Laporan Penerima Manfaat Program Subsidi</h2>
        <h3>Sistem Informasi Manajemen Koperasi Desa Sranak (SIMKODES)</h3>
        <p>Program: {{ $programName }} | Tanggal Cetak: {{ date('d/m/Y H:i') }}</p>
    </div>

    <hr>

    {{-- Tabel Tampil Data --}}
    <table>
        <thead>
            <tr>
                <th width="30">No</th>
                <th width="110">NIK Penerima</th>
                <th width="110">No. KK</th>
                <th>Nama Lengkap</th>
                <th>Program Subsidi</th>
                <th width="50">Tahun</th>
                <th width="80">Periode</th>
                <th>Keterangan</th>
                <th width="100">Tanggal Ambil</th>
                <th width="80">Status</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @forelse ($claims as $claim)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td class="font-mono text-center">{{ $claim->nik }}</td>
                    <td class="font-mono text-center">{{ $claim->no_kk }}</td>
                    <td><strong>{{ $claim->nama }}</strong></td>
                    <td>{{ $claim->program->nama ?? '-' }}</td>
                    <td class="text-center">{{ $claim->program->tahun ?? '-' }}</td>
                    <td>{{ $claim->program->periode ?? '-' }}</td>
                    <td>{{ $claim->keterangan ?? '-' }}</td>
                    <td class="text-center">{{ !empty($claim->periode) ? \Carbon\Carbon::parse($claim->periode)->format('d/m/Y H:i') : '-' }}</td>
                    <td class="text-center">{{ !empty($claim->periode) ? 'Sudah Diklaim' : 'Belum Diklaim' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center" style="padding: 20px; color: #64748b;">
                        Tidak ada data penerima subsidi yang ditemukan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Desa Sranak, {{ date('d F Y') }}<br>
        <br>
        <br>
        <br>
        <strong>Administrator SIMKODES</strong>
    </div>
</body>

</html>
