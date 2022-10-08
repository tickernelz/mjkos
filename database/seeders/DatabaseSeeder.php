<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

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
            KamarSeeder::class,
            FotoSeeder::class,
            KosSeeder::class,
            PintuSeeder::class,
            PeraturanSeeder::class,
            FasilitasSeeder::class,
            // TransaksiSeeder::class,
        ]);
    }
}
