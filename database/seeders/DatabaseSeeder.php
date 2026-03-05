<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llamar al seeder principal que rellena todos los datos
        $this->call([
            MusculosDbSeeder::class,
        ]);
    }
}
