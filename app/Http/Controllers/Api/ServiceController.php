<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\Schedule;
use App\Models\SmsBatch;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'service_date' => 'required|date',
            'mileage' => 'nullable|integer',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.service_type_id' => 'required|exists:service_types,id',
            'items.*.interval_days' => 'nullable|integer'
        ]);

        // 1. Create Service
        $service = Service::create([
            'customer_id' => $validated['customer_id'],
            'vehicle_id' => $validated['vehicle_id'],
            'service_date' => $validated['service_date'],
            'mileage' => $validated['mileage'] ?? null,
            'notes' => $validated['notes'] ?? null,
        ]);

        foreach ($validated['items'] as $item) {

            // 2. Save Service Item
            $serviceItem = ServiceItem::create([
                'service_id' => $service->id,
                'service_type_id' => $item['service_type_id'],
                'custom_interval_days' => $item['interval_days'] ?? null,
            ]);

            // 3. Determine interval
            $interval = $item['interval_days']
                ?? $serviceItem->serviceType->default_interval_days;

            if (!$interval) {
                continue;
            }

            // 4. Compute next due + send time
            $nextDue = now()->addDays($interval);
            $sendAt = $nextDue->copy()->subDays(3);

            // 🔥 5. Find or create SMS Batch (CORE LOGIC)
            $batch = SmsBatch::firstOrCreate(
                [
                    'customer_id' => $service->customer_id,
                    'vehicle_id' => $service->vehicle_id,
                    'sms_template_id' => 1, // can be dynamic later
                    'send_at' => $sendAt,
                ],
                [
                    'status' => 'pending',
                ]
            );

            // 6. Create Schedule (NO SMS LOGIC HERE)
            Schedule::create([
                'customer_id' => $service->customer_id,
                'vehicle_id' => $service->vehicle_id,
                'service_type_id' => $item['service_type_id'],
                'sms_batch_id' => $batch->id,
                'send_at' => $sendAt,
            ]);
        }

        return response()->json([
            'message' => 'Service recorded successfully',
            'data' => $service->load('items')
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
