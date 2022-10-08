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
            'kos_id' => 1,
            'nama' => '0_No 1.Pemilik.jpeg'
        ]);
        Foto::create([
            'kos_id' => 1,
            'nama' => '1_No 1.Pemilik.jpeg'
        ]);
        Foto::create([
            'kos_id' => 2,
            'nama' => '0_No 2.Pemilik.jpeg'
        ]);
        Foto::create([
            'kos_id' => 2,
            'nama' => '1_No 2.Pemilik.jpeg'
        ]);
        Foto::create([
            'kos_id' => 3,
            'nama' => '0_No 3.Pemilik.jpeg'
        ]);
        Foto::create([
            'kos_id' => 3,
            'nama' => '1_No 3.Pemilik.jpeg'
        ]);
    }
}
