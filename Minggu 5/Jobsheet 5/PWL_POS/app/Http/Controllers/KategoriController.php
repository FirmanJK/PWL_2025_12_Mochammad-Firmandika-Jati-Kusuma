<?php
namespace App\Http\Controllers;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use App\DataTables\KategoriDataTable;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable)
    {
        return $dataTable->render('kategori.index');
    }

    public function create() 
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        KategoriModel::create([
            'kategori_kode' => $request->kodeKategori,
            'kategori_nama' => $request->namaKategori,
        ]);
        return redirect('/kategori');
    }
    public function edit($id) {
        $kategori = KategoriModel::find($id);
        return view('kategori.edit', compact ('kategori'));
    }
    
    public function update(Request $request, $id) {
        $request->validate([
            'kodeKategori' => 'required',
            'namaKategori' => 'required',
        ]);
    
        $kategori = KategoriModel::firstOrFail($id);
        $kategori->update([
            'kategori_kode' => $request->kodeKategori,
            'kategori_nama' => $request->namaKategori,
        ]);
    
        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil diperbarui!');
    }
    
}

//namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;

//class KategoriController extends Controller
//{
    //public function index()
    //{
        /*$data = [
            'kategori_kode' => 'SNK',
            'kategori_nama' => 'Snack/Makanan Ringan',
            'created_at' => now()
        ];*/
        //DB::table('m_kategori')->insert($data);
        //return 'Insert data baru berhasil';

        //$row = DB::table('m_kategori')->where('kategori_kode', 'SNK') -> delete();
        //return 'Delete data berhasil. Jumlah data yang dihapus: '. $row. ' baris';

        //$data = DB::table('m_kategori')->get();
        //return view('kategori', ['data' => $data]);
    //}
//}
