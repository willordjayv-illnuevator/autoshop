<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $fillable = [
        'name',
        'default_interval_miles',
        'default_interval_months',
    ];

    /**
     * Relationships
     */

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    /**
     * Helpers (useful for your automation later)
     */

    public function hasMileageRule()
    {
        return !is_null($this->default_interval_miles);
    }

    public function hasTimeRule()
    {
        return !is_null($this->default_interval_months);
    }
}
