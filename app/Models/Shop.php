<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

    /**
     * Relationships
     */

    public function users()
    {
        return $this->hasMany(UserRole::class);
    }

    public function staff()
    {
        return $this->hasMany(UserRole::class)->whereIn('role', ['shop_owner', 'staff']);
    }

    public function serviceTypes()
    {
        return $this->hasMany(ShopServiceType::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function smsBatches()
    {
        return $this->hasMany(SMSBatch::class);
    }

    /**
     * Helpers
     */

    public function hasServiceType($serviceTypeId)
    {
        return $this->serviceTypes()
            ->where('service_type_id', $serviceTypeId)
            ->where('is_enabled', true)
            ->exists();
    }
}
