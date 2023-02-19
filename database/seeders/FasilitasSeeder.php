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
            'kos_id' => 1,
            'nama' => 'AC'
        ]);
        Fasilitas::create([
            'kos_id' => 1,
            'nama' => 'Kamar Mandi dalam'
        ]);
        Fasilitas::create([
            'kos_id' => 1,
            'nama' => 'Kasur'
        ]);
        Fasilitas::create([
            'kos_id' => 1,
            'nama' => 'Meja Belajar'
        ]);
        Fasilitas::create([
            'kos_id' => 1,
            'nama' => 'Parkir Luas'
        ]);
        Fasilitas::create([
            'kos_id' => 1,
            'nama' => 'TV'
        ]);

        Fasilitas::create([
            'kos_id' => 2,
            'nama' => 'AC'
        ]);
        Fasilitas::create([
            'kos_id' => 2,
            'nama' => 'Kamar Mandi dalam'
        ]);
        Fasilitas::create([
            'kos_id' => 2,
            'nama' => 'Kasur'
        ]);
        Fasilitas::create([
            'kos_id' => 2,
            'nama' => 'Meja Belajar'
        ]);
        Fasilitas::create([
            'kos_id' => 2,
            'nama' => 'Parkir Luas'
        ]);
        Fasilitas::create([
            'kos_id' => 2,
            'nama' => 'TV'
        ]);

        Fasilitas::create([
            'kos_id' => 3,
            'nama' => 'AC'
        ]);
        Fasilitas::create([
            'kos_id' => 3,
            'nama' => 'Kamar Mandi dalam'
        ]);
        Fasilitas::create([
            'kos_id' => 3,
            'nama' => 'Kasur'
        ]);
        Fasilitas::create([
            'kos_id' => 3,
            'nama' => 'Meja Belajar'
        ]);
        Fasilitas::create([
            'kos_id' => 3,
            'nama' => 'Parkir Luas'
        ]);
        Fasilitas::create([
            'kos_id' => 3,
            'nama' => 'TV'
        ]);
    }
}
