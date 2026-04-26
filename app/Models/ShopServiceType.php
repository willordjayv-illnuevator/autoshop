<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopServiceType extends Model
{
    protected $fillable = [
        'shop_id',
        'service_type_id',
        'is_enabled',
        'custom_interval_days',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
    ];

    /**
     * Relationships
     */

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }

    /**
     * Helpers
     */

    public function getEffectiveInterval()
    {
        return $this->custom_interval_days
            ?? $this->serviceType->default_interval_days;
    }

    public function isActive(): bool
    {
        return $this->is_enabled === true;
    }

    /**
     * Scopes
     */

    public function scopeEnabled($query)
    {
        return $query->where('is_enabled', true);
    }

    public function scopeForShop($query, $shopId)
    {
        return $query->where('shop_id', $shopId);
    }
}
