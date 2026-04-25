<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;


class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::insert([
            [
                'fname' => 'John',
                'lname' => 'Doe',
                'phone' => '1234567890',
                'email' => 'john@test.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
