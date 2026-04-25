<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // Allow mass assignment
    protected $fillable = [
        'fname',
        'lname',
        'phone',
        'email',
    ];

    protected $appends = ['full_name'];


    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }


    public function getFullNameAttribute()
    {
        return $this->fname . ' ' . $this->lname;
    }
}
