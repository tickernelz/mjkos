<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;
    protected $table = "kamar";
    protected $guarded = [];

    public function pintu()
    {
        return $this->belongsTo(Pintu::class);
    }
    public function foto()
    {
        return $this->hasMany(Foto::class);
    }
}
