<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\KategoriModel;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    public function index(){
        return KategoriModel::all();
    }

    public function store(request $request){
        $kategori = KategoriModel::create($request->all());
        return response()->json($kategori,201);
    }

    public function show(KategoriModel $kategori)
    {
        return KategoriModel::find($kategori);
    }

    public function update(Request $request, KategoriModel $kategori)
    {
        $kategori->update($request->all());
        return KategoriModel::find($kategori);
    }

    public function destroy(KategoriModel $kategori)
    {
        $kategori->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data terhapus',
        ]);
    }
}