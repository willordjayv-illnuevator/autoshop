<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SmsTemplate;

class SmsTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
            SmsTemplate::insert([
            [
                'name' => 'Oil Change Reminder',
                'message_body' => 'Hi {fname}, your vehicle service ({service_type}) is due soon. Please visit us.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'General Reminder',
                'message_body' => 'Hello {fname}, this is a reminder for your vehicle maintenance.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
