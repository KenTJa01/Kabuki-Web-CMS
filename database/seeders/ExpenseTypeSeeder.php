<?php

namespace Database\Seeders;

use App\Models\expense_type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        expense_type::create([
            'expense_code' => 'EXP00001',
            'expense_name' => 'Ordering Item',
            'flag' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        expense_type::create([
            'expense_code' => 'EXP00002',
            'expense_name' => 'Utilities',
            'flag' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        expense_type::create([
            'expense_code' => 'EXP00003',
            'expense_name' => 'Tax',
            'flag' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        expense_type::create([
            'expense_code' => 'EXP00004',
            'expense_name' => 'Other Expenses',
            'flag' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

    }
}
