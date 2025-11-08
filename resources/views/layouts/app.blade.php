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
    <title>Pencatatan Anggota Koperasi</title>

    {{-- Favicon icon --}}
    <link rel="shortcut icon" href="{{ asset('images/logokop.svg') }}" type="image/x-icon">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    {{-- Tabler Icons CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    {{-- Flatpickr CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css" integrity="sha256-RXPAyxHVyMLxb0TYCM2OW5R4GWkcDe02jdYgyZp41OU=" crossorigin="anonymous">

    {{-- Template CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    {{-- Flatpickr JS --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js" integrity="sha256-AkQap91tDcS4YyQaZY2VV34UhSCxu2bDEIgXXXuf5Hg=" crossorigin="anonymous"></script>
    {{-- Sweetalert2 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Custom Scripts --}}
    <script src="{{ asset('js/flatpickr.js') }}"></script>
    <script src="{{ asset('js/image-preview.js') }}"></script>

    <script>
        // menampilkan pesan dengan sweetalert
        @if (session('success'))
            Swal.fire({
                icon: "success",
                title: "Success!",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif (session('error'))
            Swal.fire({
                icon: "error",
                title: "Failed!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
</body>

</html>