<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SIMKODES – Sistem Informasi Managemen Koperasi Desa Sranak. Solusi digital terpadu untuk pengelolaan koperasi yang modern, aman, dan transparan.">
    <title>SIMKODES | Koperasi Merah Putih – Desa Sranak</title>

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('images/logokop.svg') }}" type="image/x-icon">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">

    {{-- Tabler Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />

    {{-- Google Font: Poppins (sinkron dengan app) --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Landing Page CSS --}}
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>

<body>

    {{-- ======== NAVBAR ======== --}}
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="landingNav">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <img src="{{ asset('images/logokop.svg') }}" alt="Logo" width="42" height="42">
                <span class="fw-bold fs-5">SIMKODES</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto me-3 gap-1">
                    <li class="nav-item"><a class="nav-link" href="#hero">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#fitur">Fitur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                </ul>
                <div class="d-flex">
                    <a href="{{ route('login') }}" class="btn btn-accent btn-sm px-4">Masuk</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- ======== HERO ======== --}}
    <section class="hero-section" id="hero">
        {{-- Animated background shapes --}}
        <div class="hero-bg-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>

        <div class="container position-relative">
            <div class="row align-items-center min-vh-100 pt-5">
                <div class="col-lg-6 text-white">
                    <span class="badge badge-glow mb-3">Koperasi Desa Sranak</span>
                    <h1 class="hero-title">
                        Kelola Koperasi Anda Secara
                        <span class="text-gradient">Digital & Modern</span>
                    </h1>
                    <p class="hero-desc mt-3 mb-4">
                        SIMKODES hadir sebagai solusi manajemen koperasi terpadu — mulai dari data anggota,
                        surat menyurat, inventaris, hingga laporan keuangan. Semua dalam satu platform.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('login') }}" class="btn btn-accent btn-lg px-4">
                            <i class="ti ti-login me-1"></i> Masuk Sekarang
                        </a>
                        <a href="#fitur" class="btn btn-outline-light btn-lg px-4">
                            <i class="ti ti-arrow-down me-1"></i> Pelajari Fitur
                        </a>
                    </div>

                    {{-- Stats --}}
                    <div class="row mt-5 pt-3 hero-stats">
                        <div class="col-4">
                            <h3 class="fw-bold mb-0 counter" data-target="100">0+</h3>
                            <small class="text-white-50">Anggota</small>
                        </div>
                        <div class="col-4">
                            <h3 class="fw-bold mb-0 counter" data-target="500">0+</h3>
                            <small class="text-white-50">Surat Dikelola</small>
                        </div>
                        <div class="col-4">
                            <h3 class="fw-bold mb-0 counter" data-target="50">0+</h3>
                            <small class="text-white-50">Inventaris</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center mt-5 mt-lg-0">
                    <div class="hero-image-wrapper">
                        <img src="{{ asset('images/logokop.svg') }}" alt="Logo Koperasi Merah Putih"
                            class="hero-logo-img">
                        <div class="hero-glow"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ======== FITUR ======== --}}
    <section class="features-section" id="fitur">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge badge-glow mb-2">Fitur Unggulan</span>
                <h2 class="section-title">Semua yang Anda Butuhkan</h2>
                <p class="section-subtitle mx-auto">
                    Platform lengkap untuk mengelola seluruh operasional koperasi desa dengan efisien dan transparan.
                </p>
            </div>

            <div class="row g-4">
                {{-- Card 1 --}}
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="ti ti-users"></i>
                        </div>
                        <h5>Manajemen Anggota</h5>
                        <p>Kelola data anggota, pengurus, dan pengawas koperasi secara terpusat dengan fitur cetak KTA.</p>
                    </div>
                </div>
                {{-- Card 2 --}}
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="ti ti-mail"></i>
                        </div>
                        <h5>Surat Masuk & Keluar</h5>
                        <p>Arsip dan kelola surat masuk maupun keluar secara digital dengan kategorisasi rapi.</p>
                    </div>
                </div>
                {{-- Card 3 --}}
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="ti ti-archive"></i>
                        </div>
                        <h5>Inventaris Barang</h5>
                        <p>Pencatatan aset dan barang koperasi lengkap dengan laporan export PDF & Excel.</p>
                    </div>
                </div>
                {{-- Card 4 --}}
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="ti ti-report-analytics"></i>
                        </div>
                        <h5>Laporan & Analitik</h5>
                        <p>Generate laporan keuangan berdasarkan periode, cetak untuk audit dan rapat anggota.</p>
                    </div>
                </div>
                {{-- Card 5 --}}
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="ti ti-list-details"></i>
                        </div>
                        <h5>Kategori Terstruktur</h5>
                        <p>Organisasi data berdasarkan kategori yang fleksibel dan mudah dikustomisasi.</p>
                    </div>
                </div>
                {{-- Card 6 --}}
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="ti ti-shield-lock"></i>
                        </div>
                        <h5>Aman & Terpercaya</h5>
                        <p>Sistem login dan manajemen sesi untuk menjaga keamanan data koperasi Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ======== TENTANG ======== --}}
    <section class="about-section" id="tentang">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 text-center mb-4 mb-lg-0">
                    <div class="about-image-wrapper">
                        <img src="{{ asset('images/logokop.svg') }}" alt="Koperasi Merah Putih" class="about-logo">
                    </div>
                </div>
                <div class="col-lg-7">
                    <span class="badge badge-glow mb-2">Tentang Kami</span>
                    <h2 class="section-title">Koperasi Merah Putih</h2>
                    <p class="about-text">
                        Koperasi Merah Putih merupakan lembaga koperasi yang berdomisili di Desa Sranak.
                        Berdiri atas semangat gotong royong dan kebersamaan, kami berkomitmen untuk meningkatkan
                        kesejahteraan anggota melalui layanan simpan pinjam, inventarisasi, dan pengelolaan
                        administrasi yang modern.
                    </p>
                    <p class="about-text">
                        Dengan hadirnya <strong>SIMKODES</strong> (Sistem Informasi Managemen Koperasi Desa Sranak),
                        seluruh proses operasional kini dapat diakses secara digital — lebih cepat, lebih rapi,
                        dan lebih transparan.
                    </p>

                    <div class="row mt-4 g-3">
                        <div class="col-sm-6">
                            <div class="about-point">
                                <i class="ti ti-check"></i>
                                <span>Transparansi Keuangan</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="about-point">
                                <i class="ti ti-check"></i>
                                <span>Data Aman & Terenkripsi</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="about-point">
                                <i class="ti ti-check"></i>
                                <span>Akses Mudah dari Mana Saja</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="about-point">
                                <i class="ti ti-check"></i>
                                <span>Dukungan Pengabdian UNUGIRI</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ======== CTA ======== --}}
    <section class="cta-section">
        <div class="container text-center">
            <h2 class="cta-title">Siap Mengelola Koperasi Anda?</h2>
            <p class="cta-desc mx-auto">
                Bergabung sekarang dan nikmati kemudahan pengelolaan koperasi secara digital.
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap mt-4">
                <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5 fw-semibold">
                    <i class="ti ti-user-plus me-1"></i> Daftar Sekarang
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-5">
                    <i class="ti ti-login me-1"></i> Masuk
                </a>
            </div>
        </div>
    </section>

    {{-- ======== KONTAK / FOOTER ======== --}}
    <footer class="footer-section" id="kontak">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <img src="{{ asset('images/logokop.svg') }}" alt="Logo" width="40" height="40">
                        <h5 class="fw-bold mb-0 text-white">SIMKODES</h5>
                    </div>
                    <p class="footer-text">
                        Sistem Informasi Managemen Koperasi Desa Sranak — dibangun untuk mempermudah pengelolaan
                        koperasi secara digital.
                    </p>
                </div>
                <div class="col-lg-4">
                    <h6 class="footer-heading">Navigasi</h6>
                    <ul class="footer-links">
                        <li><a href="#hero">Beranda</a></li>
                        <li><a href="#fitur">Fitur</a></li>
                        <li><a href="#tentang">Tentang</a></li>
                        <li><a href="{{ route('login') }}">Masuk</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h6 class="footer-heading">Kontak</h6>
                    <ul class="footer-links">
                        <li><i class="ti ti-map-pin me-2"></i> Desa Sranak</li>
                        <li><i class="ti ti-mail me-2"></i> koperasi@desasranak.id</li>
                        <li><i class="ti ti-phone me-2"></i> (0234) 000-0000</li>
                    </ul>
                </div>
            </div>
            <hr class="footer-divider">
            <div class="text-center">
                <p class="footer-copyright">
                    &copy; {{ date('Y') }} Koperasi Merah Putih — Desa Sranak. Dikembangkan oleh
                    <strong>Pengabdian Kepada Masyarakat – UNUGIRI</strong>.
                </p>
            </div>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    {{-- Landing Page JS --}}
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function () {
            const nav = document.getElementById('landingNav');
            if (window.scrollY > 60) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // Counter animation
        const counters = document.querySelectorAll('.counter');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = +counter.getAttribute('data-target');
                    let count = 0;
                    const increment = target / 60;
                    const timer = setInterval(() => {
                        count += increment;
                        if (count >= target) {
                            counter.textContent = target + '+';
                            clearInterval(timer);
                        } else {
                            counter.textContent = Math.ceil(count) + '+';
                        }
                    }, 30);
                    observer.unobserve(counter);
                }
            });
        }, { threshold: 0.5 });
        counters.forEach(c => observer.observe(c));

        // Fade-in on scroll
        const fadeEls = document.querySelectorAll('.feature-card, .about-point');
        const fadeObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in-visible');
                    fadeObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        fadeEls.forEach(el => {
            el.classList.add('fade-in-element');
            fadeObserver.observe(el);
        });
    </script>
</body>

</html>
