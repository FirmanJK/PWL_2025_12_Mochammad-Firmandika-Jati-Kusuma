<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #36d1dc, #5b86e5);
            color: white;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            background: white;
            color: black;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-back {
            background: #36d1dc;
            color: white;
            font-size: 1rem;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card p-4">
        <h1 class="text-center text-dark fw-bold">User Profile</h1>
        <table class="table table-striped mt-3">
            <tr>
                <th>ID</th>
                <td>{{ $user['id'] }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $user['name'] }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user['email'] }}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{ $user['phone'] }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $user['address'] }}</td>
            </tr>
        </table>
        <div class="text-center mt-3">
            <a href="/" class="btn btn-back px-4 py-2">Back to Home</a>
        </div>
    </div>
</div>

</body>
</html>