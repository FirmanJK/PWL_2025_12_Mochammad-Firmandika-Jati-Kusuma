<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed t_penjualan (10 transaksi)
        DB::table('t_penjualan')->insert([
            ['penjualan_id' => 1, 'user_id' => 1, 'pembeli' => 'Andi', 'penjualan_kode' => Str::random(10), 'penjualan_tanggal' => Carbon::now()],
            ['penjualan_id' => 2, 'user_id' => 1, 'pembeli' => 'Budi', 'penjualan_kode' => Str::random(10), 'penjualan_tanggal' => Carbon::now()],
            ['penjualan_id' => 3, 'user_id' => 1, 'pembeli' => 'Citra', 'penjualan_kode' => Str::random(10), 'penjualan_tanggal' => Carbon::now()],
            ['penjualan_id' => 4, 'user_id' => 1, 'pembeli' => 'Dewi', 'penjualan_kode' => Str::random(10), 'penjualan_tanggal' => Carbon::now()],
            ['penjualan_id' => 5, 'user_id' => 1, 'pembeli' => 'Eko', 'penjualan_kode' => Str::random(10), 'penjualan_tanggal' => Carbon::now()],
            ['penjualan_id' => 6, 'user_id' => 1, 'pembeli' => 'Fajar', 'penjualan_kode' => Str::random(10), 'penjualan_tanggal' => Carbon::now()],
            ['penjualan_id' => 7, 'user_id' => 1, 'pembeli' => 'Gita', 'penjualan_kode' => Str::random(10), 'penjualan_tanggal' => Carbon::now()],
            ['penjualan_id' => 8, 'user_id' => 1, 'pembeli' => 'Hadi', 'penjualan_kode' => Str::random(10), 'penjualan_tanggal' => Carbon::now()],
            ['penjualan_id' => 9, 'user_id' => 1, 'pembeli' => 'Indra', 'penjualan_kode' => Str::random(10), 'penjualan_tanggal' => Carbon::now()],
            ['penjualan_id' => 10, 'user_id' => 1, 'pembeli' => 'Joko', 'penjualan_kode' => Str::random(10), 'penjualan_tanggal' => Carbon::now()],
        ]);

    }
}
