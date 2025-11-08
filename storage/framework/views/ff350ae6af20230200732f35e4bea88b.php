
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Aplikasi Pengelolaan Data Member">
    <meta name="author" content="Indra Styawantoro">
    <title><?php echo e($title ?? 'Aplikasi Pengelolaan Data Member'); ?></title>

    
    <link rel="shortcut icon" href="<?php echo e(asset('images/logokop.svg')); ?>" type="image/x-icon">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
</head>
<body class="bg-light">

    <main class="container my-5">
        <?php echo e($slot); ?>

    </main>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo e(asset('js/flatpickr.js')); ?>"></script>
    <script src="<?php echo e(asset('js/image-preview.js')); ?>"></script>

    <script>
        <?php if(session('success')): ?>
            Swal.fire({
                icon: "success",
                title: "Berhasil!",
                text: "<?php echo e(session('success')); ?>",
                showConfirmButton: false,
                timer: 2000
            });
        <?php elseif(session('error')): ?>
            Swal.fire({
                icon: "error",
                title: "Gagal!",
                text: "<?php echo e(session('error')); ?>",
                showConfirmButton: false,
                timer: 2000
            });
        <?php endif; ?>
    </script>
</body>
</html>
<?php /**PATH C:\3.BUWONO\Dokumen\kuliah\SEMESTER 7\KKN\proker\aplikasi-pengelolaan-data-member\aplikasi-pengelolaan-data-member\resources\views/layouts/guest.blade.php ENDPATH**/ ?>