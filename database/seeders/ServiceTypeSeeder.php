<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServiceType;


class ServiceTypeSeeder extends Seeder
{
    public function run()
    {
        ServiceType::insert([
            [
                'name' => 'Oil Change',
                'default_interval_miles' => 5000,
                'default_interval_months' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Engine Oil & Filter Change',
                'default_interval_miles' => 5000,
                'default_interval_months' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Brake Inspection',
                'default_interval_miles' => 10000,
                'default_interval_months' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Brake Pad Replacement',
                'default_interval_miles' => 30000,
                'default_interval_months' => 24,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tire Rotation',
                'default_interval_miles' => 8000,
                'default_interval_months' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tire Replacement',
                'default_interval_miles' => 40000,
                'default_interval_months' => 48,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Wheel Alignment',
                'default_interval_miles' => 10000,
                'default_interval_months' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Battery Check',
                'default_interval_miles' => 12000,
                'default_interval_months' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Battery Replacement',
                'default_interval_miles' => 40000,
                'default_interval_months' => 36,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Air Filter Replacement',
                'default_interval_miles' => 12000,
                'default_interval_months' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cabin Air Filter Replacement',
                'default_interval_miles' => 12000,
                'default_interval_months' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Coolant Flush',
                'default_interval_miles' => 30000,
                'default_interval_months' => 24,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Transmission Service',
                'default_interval_miles' => 60000,
                'default_interval_months' => 48,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Engine Tune-Up',
                'default_interval_miles' => 30000,
                'default_interval_months' => 24,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Suspension Check',
                'default_interval_miles' => 20000,
                'default_interval_months' => 24,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'AC System Service',
                'default_interval_miles' => 20000,
                'default_interval_months' => 24,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Spark Plug Replacement',
                'default_interval_miles' => 30000,
                'default_interval_months' => 36,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fuel System Cleaning',
                'default_interval_miles' => 25000,
                'default_interval_months' => 24,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
