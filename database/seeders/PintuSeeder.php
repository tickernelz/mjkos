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
            'nama' => 1
        ]);
        Pintu::create([
            'nama' => 2
        ]);
        Pintu::create([
            'nama' => 3
        ]);
        Pintu::create([
            'nama' => 4
        ]);
    }
}
