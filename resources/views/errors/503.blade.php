<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="refresh" content="30">
    <title>Sedang Dalam Pemeliharaan | SIMKODES - Koperasi Desa Sranak</title>

    {{-- Favicon --}}
    <link rel="shortcut icon" href="/images/logokop.svg" type="image/x-icon">

    {{-- Google Fonts & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    {{-- Error Pages CSS --}}
    <link rel="stylesheet" href="/css/errors.css">
</head>

<body>
    {{-- Ambient glowing background circles --}}
    <div class="glow-orb-1"></div>
    <div class="glow-orb-2"></div>

    <div class="maintenance-card">
        {{-- Animated Icon --}}
        <div class="icon-container">
            <i class="ti ti-settings gear-rotate"></i>
        </div>

        {{-- Status Pill --}}
        <div>
            <span class="status-badge status-badge-warning">
                <span class="pulse-dot"></span>
                PEMELIHARAAN SISTEM
            </span>
        </div>

        {{-- Header Titles --}}
        <h1 class="title">Sistem Sedang Ditingkatkan</h1>
        <div class="subtitle">Koperasi Merah Putih — Desa Sranak</div>

        {{-- Description --}}
        <p class="description">
            Kami sedang melakukan pembaruan rutin dan peningkatan performa sistem SIMKODES untuk memberikan layanan yang lebih aman, cepat, dan handal. Layanan akan segera kembali aktif.
        </p>

        {{-- Action Button --}}
        <button type="button" class="btn-reload" onclick="reloadPage()">
            <i class="ti ti-rotate-clockwise fs-5"></i>
            <span>Muat Ulang Halaman</span>
        </button>

        {{-- Auto refresh countdown --}}
        <div class="auto-refresh-text">
            <i class="ti ti-clock"></i>
            <span>Halaman akan memuat ulang otomatis dalam <strong id="countdown">30</strong> detik</span>
        </div>

        {{-- Footer --}}
        <div class="footer-note">
            SIMKODES &bull; PKM UNUGIRI {{ date('Y') }}
        </div>
    </div>

    <script>
        let timeLeft = 30;
        const countdownEl = document.getElementById('countdown');

        const timer = setInterval(function() {
            timeLeft--;
            if (countdownEl) {
                countdownEl.textContent = timeLeft;
            }
            if (timeLeft <= 0) {
                clearInterval(timer);
                window.location.reload();
            }
        }, 1000);

        function reloadPage() {
            window.location.reload();
        }
    </script>
</body>

</html>
