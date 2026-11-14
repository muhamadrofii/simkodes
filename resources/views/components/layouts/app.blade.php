<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Required meta tags --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Aplikasi Pengelolaan Data Member">
    <meta name="author" content="SIMKODES">

    {{-- Title --}}
    <title>SIMKODES | Sistem Informasi Managemen Koperasi Desa Sranak</title>

    {{-- Favicon icon --}}
    <link rel="shortcut icon" href="{{ asset('images/logokop.svg') }}" type="image/x-icon">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    {{-- Tabler Icons CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    {{-- Flatpickr CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css"
        integrity="sha256-RXPAyxHVyMLxb0TYCM2OW5R4GWkcDe02jdYgyZp41OU=" crossorigin="anonymous">

    {{-- Template CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- Hotwire Turbo --}}
    <script src="https://cdn.jsdelivr.net/npm/@hotwired/turbo@7.3.0/dist/turbo.es2017-umd.js" defer></script>
</head>

<body>
    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Main Content --}}
    <main class="content-wrapper d-block">
        <div class="container">

            {{-- menampilkan konten sesuai halaman yang dipilih --}}
            {{ $slot }}

        </div>
    </main>

    {{-- Bottom Navbar --}}
    @include('layouts.navbar')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    {{-- Flatpickr JS --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js"
        integrity="sha256-AkQap91tDcS4YyQaZY2VV34UhSCxu2bDEIgXXXuf5Hg=" crossorigin="anonymous"></script>
    {{-- Sweetalert2 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Custom Scripts --}}
    <script src="{{ asset('js/flatpickr.js') }}"></script>
    <script src="{{ asset('js/image-preview.js') }}"></script>

    <script>
        // menampilkan pesan notifikasi dengan SweetAlert2 Modal
        function triggerAppAlerts() {
            @if (session('success'))
                Swal.fire({
                    icon: "success",
                    title: "Berhasil!",
                    text: {!! json_encode(session('success')) !!},
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true
                });
            @elseif (session('error'))
                Swal.fire({
                    icon: "error",
                    title: "Terjadi Kesalahan",
                    html: `<div class="text-dark fw-medium mt-1">{!! addslashes(session('error')) !!}</div>`,
                    confirmButtonText: "Tutup",
                    confirmButtonColor: "#001f3f",
                    showConfirmButton: true,
                    allowOutsideClick: true,
                    customClass: {
                        popup: 'rounded-4 shadow-lg border-0',
                        confirmButton: 'btn btn-primary px-4 py-2 rounded-3 fw-bold'
                    }
                });
            @elseif (session('warning'))
                Swal.fire({
                    icon: "warning",
                    title: "Peringatan",
                    html: `<div class="text-dark fw-medium mt-1">{!! addslashes(session('warning')) !!}</div>`,
                    confirmButtonText: "Mengerti",
                    confirmButtonColor: "#001f3f",
                    showConfirmButton: true
                });
            @elseif (session('import_errors'))
                Swal.fire({
                    icon: "warning",
                    title: "Perhatian: Hasil Import Data",
                    html: `
                        <div class="text-start small mt-2">
                            <p class="mb-2 text-muted">Beberapa baris data dilewati saat import:</p>
                            <div style="max-height: 200px; overflow-y: auto;">
                                <ul class="mb-0 text-danger ps-3">
                                    @foreach (session('import_errors') as $err)
                                        <li>{{ $err }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    `,
                    confirmButtonText: "Tutup",
                    confirmButtonColor: "#001f3f",
                    showConfirmButton: true
                });
            @elseif ($errors->any())
                Swal.fire({
                    icon: "error",
                    title: "Validasi Form Gagal",
                    html: `
                        <div class="text-start small mt-2">
                            <p class="mb-2 text-muted">Periksa kembali data yang belum sesuai:</p>
                            <ul class="mb-0 text-danger ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    `,
                    confirmButtonText: "Perbaiki Data",
                    confirmButtonColor: "#001f3f",
                    showConfirmButton: true,
                    customClass: {
                        popup: 'rounded-4 shadow-lg border-0',
                        confirmButton: 'btn btn-primary px-4 py-2 rounded-3 fw-bold'
                    }
                });
            @endif
        }

        document.addEventListener('turbo:load', triggerAppAlerts);
        document.addEventListener('DOMContentLoaded', triggerAppAlerts);

        // Sidebar Toggle
        document.addEventListener('turbo:load', function() {
            const toggleBtn = document.getElementById('sidebarToggle');
            const toggleBtnInternal = document.getElementById('sidebarToggleInternal');
            const body = document.body;

            const toggleSidebar = function(e) {
                e.stopPropagation();
                body.classList.toggle('sidebar-toggled');
            };

            if (toggleBtn) {
                toggleBtn.addEventListener('click', toggleSidebar);
            }
            if (toggleBtnInternal) {
                toggleBtnInternal.addEventListener('click', toggleSidebar);
            }

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (body.classList.contains('sidebar-toggled') && window.innerWidth < 768) {
                    const sidebar = document.querySelector('.sidebar-new');
                    const isClickInsideSidebar = sidebar && sidebar.contains(event.target);
                    const isClickToggleBtn = toggleBtn && (event.target === toggleBtn || toggleBtn.contains(event.target));
                    const isClickInternalToggleBtn = toggleBtnInternal && (event.target === toggleBtnInternal || toggleBtnInternal.contains(event.target));
                    
                    if (!isClickInsideSidebar && !isClickToggleBtn && !isClickInternalToggleBtn) {
                        body.classList.remove('sidebar-toggled');
                    }
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
