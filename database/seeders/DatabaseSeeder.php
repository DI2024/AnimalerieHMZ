<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Run all seeders in order
        $this->call([
            AdminUserSeeder::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            OfferSeeder::class,
            ProductSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
