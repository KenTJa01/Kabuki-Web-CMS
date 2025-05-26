<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            MenuSeeder::class,
            StatusSeeder::class,
            MovementTypeSeeder::class,
            IncomeTypeSeeder::class,
            ExpenseTypeSeeder::class,
            ProfileSeeder::class,
            UserSeeder::class,
            ItemSeeder::class,
        ]);
    }
}
