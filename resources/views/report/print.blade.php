<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Required meta tags --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {{-- Title --}}
    <title>Data Anggota Per {{ date('F j, Y', strtotime(request('start_date'))) }} - {{ date('F j, Y', strtotime(request('end_date'))) }}</title>
    
    {{-- custom style --}}
    <style type="text/css">
        table, th, td {
            border: 1px solid #dee2e6;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px 5px;
        }

        hr {
            color: #dee2e6;
        }
    </style>
</head>

<body>
    {{-- judul laporan --}}
    <div style="text-align: center">
        <h3>Data Anggota Per {{ date('F j, Y', strtotime(request('start_date'))) }} - {{ date('F j, Y', strtotime(request('end_date'))) }}.</h3>
    </div>

    <hr style="margin-bottom:20px">

    {{-- tabel tampil data --}}
    <table style="width:100%">
        <thead style="background-color: #6861ce; color: #ffffff">
            <th>No.</th>
            <th>Kategori</th>
            <th>Tanggal Bergabung</th>
            <th>Nama Lengkap</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Email</th>
            <th>Nomor Telepon</th>
        </thead>
        <tbody>
        @php
            $no = 1;
        @endphp
        @forelse ($members as $member)
            {{-- jika data ada, tampilkan data --}}
            <tr>
                <td width="30" align="center">{{ $no++ }}</td>
                <td width="60" align="center">{{ $member->category->name }}</td>
                <td width="90" align="center">{{ date('F j, Y', strtotime($member->join_date)) }}</td>
                <td width="90">{{ $member->full_name }}</td>
                <td width="60" align="center">{{ $member->gender }}</td>
                <td width="150">{{ $member->address }}</td>
                <td width="60">{{ $member->email }}</td>
                <td width="70" align="center">{{ $member->phone_number }}</td>
            </tr>
        @empty
            {{-- jika data tidak ada, tampilkan pesan data tidak tersedia --}}
            <tr>
                <td colspan="8">Tidak Ada Data.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div style="margin-top: 25px; text-align: right">Bandar Lampung, {{ date('F j, Y') }}</div>
</body>

</html>
