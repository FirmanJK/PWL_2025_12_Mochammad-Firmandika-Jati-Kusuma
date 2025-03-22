<!DOCTYPE html>
<html>
<head>
    <title>Data Level Pengguna</title>
</head>
<body>
    <h1>Data Level Pengguna</h1>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Kode Level</th>
            <th>Nama Level</th>
        </tr>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($d->level_id); ?></td>
            <td><?php echo e($d->level_kode); ?></td>
            <td><?php echo e($d->level_nama); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
</body>
</html><?php /**PATH D:\laragon\www\PWL_2025_12_Mochammad-Firmandika-Jati-Kusuma\Minggu 3\Jobsheet 3\PWL_POS\resources\views/level.blade.php ENDPATH**/ ?>