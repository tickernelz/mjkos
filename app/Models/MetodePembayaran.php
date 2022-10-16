<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    protected $guarded = [
        'id',
    ];

    public function MetodePembayaranPemilik()
    {
        return $this->hasMany(MetodePembayaranPemilik::class);
    }
}
