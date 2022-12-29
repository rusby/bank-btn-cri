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
            KecamatanSeeder::class,
            KelurahanSeeder::class,
            KodePosSeeder::class,
            KotaSeeder::class,
            ProvinsiSeeder::class,
            // KantorCabangSeeder::class,
            // DeveloperSeeder::class,
            UserSeeder::class,
            StatusSeeder::class,
            // CollectionSeeder::class
        ]);
    }
}
