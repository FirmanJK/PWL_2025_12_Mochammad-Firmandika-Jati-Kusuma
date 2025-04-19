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
    // Ambil data user dalam bentuk json untuk datatables 
    public function list(Request $request) 
    { 
        $users = UserModel::select('user_id', 'username', 'nama', 'level_id') 
              ->with('level'); 
        
        // Filter data user berdasarkan level_id
        if($request->level_id) {
            $users->where('level_id', $request->level_id);
        }
        return DataTables::of($users) 
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
            ->addIndexColumn()  
            ->addColumn('aksi', function ($user) {  // menambahkan kolom aksi 
                //$btn  = '<a href="'.url('/user/' . $user->user_id).'" class="btn btn-info btn sm">Detail</a> '; 
                //$btn .= '<a href="'.url('/user/' . $user->user_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> '; 
                //$btn .= '<form class="d-inline-block" method="POST" action="' .
                //url('/user/' . $user->user_id) . '">' . csrf_field() . method_field('DELETE') .
                //'<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                
                $btn = '<button onclick="modalAction(\'' . url('/user/' . $user->user_id .
                '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->user_id .
                '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->user_id .
                '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';

         return $btn;
        })->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
        ->make(true); 
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