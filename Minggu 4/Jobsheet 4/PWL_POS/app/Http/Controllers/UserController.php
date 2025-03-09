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

        //$data =[
          //  'level_id' => 2,
            //'username' => 'manager_tiga',  //'username' => 'manager_dua',
            //'nama' => 'Manager 3', //'nama' => 'Manager 2',
            //'password' => Hash::make('12345')
        //];
        //UserModel::create($data); //tambah data user dengan Eloquent Model

        //coba akses model UserModel
        //$user = UserModel::where('level_id', 1)->first(); // Mengambil semua data dari tabel m_user
        //$user = UserModel::firstWhere('level_id', 1); // Mengambil semua data dari tabel m_user
        
       //$user = UserModel::findOr(1,['username', 'nama'], function () {
        //    abort(404);
        //$user = UserModel::findOr(20,['username', 'nama'], function () {
        //abort(404);
        // }); // Mengambil semua data dari tabel m_user
        
        //$user = UserModel::findOrFail(1);
        //$user = UserModel::where('username', 'manager9')->firstOrFail();
        //$user = UserModel::where('level_id', 2) ->count(); 

        //'username'=> 'manager',
        //'nama' => 'Manager',
        
        // Cari user berdasarkan username, jika tidak ada, buat user baru dengan password yang dienkripsi
         //$user = UserModel::firstOrCreate(
            //['username' => 'manager22'], // Pencarian berdasarkan username
            //[
                //'nama' => 'Manager Dua Dua',
                //'password' => Hash::make('12345'), // Pastikan password dienkripsi
                //'level_id' => 2
            //]

                //'username' => 'manager',
                 //'nama' => 'Manager',

            $user = UserModel::firstOrNew(
                [
                    'username' => 'manager33',
                    'nama' => 'Manager Tiga Tiga',
                    'password' => Hash::make('12345'),
                    'level_id' => 2
                ],
            );
            $user->save(); // Simpan data user baru

        return view('user', ['data' => $user]);
    }
}