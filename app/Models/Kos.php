<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kos extends Model
{
    use HasFactory;

    protected $table = "kos";
    protected $guarded = [
        'id'
    ];

    public function hargaNumber()
    {
        return number_format($this->harga, 0, ',', '.');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function fasilitas()
    {
        return $this->hasMany(Fasilitas::class);
    }

    public function peraturan()
    {
        return $this->hasMany(Peraturan::class);
    }

    public function pintu()
    {
        return $this->hasMany(Pintu::class);
    }

    public function foto()
    {
        return $this->hasMany(Foto::class);
    }
}
