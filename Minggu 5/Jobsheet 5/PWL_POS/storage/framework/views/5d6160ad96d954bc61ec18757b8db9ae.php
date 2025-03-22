<!DOCTYPE html>
    <html lang="id">
    <body>
        <h1>Form Tambah Data User</h1>
        <form method="post" action=<?php echo e(url ('/user/tambah_simpan')); ?>>
            <?php echo e(csrf_field()); ?>


            <label>Username</label>
            <input type="text" name="username" placeholder=" Masukkan Username">
            <br>
            <label>Nama</label>
            <input type="text" name="nama" placeholder=" Masukkan Nama">
            <br>
            <label>Password</label>
            <input type="password" name="password" placeholder=" Masukkan Password">
            <br>
            <label>Level ID</label>
            <input type="number" name="level_id" placeholder=" Masukkan ID Level">
            <br><br>
            <input type="submit" class="btn btn-succes" value="Simpan">

        </form>
    </body>
</html><?php /**PATH D:\laragon\www\PWL_2025_12_Mochammad-Firmandika-Jati-Kusuma\Minggu 4\Jobsheet 4\PWL_POS\resources\views/user_tambah.blade.php ENDPATH**/ ?>