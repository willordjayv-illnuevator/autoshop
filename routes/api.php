<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\VehicleController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SmsTemplateController;

Route::apiResource('customers', CustomerController::class);
Route::apiResource('vehicles', VehicleController::class);
Route::apiResource('services', ServiceController::class);
Route::apiResource('schedules', ScheduleController::class);
Route::apiResource('templates', SmsTemplateController::class);

Route::get('/test', function () {
    return ['message' => 'API working'];
});
