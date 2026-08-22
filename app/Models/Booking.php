<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'property_id',
        'tenant_id',
        'booking_date',
        'amount',
        'status',
        'notes',
    ];


    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }
    // public function tenant()
    // {
    //     return $this->belongsTo(Tenant::class);
    // }
}