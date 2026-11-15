<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Tidak Ditemukan (404) | SIMKODES - Koperasi Desa Sranak</title>

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('images/logokop.svg') }}" type="image/x-icon">

    {{-- Google Fonts & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    {{-- Error Pages CSS --}}
    <link rel="stylesheet" href="{{ asset('css/errors.css') }}">
</head>

<body>
    {{-- Ambient glowing background circles --}}
    <div class="glow-orb-1"></div>
    <div class="glow-orb-2"></div>

    <div class="error-card">
        {{-- Icon --}}
        <div class="icon-container icon-gold">
            <i class="ti ti-map-pin-off"></i>
        </div>

        {{-- Status Badge --}}
        <div>
            <span class="status-badge status-badge-primary">
                404 &bull; HALAMAN TIDAK DITEMUKAN
            </span>
        </div>

        {{-- Titles --}}
        <h1 class="title">Halaman Tidak Ditemukan</h1>
        <div class="subtitle">Koperasi Merah Putih — Desa Sranak</div>

        {{-- Description --}}
        <p class="description">
            Maaf, halaman atau tautan yang Anda tuju tidak tersedia atau telah dipindahkan ke alamat baru. Silakan kembali ke beranda.
        </p>

        {{-- Action Button --}}
        <a href="/" class="btn-action">
            <i class="ti ti-home fs-5"></i>
            <span>Kembali ke Beranda</span>
        </a>

        {{-- Footer --}}
        <div class="footer-note">
            SIMKODES &bull; PKM UNUGIRI {{ date('Y') }}
        </div>
    </div>
</body>

</html>
