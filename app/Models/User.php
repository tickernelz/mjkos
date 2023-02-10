<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'telp',
        'jk',
        'pekerjaan',
        'aktif',
        'foto',
        'foto_ktp',
        'foto_kk',
        'role_id',
        'status',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isReviewed($kos_id)
    {
        return $this->review()->where('kos_id', $kos_id)->exists();
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function kos()
    {
        return $this->hasMany(Kos::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function MetodePembayaran()
    {
        return $this->hasMany(MetodePembayaran::class);
    }

    public function RekeningPembayaran()
    {
        return $this->hasMany(RekeningPembayaran::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }
}
