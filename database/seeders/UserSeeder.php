<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'username' => 'superadmin',
            'password' => '$2y$10$5xDWSNh2K17huJJkmoY4EeJUJTPO.sf8ArkKYFn.ZeWZwUtyd1MAm',
            'name' => 'Super Admin',
            'is_active' => 1,
            'profile_id' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

    }
}
