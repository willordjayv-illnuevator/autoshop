<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shop;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        Shop::create([
            'name' => 'AutoCare Center',
            'email' => 'autocare@test.com',
            'phone' => '555-123-4567',
            'address' => '123 Main Street, Flagstaff, AZ',
        ]);

        Shop::create([
            'name' => 'QuickFix Garage',
            'email' => 'quickfix@test.com',
            'phone' => '555-987-6543',
            'address' => '456 Elm Street, Flagstaff, AZ',
        ]);
    }
}
