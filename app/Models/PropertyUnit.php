<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyUnit extends Model
{
    protected $fillable = ['property_id', 'unit_number', 'unit_type', 'rent', 'status', 'tenant_id'];
    protected $casts = ['rent'=>'decimal:2'];
}
