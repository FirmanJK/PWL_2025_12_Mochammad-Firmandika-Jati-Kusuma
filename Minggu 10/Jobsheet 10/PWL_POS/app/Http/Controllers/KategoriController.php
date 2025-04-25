<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class KategoriController extends Controller
{
    public function index(){
        //=======================================================================================Jobsheet 3 Praktikum 4========================================================================================
        // DB::insert('insert into m_kategori(kategori_kode, kategori_nama, deskripsi, created_at) values(?, ?, ?, ?)', ['ADP', 'Alat Dapur', 'Kategori peralatan dapur', now()]);
        // return 'Insert data baru berhasil';

        // $row = DB::update('update m_kategori set kategori_nama = ? where kategori_kode = ?', ['Peralatan Dapur', 'ADP']);
        // return 'Update data berhasil, jumlah data yang diupdate: '.$row. ' baris';

        // $row = DB::delete('delete from m_kategori where kategori_kode = ?', ['ADP']);
        // return 'Delete data berhasil, jumlah data yang dihapus: '.$row. ' baris';

        // $data = DB::select('select * from m_kategori');
        // return view('kategori', ['data' => $data]);

        //=======================================================================================Jobsheet 3 Praktikum 5=========================================================================================
        // $data = [
        //     'kategori_kode' => 'SNK',
        //     'kategori_nama' => 'Snack/Makanan Ringan',
        //     'created_at' => now()
        // ];

        // DB::table('m_kategori')->insert($data);
        // return 'Insert data baru berhasil';

        // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->update(['kategori_nama' => 'Camilan']);
        // return 'Update data berhasil, jumlah data yang diupdate: '.$row. ' baris';

        // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->delete();
        // return 'Delete data berhasil, jumlah data yang dihapus: '.$row. ' baris';

        // $data = DB::table('m_kategori')->get();
        // return view('kategori', ['data' => $data]);

        //=======================================================================================Jobsheet 3 Praktikum 6===========================================================================================
        // $data = [
        //     'kategori_kode' => 'SNK',
        //     'kategori_nama' => 'Snack/Makanan Ringan',
        //     'created_at' => now()
        // ];

        // KategoriModel::insert($data);

        // $data =[
        //     'kategori_nama' => 'Camilan'
        // ];

        // KategoriModel::where('kategori_kode', 'SNK')->update($data);

        // $kategori = KategoriModel::all();
        // return view('kategori', ['data' => $kategori]);

        //=======================================================================================Jobsheet 4 Praktikum 1============================================================================================
        // $data = [
        //     'kategori_kode' => 'OTM',
        //     'kategori_nama' => 'Otomotif',
        //     'deskripsi' => 'Kategori untuk barang otomotif',
        // ];
        // KategoriModel::create($data);

        // $data = [
        //     'kategori_kode' => 'ATL',
        //     'kategori_nama' => 'Alat Tulis',
        //     'deskripsi' => 'Kategori untuk peralatan tulis',
        // ];
        // KategoriModel::create($data);

        // $kategori = KategoriModel::all();
        // return view('kategori', ['data' => $kategori]);

        //========================================================================================Jobsheet 4 Praktikum 2.6============================================================================================
        // $kategori = KategoriModel::all();
        // return view('kategori', ['data' => $kategori]);

        //===========================================================================================Jobsheet 5=======================================================================================================
        $breadcrumb = (object) [
            'title' => 'Daftar Kategori Barang',
            'list' => ['Home', 'Kategori']
        ];

        $page = (object) [
            'title' => 'Daftar kategori barang yang terdaftar dalam sistem'
        ];


        $activeMenu = 'kategori'; // set menu yang sedang aktif

        return view('kategori.index', ['breadcrumb' => $breadcrumb, 'page' => $page,'activeMenu' => $activeMenu]);
    }

    //========================================================================================Jobsheet 4 Praktikum 2.6============================================================================================
    public function tambah()
    {
        return view('kategori_tambah');
    }

    public function tambah_simpan(Request $request)
    {
        KategoriModel::create([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect('/kategori');
    }

    public function ubah($id)
    {
        $kategori = KategoriModel::find($id);
        return view('kategori_ubah', ['data' => $kategori]);
    }

    public function ubah_simpan($id, Request $request)
    {
        $kategori = KategoriModel::find($id);

        $kategori->kategori_kode = $request->kategori_kode;
        $kategori->kategori_nama = $request->kategori_nama;
        $kategori->deskripsi = $request->deskripsi;

        $kategori->save();

        return redirect('/kategori');
    }

    public function hapus($id)
    {
        $kategori = KategoriModel::find($id);
        $kategori->delete();

        return redirect('/kategori');
    }
    //=============================================================================================================================================================================================================

    //========================================================================================Jobsheet 5=======================================================================================================
    public function list(){
        $kategoris = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');


        return DataTables::of($kategoris)

            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategoris) { // menambahkan kolom aksi

                // $btn = '<a href="'.url('/kategori/' . $kategoris->kategori_id).'" class="btn btn-info btnsm">Detail</a> ';
                // $btn .= '<a href="'.url('/kategori/' . $kategoris->kategori_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
                // $btn .= '<form class="d-inline-block" method="POST" action="'.url('/kategori/'.$kategoris->kategori_id).'">'
                //     . csrf_field() . method_field('DELETE') .
                //     '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
                $btn = '<button onclick="modalAction(\'' . url('/kategori/' . $kategoris->kategori_id .
                    '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kategori/' . $kategoris->kategori_id .
                    '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kategori/' . $kategoris->kategori_id .
                    '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Kategori',
            'list' => ['Home', 'Kategori', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah kategori baru'
        ];

        $activeMenu = 'kategori'; // set menu yang sedang aktif

        return view('kategori.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_kode' => 'required|string|max:10|unique:m_kategori,kategori_kode',
            'kategori_nama' => 'required|string|max:100',
            'deskripsi' => 'required|string|max:255'
        ]);

        KategoriModel::create([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect('/kategori')->with('success', 'Data kategori berhasil disimpan');
    }

    public function show(string $id)
    {
        $kategori = KategoriModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Kategori',
            'list' => ['Home', 'Kategori', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail kategori'
        ];

        $activeMenu = 'kategori'; // set menu yang sedang aktif

        return view('kategori.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $kategori = KategoriModel::find($id);


        $breadcrumb = (object) [
            'title' => 'Edit Kategori',
            'list' => ['Home', 'Kategori', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit kategori'
        ];

        $activeMenu = 'kategori'; // set menu yang sedang aktif

        return view('kategori.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori_kode' => 'required|string|max:10|unique:m_kategori,kategori_kode,'.$id.',kategori_id',
            'kategori_nama' => 'required|string|max:100',
            'deskripsi' => 'required|string|max:255'
        ]);

        KategoriModel::find($id)->update([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect('/kategori')->with('success', 'Data kategori berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = KategoriModel::find($id);
        if (!$check) {
            return redirect('/kategori')->with('error', 'Data kategori tidak ditemukan');
        }

        try {
            KategoriModel::destroy($id);
            return redirect('/kategori')->with('success', 'Data kategori berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/kategori')->with('error', 'Data kategori gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
    //=========================================================================================================================================================================================================

    //========================================================================================Jobsheet 6=======================================================================================================
    public function create_ajax()
    {
        return view('kategori.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        // cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kategori_kode' => ['required', 'string', 'max:10', 'unique:m_kategori,kategori_kode'],
                'kategori_nama' => ['required', 'string', 'max:100'],
                'deskripsi'     => ['required', 'string', 'max:255']
            ];



            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // response status, false: error/gagal, true: berhasil
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors() // pesan error validasi
                ]);
            }

            KategoriModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data kategori berhasil disimpan'
            ]);
        }

        redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $kategori = KategoriModel::find($id);
        return view('kategori.edit_ajax', ['kategori' => $kategori]);
    }

    public function update_ajax(Request $request, string $id)
    {
        // cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kategori_kode' => ['required', 'string', 'max:10', 'unique:m_kategori,kategori_kode,'.$id.',kategori_id'],
                'kategori_nama' => ['required', 'string', 'max:100'],
                'deskripsi'     => ['required', 'string', 'max:255']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // response status, false: error/gagal, true: berhasil
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors() // pesan error validasi
                ]);
            }

            $kategori = KategoriModel::find($id);

            if ($kategori) {
                $kategori->update($request->all());

                return response()->json([
                    'status'  => true,
                    'message' => 'Data kategori berhasil diupdate.',
                ]);
            }

            return response()->json([
                'status'  => false,
                'message' => 'Data tidak ditemukan.',
            ]);
        }

        redirect('/');
    }

    public function confirm_ajax(string $id) {
        $kategori = KategoriModel::find($id);

        return view('kategori.confirm_ajax', ['kategori' => $kategori]);
    }

    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
                $kategori = KategoriModel::find($id);
                if ($kategori) {
                    try{
                        $kategori->delete();
                        return response()->json([
                            'status' => true,
                            'message' => 'Data berhasil dihapus'
                        ]);
                    } catch(QueryException $e) {
                        return response()->json([
                            'status' => false,
                            'message' => 'Data kategori gagal dihapus, karena masih ada data lain yang terkait'
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Data tidak ditemukan'
                    ]);
                }
        }

        return redirect('/');
    }

    public function show_ajax(string $id){
        $kategori = KategoriModel::find($id);

        return view('kategori.show_ajax', ['kategori' => $kategori]);
    }

    public function import(){
        return view('kategori.import');
    }

    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                'file_kategori' => ['required', 'mimes:xlsx', 'max:1024']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,
                    'message'  => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $file = $request->file('file_kategori');

            $reader = IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(true);

            $path = $file->getPathname();
            $spreadsheet = $reader->load($path);
            $sheet = $spreadsheet->getActiveSheet();

            $data = $sheet->toArray(null, false, true, true);
            $insert = [];

            if (count($data) > 1) {
                foreach ($data as $baris => $value) {
                    if ($baris > 1) {
                        $insert[] = [
                            'kategori_kode' => $value['A'],
                            'kategori_nama' => $value['B'],
                            'deskripsi'     => $value['C'],
                            'created_at'  => now(),
                        ];
                    }
                }

                if (count($insert) > 0) {
                    KategoriModel::insertOrIgnore($insert);
                }

                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil diimport'
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Tidak ada data yang diimport'
                ]);
            }
        }

        return redirect('/');
    }

    public function export_excel()
    {
        //Ambil value kategori yang akan diexport
        $kategori = KategoriModel::select(
            'kategori_kode',
            'kategori_nama',
            'deskripsi'
        )
        ->orderBy('kategori_id')
        ->get();

        //load library excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet(); //ambil sheet aktif

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode Kategori');
        $sheet->setCellValue('C1', 'Nama Kategori');
        $sheet->setCellValue('D1', 'Deskripsi Kategori');

        $sheet->getStyle('A1:D1')->getFont()->setBold(true); // Set header bold

        $no = 1; //Nomor value dimulai dari 1
        $baris = 2; //Baris value dimulai dari 2
        foreach ($kategori as $key => $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->kategori_kode);
            $sheet->setCellValue('C' . $baris, $value->kategori_nama);
            $sheet->setCellValue('D' . $baris, $value->deskripsi);
            $no++;
            $baris++;
        }

        foreach (range('A', 'D') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true); //set auto size untuk kolom
        }

        $sheet->setTitle('Data kategori'); //set judul sheet
        $writer = IOFactory ::createWriter($spreadsheet, 'Xlsx'); //set writer
        $filename = 'Data_kategori_' . date('Y-m-d_H-i-s') . '.xlsx'; //set nama file

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $writer->save('php://output'); //simpan file ke output
        exit; //keluar dari scriptA
    }

    public function export_pdf(){
        $kategori = KategoriModel::select(
            'kategori_kode',
            'kategori_nama',
            'deskripsi'
        )
        ->orderBy('kategori_id')
        ->orderBy('kategori_kode')
        ->get();

        // use Barryvdh\DomPDF\Facade\Pdf;
        $pdf = PDF::loadView('kategori.export_pdf', ['kategori' => $kategori]);
        $pdf->setPaper('A4', 'portrait'); // set ukuran kertas dan orientasi
        $pdf->setOption("isRemoteEnabled", true); // set true jika ada gambar dari url
        $pdf->render(); // render pdf

        return $pdf->stream('Data Kategori Barang '.date('Y-m-d H-i-s').'.pdf');
    }
}