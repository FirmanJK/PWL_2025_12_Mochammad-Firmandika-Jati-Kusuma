<!-- <!DOCTYPE html>
<html>
<body>
    <h1>Data User</h1>
    <table border="1" cellpadding="2" cellspacing="0">
         <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Nama</th>
            <th>ID Level Pengguna</th>
        </tr> -->

        <!-- <tr>
            <td>ID</td>
            <td>Username</td>
            <td>Nama</td>
            <td>ID Level Pengguna</td>
        </tr>
        <tr>
        </tr>
    </table>
</body>
</html> -->

<!-- <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
    <style>
        --table {
            --border-collapse: collapse;
            width: 100px;
        }
        --th, td {
            --border: 1px solid black;
            --padding: 5px;
            --text-align: left;
        }
    </style>
</head>-->

                <!--<th>ID</th>
                <th>Username</th>
                <th>Nama</th>
                <th>ID Level Pengguna</th>
                <th>Aksi</th> -->
<!DOCTYPE html>
<html lang="id">
<body>
    <body>
        <h1>Data User</h1>
        <a href="<?php echo e(url('/user/tambah')); ?>">+ Tambah User</a>
        <table border="1" cellpadding="2" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Nama</th>
                <th>ID Level Pengguna</th>
                <td>Kode Level</td>
                <td>Nama Level</td>
                <th>Aksi</th>
            </tr>
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($d->user_id); ?></td>
                    <td><?php echo e($d->username); ?></td>
                    <td><?php echo e($d->nama); ?></td>
                    <td><?php echo e($d->level_id); ?></td>
                    <td><?php echo e($d->level->level_kode); ?></td>
                    <td><?php echo e($d->level->level_nama); ?></td>
                    <td>
                        <a href="<?php echo e(url('/user/ubah/' . $d->user_id)); ?>">Ubah</a> |
                        <a href="<?php echo e(url('/user/hapus/' . $d->user_id)); ?>">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    </body>
</html>

<?php /**PATH D:\laragon\www\PWL_2025_12_Mochammad-Firmandika-Jati-Kusuma\Minggu 4\Jobsheet 4\PWL_POS\resources\views/user.blade.php ENDPATH**/ ?>