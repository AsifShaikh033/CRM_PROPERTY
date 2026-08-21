<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentalAgreement extends Model
{
    protected $fillable = ['property_id', 'unit_id', 'tenant_id', 'start_date', 'end_date', 'rent', 'deposit', 'status'];
    protected $casts = ['start_date'=>'datetime','end_date'=>'datetime','rent'=>'decimal:2','deposit'=>'decimal:2'];
}
