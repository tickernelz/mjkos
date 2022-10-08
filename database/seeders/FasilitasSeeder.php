<?php

namespace Database\Seeders;

use App\Models\Fasilitas;
use Illuminate\Database\Seeder;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fasilitas::create([
            'nama' => 'AC'
        ]);
        Fasilitas::create([
            'nama' => 'Kamar Mandi dalam'
        ]);
        Fasilitas::create([
            'nama' => 'Kasur'
        ]);
        Fasilitas::create([
            'nama' => 'Meja Belajar'
        ]);
        Fasilitas::create([
            'nama' => 'Parkir Luas'
        ]);
        Fasilitas::create([
            'nama' => 'TV'
        ]);
    }
}
