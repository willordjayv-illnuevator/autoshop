<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relationships
     */

    public function roles()
    {
        return $this->hasMany(UserRole::class);
    }

    /**
     * Active role helpers
     */

    public function shopRoles()
    {
        return $this->roles()->whereNotNull('shop_id');
    }

    public function customerRoles()
    {
        return $this->roles()->whereNotNull('customer_id');
    }

    /**
     * Role checks
     */

    public function hasRole(string $role, $shopId = null): bool
    {
        return $this->roles()
            ->where('role', $role)
            ->when($shopId, function ($query) use ($shopId) {
                $query->where('shop_id', $shopId);
            })
            ->exists();
    }

    /**
     * Get active shop context (useful for PMS)
     */

    public function activeShop()
    {
        return $this->roles()
            ->whereNotNull('shop_id')
            ->with('shop')
            ->first()?->shop;
    }

    /**
     * Get active customer profile (for B2C app)
     */

    public function customerProfile()
    {
        return $this->roles()
            ->whereNotNull('customer_id')
            ->with('customer')
            ->first()?->customer;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
