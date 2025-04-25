<?php

namespace App\Http\Controllers;

use App\Models\StokModel;
use App\Models\UserModel;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use App\Models\SupplierModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class StokController extends Controller
{
    public function index(){
        //=======================================================================================Jobsheet 3 Praktikum 4========================================================================================
        // DB::insert('insert into t_stok(barang_id, user_id, supplier_id, stok_tanggal, stok_jumlah, created_at) values(?, ?, ?, ?, ?, ?)', [11, 1, 1, now(), 100, now()]);
        // return 'Insert data baru berhasil';

        // $row = DB::update('update t_stok set stok_jumlah = ? where stok_id = ?', [150, 11]);
        // return 'Update data berhasil, jumlah data yang diupdate: '.$row. ' baris';

        // $row = DB::delete('delete from t_stok where stok_id = ?', [11]);
        // return 'Delete data berhasil, jumlah data yang dihapus: '.$row. ' baris';

        // $data = DB::select('select * from t_stok');
        // return view('stok', ['data' => $data]);

         //=======================================================================================Jobsheet 3 Praktikum 5=========================================================================================
        // $data = [
        //     'barang_id' => '11',
        //     'user_id' => '1',
        //     'supplier_id' => '1',
        //     'stok_tanggal' => now(),
        //     'stok_jumlah' => '100',
        //     'created_at' => now()
        // ];

        // DB::table('t_stok')->insert($data);
        // return 'Insert data baru berhasil';

        // $row = DB::table('t_stok')->where('stok_id', '11')->update(['stok_jumlah' => '150']);
        // return 'Update data berhasil, jumlah data yang diupdate: '.$row. ' baris';

        // $row = DB::table('t_stok')->where('stok_id', '11')->delete();
        // return 'Delete data berhasil, jumlah data yang dihapus: '.$row. ' baris';

        // $data = DB::table('t_stok')->get();
        // return view('stok', ['data' => $data]);

       //=======================================================================================Jobsheet 3 Praktikum 6===========================================================================================
        // $data = [
        //     'barang_id' => '11',
        //     'user_id' => '1',
        //     'supplier_id' => '1',
        //     'stok_tanggal' => now(),
        //     'stok_jumlah' => '100',
        //     'created_at' => now()
        // ];

        // StokModel::insert($data);

        // $data =[
        //     'stok_jumlah' => '150'
        // ];

        // StokModel::where('stok_id', '11')->update($data);

        // $stok = StokModel::all();

        //=======================================================================================Jobsheet 4 Praktikum 1============================================================================================
        // $data = [
        //     'barang_id' => '12',
        //     'user_id' => '1',
        //     'supplier_id' => '3',
        //     'stok_tanggal' => now(),
        //     'stok_jumlah' => '60'
        // ];
        // StokModel::create($data);

        // $data = [
        //     'barang_id' => '13',
        //     'user_id' => '1',
        //     'supplier_id' => '2',
        //     'stok_tanggal' => now(),
        //     'stok_jumlah' => '45'
        // ];
        // StokModel::create($data);

        // $stok = StokModel::all();
        // return view('stok', ['data' => $stok]);

        //========================================================================================Jobsheet 4 Praktikum 2.6============================================================================================
        // $stok = StokModel::with('barang', 'user', 'supplier')->get();
        // return view('stok', ['data' => $stok]);

        //===========================================================================================Jobsheet 5=====================================================================================================
        $breadcrumb = (object) [
            'title' => 'Daftar Stock Barang',
            'list' => ['Home', 'Stock Barang']
        ];

        $page = (object) [
            'title' => 'Daftar stock barang yang terdaftar dalam sistem'
        ];

        $barang = BarangModel::select('barang_id', 'barang_nama')->get();
        $user = UserModel::select('user_id', 'username')->get();
        $supplier = SupplierModel::select('supplier_id', 'supplier_nama')->get();

        $activeMenu = 'stok'; // set menu yang sedang aktif

        return view('stok.index', ['breadcrumb' => $breadcrumb, 'barang' => $barang, 'user'=> $user, 'supplier' => $supplier, 'page' => $page,'activeMenu' => $activeMenu]);
    }

    //=======================================================================================Jobsheet 4 Praktikum 2.6============================================================================================
    public function tambah()
    {
        $barangs = BarangModel::all();
        $users  = UserModel::all();
        $suppliers = SupplierModel::all();

        return view('stok_tambah', ['barangs' => $barangs, 'users' => $users, 'suppliers' => $suppliers]);
    }

    public function tambah_simpan(Request $request)
    {
        StokModel::create([
            'barang_id'    => $request->barang_id,
            'user_id'      => $request->user_id,
            'supplier_id'  => $request->supplier_id,
            'stok_tanggal' => $request->stok_tanggal,
            'stok_jumlah'  => $request->stok_jumlah,
        ]);

        return redirect('/stok');
    }

    public function ubah($id)
    {
        $stok = StokModel::find($id);
        $barangs = BarangModel::all();
        $users  = UserModel::all();
        $suppliers = SupplierModel::all();
        return view('stok_ubah', ['data' => $stok, 'barangs' => $barangs, 'users' => $users, 'suppliers' => $suppliers]);
    }

    public function ubah_simpan($id, Request $request)
    {
        $stok = StokModel::find($id);

        $stok->barang_id    = $request->barang_id;
        $stok->user_id      = $request->user_id;
        $stok->stok_tanggal = $request->stok_tanggal;
        $stok->stok_jumlah  = $request->stok_jumlah;

        $stok->save();

        return redirect('/stok');
    }

    public function hapus($id)
    {
        $stok = StokModel::find($id);
        $stok->delete();

        return redirect('/stok');
    }
    //=======================================================================================================================================================================================================

    //========================================================================================Jobsheet 5=====================================================================================================

    public function list(Request $request){
        $stoks = StokModel::select('stok_id', 'barang_id', 'user_id', 'supplier_id', 'stok_tanggal', 'stok_jumlah')
        ->with(['barang', 'user', 'supplier']);

        $barang_id = $request->input('barang_id');
        if (!empty($barang_id)) {
            $stoks->where('barang_id', $barang_id);
        }

        $user_id = $request->input('user_id');
        if (!empty($user_id)) {
            $stoks->where('user_id', $user_id);
        }

        $supplier_id = $request->input('supplier_id');
        if (!empty($supplier_id)) {
            $stoks->where('supplier_id', $supplier_id);
        }

        return DataTables::of($stoks)

        ->addIndexColumn() // menambahkan kolom index / no urut (default user_id kolom:DT_RowIndex)
        ->addColumn('aksi', function ($stoks) { // menambahkan kolom aksi
            // $btn = '<a href="'.url('/stok/' . $stoks->stok_id).'" class="btn btn-info btnsm">Detail</a> ';
            // $btn .= '<a href="'.url('/stok/' . $stoks->stok_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
            // $btn .= '<form class="d-inline-block" method="POST" action="'. url('/stok/'.$stoks->stok_id).'">'
            // . csrf_field() . method_field('DELETE') .
            // '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
            $btn = '<button onclick="modalAction(\'' . url('/stok/' . $stoks->stok_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/stok/' . $stoks->stok_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/stok/' . $stoks->stok_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';

            return $btn;
        })->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Stok Barang',
            'list' => ['Home', 'Stock Barang', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah stock baru'
        ];

        $activeMenu = 'stok';
        $barang = BarangModel::all();
        $user = UserModel::all();
        $supplier = SupplierModel::all();

        return view('stok.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'user' => $user, 'supplier' => $supplier, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|integer',
            'user_id' => 'required|integer',
            'supplier_id' => 'required|integer',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer|min:1',
        ]);

        StokModel::create([
            'barang_id' => $request->barang_id,
            'user_id' => $request->user_id,
            'supplier_id' => $request->supplier_id,
            'stok_tanggal' => $request->stok_tanggal,
            'stok_jumlah' => $request->stok_jumlah,
        ]);

        return redirect('/stok')->with('success', 'Data stok berhasil disimpan');
    }

    // Menampilkan detail stok
    public function show(string $id)
    {
        $stok = StokModel::with('barang', 'user', 'supplier')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Stok Barang',
            'list' => ['Home', 'stok barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail stok barang'
        ];

        $activeMenu = 'stok';

        return view('stok.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stok' => $stok, 'activeMenu' => $activeMenu]);
    }

    // Menampilkan halaman form edit stok
    public function edit(string $id)
    {
        $stok = stokModel::find($id);
        $barang = BarangModel::all();
        $user = UserModel::all();
        $supplier = SupplierModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Stok Barang',
            'list' => ['Home', 'stok barang', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit stok barang'
        ];


        $activeMenu = 'stok';

        return view('stok.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stok' => $stok, 'barang' => $barang, 'user' => $user, 'supplier' => $supplier, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan perubahan data stok
    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_id' => 'required|integer',
            'user_id' => 'required|integer',
            'supplier_id' => 'required|integer',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer|min:1',
        ]);


        stokModel::find($id)->update([
            'barang_id' => $request->barang_id,
            'user_id' => $request->user_id,
            'supplier_id' => $request->supplier_id,
            'stok_tanggal' => $request->stok_tanggal,
            'stok_jumlah' => $request->stok_jumlah,
        ]);

        return redirect('/stok')->with('success', 'Data stok berhasil diperbarui');
    }


    // Menghapus data stok
    public function destroy(string $id)
    {
        $check = stokModel::find($id);
        if (!$check) {
            return redirect('/stok')->with('error', 'Data stok tidak ditemukan');
        }

        try {
            stokModel::destroy($id);
            return redirect('/stok')->with('success', 'Data stok berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/stok')->with('error', 'Data stok gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
    //=======================================================================================================================================================================================================

    //========================================================================================Jobsheet 6=====================================================================================================
    public function create_ajax()
    {
        $barang = BarangModel::select('barang_id', 'barang_nama')->get();
        $user = UserModel::select('user_id', 'username')->get();
        $supplier = SupplierModel::select('supplier_id', 'supplier_nama')->get(); // Ambil data supplier

        return view('stok.create_ajax', [
            'barang' => $barang,
            'user' => $user,
            'supplier' => $supplier
        ]);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                'barang_id'    => ['required', 'integer', 'exists:m_barang,barang_id'],
                'supplier_id'  => ['required', 'integer', 'exists:m_supplier,supplier_id'],
                'stok_tanggal' => ['required', 'date'],
                'stok_jumlah'  => ['required', 'integer', 'min:1'],
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,
                    'message'  => 'Validasi gagal.',
                    'msgField' => $validator->errors(),
                ]);
            }

            DB::beginTransaction(); // Mulai transaksi database

            try {

                $data = $request->all();
                $data['user_id'] = auth()->id();

                StokModel::create($data);


                BarangModel::where('barang_id', $request->barang_id)
                    ->increment('barang_stok', $request->stok_jumlah);

                DB::commit(); // Commit transaksi jika berhasil

                return response()->json([
                    'status'  => true,
                    'message' => 'Data stok berhasil disimpan.',
                ]);

            } catch (\Exception $e) {
                DB::rollBack(); // Rollback transaksi jika terjadi error

                return response()->json([
                    'status'  => false,
                    'message' => 'Gagal menyimpan data: ' . $e->getMessage(),
                ]);
            }
        }

        return redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $stok = StokModel::find($id);
        $barang = BarangModel::select('barang_id', 'barang_nama')->get();
        $user = UserModel::select('user_id', 'nama')->get();
        $supplier = SupplierModel::select('supplier_id', 'supplier_nama')->get(); // Ambil daftar supplier

        return view('stok.edit_ajax', [
            'stok' => $stok,
            'barang' => $barang,
            'user' => $user,
            'supplier' => $supplier,
        ]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'barang_id'    => ['required', 'integer', 'exists:m_barang,barang_id'],
                'user_id'      => ['required', 'integer', 'exists:m_user,user_id'],
                'supplier_id'  => ['required', 'integer', 'exists:m_supplier,supplier_id'],
                'stok_tanggal' => ['required', 'date'],
                'stok_jumlah'  => ['required', 'integer', 'min:1'],
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,
                    'message'  => 'Validasi gagal.',
                    'msgField' => $validator->errors(),
                ]);
            }

            DB::beginTransaction(); // Mulai transaksi

            try {
                $stok = StokModel::find($id);

                if (!$stok) {
                    return response()->json([
                        'status'  => false,
                        'message' => 'Data tidak ditemukan.',
                    ]);
                }

                // Simpan nilai stok lama sebelum diupdate
                $oldStokJumlah = $stok->stok_jumlah;

                $stok->update($request->all());

                $diff = $request->stok_jumlah - $oldStokJumlah;

                // Update stok barang hanya jika ada perubahan jumlah
                if ($diff != 0) {
                    BarangModel::where('barang_id', $request->barang_id)
                        ->increment('barang_stok', $diff);
                }

                DB::commit(); // Commit transaksi

                return response()->json([
                    'status'  => true,
                    'message' => 'Data stok berhasil diupdate.',
                ]);

            } catch (\Exception $e) {
                DB::rollBack(); // Rollback ketika error

                return response()->json([
                    'status'  => false,
                    'message' => 'Gagal mengupdate data: ' . $e->getMessage(),
                ]);
            }
        }

        return redirect('/');
    }
    public function confirm_ajax(string $id)
    {
        $stok = StokModel::find($id);

        return view('stok.confirm_ajax', ['stok' => $stok]);
    }
    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $stok = StokModel::find($id);
            if ($stok) {
                try{
                    $stok->delete();
                    return response()->json([
                        'status' => true,
                        'message' => 'Data stok berhasil dihapus.',
                    ]);
                } catch(QueryException $e){
                    return response()->json([
                        'status' => false,
                        'message' => 'Data stok gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini.'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan.',
                ]);
            }
        }

        return redirect('/');
    }

    public function show_ajax(string $id){
        $stok = StokModel::with(['user', 'barang', 'supplier'])->find($id);

        return view('stok.show_ajax', ['stok' => $stok]);
    }

    public function import(){
        return view('stok.import');
    }

    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                // Validasi file harus xlsx, maksimal 1MB
                'file_stok' => ['required', 'mimes:xlsx', 'max:1024']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,
                    'message'  => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            // Ambil file dari request
            $file = $request->file('file_stok');

            // Membuat reader untuk file excel dengan format Xlsx
            $reader = IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(true); // Hanya membaca data saja

            $path = $file->getPathname();
            $spreadsheet = $reader->load($path);
            $sheet = $spreadsheet->getActiveSheet();

            // Ambil data excel sebagai array
            $data = $sheet->toArray(null, false, true, true);
            $insert = [];
            $barangIds   = [];
             if (count($data) > 1) { // Jika data lebih dari 1 baris
                foreach ($data as $baris => $value) {
                    if ($baris > 1) { // Baris ke-1 adalah header, maka lewati

                        $tanggal_masuk = is_numeric($value['D'])
                        ? Date::excelToDateTimeObject($value['D'])->format('Y-m-d')
                        : date('Y-m-d', strtotime($value['D']));


                        $insert[] = [
                            'barang_id'           => $value['A'],
                            'user_id'             => $value['B'],
                            'supplier_id'         => $value['C'],
                            'stok_tanggal'  => $tanggal_masuk,
                            'stok_jumlah'         => $value['E'],
                            'created_at'           => now(),
                        ];
                        $barangIds[] = $value['A'];
                    }
                }

                if (count($insert) > 0) {
                    // Insert data ke database, jika data sudah ada, maka diabaikan
                    StokModel::insertOrIgnore($insert);

                    $uniqueBarang = array_unique($barangIds);
                    foreach ($uniqueBarang as $barang_id) {
                        $stokTambahan = 0;
                        foreach ($insert as $row) {
                            if ($row['barang_id'] == $barang_id) {
                                $stokTambahan += $row['stok_jumlah'];
                            }
                        }

                        BarangModel::where('barang_id', $barang_id)
                                ->increment('barang_stok', $stokTambahan);
                    }
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
        //Ambil value stok yang akan diexport
        $stok = StokModel::select(
            'barang_id',
            'user_id',
            'supplier_id',
            'stok_tanggal',
            'stok_jumlah'
        )
        ->orderBy('stok_id')
        ->with(['barang', 'user', 'supplier'])
        ->get();

        //load library excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet(); //ambil sheet aktif

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Barang');
        $sheet->setCellValue('C1', 'Nama User');
        $sheet->setCellValue('D1', 'Nama Supplier');
        $sheet->setCellValue('E1', 'Tanggal Stok');
        $sheet->setCellValue('F1', 'Jumlah Stok');

        $sheet->getStyle('A1:F1')->getFont()->setBold(true); // Set header bold

        $no = 1; //Nomor value dimulai dari 1
        $baris = 2; //Baris value dimulai dari 2
        foreach ($stok as $key => $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->barang->barang_nama);
            $sheet->setCellValue('C' . $baris, $value->user->nama);
            $sheet->setCellValue('D' . $baris, $value->supplier->supplier_nama);
            $sheet->setCellValue('E' . $baris, $value->stok_tanggal);
            $sheet->setCellValue('F' . $baris, $value->stok_jumlah);
            $no++;
            $baris++;
        }

        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true); //set auto size untuk kolom
        }

        $sheet->setTitle('Data Stock Barang'); //set judul sheet
        $writer = IOFactory ::createWriter($spreadsheet, 'Xlsx'); //set writer
        $filename = 'Data_Stock_Barang_' . date('Y-m-d_H-i-s') . '.xlsx'; //set nama file

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
        $stok = StokModel::select(
            'barang_id',
            'user_id',
            'supplier_id',
            'stok_tanggal',
            'stok_jumlah'
        )
        ->orderBy('barang_id')
        ->orderBy('stok_tanggal')
        ->with(['barang', 'user', 'supplier'])
        ->get();

        // use Barryvdh\DomPDF\Facade\Pdf;
        $pdf = PDF::loadView('stok.export_pdf', ['stok' => $stok]);
        $pdf->setPaper('A4', 'portrait'); // set ukuran kertas dan orientasi
        $pdf->setOption("isRemoteEnabled", true); // set true jika ada gambar dari url
        $pdf->render(); // render pdf

        return $pdf->stream('Data Stock Barang '.date('Y-m-d H-i-s').'.pdf');
    }
}