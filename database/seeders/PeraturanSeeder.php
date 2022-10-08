<?php

namespace Database\Seeders;

use App\Models\Peraturan;
use Illuminate\Database\Seeder;

class PeraturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Peraturan::create([
            'kos_id' => 1,
            'nama' => 'Tamu menginap dikenakan biaya'
        ]);
        Peraturan::create([
            'kos_id' => 1,
            'nama' => 'Tipe ini bisa diisi maks. 1 orang/ kamar'
        ]);
        Peraturan::create([
            'kos_id' => 1,
            'nama' => 'Tidak untuk pasutri'
        ]);
        Peraturan::create([
            'kos_id' => 1,
            'nama' => 'Tidak boleh bawa anak'
        ]);
        Peraturan::create([
            'kos_id' => 1,
            'nama' => 'Tidak boleh membawa binatang'
        ]);
        Peraturan::create([
            'kos_id' => 1,
            'nama' => 'Gerbang ditutup sampai 23.00'
        ]);
    }
}
