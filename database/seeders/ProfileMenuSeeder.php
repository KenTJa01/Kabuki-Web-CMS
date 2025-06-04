<?php

namespace Database\Seeders;

use App\Models\Profile_menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Profile_menu::create([
            'profile_id' => 1,
            'menu_id' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Profile_menu::create([
            'profile_id' => 1,
            'menu_id' => 2,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Profile_menu::create([
            'profile_id' => 1,
            'menu_id' => 3,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Profile_menu::create([
            'profile_id' => 1,
            'menu_id' => 4,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Profile_menu::create([
            'profile_id' => 1,
            'menu_id' => 5,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

    }
}
