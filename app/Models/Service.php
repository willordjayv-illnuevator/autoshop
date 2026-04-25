<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'customer_id',
        'vehicle_id',
        'mileage',
        'service_date',
        'notes'
    ];

    /**
     * Relationships
     */

    public function items()
    {
        return $this->hasMany(ServiceItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Accessors (optional but useful)
     */

    // public function getIsDueSoonAttribute()
    // {
    //     if ($this->next_service_due_date) {
    //         return $this->next_service_due_date <= now()->addDays(7);
    //     }

    //     return false;
    // }

    // public function getIsOverdueAttribute()
    // {
    //     if ($this->next_service_due_date) {
    //         return $this->next_service_due_date < now();
    //     }

    //     return false;
    // }
}
