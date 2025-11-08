<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KTA A5 Landscape</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        @page {
            size: 794px 559px;
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
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
        }

        .content {
            position: absolute;
            top: 30px;
            left: 100px;
            right: 130px;
            bottom: 30px;
            z-index: 1;
        }

        .header {
            text-align: center;
            font-size: 18px;
            font-weight: 700;
            line-height: 1.4;
            margin-bottom: 6px;
        }

        .subheader {
            text-align: center;
            font-size: 13px;
            font-style: italic;
            margin-bottom: 20px;
            font-weight: 400;
        }

        .data {
            margin-top: 10px;
        }

        .data td {
            padding: 3px 6px;
            font-size: 12px;
        }

        .data td:first-child {
            width: 140px;
            font-weight: 600;
        }

        .data td:nth-child(2) {
            width: 10px;
        }

        .photo {
            position: absolute;
            top: 150px;
            right: 100px;
            width: 85px;
            height: 105px;
            background-color: #f0f0f0;
            border: 2px solid #000;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            text-align: center;
        }

        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="kta">
        
        <img src="data:image/png;base64,<?php echo e($kop); ?>" alt="Background" class="background-img" />

        
        <div class="content">
            <div class="header">
                KARTU ANGGOTA<br>
                KOPERASI MERAH PUTIH DESA SRANAK<br>
                KECAMATAN TRUCUK, BOJONEGORO
            </div>
            <div class="subheader">
                Merah Putih, Mandiri dan Sejahtera
            </div>

            <table class="data">
                <tr>
                    <td>Kategori</td>
                    <td>:</td>
                    <td><?php echo e($member->category->name ?? '-'); ?></td>
                </tr>
                <tr>
                    <td>Nama Lengkap</td>
                    <td>:</td>
                    <td><?php echo e($member->nama); ?></td>
                </tr>
                <tr>
                    <td>Umur</td>
                    <td>:</td>
                    <td><?php echo e($member->umur ? $member->umur . ' tahun' : '-'); ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>
                        <?php echo e($member->jenis_kelamin === 'L' ? 'Laki-laki' : ($member->jenis_kelamin === 'P' ? 'Perempuan' : '-')); ?>

                    </td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td><?php echo e($member->mata_pencaharian ?? '-'); ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?php echo e($member->tempat_tinggal ?? '-'); ?></td>
                </tr>
                <tr>
                    <td>Tanggal Masuk</td>
                    <td>:</td>
                    <td>
                        <?php echo e($member->tanggal_masuk ? date('d F Y', strtotime($member->tanggal_masuk)) : '-'); ?>

                    </td>
                </tr>
                <?php if($member->tanggal_keluar): ?>
                <tr>
                    <td>Tanggal Keluar</td>
                    <td>:</td>
                    <td><?php echo e(date('d F Y', strtotime($member->tanggal_keluar))); ?></td>
                </tr>
                <?php endif; ?>
                <?php if($member->sebab_berhenti): ?>
                <tr>
                    <td>Sebab Berhenti</td>
                    <td>:</td>
                    <td><?php echo e($member->sebab_berhenti); ?></td>
                </tr>
                <?php endif; ?>
            </table>
        </div>

        
        <div class="photo">
            <?php if($photoBase64): ?>
                <img src="<?php echo e($photoBase64); ?>" alt="Foto Anggota">
            <?php else: ?>
                Foto<br>Tidak Tersedia
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\3.BUWONO\Dokumen\kuliah\SEMESTER 7\KKN\proker\aplikasi-pengelolaan-data-member\aplikasi-pengelolaan-data-member\resources\views/members/kta.blade.php ENDPATH**/ ?>