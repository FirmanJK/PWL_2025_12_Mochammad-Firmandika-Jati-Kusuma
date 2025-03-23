<!DOCTYPE html>
<html>
<head>
    <title>Data User</title>
</head>
<body>
    <h1>Data User</h1>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Nama</th>
            <th>ID Level Pengguna</th>
        </tr>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($d->user_id); ?></td>
            <td><?php echo e($d->username); ?></td>
            <td><?php echo e($d->nama); ?></td>
            <td><?php echo e($d->level_id); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
</body>
</html>
<?php /**PATH D:\laragon\www\PWL_2025_12_Mochammad-Firmandika-Jati-Kusuma\Minggu 3\Jobsheet 3\PWL_POS\resources\views/user.blade.php ENDPATH**/ ?>