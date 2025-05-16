<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Profile::create([
            'profile_code' => 'SUPERADMIN',
            'profile_name' => 'SUPERADMIN',
            'flag' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Profile::create([
            'profile_code' => 'ADMIN',
            'profile_name' => 'ADMIN',
            'flag' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

    }
}
