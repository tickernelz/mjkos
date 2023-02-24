<?php

namespace Database\Seeders;

use App\Models\Kos;
use Illuminate\Database\Seeder;

class KosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kos::create([
            'user_id' => 2,
            'nama' => 'Kos Putri',
            'alamat' => 'Jl. Putri No. 1',
            'address_latitude' => -6.914744,
            'address_longitude' => 107.609810,
            'ukuran' => '5 X 5 meter',
            'harga' => 1000000,
            'status' => 0,
            'cover' => 'No 1.Pemilik.jpeg',
            'deskripsi' => 'Kos Putri adalah kos yang nyaman dan bersih',
            'jumlah_kamar' => 5,
            'jumlah_kamar_terisi' => 4,
            'tampil' => 1,
            'verifikasi' => 'sudah'
        ]);

        Kos::create([
            'user_id' => 2,
            'nama' => 'Kos Putra',
            'alamat' => 'Jl. Putra No. 2',
            'address_latitude' => -6.914744,
            'address_longitude' => 107.609810,
            'ukuran' => '5 X 5 meter',
            'harga' => 1000000,
            'status' => 0,
            'cover' => 'No 2.Pemilik.jpeg',
            'deskripsi' => 'Kos Putra adalah kos yang nyaman dan bersih',
            'jumlah_kamar' => 5,
            'jumlah_kamar_terisi' => 3,
            'tampil' => 1,
            'verifikasi' => 'sudah'
        ]);

        Kos::create([
            'user_id' => 2,
            'nama' => 'Kos Jagat',
            'alamat' => 'Jl. Putri No. 3',
            'address_latitude' => -6.914744,
            'address_longitude' => 107.609810,
            'ukuran' => '5 X 5 meter',
            'harga' => 1000000,
            'status' => 0,
            'cover' => 'No 3.Pemilik.jpeg',
            'deskripsi' => 'Kos Jagat adalah kos yang nyaman dan bersih',
            'jumlah_kamar' => 5,
            'jumlah_kamar_terisi' => 2,
            'tampil' => 1,
            'verifikasi' => 'sudah',
        ]);
    }
}
