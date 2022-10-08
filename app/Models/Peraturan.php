<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peraturan extends Model
{
    use HasFactory;

    protected $table = "peraturan";
    protected $guarded = [
        'id'
    ];

    public function kos()
    {
        return $this->belongsTo(Kos::class);
    }
}
