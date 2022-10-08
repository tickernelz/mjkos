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
            'nama' => 'Tamu menginap dikenakan biaya'
        ]);
        Peraturan::create([
            'nama' => 'Tipe ini bisa diisi maks. 1 orang/ kamar'
        ]);
        Peraturan::create([
            'nama' => 'Tidak untuk pasutri'
        ]);
        Peraturan::create([
            'nama' => 'Tidak boleh bawa anak'
        ]);
        Peraturan::create([
            'nama' => 'Tidak boleh membawa binatang'
        ]);
        Peraturan::create([
            'nama' => 'Gerbang ditutup sampai 23.00'
        ]);
    }
}
