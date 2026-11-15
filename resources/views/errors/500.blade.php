<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Terjadi Kendala pada Sistem (500) | SIMKODES - Koperasi Desa Sranak</title>

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
    <div class="glow-orb-1 glow-orb-danger"></div>
    <div class="glow-orb-2"></div>

    <div class="error-card">
        {{-- Icon --}}
        <div class="icon-container icon-danger">
            <i class="ti ti-alert-triangle"></i>
        </div>

        {{-- Status Badge --}}
        <div>
            <span class="status-badge status-badge-danger">
                500 &bull; KENDALA SERVER INTERNAL
            </span>
        </div>

        {{-- Titles --}}
        <h1 class="title">Terjadi Kendala pada Sistem</h1>
        <div class="subtitle">Koperasi Merah Putih — Desa Sranak</div>

        {{-- Description --}}
        <p class="description">
            Terjadi kendala teknis internal pada server saat memproses permintaan Anda. Tim teknis kami telah mencatat peristiwa ini untuk segera diselesaikan.
        </p>

        {{-- Actions --}}
        <div class="d-flex flex-column flex-sm-row gap-2">
            <button type="button" class="btn-action w-100" onclick="window.location.reload()">
                <i class="ti ti-rotate-clockwise fs-5"></i>
                <span>Muat Ulang</span>
            </button>
            <a href="/" class="btn-action btn-secondary-custom w-100">
                <i class="ti ti-home fs-5"></i>
                <span>Beranda</span>
            </a>
        </div>

        {{-- Footer --}}
        <div class="footer-note">
            SIMKODES &bull; PKM UNUGIRI {{ date('Y') }}
        </div>
    </div>
</body>

</html>
