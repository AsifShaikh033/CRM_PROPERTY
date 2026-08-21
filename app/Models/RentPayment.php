<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentPayment extends Model
{
    protected $fillable = [
        'tenant_id',
        'property_id',
        'unit_id',
        'amount',
        'payment_date',
        'month',
        'year',
        'method',
        'status',
        'reference',
    ];


    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }


    public function property()
    {
        return $this->belongsTo(Property::class);
    }


    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}