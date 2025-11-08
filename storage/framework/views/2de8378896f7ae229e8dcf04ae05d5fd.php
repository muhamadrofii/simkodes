<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    <title>Data Anggota Per <?php echo e(date('F j, Y', strtotime(request('start_date')))); ?> - <?php echo e(date('F j, Y', strtotime(request('end_date')))); ?></title>
    
    
    <style type="text/css">
        table, th, td {
            border: 1px solid #dee2e6;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px 5px;
        }

        hr {
            color: #dee2e6;
        }
    </style>
</head>

<body>
    
    <div style="text-align: center">
        <h3>Data Anggota Per <?php echo e(date('F j, Y', strtotime(request('start_date')))); ?> - <?php echo e(date('F j, Y', strtotime(request('end_date')))); ?>.</h3>
    </div>

    <hr style="margin-bottom:20px">

    
    <table style="width:100%">
        <thead style="background-color: #6861ce; color: #ffffff">
            <th>No.</th>
            <th>Kategori</th>
            <th>Tanggal Bergabung</th>
            <th>Nama Lengkap</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Email</th>
            <th>Nomor Telepon</th>
        </thead>
        <tbody>
        <?php
            $no = 1;
        ?>
        <?php $__empty_1 = true; $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            
            <tr>
                <td width="30" align="center"><?php echo e($no++); ?></td>
                <td width="60" align="center"><?php echo e($member->category->name); ?></td>
                <td width="90" align="center"><?php echo e(date('F j, Y', strtotime($member->join_date))); ?></td>
                <td width="90"><?php echo e($member->full_name); ?></td>
                <td width="60" align="center"><?php echo e($member->gender); ?></td>
                <td width="150"><?php echo e($member->address); ?></td>
                <td width="60"><?php echo e($member->email); ?></td>
                <td width="70" align="center"><?php echo e($member->phone_number); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            
            <tr>
                <td colspan="8">Tidak Ada Data.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

    <div style="margin-top: 25px; text-align: right">Bandar Lampung, <?php echo e(date('F j, Y')); ?></div>
</body>

</html>
<?php /**PATH C:\3.BUWONO\Dokumen\kuliah\SEMESTER 7\KKN\proker\aplikasi-pengelolaan-data-member\aplikasi-pengelolaan-data-member\resources\views/report/print.blade.php ENDPATH**/ ?>