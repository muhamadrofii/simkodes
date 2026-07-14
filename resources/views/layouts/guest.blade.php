{{-- Layout Login/Register Tanpa Sidebar & Navbar --}}
<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Meta & Title --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Aplikasi Pengelolaan Data Member">
    <meta name="author" content="Indra Styawantoro">
    <title>{{ $title ?? 'SIMKODES | Sistem Informasi Managemen Koperasi Desa Sranak' }}</title>

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('images/logokop.svg') }}" type="image/x-icon">

    {{-- Bootstrap, Icons, Fonts, CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="d-flex align-items-center justify-content-center min-vh-100 position-relative" style="background: linear-gradient(135deg, #001f3f 0%, #00152c 50%, #000c1d 100%); overflow-x: hidden;">
    {{-- Glowing background circles --}}
    <div class="position-absolute rounded-circle opacity-10" style="width: 400px; height: 400px; top: -100px; left: -100px; background: #0d6efd; filter: blur(80px); pointer-events: none; z-index: 1;"></div>
    <div class="position-absolute rounded-circle opacity-10" style="width: 300px; height: 300px; bottom: -50px; right: -50px; background: #f0a500; filter: blur(60px); pointer-events: none; z-index: 1;"></div>

    <main class="w-100 py-4 px-3 position-relative" style="max-width: 500px; z-index: 10;">
        {{ $slot }}
    </main>

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/flatpickr.js') }}"></script>
    <script src="{{ asset('js/image-preview.js') }}"></script>

    <script>
        @if (session('success'))
            Swal.fire({
                icon: "success",
                title: "Berhasil!",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif (session('error'))
            Swal.fire({
                icon: "error",
                title: "Gagal!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
</body>

</html>
