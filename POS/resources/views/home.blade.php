<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Application</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #ff9a9e, #fad0c4);
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .list-group-item {
            font-size: 1.2rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            transition: background 0.3s ease-in-out;
        }
        .list-group-item:hover {
            background: rgba(0, 0, 0, 0.05);
            transform: scale(1.05);
        }
        .icon {
            margin-right: 10px;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card p-4 bg-white">
        <h1 class="text-center text-dark fw-bold">Welcome to POS Application</h1>
        <p class="text-center text-muted">Ini adalah halaman utama dari aplikasi Point of Sales.</p>

        <ul class="list-group list-group-flush">
            <li class="list-group-item text-primary">
                <span class="icon">🍔</span>
                <a href="/category/food-beverage" class="text-decoration-none text-primary">Food & Beverage</a>
            </li>
            <li class="list-group-item text-danger">
                <span class="icon">💄</span>
                <a href="/category/beauty-health" class="text-decoration-none text-danger">Beauty & Health</a>
            </li>
            <li class="list-group-item text-success">
                <span class="icon">🏡</span>
                <a href="/category/home-care" class="text-decoration-none text-success">Home Care</a>
            </li>
            <li class="list-group-item text-info">
                <span class="icon">🍼</span>
                <a href="/category/baby-kid" class="text-decoration-none text-info">Baby & Kid</a>
            </li>
            <li class="list-group-item text-dark">
                <span class="icon">🛒</span>
                <a href="/sales" class="text-decoration-none text-dark">Sales Page</a>
            </li>
            <li class="list-group-item text-warning">
                <span class="icon">👤</span>
                <a href="/user/1/name/Alex" class="text-decoration-none text-warning">User Profile</a>
            </li>
        </ul>
    </div>
</div>

</body>
</html>