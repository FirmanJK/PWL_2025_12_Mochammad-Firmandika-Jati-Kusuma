<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Sales</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
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
        .total {
            font-size: 1.5rem;
            font-weight: bold;
            color: green;
        }
        .btn-pay {
            background: #28a745;
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card p-4">
        <h1 class="text-center text-dark fw-bold">Sales Transactions</h1>
        <table class="table table-bordered mt-3">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php $totalAmount = 0; @endphp
                @foreach ($transactions as $index => $transaction)
                    @php
                        $subtotal = $transaction['quantity'] * $transaction['price'];
                        $totalAmount += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $transaction['name'] }}</td>
                        <td>{{ $transaction['quantity'] }}</td>
                        <td>Rp {{ number_format($transaction['price'], 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h2 class="total text-end">Total: Rp {{ number_format($totalAmount, 0, ',', '.') }}</h2>
        <div class="text-center mt-3">
            <button class="btn btn-pay px-5 py-2">Proceed to Payment</button>
        </div>
    </div>
</div>

</body>
</html>