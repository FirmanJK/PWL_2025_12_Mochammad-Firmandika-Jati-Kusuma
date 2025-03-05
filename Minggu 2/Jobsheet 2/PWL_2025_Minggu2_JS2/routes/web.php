<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\WelcomeController;  
//use App\Http\Controllers\WelcomeController;

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

Route::get('/', function () {
    return view('welcome');
});

//BASIC ROUTING
//Menambahkan route pertama, membuat route ’/hello’ yang menampilkan pesan ‘Hello World’.
Route::get('/hello', function () {
    return 'Hello World';
    
});

//Menambahkan route kedua, tambahkan route /world 
Route::get('/world', function() {
    return 'World';
});

//Membuat route ’/’ yang menampilkan pesan ‘Selamat Datang’. 
Route::get('/', function () {
    return 'Selamat Datang';
});

//Membuat route ‘/about’ yang akan menampilkan NIM dan nama
Route::get('/about', function () {
    return 'NIM : 2341720229 <br> Nama : Mochammad Firmandika Jati Kusuma';
});

//Route parameters 
//Memanggil route /user/{name} sekaligus mengirimkan parameter berupa nama user $name
Route::get('/user/{name}', function ($name) {
    return 'Nama saya '.$name;
});

//Route bisa menerima lebih dari 1 parameter. Route menerima parameter $postId dan juga $comment.
Route::get('/posts/{post}/comments/{comment}', function 
    ($postId, $commentId) { 
    return 'Pos ke-'.$postId." Komentar ke-: ".$commentId; 
});

// Membuat route /articles/{id} yang akan menampilkan output “Halaman Artikel 
// dengan ID {id}”, ganti id sesuai dengan input dari url.  
Route::get('/articles/{id}', function ($id) {
    return 'Halaman Artikel dengan ID '.$id;
});

//Optional Parameters
//Memanggil route /user sekaligus mengirimkan parameter berupa nama user 
//$name dimana parameternya bersifat opsional.
// Route::get('/user/{name?}', function ($name='null') {
//     return 'Nama saya '.$name;
// });
// Mengubah kode pada route /user diatas
Route::get('/user/{name?}', function ($name='John') {
    return 'Nama saya '.$name;
});

//Menambahkan controller pada route dengan mengubah troute/hello
//Route::get('/hello', [WelcomeController::class,'index']);

//Membuat route dengan resource '/' untuk mengakses PageController
// yang memiliki method index
Route::get('/', [PageController::class,'index']); 

//Membuat route dengan resource '/about' untuk mengakses PageController
// yang memiliki method about
Route::get('/about', [PageController::class,'about']);

//Membuat route dengan resource '/about' untuk mengakses PageController
// yang memiliki method about
Route::get('articles/{id}', [PageController::class,'articles']);

//Membuat route home untuk mengakses HomeController menggunakan method index
Route::get('/', [HomeController::class,'index']); 

//Membuat route about untuk mengakses AboutController menggunakan method about
Route::get('/about', [AboutController::class,'about']);

//Membuat route articles untuk mengakses ArticleController menggunakan method articles
Route::get('articles/{id}', [ArticleController::class,'articles']);

//Membuat route resource '/photos' untuk mengakses PhotoController
Route::resource('photos', PhotoController::class); 

//Membuat route untuk resource 'photos' yang hanya mencakup dua metode: 
//index (untuk menampilkan daftar foto) dan show (untuk menampilkan foto tertentu).
//Menggunakan only() hanya yang akan diaktifkan, 
//sementara metode lainnya (seperti create, store, update, dan destroy) tidak diaktifkan.
Route::resource('photos', PhotoController::class)->only([ 
    'index', 'show' 
]); 

//Membuat route untuk resource 'photos' yang mencakup semua metode CRUD kecuali create, store, update, dan destroy. 
//Dengan menggunakan except(), Laravel hanya mengaktifkan metode index 
//dan show untuk menampilkan daftar foto dan foto tertentu, sementara metode lainnya tidak diaktifkan.
Route::resource('photos', PhotoController::class)->except([ 
    'create', 'store', 'update', 'destroy' 
]);


//Membuat route yang menampilkan view 'hello' 
//dengan parameter 'name' yang berisi 'Firman'
//Route::get('/greeting', function () { 
//    return view('blog.hello', ['name' => 'Mochammad Firmandika Jati Kusuma']); 
//    });

//Mengubah route/greeting dan diarahkan ke WelcomeController pada fungsi greeting. 
Route::get('/greeting', [WelcomeController::class, 'greeting']);     