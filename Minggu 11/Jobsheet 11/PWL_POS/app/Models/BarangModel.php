<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// app/Models/BarangModel.php

use App\Models\StokModel;

class BarangModel extends Model
{
    use HasFactory;

    protected $table = 'm_barang';
    protected $primaryKey = 'barang_id';

    protected $fillable = [
        'kategori_id',  
        'barang_kode',
        'barang_nama',
        'harga_beli',
        'harga_jual',
        'barang_stok'
        // Tidak perlu tambahkan 'barang_stok' di sini karena bukan kolom database
    ];

    public $timestamps = false;

    public function kategori()
    {
        return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id');
    }

    // Tambahkan accessor untuk menghitung stok real-time
    public function getBarangStokAttribute()
    {
        return StokModel::where('barang_id', $this->barang_id)->sum('stok_jumlah');
    }
}