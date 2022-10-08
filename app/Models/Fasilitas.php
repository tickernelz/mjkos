<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $table = "fasilitas";
    protected $guarded = [
        'id'
    ];

    public function kos()
    {
        return $this->belongsTo(Kos::class);
    }
}
