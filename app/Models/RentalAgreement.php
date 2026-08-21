<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentalAgreement extends Model
{
    protected $fillable = [
        'property_id',
        'unit_id',
        'tenant_id',
        'start_date',
        'end_date',
        'rent',
        'deposit',
        'status',
    ];


    public function property()
    {
        return $this->belongsTo(Property::class);
    }


    // public function unit()
    // {
    //     return $this->belongsTo(Unit::class);
    // }


    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}