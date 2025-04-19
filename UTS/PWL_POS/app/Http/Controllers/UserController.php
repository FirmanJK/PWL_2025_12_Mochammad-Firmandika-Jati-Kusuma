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

            //----------------------------------------------------Jobsheet 3 - Migration--------------------------------------------------------------------
            $user = UserModel::findOrFail(1);
            return view('user', ['data' => $user]);
    }
}        