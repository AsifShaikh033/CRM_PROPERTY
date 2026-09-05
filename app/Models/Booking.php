<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'property_id',
        'lead_id',
        'lead_name',
        'lead_interested_property',
        'lead_assigned_agent',
        'lead_phone',
        'lead_email',
        'lead_lead_status',
        'lead_follow_up_status',
        'booking_date',
        'amount',
        'status',
        'notes',
    ];


    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id', 'id');
    }
    
    // public function tenant()
    // {
    //     return $this->belongsTo(Tenant::class);
    // }
}