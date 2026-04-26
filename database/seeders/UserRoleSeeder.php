<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */

        $shopUser = User::create([
            'name' => 'Shop Owner',
            'email' => 'shop@demo.com',
            'password' => Hash::make('password'),
        ]);

        $customerUser = User::create([
            'name' => 'Customer User',
            'email' => 'customer@demo.com',
            'password' => Hash::make('password'),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */

        UserRole::create([
            'user_id' => $shopUser->id,
            'role' => 'shop_owner',
            'shop_id' => 1, // assumes shop exists already
            'customer_id' => null,
        ]);

        UserRole::create([
            'user_id' => $customerUser->id,
            'role' => 'customer',
            'shop_id' => null,
            'customer_id' => 1, // assumes customer exists or future seeded
        ]);
    }
}
