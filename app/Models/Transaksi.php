<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = "transaksi";
    protected $guarded = [
        'id'
    ];

    public function biayaNumber()
    {
        // Check if the biaya have a dot
        if (strpos($this->biaya, '.') !== false) {
            return $this->biaya;
        } else {
            return number_format($this->biaya, 0, ',', '.');
        }
    }

    public function kos()
    {
        return $this->belongsTo(Kos::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function penyewa_tambahan()
    {
        return $this->hasMany(PenyewaTambahan::class);
    }
}
