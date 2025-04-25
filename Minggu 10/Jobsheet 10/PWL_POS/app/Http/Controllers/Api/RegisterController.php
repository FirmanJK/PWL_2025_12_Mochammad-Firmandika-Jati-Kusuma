<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:20|unique:m_user',
            'password' => 'required|string|min:5|confirmed',
            'nama' => 'required|string|max:100',
            'level_id' => 'required|integer|exists:m_level,level_id',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(), 422);
        }

        $user = UserModel::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'nama' => $request->nama,
            'level_id' => $request->level_id,
        ]);

        if($user){
            return response()->json([
                'succes' => true,
                'user' => $user,
            ], 201);
        }

        return response()->json([
            'succes' => false,
        ], 409);
    }
}