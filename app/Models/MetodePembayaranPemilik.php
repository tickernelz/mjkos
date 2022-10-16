<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodePembayaranPemilik extends Model
{
    protected $guarded = [
        'id',
    ];

    public function MetodePembayaran()
    {
        return $this->belongsTo(MetodePembayaran::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
