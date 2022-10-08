<?php

namespace Database\Seeders;

use App\Models\Kamar;
use Illuminate\Database\Seeder;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kamar::create([
            'pintu_id' => 1,
            'ukuran'    => '20 X 30 meter',
            'harga'     => '2,000,000',
            'deskripsi' => 'Kamar Paling dekat dengan pintu gerbang, menghadap ke arah timur',
            'cover' => 'No 1.Pemilik.jpeg',
            'status' => 0,
            'tampil'    => 1
        ]);
        Kamar::create([
            'pintu_id' => 2,
            'ukuran'    => '20 X 30 meter',
            'harga'     => '2,000,000',
            'deskripsi' => 'Kamar Paling dekat dengan pintu gerbang, menghadap ke arah timur',
            'cover' => 'No 2.Pemilik.jpeg',
            'status' => 0,
            'tampil'    => 1
        ]);
        Kamar::create([
            'pintu_id' => 3,
            'ukuran'    => '20 X 30 meter',
            'harga'     => '2,000,000',
            'deskripsi' => 'kamar berada di lantai 1  dengan jendela yang menghadap ke arah koridor.',
            'cover' => 'No 3.Pemilik.jpeg',
            'status' => 0,
            'tampil'    => 1
        ]);
        Kamar::create([
            'pintu_id' => 4,
            'ukuran'    => '20 X 30 meter',
            'harga'     => '2,000,000',
            'deskripsi' => 'kamar berada di lantai 2  dengan jendela yang menghadap ke arah koridor.',
            'cover' => 'No 4.Pemilik.jpeg',
            'status' => 0,
            'tampil'    => 1
        ]);
    }
}
