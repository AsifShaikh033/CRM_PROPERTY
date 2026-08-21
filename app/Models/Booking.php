<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['property_id', 'tenant_id', 'booking_date', 'amount', 'status', 'notes'];
    protected $casts = ['booking_date'=>'datetime','amount'=>'decimal:2'];
}
