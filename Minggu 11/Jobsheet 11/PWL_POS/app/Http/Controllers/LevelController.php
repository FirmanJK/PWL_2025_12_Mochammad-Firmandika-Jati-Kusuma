<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class LevelController extends Controller
{
    public function index()
    {
        //=======================================================================================Jobsheet 3 Praktikum 4========================================================================================
        // DB::insert('insert into m_level(level_kode, level_nama, created_at) values(?, ?, ?)', ['CUS', 'Pelanggan', now()]); //menambahkan data baru ke tabel m_level menggunakan query parameter
        // return 'Insert data baru berhasil';

        // $row = DB::update('update m_level set level_nama = ? where level_kode = ?', ['Customer', 'CUS']); // Melakukan update ke data yang memiliki level kode CUS dengan nilai baru yaitu Customer
        // return 'Update data berhasil, jumlah data yang diupdate: '.$row. ' baris';

        // $row = DB::delete('delete from m_level where level_kode = ?', ['CUS']); // Menghapus data yang memiliki level kode CUS
        // return 'Delete data berhasil, jumlah data yang dihapus: '.$row. ' baris';

        // $data = DB::select('select * from m_level'); // Mengambil semua data dari tabel m_level
        // return view('level', ['data' => $data]);

        //=======================================================================================Jobsheet 3 Praktikum 5=========================================================================================
        // $data = [
        //     'level_kode' => 'CUS',
        //     'level_nama' => 'Customer',
        //     'created_at' => now()
        // ];

        // DB::table('m_level')->insert($data);
        // return 'Insert data baru berhasil';

        // $row = DB::table('m_level')->where('level_kode', 'CUS')->update(['level_nama' => 'Pelanggan']);
        // return 'Update data berhasil, jumlah data yang diupdate: '.$row. ' baris';

        // $row = DB::table('m_level')->where('level_kode', 'CUS')->delete();
        // return 'Delete data berhasil, jumlah data yang dihapus: '.$row. ' baris';

        // $data = DB::table('m_level')->get();
        // return view('level', ['data' => $data]);

        //=======================================================================================Jobsheet 3 Praktikum 6===========================================================================================
        // $data = [
        //     'level_kode' => 'CUS',
        //     'level_nama' => 'Customer',
        //     'created_at' => now()
        // ];

        // LevelModel::insert($data);

        // $data =[
        //     'level_nama' => 'Pelanggan'
        // ];

        // LevelModel::where('level_kode', 'CUS')->update($data);

        // $level = LevelModel::all();
        // return view('level', ['data' => $level]);

        //=======================================================================================Jobsheet 4 Praktikum 1============================================================================================
        // $data = [
        //     'level_kode' => 'LDR',
        //     'level_nama' => 'Leader'
        // ];
        // LevelModel::create($data);

        // $data = [
        //     'level_kode' => 'HRD',
        //     'level_nama' => 'Human Resource Development'
        // ];
        // LevelModel::create($data);

        // $level = LevelModel::all();
        // return view('level', ['data' => $level]);

        //========================================================================================Jobsheet 4 Praktikum 2.6============================================================================================
        // $level = LevelModel::all();
        // return view('level', ['data' => $level]);

        //==============================================================================================Jobsheet 5================================================================================================
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level']
        ];

        $page = (object) [
            'title' => 'Daftar level yang terdaftar dalam sistem'
        ];


        $activeMenu = 'level'; // set menu yang sedang aktif

        return view('level.index', ['breadcrumb' => $breadcrumb, 'page' => $page,'activeMenu' => $activeMenu]);
    }

    //=======================================================================================Jobsheet 4 Praktikum 2.6============================================================================================
    public function tambah()
    {
        return view('level_tambah');
    }

    public function tambah_simpan(Request $request)
    {
        LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return redirect('/level');
    }

    public function ubah($id)
    {
        $level = LevelModel::find($id);
        return view('level_ubah', ['data' => $level]);
    }

    public function ubah_simpan($id, Request $request)
    {
        $level = LevelModel::find($id);

        $level->level_kode = $request->level_kode;
        $level->level_nama = $request->level_nama;

        $level->save();

        return redirect('/level');
    }

    public function hapus($id)
    {
        $level = LevelModel::find($id);
        $level->delete();

        return redirect('/level');
    }
    //==================================================================================================================================================================================================================

    //========================================================================================Jobsheet 5 Praktikum 3==============================================================================================
    public function list(){
        $levels = LevelModel::select('level_id', 'level_kode', 'level_nama');


        return DataTables::of($levels)

            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('aksi', function ($levels) { // menambahkan kolom aksi

                // $btn = '<a href="'.url('/level/' . $levels->level_id).'" class="btn btn-info btnsm">Detail</a> ';
                // $btn .= '<a href="'.url('/level/' . $levels->level_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
                // $btn .= '<form class="d-inline-block" method="POST" action="'.url('/level/'.$levels->level_id).'">'
                //     . csrf_field() . method_field('DELETE') .
                //     '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
                $btn = '<button onclick="modalAction(\'' . url('/level/' . $levels->level_id .
                    '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/level/' . $levels->level_id .
                    '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/level/' . $levels->level_id .
                    '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                    return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah level baru'
        ];

        $activeMenu = 'level'; // set menu yang sedang aktif

        return view('level.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'level_kode' => 'required|string|max:10|unique:m_level,level_kode',
            'level_nama' => 'required|string|max:100'
        ]);

        LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama
        ]);

        return redirect('/level')->with('success', 'Data level berhasil disimpan');
    }

    public function show(string $id)
    {
        $level = LevelModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Level',
            'list' => ['Home', 'Level', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail level'
        ];

        $activeMenu = 'level'; // set menu yang sedang aktif

        return view('level.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $level = LevelModel::find($id);


        $breadcrumb = (object) [
            'title' => 'Edit Level',
            'list' => ['Home', 'Level', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit level'
        ];

        $activeMenu = 'level'; // set menu yang sedang aktif

        return view('level.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'level_kode' => 'required|string|max:10|unique:m_level,level_kode,'.$id.',level_id',
            'level_nama' => 'required|string|max:100'
        ]);

        LevelModel::find($id)->update([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama
        ]);

        return redirect('/level')->with('success', 'Data level berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = LevelModel::find($id);
        if (!$check) {
            return redirect('/level')->with('error', 'Data level tidak ditemukan');
        }

        try {
            LevelModel::destroy($id);
            return redirect('/level')->with('success', 'Data level berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/level')->with('error', 'Data level gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
    //======================================================================================================================================================================================================

    //=========================================================================================Jobsheet 6===================================================================================================
    public function create_ajax()
    {
        return view('level.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        // cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_kode' => ['required', 'string', 'max:10', 'unique:m_level,level_kode'],
                'level_nama' => ['required', 'string', 'max:100']
            ];


            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // response status, false: error/gagal, true: berhasil
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors() // pesan error validasi
                ]);
            }

            LevelModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data level berhasil disimpan'
            ]);
        }

        redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $level = LevelModel::find($id);
        return view('level.edit_ajax', ['level' => $level]);
    }

    public function update_ajax(Request $request, string $id)
    {
        // cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_kode' => ['required', 'string', 'max:10', 'unique:m_level,level_kode,'.$id.',level_id'],
                'level_nama' => ['required', 'string', 'max:100']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // response status, false: error/gagal, true: berhasil
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors() // pesan error validasi
                ]);
            }

            LevelModel::find($id)->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data level berhasil diubah'
            ]);
        }

        redirect('/');
    }

    public function confirm_ajax(string $id) {
        $level = LevelModel::find($id);

        return view('level.confirm_ajax', ['level' => $level]);
    }


    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $level = LevelModel::find($id);
            if ($level) {
                try {
                    $level->delete();
                    return response()->json([
                        'status' => true,
                        'message' => 'Data berhasil dihapus'
                    ]);
                } catch (QueryException $e) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Data level gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini.'
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

    public function show_ajax(string $id)
    {
        $level = LevelModel::find($id);
        return view('level.show_ajax', ['level' => $level]);
    }

    public function import(){
        return view('level.import');
    }

    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                'file_level' => ['required', 'mimes:xlsx', 'max:1024']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,
                    'message'  => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $file = $request->file('file_level');

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
                            'level_kode' => $value['A'],
                            'level_nama' => $value['B'],
                            'created_at'  => now(),
                        ];
                    }
                }

                if (count($insert) > 0) {
                    LevelModel::insertOrIgnore($insert);
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
        //Ambil value barang yang akan diexport
        $level = LevelModel::select(
            'level_kode',
            'level_nama'
        )
        ->orderBy('level_id')
        ->get();

        //load library excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet(); //ambil sheet aktif

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode Level');
        $sheet->setCellValue('C1', 'Nama Level');

        $sheet->getStyle('A1:C1')->getFont()->setBold(true); // Set header bold

        $no = 1; //Nomor value dimulai dari 1
        $baris = 2; //Baris value dimulai dari 2
        foreach ($level as $key => $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->level_kode);
            $sheet->setCellValue('C' . $baris, $value->level_nama);
            $no++;
            $baris++;
        }

        foreach (range('A', 'C') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true); //set auto size untuk kolom
        }

        $sheet->setTitle('Data Level'); //set judul sheet
        $writer = IOFactory ::createWriter($spreadsheet, 'Xlsx'); //set writer
        $filename = 'Data_Level_' . date('Y-m-d_H-i-s') . '.xlsx'; //set nama file

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
        $level = LevelModel::select(
            'level_kode',
            'level_nama',
        )
        ->orderBy('level_id')
        ->orderBy('level_kode')
        ->get();

        // use Barryvdh\DomPDF\Facade\Pdf;
        $pdf = PDF::loadView('level.export_pdf', ['level' => $level]);
        $pdf->setPaper('A4', 'portrait'); // set ukuran kertas dan orientasi
        $pdf->setOption("isRemoteEnabled", true); // set true jika ada gambar dari url
        $pdf->render(); // render pdf

        return $pdf->stream('Data Level '.date('Y-m-d H-i-s').'.pdf');
    }
}