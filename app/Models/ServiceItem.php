<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceItem extends Model
{
    protected $fillable = [
        'service_id',
        'service_type_id',
        'custom_interval_days',
        'custom_interval_mileage'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }
}
