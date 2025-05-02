<?php

namespace App\Http\Controllers\Api;

use App\Models\BarangModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BarangController extends Controller
{
    public function index(){
        return BarangModel::all();
    }

    public function store(request $request){
        $barang = BarangModel::create($request->all());
        return response()->json($barang,201);
    }

    public function show(BarangModel $barang)
    {
        return BarangModel::find($barang);
    }

    public function update(Request $request, BarangModel $barang)
    {
        $barang->update($request->all());
        return BarangModel::find($barang);
    }

    public function destroy(BarangModel $barang)
    {
        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data terhapus',
        ]);
    }
}