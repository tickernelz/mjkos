<?php

namespace Database\Seeders;

use App\Models\Pintu;
use Illuminate\Database\Seeder;

class PintuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pintu::create([
            'kos_id' => 1,
            'nama' => 'Pintu A1',
            'status' => 0
        ]);
        Pintu::create([
            'kos_id' => 1,
            'nama' => 'Pintu A2',
            'status' => 0
        ]);
        Pintu::create([
            'kos_id' => 1,
            'nama' => 'Pintu A3',
            'status' => 0
        ]);
        Pintu::create([
            'kos_id' => 1,
            'nama' => 'Pintu A4',
            'status' => 0
        ]);
    }
}
