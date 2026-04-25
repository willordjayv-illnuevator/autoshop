<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;


class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schedule::insert([
            [
                'customer_id' => 1,
                'vehicle_id' => 1,
                'service_type_id' => 1,
                'sms_template_id' => 1,
                'send_at' => now()->addMinutes(1),
                'status' => 'pending',
                'message_preview' => 'Test SMS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
