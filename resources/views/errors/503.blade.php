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

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', system-ui, -apple-system, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #001f3f 0%, #00152c 50%, #000c1d 100%);
            color: #ffffff;
            position: relative;
            overflow-x: hidden;
            padding: 20px;
        }

        /* Ambient glowing background orbs */
        .glow-orb-1 {
            position: absolute;
            width: 450px;
            height: 450px;
            top: -120px;
            left: -100px;
            background: #0d6efd;
            filter: blur(100px);
            opacity: 0.15;
            pointer-events: none;
            border-radius: 50%;
        }

        .glow-orb-2 {
            position: absolute;
            width: 350px;
            height: 350px;
            bottom: -80px;
            right: -80px;
            background: #f0a500;
            filter: blur(90px);
            opacity: 0.12;
            pointer-events: none;
            border-radius: 50%;
        }

        /* Card Container */
        .maintenance-card {
            background: rgba(255, 255, 255, 0.98);
            color: #1e293b;
            border-radius: 24px;
            padding: 40px 30px;
            max-width: 520px;
            width: 100%;
            text-align: center;
            box-shadow: 0 25px 60px rgba(0, 15, 35, 0.45);
            border: 1px solid rgba(255, 255, 255, 0.8);
            position: relative;
            z-index: 10;
        }

        @media (min-width: 576px) {
            .maintenance-card {
                padding: 50px 40px;
            }
        }

        /* Animated Icon Container */
        .icon-container {
            width: 96px;
            height: 96px;
            border-radius: 28px;
            background: linear-gradient(135deg, #001f3f 0%, #003366 100%);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            box-shadow: 0 12px 28px rgba(0, 31, 63, 0.25);
            position: relative;
        }

        .gear-rotate {
            animation: spin 8s linear infinite;
            color: #f0a500;
            font-size: 3rem;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        /* Pulse Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(240, 165, 0, 0.12);
            color: #b45309;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 18px;
            letter-spacing: 0.3px;
        }

        .pulse-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #f59e0b;
            box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7);
            animation: pulse-animation 2s infinite;
        }

        @keyframes pulse-animation {
            0% {
                box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7);
            }
            70% {
                box-shadow: 0 0 0 8px rgba(245, 158, 11, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(245, 158, 11, 0);
            }
        }

        /* Typography */
        .title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #001f3f;
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .subtitle {
            font-size: 0.85rem;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 18px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .description {
            font-size: 0.92rem;
            color: #475569;
            line-height: 1.6;
            margin-bottom: 28px;
        }

        /* Action Button */
        .btn-reload {
            background: linear-gradient(135deg, #001f3f 0%, #003366 100%);
            color: #ffffff;
            border: none;
            padding: 12px 28px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            box-shadow: 0 6px 18px rgba(0, 31, 63, 0.2);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-reload:hover {
            background: linear-gradient(135deg, #003366 0%, #004488 100%);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 31, 63, 0.3);
        }

        .btn-reload:active {
            transform: translateY(0);
        }

        /* Timer Info */
        .auto-refresh-text {
            font-size: 0.78rem;
            color: #94a3b8;
            margin-top: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .footer-note {
            font-size: 0.75rem;
            color: #94a3b8;
            margin-top: 24px;
            border-top: 1px solid #f1f5f9;
            padding-top: 16px;
        }
    </style>
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
            <span class="status-badge">
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

