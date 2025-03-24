<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        // Contoh data transaksi (bisa diganti dengan data dari database)
        $transactions = [
            ['name' => 'Burger', 'quantity' => 2, 'price' => 25000],
            ['name' => 'Lipstick', 'quantity' => 1, 'price' => 75000],
            ['name' => 'Shampoo', 'quantity' => 3, 'price' => 30000],
            ['name' => 'Baby Milk', 'quantity' => 2, 'price' => 50000]
        ];

        return view('sales.index', compact('transactions'));
    }
}
