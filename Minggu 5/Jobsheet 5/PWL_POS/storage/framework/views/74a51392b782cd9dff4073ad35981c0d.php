<!DOCTYPE html>
    <html lang="id">
    <body>
        <h1>Form Ubah Data User</h1>
        <a href="/user">Kembali</a>
        <br><br>

        <form method="post" action=<?php echo e(url ('/user/ubah_simpan/' . $data->user_id)); ?>>
            <?php echo e(csrf_field()); ?>

            <?php echo e(method_field('PUT')); ?>


            <label>Username</label>
            <input type="text" name="username" placeholder=" Masukkan Username" value="<?php echo e($data->username); ?>">
            <br>
            <label>Nama</label>
            <input type="text" name="nama" placeholder=" Masukkan Nama" value="<?php echo e($data->username); ?>">
            <br>
            <label>Password</label>
            <input type="password" name="password" placeholder=" Masukkan Password" value="<?php echo e($data->password); ?>">
            <br>
            <label>Level ID</label>
            <input type="number" name="level_id" placeholder=" Masukkan ID Level" value="<?php echo e($data->level_id); ?>">
            <br><br>
            <input type="submit" class="btn btn-succes" value="Ubah">

        </form>
    </body>
</html>

<!-- value="ubah"<?php /**PATH D:\laragon\www\PWL_2025_12_Mochammad-Firmandika-Jati-Kusuma\Minggu 4\Jobsheet 4\PWL_POS\resources\views/user_ubah.blade.php ENDPATH**/ ?>