<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'role_id' => 1,
            'status' => '1',
            'aktif'    => 1,
            'foto_kk' => 'kk.jpg',
            'foto_ktp' => 'ktp.jpg',
            'telp'  => '08567567456456',
            'jk'    => 'L',
            'pekerjaan' =>  'Lainnya',
            'password' => bcrypt('secret'),
        ]);

        $user->assignRole('admin');

        $user = User::create([
            'name' => 'Pemilik',
            'email' => 'pemilik@admin.com',
            'role_id' => 2,
            'status' => '1',
            'aktif'    => 1,
            'foto_kk' => 'kk.jpg',
            'foto_ktp' => 'ktp.jpg',
            'telp'  => '08567567456456',
            'jk'    => 'L',
            'pekerjaan' =>  'Lainnya',
            'password' => bcrypt('secret'),
        ]);

        $user->assignRole('pemilik');

        $user = User::create([
            'name' => 'Pengunjung',
            'email' => 'pengunjung@admin.com',
            'role_id' => 3,
            'status' => '1',
            'telp'  => '08567567456456',
            'jk'    => 'L',
            'foto_kk' => 'kk.jpg',
            'foto_ktp' => 'ktp.jpg',
            'aktif'    => 1,
            'pekerjaan' =>  'Lainnya',
            'password' => bcrypt('secret'),
        ]);

        $user->assignRole('pengunjung');
    }
}
