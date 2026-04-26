<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\SmsTemplate;
use App\Models\ServiceType;
use App\Models\Schedule;
use App\Models\SmsBatch;



class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $customer = Customer::first();
        $vehicle = Vehicle::first();
        $template = SmsTemplate::first();

        $oilChange = ServiceType::where('name', 'Oil Change')->first();
        $brakeCheck = ServiceType::where('name', 'Brake Inspection')->first();

        // 1. Create SMS batch
        $batch = SmsBatch::create([
            'customer_id' => $customer->id,
            'vehicle_id' => $vehicle->id,
            'shop_id' => 1,
            'sms_template_id' => $template->id,
            'send_at' => Carbon::now()->addDay()->toDateString(),
            'status' => 'pending',
        ]);

        // 2. Create Schedule 1
        Schedule::create([
            'customer_id' => $customer->id,
            'vehicle_id' => $vehicle->id,
            'shop_id' => 1,
            'service_type_id' => $oilChange->id,
            'sms_batch_id' => $batch->id,
            'send_at' => $batch->send_at,
        ]);

        // 3. Create Schedule 2 (same batch = merged SMS test)
        Schedule::create([
            'customer_id' => $customer->id,
            'vehicle_id' => $vehicle->id,
            'shop_id' => 1,
            'service_type_id' => $brakeCheck->id,
            'sms_batch_id' => $batch->id,
            'send_at' => $batch->send_at,
        ]);
    }
}
