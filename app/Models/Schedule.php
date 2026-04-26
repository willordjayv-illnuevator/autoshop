<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'customer_id',
        'vehicle_id',
        'service_type_id',
        'sms_batch_id',
        'send_at',
    ];

    protected $casts = [
        'send_at' => 'datetime',
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }

    public function batch()
    {
        return $this->belongsTo(SmsBatch::class, 'sms_batch_id');
    }

     public function scopeDue($query)
    {
        return $query->where('send_at', '<=', now());
    }

    public function scopeUnbatched($query)
    {
        return $query->whereNull('sms_batch_id');
    }
}
