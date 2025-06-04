<?php

namespace Database\Seeders;

use App\Models\Work_type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Work_type::create([
            'work_type_code' => 'WT00001',
            'work_type_name' => 'Coating',
            'work_type_desc' => 'Coating',
            'flag' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Work_type::create([
            'work_type_code' => 'WT00002',
            'work_type_name' => 'Pemasangan Kaca Film',
            'work_type_desc' => 'Pemasangan Kaca Film',
            'flag' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Work_type::create([
            'work_type_code' => 'WT00003',
            'work_type_name' => 'Maintenance',
            'work_type_desc' => 'Maintenance',
            'flag' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Work_type::create([
            'work_type_code' => 'WT00004',
            'work_type_name' => 'Pemasangan Anti Karat',
            'work_type_desc' => 'Pemasangan Anti Karat',
            'flag' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Work_type::create([
            'work_type_code' => 'WT00005',
            'work_type_name' => 'Pemasangan Karpet',
            'work_type_desc' => 'Pemasangan Karpet',
            'flag' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

    }
}
