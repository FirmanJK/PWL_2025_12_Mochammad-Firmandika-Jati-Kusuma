<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable; // implementasi class Authenticatable

class UserModel extends Authenticatable
{
    use HasFactory;
//========================================= Jobsheet 10 Praktikum 1 =========================================
public function getJWTIdentifier()
{
    return $this->getKey();
}

public function getJWTCustomClaims()
{
    return [];
}
 //==========================================Jobsheet 3 Praktikum 6=======================================
    protected $table = 'm_user';
    protected $primaryKey = 'user_id';
//==========================================Jobsheet 4 Praktikum 1=======================================
    protected $fillable = ['level_id', 'username', 'nama', 'password', 
                            'profile_photo', 'created_at', 'updated_at']; // kolom yang bisa diisi
//  protected $fillable = ['level_id', 'username', 'nama'];

//==============================================Jobsheet 7=====================================================
    protected $hidden = ['password']; // jangan ditampilkan saat select

    protected $casts = ['password' => 'hashed']; // casting password agar otomatis di hash

//=========================================Jobsheet 4 Praktikum 2.7=======================================
    /**
     * Relasi ke tabel level
     */
    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

    //==================================================Jobsheet 7=================================================
     /**
     * Mendapatkan nama role
     */
    public function getRoleName(): string
    {
        return $this->level->level_nama;
    }

    /**
     * Cek apakah user memiliki role tertentu
     */
    public function hasRole($role): bool
    {
        return $this->level->level_kode === $role;
    }  
    
    /**
     * Mendapatkan kode role
     */
    public function getRole()
    {
        return $this->level->level_kode;
    }
}