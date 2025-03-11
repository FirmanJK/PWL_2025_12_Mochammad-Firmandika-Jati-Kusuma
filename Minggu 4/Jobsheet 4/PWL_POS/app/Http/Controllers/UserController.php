<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = UserModel::with('level')->get(); // Mengambil semua data dari tabel m_user
        return view('user',['data' => $user]);
}
       
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

            //$user = UserModel::firstOrNew(
                
                    //'username' => 'manager33',
                    //'nama' => 'Manager Tiga Tiga',
                    //'password' => Hash::make('12345'),
                    //'level_id' => 2

                    //$user->save(); // Simpan data user baru

                    //'username' => 'manager55',
                    //'nama' => 'Manager55',
                    
                    //$user->username = 'manager56';

                    //$user->isDirty(); // true
                    //$user->isDirty('username'); // true
                    //$user->isDirty('nama'); // false
                    //$user->isDirty(['nama', 'username']); //true

                    //$user->isClean(); // false
                    //$user->isClean('username'); // false
                    //$user->isClean('nama'); // true
                    //$user->isClean(['nama', 'username']); // false

                    //$user->isDirty(); // false
                    //$user->isClean(); // true 
                    //dd($user->isDirty());

                    //'username' => 'manager11',
                    //'nama' => 'Manager11',
                    //'password' => Hash::make('12345'),
                    //'level_id' => 2

                    //$user->username ='manager12';

                    //$user->save(); // Simpan perubahan data user

                    //$user->wasChanged (); // true
                    //$user->wasChanged('username'); // true
                    //$user->wasChanged(['username', 'level_id']); // true
                    //$user->wasChanged('nama'); // false
                    //dd($user->wasChanged(['nama', 'username']));//true

                //$user = UserModel::all(); // Mengambil semua data dari tabel m_user
                //return view('user',['data' => $user]);
                // dd($user);
                
               

    public function tambah() 
    {
            return view('user_tambah');
    }

    public function tambah_simpan(Request $request)
    {
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'level_id' => $request->level_id
        ]);

        return redirect('/user');
    }

    public function ubah($id)
    {
        $user = UserModel::find($id);
        return view('user_ubah', ['data' => $user]);
    }

    public function ubah_simpan($id, Request $request)
    {
        $user = UserModel::find($id);

        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->password = Hash::make('$request->password');
        $user->level_id = $request->level_id;

        $user->save();

        return redirect('/user');
    }

    public function hapus($id)
    {
        $user = UserModel::find($id);
        $user->delete();

        return redirect('/user');
    }
}