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
        // Validasi input sebelum menyimpan
        $request->validate([
            'kategoriKode' => 'required|unique:m_kategori,kategori_kode',
            'kategoriNama' => 'required',
        ]);

        // Simpan data ke tabel
        KategoriModel::create([
            'kategori_kode' => $request->kategoriKode,
            'kategori_nama' => $request->kategoriNama,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id) 
    {
        // Ambil data kategori berdasarkan ID
        $kategori = KategoriModel::findOrFail($id);

        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id) 
    {
        // Validasi input
        $request->validate([
            'kategoriKode' => 'required|unique:m_kategori,kategori_kode,' . $id . ',kategori_id',
            'kategoriNama' => 'required',
        ]);

        // Ambil data kategori berdasarkan ID
        $kategori = KategoriModel::findOrFail($id);

        // Update data kategori
        $kategori->update([
            'kategori_kode' => $request->kategoriKode,
            'kategori_nama' => $request->kategoriNama,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect('/kategori')
        ->with('success', 'Kategori berhasil diperbarui!');

    }

    public function destroy($id) 
    {
        // Hapus data kategori berdasarkan ID
        KategoriModel::destroy($id);

        // Redirect ke halaman index dengan pesan sukses
        return redirect('/kategori')
        ->with('success', 'Kategori berhasil dihapus!');
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
