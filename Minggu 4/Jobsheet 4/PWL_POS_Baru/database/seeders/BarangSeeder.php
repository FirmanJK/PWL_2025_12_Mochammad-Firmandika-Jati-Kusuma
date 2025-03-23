<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Seed m_barang (10 data barang)
        DB::table('m_barang')->insert([
            ['barang_id' => 1, 'kategori_id' => 1, 'barang_kode' => 'TV001', 'barang_nama' => 'Televisi', 'harga_beli' => 2000000, 'harga_jual' => 2500000],
            ['barang_id' => 2, 'kategori_id' => 2, 'barang_kode' => 'TSHRT1', 'barang_nama' => 'T-Shirt', 'harga_beli' => 50000, 'harga_jual' => 100000],
            ['barang_id' => 3, 'kategori_id' => 3, 'barang_kode' => 'MKN001', 'barang_nama' => 'Mie Instan', 'harga_beli' => 2000, 'harga_jual' => 3000],
            ['barang_id' => 4, 'kategori_id' => 4, 'barang_kode' => 'OBG001', 'barang_nama' => 'Obeng', 'harga_beli' => 10000, 'harga_jual' => 20000],
            ['barang_id' => 5, 'kategori_id' => 5, 'barang_kode' => 'TOY001', 'barang_nama' => 'Boneka', 'harga_beli' => 15000, 'harga_jual' => 25000],
            ['barang_id' => 6, 'kategori_id' => 1, 'barang_kode' => 'HP001', 'barang_nama' => 'Handphone', 'harga_beli' => 3000000, 'harga_jual' => 3500000],
            ['barang_id' => 7, 'kategori_id' => 2, 'barang_kode' => 'JNS001', 'barang_nama' => 'Celana Jeans', 'harga_beli' => 120000, 'harga_jual' => 180000],
            ['barang_id' => 8, 'kategori_id' => 3, 'barang_kode' => 'SRP001', 'barang_nama' => 'Sirup', 'harga_beli' => 15000, 'harga_jual' => 25000],
            ['barang_id' => 9, 'kategori_id' => 4, 'barang_kode' => 'HTM001', 'barang_nama' => 'Hammer', 'harga_beli' => 25000, 'harga_jual' => 40000],
            ['barang_id' => 10, 'kategori_id' => 5, 'barang_kode' => 'RBT001', 'barang_nama' => 'Robot Mainan', 'harga_beli' => 100000, 'harga_jual' => 150000],
        ]);

    }
}
