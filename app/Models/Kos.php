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

    public function meanRating()
    {
        $avg = $this->review()->avg('rating');
        // round to nearest 0.5
        return round($avg * 2) / 2;
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

    public function foto()
    {
        return $this->hasMany(Foto::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }
}
