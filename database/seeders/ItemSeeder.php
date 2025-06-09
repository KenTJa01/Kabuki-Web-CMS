<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Item::create([
            'item_code' => 'K00001',
            'item_name' => 'Kaca Film Depan',
            'item_desc' => 'Kaca Film untuk kaca depan mobil kecil',
            'unit_type' => 'meter',
            'price' => 500000,
            'flag' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Item::create([
            'item_code' => 'K00002',
            'item_name' => 'Kaca Film Kanan',
            'item_desc' => 'Kaca Film untuk kaca kanan mobil kecil',
            'unit_type' => 'meter',
            'price' => 300000,
            'flag' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

    }
}
