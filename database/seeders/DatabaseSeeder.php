<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            CountrySeeder::class,
            RoleSeeder::class,
            ConstantSeeder::class,
            ContactSeeder::class,
            FileTypeSeeder::class,
            MettingStatusSeeder::class,
            RefereeSeeder::class,
            JobTypeSeeder::class
        ]);
    }
}
