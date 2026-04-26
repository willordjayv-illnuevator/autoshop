<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\ServiceType;
use Carbon\Carbon;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $customers = Customer::all();
        $serviceTypes = ServiceType::all();

        if ($customers->isEmpty() || $serviceTypes->isEmpty()) {
            $this->command->warn('No customers or service types found. Seed them first.');
            return;
        }

        foreach ($customers as $customer) {

            $vehicles = $customer->vehicles;

            foreach ($vehicles as $vehicle) {

                // Create 2–3 service records per vehicle
                for ($i = 0; $i < 3; $i++) {

                    $serviceDate = Carbon::now()->subDays(rand(10, 200))->toDateString();

                    $service = Service::create([
                        'customer_id' => $customer->id,
                        'vehicle_id' => $vehicle->id,
                        'shop_id' => $vehicle->id,
                        'service_date' => $serviceDate,
                        'mileage' => rand(1000, 100000),
                        'notes' => 'Seeded service record',
                    ]);

                    // Pick random 2–4 service types per visit
                    $randomTypes = $serviceTypes->random(rand(2, 4));

                    foreach ($randomTypes as $type) {

                        ServiceItem::create([
                            'service_id' => $service->id,
                            'service_type_id' => $type->id,
                            'custom_interval_days' => $type->default_interval_days ?? rand(60, 180),
                        ]);
                    }
                }
            }
        }
    }
}
