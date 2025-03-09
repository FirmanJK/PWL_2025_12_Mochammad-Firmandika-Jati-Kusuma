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

<!DOCTYPE html>
<html lang="id">
<!-- <head> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
    <!-- <style>
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
<body>
    <h1>Data User</h1>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <td>ID</td>
            <td>Username</td>
            <td>Nama</td>
            <td>ID Level Pengguna</td>
        </tr>
        <tr>
            <td>{{ $data->user_id }}</td>
            <td>{{ $data->username }}</td>
            <td>{{ $data->nama }}</td>
            <td>{{ $data->level_id }}</td>
        </tr>
    </table>
</body>
</html>