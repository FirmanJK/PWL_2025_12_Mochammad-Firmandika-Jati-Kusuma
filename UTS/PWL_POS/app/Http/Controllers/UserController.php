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
        $user = UserModel::create([
            'username' => 'manager56',
            'name' => 'Manager55',
            'password' => Hash::make('12345'),
            'level_id' => 2,
        ]);
        
        $user->username = 'manager56';
        
        $user->isDirty(); // true
        $user->isDirty('username'); // true
        $user->isDirty('name'); // false
        $user->isDirty(['name', 'username']); // true
        
        $user->isClean(); // false
        $user->isClean('username'); // false
        $user->isClean('name'); // true
        $user->isClean(['name', 'username']); // false
        
        $user->save();
        
        $user->isDirty(); // false
        $user->isClean(); // true
        
        dd($user->isDirty());
    }
}