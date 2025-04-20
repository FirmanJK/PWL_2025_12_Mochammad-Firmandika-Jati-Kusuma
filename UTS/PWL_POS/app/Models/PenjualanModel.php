<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenjualanModel extends Model
{
    use HasFactory;

    //==========================================Jobsheet 3 Praktikum 6=======================================
    protected $table = 't_penjualan';
    protected $primaryKey = 'penjualan_id';

    //==========================================Jobsheet 4 Praktikum 1=======================================
    protected $fillable = [
        'user_id',
        'pembeli',
        'penjualan_kode',
        'penjualan_tanggal'
    ];

    // protected $fillable = [
    //     'user_id',
    //     'pembeli',
    //     'penjualan_kode'
    // ];

    //=========================================Jobsheet 4 Praktikum 2.7=======================================
    public function user(): BelongsTo {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }

    public function penjualanDetail(): HasMany {
        return $this->hasMany(PenjualanDetailModel::class, 'penjualan_id', 'penjualan_id');
    }
}