<?php

namespace Database\Seeders;

use App\Models\Income_type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IncomeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Income_type::create([
            'income_code' => 'INC00001',
            'income_name' => 'Transaction',
            'flag' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Income_type::create([
            'income_code' => 'INC00002',
            'income_name' => 'Other Income',
            'flag' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

    }
}
