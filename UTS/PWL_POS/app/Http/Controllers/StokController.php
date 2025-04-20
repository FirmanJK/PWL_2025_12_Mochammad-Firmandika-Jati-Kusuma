<?php

namespace App\Http\Controllers;

use App\Models\StokModel;
use App\Models\UserModel;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use App\Models\SupplierModel;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class StokController extends Controller
{
    public function index()
    {
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

    public function list(Request $request)
    {
        $stoks = StokModel::select('stok_id', 'supplier_id', 'barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah')
            ->with(['barang', 'user', 'supplier']);
    
        if ($request->filled('barang_id')) {
            $stoks->where('barang_id', $request->barang_id);
        }
    
        if ($request->filled('user_id')) {
            $stoks->where('user_id', $request->user_id);
        }
    
        if ($request->filled('supplier_id')) {
            $stoks->where('supplier_id', $request->supplier_id);
        }
    
        return DataTables::of($stoks)
            ->addIndexColumn()
    
            // ✅ Tambahkan kolom supplier_nama (biar bisa dipanggil langsung di JS)
            ->addColumn('supplier_nama', function ($stok) {
                return $stok->supplier->supplier_nama ?? '-';
            })
    
            // ✅ (opsional) Tambahkan juga barang_nama dan user_nama untuk tampil di tabel
            ->addColumn('barang_nama', function ($stok) {
                return $stok->barang->barang_nama ?? '-';
            })
            ->addColumn('user_nama', function ($stok) {
                return $stok->user->nama ?? '-';
            })
    
            ->addColumn('aksi', function ($stok) {
                $btn = '<button onclick="modalAction(\'' . url('/stok/' . $stok->stok_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/stok/' . $stok->stok_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/stok/' . $stok->stok_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }    

    public function show_ajax(string $id)
    {
        $stok = StokModel::find($id);
        $barang = BarangModel::select('barang_id', 'barang_nama')->get();
        $user = UserModel::select('user_id', 'username')->get();
        $supplier = SupplierModel::select('supplier_id', 'supplier_nama')->get();
        return view('stok.show_ajax', ['stok' => $stok, 'barang' => $barang, 'user' => $user, 'supplier' => $supplier]);
    }

    public function create_ajax()
    {
        $barang = BarangModel::select('barang_id', 'barang_nama')->get();
        $user = UserModel::select('user_id', 'nama')->get();
        $supplier = SupplierModel::select('supplier_id', 'supplier_nama')->get(); // Ambil data supplier

        return view('stok.create_ajax', [
            'barang' => $barang,
            'user' => $user,
            'supplier' => $supplier
        ]);
    }

    // Simpan data stok baru
    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                'barang_id'    => ['required', 'integer', 'exists:m_barang,barang_id'],
                'user_id'      => ['required', 'integer', 'exists:m_user,user_id'],
                'supplier_id'  => ['required', 'integer', 'exists:m_supplier,supplier_id'], // validasi supplier
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

            StokModel::create($request->all());

            return response()->json([
                'status'  => true,
                'message' => 'Data stok berhasil disimpan.',
            ]);
        }

        return redirect('/');
    }

    // Form edit data stok
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

    // Update data stok
    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'barang_id'    => ['required', 'integer', 'exists:m_barang,barang_id'],
                'user_id'      => ['required', 'integer', 'exists:m_user,user_id'],
                'supplier_id'  => ['required', 'integer', 'exists:m_supplier,supplier_id'], // validasi supplier
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

            $stok = StokModel::find($id);
            if ($stok) {
                $stok->update($request->all());

                return response()->json([
                    'status'  => true,
                    'message' => 'Data stok berhasil diupdate.',
                ]);
            }

            return response()->json([
                'status'  => false,
                'message' => 'Data tidak ditemukan.',
            ]);
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
                $stok->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'Data stok berhasil dihapus.',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan.',
                ]);
            }
        }

        return redirect('/');
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

            // Load file excel
            $spreadsheet = $reader->load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet(); // Ambil sheet yang aktif

            // Ambil data excel sebagai array
            $data = $sheet->toArray(null, false, true, true);
            $insert = [];

            // Ambil data valid dari database
            $valid_barang_ids   = DB::table('m_barang')->pluck('barang_id')->toArray();
            $valid_user_ids     = DB::table('m_user')->pluck('user_id')->toArray();
            $valid_supplier_ids = DB::table('m_supplier')->pluck('supplier_id')->toArray();

            // Pastikan data memiliki lebih dari 1 baris (header + data)
            if (count($data) > 1) {
                foreach ($data as $baris => $value) {
                    if ($baris > 1) { // Baris pertama adalah header, jadi lewati

                        // Validasi apakah data barang_id, user_id, supplier_id terdaftar di database
                        if (!in_array($value['A'], $valid_barang_ids)) {
                            return response()->json([
                                'status'  => false,
                                'message' => "Data barang_id pada baris {$baris} tidak terdaftar."
                            ]);
                        }
                        if (!in_array($value['B'], $valid_user_ids)) {
                            return response()->json([
                                'status'  => false,
                                'message' => "Data user_id pada baris {$baris} tidak terdaftar."
                            ]);
                        }
                        if (!in_array($value['C'], $valid_supplier_ids)) {
                            return response()->json([
                                'status'  => false,
                                'message' => "Data supplier_id pada baris {$baris} tidak terdaftar."
                            ]);
                        }

                        $stok_tanggal = is_numeric($value['D'])
                            ? Date::excelToDateTimeObject($value['D'])->format('Y-m-d')
                            : date('Y-m-d', strtotime($value['D']));

                        $insert[] = [
                            'barang_id'           => $value['A'],
                            'user_id'             => $value['B'],
                            'supplier_id'         => $value['C'],
                            'stok_tanggal'        => $value['D'],
                            'stok_jumlah'         => $value['E'],
                            'created_at'          => now(),
                        ];
                    }
                }

                if (count($insert) > 0) {
                    // Insert data ke database, jika data sudah ada, maka diabaikan
                    StokModel::insertOrIgnore($insert);
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
        $sheet->setCellValue('E1', 'Tanggal Masuk');
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