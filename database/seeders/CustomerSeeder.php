<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = file(storage_path('app/data_customer.csv'));

        foreach ($data as $d) {
            $row = explode(',', $d);

            $userData = Customer::firstOrCreate([
                'customer_code' => $row[0],
            ], [
                'customer_name' => $row[1],
                'no_telp' => $row[2],
                'address' => $row[3],
                'vehicle_type' => $row[7],
                'vehicle_no' => $row[8],
                'flag' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ]);

        }

    }
}
