<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Aplikasi Pengelolaan Data Member">
    <meta name="author" content="Indra Styawantoro">

    
    <title>Pencatatan Anggota Koperasi</title>

    
    <link rel="shortcut icon" href="<?php echo e(asset('images/logokop.svg')); ?>" type="image/x-icon">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css" integrity="sha256-RXPAyxHVyMLxb0TYCM2OW5R4GWkcDe02jdYgyZp41OU=" crossorigin="anonymous">

    
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
</head>

<body>
    
    <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <main class="content-wrapper d-block">
        <div class="container">

            
            <?php echo e($slot); ?>


        </div>
    </main>

    
    <?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js" integrity="sha256-AkQap91tDcS4YyQaZY2VV34UhSCxu2bDEIgXXXuf5Hg=" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
    <script src="<?php echo e(asset('js/flatpickr.js')); ?>"></script>
    <script src="<?php echo e(asset('js/image-preview.js')); ?>"></script>

    <script>
        // menampilkan pesan dengan sweetalert
        <?php if(session('success')): ?>
            Swal.fire({
                icon: "success",
                title: "Success!",
                text: "<?php echo e(session('success')); ?>",
                showConfirmButton: false,
                timer: 2000
            });
        <?php elseif(session('error')): ?>
            Swal.fire({
                icon: "error",
                title: "Failed!",
                text: "<?php echo e(session('error')); ?>",
                showConfirmButton: false,
                timer: 2000
            });
        <?php endif; ?>
    </script>
</body>

</html><?php /**PATH C:\3.BUWONO\Dokumen\kuliah\SEMESTER 7\KKN\proker\aplikasi-pengelolaan-data-member\aplikasi-pengelolaan-data-member\resources\views/layouts/app.blade.php ENDPATH**/ ?>