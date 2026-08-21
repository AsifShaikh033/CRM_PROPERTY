<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentPayment extends Model
{
    protected $fillable = ['tenant_id', 'property_id', 'unit_id', 'amount', 'payment_date', 'month', 'year', 'method', 'status', 'reference'];
    protected $casts = ['amount'=>'decimal:2','payment_date'=>'datetime'];
}
