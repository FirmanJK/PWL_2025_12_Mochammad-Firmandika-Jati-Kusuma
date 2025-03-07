<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
       
        //tambah data user dengan Eloquent Model
        //$data = [
            //'username' => 'customer-1',
            //'nama' => 'Pelanggan Pertama',
            //'password' => Hash::make('12345'),
            //'level_id' => 1
        //];
        //UserModel::where('username', 'customer-1')->update($data);  //update data user

        $data =[
            'level_id' => 2,
            'username' => 'manager_tiga',  //'username' => 'manager_dua',
            'nama' => 'Manager 3', //'nama' => 'Manager 2',
            'password' => Hash::make('12345')
        ];
        UserModel::create($data); //tambah data user dengan Eloquent Model

        //coba akses model UserModel
        $user = UserModel::all(); // Mengambil semua data dari tabel m_users
        return view('user', ['data' => $user]);
        
    }
}