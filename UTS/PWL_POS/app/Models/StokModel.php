<?php

namespace App\Models;

use App\Models\UserModel;
use App\Models\BarangModel;
use App\Models\SupplierModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StokModel extends Model
{
    use HasFactory;

    protected $table = 't_stok';
    protected $primaryKey = 'stok_id';

    protected $fillable = [
        'barang_id',
        'user_id',
        'supplier_id',
        'stok_tanggal',
        'stok_jumlah',
    ];

    /**
     * Relasi ke model Barang (m_barang)
     */
    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'barang_id', 'barang_id');
    }

    /**
     * Relasi ke model User (m_user)
     */
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }

    /**
     * Relasi ke model Supplier (m_supplier)
     */
    public function supplier()
    {
        return $this->belongsTo(SupplierModel::class, 'supplier_id', 'supplier_id');
    }
}