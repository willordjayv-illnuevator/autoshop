<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'customer_id',
        'vehicle_id',
        'service_type_id',
        'sms_template_id',
        'send_at',
        'status',
        'message_preview',
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function template()
    {
        return $this->belongsTo(SmsTemplate::class, 'sms_template_id');
    }

    // /**
    //  * Scopes
    //  */

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // public function scopeDue($query)
    // {
    //     return $query->where('send_at', '<=', now());
    // }

    /**
     * Helpers
     */

    public function markAsSent()
    {
        $this->update(['status' => 'sent']);
    }

    public function markAsFailed()
    {
        $this->update(['status' => 'failed']);
    }
}
