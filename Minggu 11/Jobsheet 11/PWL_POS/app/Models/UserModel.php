<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable implements JWTSubject
{
    use HasFactory;
    //==========================================Jobsheet 10 Praktikum 1=======================================
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    //==========================================Jobsheet 3 Praktikum 6=======================================
    protected $table = 'm_user'; //Mendefinisikan nama tabel yang digunakan di model ini
    protected $primaryKey = 'user_id'; //Mendefinisikan primary key dari tabel yang digunakan

    //==========================================Jobsheet 4 Praktikum 1=======================================
    protected $fillable = [
        'level_id',
        'username',
        'nama',
        'password',
        'foto_profile',
        'image'    // tambahan Js 11
    ];

    //  protected $fillable = ['level_id', 'username', 'nama'];

    //==============================================Jobsheet 7=====================================================
    protected $hidden = ['password']; // jangan di tampilkan saat select

    protected $casts = ['password' => 'hashed']; // casting password agar otomatis di hash

    //=========================================Jobsheet 4 Praktikum 2.7=======================================
    public function level(): BelongsTo //Menunjukkan bahwa setiap user memiliki relasi belongsTo dengan tabel LevelModel, dihubungkan melalui level_id.
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

    public function stok(): HasMany {
        return $this->hasMany(StokModel::class, 'user_id', 'user_id');
    }

    public function penjualan(): HasMany {
        return $this->hasMany(PenjualanModel::class, 'user_id', 'user_id');
    }

    //==================================================Jobsheet 7=================================================
    public function getRoleName(): string {
        return $this->level->level_nama;
    }

    public function hasRole($role): bool {
        return $this->level->level_kode == $role;
    }

    public function getRole(){
        return $this->level->level_kode;
    }

    //==================================================Jobsheet 11=================================================
    public function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => url('storage/posts/' . $image),
        );
    }

}