<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            KosSeeder::class,
            FotoSeeder::class,
            PintuSeeder::class,
            PeraturanSeeder::class,
            FasilitasSeeder::class,
            PengaturanSeeder::class,
            // TransaksiSeeder::class,
        ]);
    }
}