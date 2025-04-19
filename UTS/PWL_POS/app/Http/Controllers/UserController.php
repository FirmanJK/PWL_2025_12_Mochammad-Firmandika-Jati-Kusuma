<?php

namespace App\Http\Controllers;

//memanggil UserModel
use App\Models\UserModel;
use App\Models\LevelModel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\password;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    public function index()
{
    $breadcrumb = (object) [
        'title' => "Online user",
        'list' => ["home", "User"]
    ];
    
    $page = (object) [
        'title' => "Online user yang terdaftar dalam sistem"
    ];
    
    $activeMenu = 'user'; // set menu yang aktif
    $level = LevelModel::all(); // ambil data level untuk filter dropdown
    
    return view('user.index', [
        'breadcrumb' => $breadcrumb,
        'page' => $page,
        'level' => $level,
        'activeMenu' => $activeMenu
    ]);
}

public function store_ajax(Request $request)
{
    // cek apakah request berupa ajax
    if ($request->ajax() || $request->wantsJson()) {
        $rules = [
            'level_id' => 'required|integer',
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama' => 'required|string|max:100',
            'password' => 'required|min:6'
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false, // response status, false: error/gagal, true: berhasil
                'message' => 'Validasi Gagal',
                'msgField' => $validator->errors() // pesan error validasi
            ]);
        }

        // UserModel::create($request->all());

        // Menambahkan perbaikan kode untuk melakukan hash password terlebih dahulu sebelum disimpan ke database
        $data = $request->all();

        $data['password'] = Hash::make($request->password);

        UserModel::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Data user berhasil disimpan'
        ]);
    }

    redirect('/');
}
}