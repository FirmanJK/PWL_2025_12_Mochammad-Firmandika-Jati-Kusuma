<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//--------------------------------------------Jobsheet 3-------------------------------------
//Route::get('/level', [LevelController::class, 'index']);
//Route::get('kategori', [KategoriController::class, 'index']);
//Route::get('/user', [UserController::class, 'index']);


//--------------------------------------------Jobsheet 4--------------------------------
//Route::get('/user/tambah', [UserController::class, 'tambah']);
//Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
//Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
//Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
//Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

//--------------------------------------------Jobsheet 5--------------------------------
Route::get('/', [WelcomeController::class, 'index']);

//Route::group(['prefix' => 'user'], function () {
    //Route::get('/', [UserController::class, 'index']);             // menampilkan halaman awal user
    //Route::post('/list', [UserController::class, 'list']);        // menampilkan data user dalam bentuk json untuk datatables
    //Route::get('/create', [UserController::class, 'create']);    // menampilkan halaman form tambah user
    //Route::post('/', [UserController::class, 'store']);          // menyimpan data user baru
    //Route::get('/{id}', [UserController::class, 'show']);        // menampilkan detail user
    //Route::get('/{id}/edit', [UserController::class, 'edit']);  // menampilkan halaman form edit user
    //Route::put("/{id}", [UserController::class, 'update']);       // menyimpan perubahan data user
    //Route::delete('/{id}', [UserController::class, 'destroy']);  // menghapus data user
    
//});
//Route::group(['prefix' => 'level'], function () {
    //Route::get('/', [LevelController::class, 'index']);             // menampilkan halaman awal level
    //Route::post('/list', [LevelController::class, 'list']);        // menampilkan data level dalam bentuk json untuk datatables
    //Route::get('/create', [LevelController::class, 'create']);    // menampilkan halaman form tambah level
    //Route::post('/', [LevelController::class, 'store']);          // menyimpan data level baru
    //Route::get('/{id}', [LevelController::class, 'show']);        // menampilkan detail level
    //Route::get('/{id}/edit', [LevelController::class, 'edit']);  // menampilkan halaman form edit level
    //Route::put("/{id}", [LevelController::class, 'update']);       // menyimpan perubahan data level
    //Route::delete('/{id}', [LevelController::class, 'destroy']);  // menghapus data level
//});

//Route::group(['prefix' => 'kategori'], function () {
    //Route::get('/', [KategoriController::class, 'index']);
    //Route::post('/list', [KategoriController::class, 'list']);
    //Route::get('/create', [KategoriController::class, 'create']);
    //Route::post('/', [KategoriController::class, 'store']);
    //Route::get('/{id}', [KategoriController::class, 'show']);
    //Route::get('/{id}/edit', [KategoriController::class, 'edit']);
    //Route::put("/{id}", [KategoriController::class, 'update']);
    //Route::delete('/{id}', [KategoriController::class, 'destroy']);
//});

//Route::group(['prefix' => 'supplier'], function () {
    //Route::get('/', [SupplierController::class, 'index']);
    //Route::post('/list', [SupplierController::class, 'list']);
    //Route::get('/create', [SupplierController::class, 'create']);
    //Route::post('/', [SupplierController::class, 'store']);
    //Route::get('/{id}', [SupplierController::class, 'show']);
    //Route::get('/{id}/edit', [SupplierController::class, 'edit']);
    //Route::put("/{id}", [SupplierController::class, 'update']);
    //Route::delete('/{id}', [SupplierController::class, 'destroy']);
//});
//Route::group(['prefix' => 'barang'], function () {
    //Route::get('/', [BarangController::class, 'index']);
    //Route::post('/list', [BarangController::class, 'list']);
    //Route::get('/create', [BarangController::class, 'create']);
    //Route::post('/', [BarangController::class, 'store']);
    //Route::get('/{id}', [BarangController::class, 'show']);
    //Route::get('/{id}/edit', [BarangController::class, 'edit']);
    //Route::put("/{id}", [BarangController::class, 'update']);
    //Route::delete('/{id}', [BarangController::class, 'destroy']);
//});

//--------------------------------------------Jobsheet 6--------------------------------
//--------------------------------------------Praktikum 1--------------------------------
//Route::group(['prefix' => 'user'], function () {
//    Route::get('/', [UserController::class, 'index']);             // menampilkan halaman awal user
//    Route::post('/list', [UserController::class, 'list']);        // menampilkan data user dalam bentuk json untuk datatables
//    Route::get('/create', [UserController::class, 'create']);    // menampilkan halaman form tambah user
//    Route::post('/', [UserController::class, 'store']);          // menyimpan data user baru
//    Route::get('/create_ajax', [UserController::class, 'create_ajax']); // menampilkan halaman form tambah user Ajax
//    Route::post('/ajax', [UserController::class, 'store_ajax']); // menyimpan data user baru Ajax
//    Route::get('/{id}', [UserController::class, 'show']);        // menampilkan detail user
//    Route::get('/{id}/edit', [UserController::class, 'edit']);  // menampilkan halaman form edit user
//    Route::put("/{id}", [UserController::class, 'update']);       // menyimpan perubahan data user
//    Route::delete('/{id}', [UserController::class, 'destroy']);  // menghapus data user
//});

//--------------------------------------------Praktikum 2--------------------------------
Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']);             // menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']);        // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']);    // menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']);          // menyimpan data user baru
    Route::get('/create_ajax', [UserController::class, 'create_ajax']); // menampilkan halaman form tambah user Ajax
    Route::post('/ajax', [UserController::class, 'store_ajax']); // menyimpan data user baru Ajax
    Route::get('/{id}', [UserController::class, 'show']);        // menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']);  // menampilkan halaman form edit user
    Route::put("/{id}", [UserController::class, 'update']);       // menyimpan perubahan data user
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);  // menampilkan halaman form edit user ajax
    Route::put("/{id}/update_ajax", [UserController::class, 'update_ajax']); // menyimpan perubahan data user ajax
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);  // untuk tampilkan form confirm delete user ajax
    Route::delete("/{id}/delete_ajax", [UserController::class, 'delete_ajax']); // untuk hapus data user ajax
    Route::delete('/{id}', [UserController::class, 'destroy']);  // menghapus data user
});

Route::group(['prefix' => 'level'], function () {
    Route::get('/', [LevelController::class, 'index']);             // menampilkan halaman awal level
    Route::post('/list', [LevelController::class, 'list']);        // menampilkan data level dalam bentuk json untuk datatables
    Route::get('/create', [LevelController::class, 'create']);    // menampilkan halaman form tambah level
    Route::post('/', [LevelController::class, 'store']);          // menyimpan data level baru
    Route::get('/create_ajax', [LevelController::class, 'create_ajax']); // menampilkan halaman form tambah level Ajax
    Route::post('/ajax', [LevelController::class, 'store_ajax']); // menyimpan data level baru Ajax
    Route::get('/{id}', [LevelController::class, 'show']);        // menampilkan detail level
    Route::get('/{id}/edit', [LevelController::class, 'edit']);  // menampilkan halaman form edit level
    Route::put("/{id}", [LevelController::class, 'update']);       // menyimpan perubahan data level
    Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);  // menampilkan halaman form edit level ajax
    Route::put("/{id}/update_ajax", [LevelController::class, 'update_ajax']); // menyimpan perubahan data level ajax
    Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);  // untuk tampilkan form confirm delete level ajax
    Route::delete("/{id}/delete_ajax", [LevelController::class, 'delete_ajax']); // untuk hapus data level ajax
    Route::delete('/{id}', [LevelController::class, 'destroy']);  // menghapus data level
});

Route::group(['prefix' => 'kategori'], function () {
    Route::get('/', [KategoriController::class, 'index']);              // menampilkan halaman awal kategori
    Route::post('/list', [KategoriController::class, 'list']);          // menampilkan data kategori dalam bentuk json untuk datatables
    Route::get('/create', [KategoriController::class, 'create']);       // menampilkan halaman form tambah kategori
    Route::post('/', [KategoriController::class, 'store']);             // menyimpan data kategori baru
    Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); // menampilkan halaman form tambah kategori Ajax
    Route::post('/ajax', [KategoriController::class, 'store_ajax']); // menyimpan data kategori baru Ajax
    Route::get('/{id}', [KategoriController::class, 'show']);           // menampilkan detail kategori
    Route::get('/{id}/edit', [KategoriController::class, 'edit']);      // menampilkan halaman form edit kategori
    Route::put("/{id}", [KategoriController::class, 'update']);         // menyimpan perubahan data kategori
    Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);  // menampilkan halaman form edit kategori ajax
    Route::put("/{id}/update_ajax", [KategoriController::class, 'update_ajax']); // menyimpan perubahan data kategori ajax
    Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);  // untuk tampilkan form confirm kategori ajax
    Route::delete("/{id}/delete_ajax", [KategoriController::class, 'delete_ajax']); // untuk hapus data kategori ajax
    Route::delete('/{id}', [KategoriController::class, 'destroy']);    // menghapus data kategori
});

Route::group(['prefix' => 'supplier'], function () {
    Route::get('/', [SupplierController::class, 'index']);              // menampilkan halaman awal supplier
    Route::post('/list', [SupplierController::class, 'list']);          // menampilkan data supplier dalam bentuk json untuk datatables
    Route::get('/create', [SupplierController::class, 'create']);       // menampilkan halaman form tambah supplier
    Route::post('/', [SupplierController::class, 'store']);             // menyimpan data supplier baru
    Route::get('/create_ajax', [SupplierController::class, 'create_ajax']); // menampilkan halaman form tambah supplier Ajax
    Route::post('/ajax', [SupplierController::class, 'store_ajax']);        // menyimpan data supplier baru Ajax
    Route::get('/{id}', [SupplierController::class, 'show']);               // menampilkan detail supplier
    Route::get('/{id}/edit', [SupplierController::class, 'edit']);          // menampilkan halaman form edit supplier
    Route::put("/{id}", [SupplierController::class, 'update']);             // menyimpan perubahan data supplier
    Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);  // menampilkan halaman form edit supplier ajax
    Route::put("/{id}/update_ajax", [SupplierController::class, 'update_ajax']); // menyimpan perubahan data supplier ajax
    Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']);  // untuk tampilkan form confirm supplier ajax
    Route::delete("/{id}/delete_ajax", [SupplierController::class, 'delete_ajax']); // untuk hapus data supplier  ajax
    Route::delete('/{id}', [SupplierController::class, 'destroy']);         // menghapus data supplier
});
Route::group(['prefix' => 'barang'], function () {
    Route::get('/', [BarangController::class, 'index']);                // menampilkan halaman awal barang
    Route::post('/list', [BarangController::class, 'list']);            // menampilkan data barang dalam bentuk json untuk datatables
    Route::get('/create', [BarangController::class, 'create']);         // menampilkan halaman form tambah barang
    Route::post('/', [BarangController::class, 'store']);               // menampilkan  halaman form tambah barang
    Route::get('/create_ajax', [BarangController::class, 'create_ajax']);  // menampilkan halaman form tambah barang Ajax
    Route::post('/ajax', [BarangController::class, 'store_ajax']);        // menyimpan data barang baru Ajax
    Route::get('/{id}', [BarangController::class, 'show']);             // menampilkan detail barang
    Route::get('/{id}/edit', [BarangController::class, 'edit']);        // menampilkan halaman form edit barang
    Route::put("/{id}", [BarangController::class, 'update']);           // menyimpan perubahan data barang 
    Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);  // menampilkan halaman form edit barang ajax
    Route::put("/{id}/update_ajax", [BarangController::class, 'update_ajax']); // menyimpan perubahan data baranag ajax
    Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);  // untuk tampilkan form confirm barang ajax
    Route::delete("/{id}/delete_ajax", [BarangController::class, 'delete_ajax']); // untuk hapus data barang ajax
    Route::delete('/{id}', [BarangController::class, 'destroy']);       // menghapus data barang
});