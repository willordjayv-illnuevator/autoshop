<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $fillable = [
        'user_id',
        'role',
        'shop_id',
        'customer_id',
    ];

    /**
     * Relationships
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Role checks
     */

    public function isShopRole(): bool
    {
        return in_array($this->role, ['shop_owner', 'staff']);
    }

    public function isCustomerRole(): bool
    {
        return $this->role === 'customer';
    }

    /**
     * Scopes
     */

    public function scopeShopRoles($query)
    {
        return $query->whereIn('role', ['shop_owner', 'staff']);
    }

    public function scopeCustomerRoles($query)
    {
        return $query->where('role', 'customer');
    }

    public function scopeForShop($query, $shopId)
    {
        return $query->where('shop_id', $shopId);
    }

    public function scopeForCustomer($query, $customerId)
    {
        return $query->where('customer_id', $customerId);
    }
}
