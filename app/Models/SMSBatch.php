<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//TODO: To make a sent logs model

class SmsBatch extends Model
{
    protected $fillable = [
        'customer_id',
        'vehicle_id',
        'sms_template_id',
        'send_at',
        'status',
        'message_preview',
    ];

    protected $casts = [
        'send_at' => 'datetime',
    ];

    // Relationships

    public function template()
    {
        return $this->belongsTo(SmsTemplate::class, 'sms_template_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'sms_batch_id');
    }

    // Scopes

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeDue($query)
    {
        return $query->whereDate('send_at', '<=', now());
    }

    // Helpers

    public function markAsSent()
    {
        $this->update(['status' => 'sent']);
    }

    public function markAsFailed()
    {
        $this->update(['status' => 'failed']);
    }
}
