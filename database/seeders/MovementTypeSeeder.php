<?php

namespace Database\Seeders;

use App\Models\Movement_type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovementTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Movement_type::create([
            'mov_code' => 'REC',
            'mov_name' => 'Receiving',
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Movement_type::create([
            'mov_code' => 'TRS',
            'mov_name' => 'Transaction',
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Movement_type::create([
            'mov_code' => 'ADJ',
            'mov_name' => 'Adjustment',
            'created_by' => 1,
            'updated_by' => 1,
        ]);

    }
}
