<?php

namespace Database\Seeders;

use App\Models\Order_type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Order_type::create([
            'order_type_code' => 'OT00001',
            'order_type_name' => 'Coating Shapire',
            'order_type_desc' => 'Coating shapire 10H',
            'work_type_id' => 1,
            'flag' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Order_type::create([
            'order_type_code' => 'OT00002',
            'order_type_name' => 'Coating Ceramic',
            'order_type_desc' => 'Coating nano ceramic 9H+',
            'work_type_id' => 1,
            'flag' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Order_type::create([
            'order_type_code' => 'OT00003',
            'order_type_name' => 'Masterpiece',
            'order_type_desc' => 'Masterpiece',
            'work_type_id' => 2,
            'flag' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Order_type::create([
            'order_type_code' => 'OT00004',
            'order_type_name' => 'Signatur',
            'order_type_desc' => 'Signatur',
            'work_type_id' => 2,
            'flag' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Order_type::create([
            'order_type_code' => 'OT00005',
            'order_type_name' => '3M',
            'order_type_desc' => '3M',
            'work_type_id' => 2,
            'flag' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

    }
}
