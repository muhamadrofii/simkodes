<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>KTA Officer - Koperasi Merah Putih</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        @page {
            size: A5 landscape;
            margin: 0;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            color: #000;
        }

        .kta {
            position: relative;
            width: 794px;
            height: 559px;
            overflow: hidden;
        }

        .background-img {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            object-fit: cover;
            z-index: 0;
        }

        .content {
            position: absolute;
            top: 40px; left: 90px; right: 130px; bottom: 30px;
            z-index: 1;
        }

        .header {
            text-align: center;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .subheader {
            text-align: center;
            font-size: 13px;
            font-style: italic;
            margin-bottom: 20px;
            color: #333;
        }

        .badge {
            text-align: center;
            font-size: 14px;
            font-weight: 700;
            background-color: #c62828;
            color: white;
            padding: 4px 10px;
            border-radius: 6px;
            display: inline-block;
            margin-bottom: 20px;
        }

        .data td {
            padding: 3px 6px;
            font-size: 12px;
        }

        .data td:first-child {
            width: 140px;
            font-weight: 600;
        }

        .photo {
            position: absolute;
            top: 140px;
            right: 100px;
            width: 90px;
            height: 110px;
            border: 2px solid #000;
            background-color: #f9f9f9;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .footer {
            position: absolute;
            bottom: 30px;
            left: 100px;
            right: 100px;
            font-size: 11px;
            text-align: center;
            border-top: 1px solid #aaa;
            padding-top: 6px;
        }
    </style>
</head>
<body>
    <div class="kta">
        
        <img src="data:image/png;base64,<?php echo e($kop); ?>" alt="Background" class="background-img" />

        <div class="content">
            <div class="header">
                KARTU TANDA PENGURUS<br>
                KOPERASI MERAH PUTIH DESA SRANAK
            </div>
            <div class="subheader">
                Merah Putih, Mandiri, dan Sejahtera
            </div>

            
            <div class="badge">PENGURUS</div>

            <table class="data">
                <tr><td>Nama Lengkap</td><td>:</td><td><?php echo e($officer->nama); ?></td></tr>
                <tr><td>Jabatan</td><td>:</td><td><?php echo e($officer->mata_pencaharian ?? 'Pengurus'); ?></td></tr>
                <tr><td>Alamat</td><td>:</td><td><?php echo e($officer->tempat_tinggal ?? '-'); ?></td></tr>
                <tr><td>Tanggal Masuk</td><td>:</td><td><?php echo e($officer->tanggal_masuk ? date('d F Y', strtotime($officer->tanggal_masuk)) : '-'); ?></td></tr>
            </table>
        </div>

        
        <div class="photo">
            <?php if($photoBase64): ?>
                <img src="<?php echo e($photoBase64); ?>" alt="Foto Officer">
            <?php else: ?>
                Foto<br>Tidak Ada
            <?php endif; ?>
        </div>

        <div class="footer">
            <strong>Koperasi Merah Putih</strong> – Desa Sranak, Kecamatan Trucuk, Bojonegoro<br>
            Ditetapkan pada: <?php echo e(now()->translatedFormat('d F Y')); ?>

        </div>
    </div>
</body>
</html>
<?php /**PATH C:\3.BUWONO\Dokumen\kuliah\SEMESTER 7\KKN\proker\aplikasi-pengelolaan-data-member\aplikasi-pengelolaan-data-member\resources\views/officers/kta.blade.php ENDPATH**/ ?>