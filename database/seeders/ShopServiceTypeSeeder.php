<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShopServiceType;

class ShopServiceTypeSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Shop Service Types (enable services per shop)
        |--------------------------------------------------------------------------
        */

        ShopServiceType::create([
            'shop_id' => 1,
            'service_type_id' => 1, // Oil Change
            'is_enabled' => true,
            'custom_interval_days' => null,
        ]);

        ShopServiceType::create([
            'shop_id' => 1,
            'service_type_id' => 2, // Brake Check
            'is_enabled' => true,
            'custom_interval_days' => 45,
        ]);
    }
}
