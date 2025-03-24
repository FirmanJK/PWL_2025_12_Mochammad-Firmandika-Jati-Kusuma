<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id, $name)
{
    // Jika nama adalah 'Alex', ubah menjadi 'Firman'
    if (strtolower($name) === 'alex') {
        $name = 'Mochammad Firmandika Jati Kusuma';
    }

    $user = [
        'id' => $id,
        'name' => $name,
        'email' => strtolower($name) . '@gmail.com',
        'phone' => '08123456789',
        'address' => 'Jl. Merdeka No. 45, Jakarta',
    ];

    return view('user.profile', compact('user'));
    }
}