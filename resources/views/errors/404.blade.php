<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Tidak Ditemukan (404) | SIMKODES - Koperasi Desa Sranak</title>

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

        .error-card {
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
            .error-card {
                padding: 50px 40px;
            }
        }

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
            color: #f0a500;
            font-size: 3rem;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(13, 110, 253, 0.12);
            color: #0d6efd;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 18px;
            letter-spacing: 0.3px;
        }

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

        .btn-action {
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

        .btn-action:hover {
            background: linear-gradient(135deg, #003366 0%, #004488 100%);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 31, 63, 0.3);
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
    <div class="glow-orb-1"></div>
    <div class="glow-orb-2"></div>

    <div class="error-card">
        <div class="icon-container">
            <i class="ti ti-map-pin-off"></i>
        </div>

        <div>
            <span class="status-badge">
                404 &bull; HALAMAN TIDAK DITEMUKAN
            </span>
        </div>

        <h1 class="title">Halaman Tidak Ditemukan</h1>
        <div class="subtitle">Koperasi Merah Putih — Desa Sranak</div>

        <p class="description">
            Maaf, halaman atau tautan yang Anda tuju tidak tersedia atau telah dipindahkan ke alamat baru. Silakan kembali ke beranda.
        </p>

        <a href="/" class="btn-action">
            <i class="ti ti-home fs-5"></i>
            <span>Kembali ke Beranda</span>
        </a>

        <div class="footer-note">
            SIMKODES &bull; PKM UNUGIRI {{ date('Y') }}
        </div>
    </div>
</body>

</html>

