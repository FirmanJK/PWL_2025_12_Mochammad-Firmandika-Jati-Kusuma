<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'supplier_id'     => 2,
                'supplier_kode'   => 'SUP002',
                'supplier_nama'   => 'CV Berkah Abadi',
                'supplier_alamat' => 'Jl. Merdeka No. 45, Bandung',
                'created_at'      => '2025-03-22 08:59:38',
                'updated_at'      => '2025-03-22 08:50:38',
            ],
            [
                'supplier_id'     => 4,
                'supplier_kode'   => 'SUP003',
                'supplier_nama'   => 'UD Sukses Mandiri',
                'supplier_alamat' => 'Jl. Diponegoro No.78, Surabaya',
                'created_at'      => '2025-03-25 13:52:10',
                'updated_at'      => '2025-03-25 13:52:10',
            ],
            [
                'supplier_id'     => 5,
                'supplier_kode'   => 'SUP007',
                'supplier_nama'   => 'PT Beiersdorf',
                'supplier_alamat' => 'Jl. Raya Singosari Malang',
                'created_at'      => '2025-03-29 08:02:48',
                'updated_at'      => '2025-03-29 08:02:48',
            ],
            [
                'supplier_id'     => 6,
                'supplier_kode'   => 'SUP008',
                'supplier_nama'   => 'PT Nusantara Sumberdaya',
                'supplier_alamat' => 'Jl. Gatot Subroto No. 21, Jakarta Selatan',
                'created_at'      => '2025-04-10 06:41:34',
                'updated_at'      => null,
            ],
            [
                'supplier_id'     => 7,
                'supplier_kode'   => 'SUP009',
                'supplier_nama'   => 'CV Mitra Pangan Sejahtera',
                'supplier_alamat' => 'Jl. Ahmad Yani No. 17, Semarang',
                'created_at'      => '2025-04-10 06:41:34',
                'updated_at'      => null,
            ],
            [
                'supplier_id'     => 8,
                'supplier_kode'   => 'SUP010',
                'supplier_nama'   => 'UD Sentosa Teknik',
                'supplier_alamat' => 'Jl. Veteran No. 88, Surabaya',
                'created_at'      => '2025-04-10 06:41:34',
                'updated_at'      => null,
            ],
        ];

        DB::table('m_supplier')->insert($data);
    }
}