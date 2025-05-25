<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Status::create([
            'module' => 'receiving',
            'flag_desc' => 'Received',
            'flag_value' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Status::create([
            'module' => 'transaction',
            'flag_desc' => 'Paid',
            'flag_value' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Status::create([
            'module' => 'transaction',
            'flag_desc' => 'Unpaid',
            'flag_value' => 2,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Status::create([
            'module' => 'transaction',
            'flag_desc' => 'Overdue',
            'flag_value' => 3,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

    }
}
