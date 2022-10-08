<?php

namespace Database\Seeders;

use App\Models\Foto;
use Illuminate\Database\Seeder;

class FotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Foto::create([
            'kamar_id' => 1,
            'nama' => '0_No 1.Pemilik.jpeg'
        ]);
        Foto::create([
            'kamar_id' => 1,
            'nama' => '1_No 1.Pemilik.jpeg'
        ]);
        Foto::create([
            'kamar_id' => 2,
            'nama' => '0_No 2.Pemilik.jpeg'
        ]);
        Foto::create([
            'kamar_id' => 2,
            'nama' => '1_No 2.Pemilik.jpeg'
        ]);
        Foto::create([
            'kamar_id' => 3,
            'nama' => '0_No 3.Pemilik.jpeg'
        ]);
        Foto::create([
            'kamar_id' => 3,
            'nama' => '1_No 3.Pemilik.jpeg'
        ]);
        Foto::create([
            'kamar_id' => 4,
            'nama' => '0_No 4.Pemilik.jpeg'
        ]);
        Foto::create([
            'kamar_id' => 4,
            'nama' => '1_No 4.Pemilik.jpeg'
        ]);
    }
}
