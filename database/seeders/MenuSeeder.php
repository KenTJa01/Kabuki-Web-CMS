<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Menu::create([
            'menu_name' => 'Master Data',
            'menu_url' => '/master_data',
            'flag' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Menu::create([
            'menu_name' => 'Transaction',
            'menu_url' => '/transaction',
            'flag' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Menu::create([
            'menu_name' => 'Stock',
            'menu_url' => '/stock',
            'flag' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

    }
}
