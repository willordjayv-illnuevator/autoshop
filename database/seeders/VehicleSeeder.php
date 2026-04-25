<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehicle;


class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicle::insert([
            [
                'customer_id' => 1,
                'make' => 'Toyota',
                'model' => 'Camry',
                'year' => '2020',
                'plate_number' => 'ABC123',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

