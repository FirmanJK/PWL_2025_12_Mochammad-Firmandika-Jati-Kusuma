<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'barang_stok',
        'image'
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

    public function penjualanDetail(): HasMany {
        return $this->hasMany(PenjualanDetailModel::class, 'barang_id', 'barang_id');
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($image) => url('/storage/posts/' . $image),
        );
    }
}