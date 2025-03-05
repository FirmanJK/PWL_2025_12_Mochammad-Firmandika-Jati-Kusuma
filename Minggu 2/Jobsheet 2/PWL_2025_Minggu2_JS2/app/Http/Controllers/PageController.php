<?php

//Struktur Controller
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //Menambahkan fuction dengan access public
    public function index() {
        return 'Selamat Datang';
    }

    public function about() {
        return 'Nama : Mochammad Firmandika Jati Kusuma <br> NIM : 2341720229';
    }

    public function articles($id) {
        return 'Halaman Artikel dengan ID '.$id;
    }

}
