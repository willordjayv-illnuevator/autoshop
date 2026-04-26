<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\Schedule;
use App\Models\SmsTemplate;

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

            // 3. Get interval (custom OR default)
            $interval = $item['interval_days']
                ?? $serviceItem->serviceType->default_interval_days;

            if (!$interval) continue;

            $nextDue = now()->addDays($interval);

            //TODO: There will be changes here because of the Batch SMS Architectural revisal

            $template = SmsTemplate::find(1);

            $message = $template->message_body;

            $message = str_replace('{fname}', $service->customer->fname, $message);
            $message = str_replace('{vehicle}', $service->vehicle->make . ' ' . $service->vehicle->plate_number, $message);
            $message = str_replace('{service_type}', $serviceItem->serviceType->name, $message);

            // 4. Cancel old pending schedules for this service type
            Schedule::where('vehicle_id', $service->vehicle_id)
                ->where('service_type_id', $item['service_type_id'])
                ->where('status', 'pending')
                ->update(['status' => 'cancelled']);


            // 5. Create new schedule
            Schedule::create([
                'customer_id' => $service->customer_id,
                'vehicle_id' => $service->vehicle_id,
                'service_type_id' => $item['service_type_id'],
                'send_at' => $nextDue->copy()->subDays(3),
                'message_preview' => $message,
                'status' => 'pending'
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
