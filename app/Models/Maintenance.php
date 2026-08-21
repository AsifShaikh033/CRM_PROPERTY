<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $fillable = ['property_id', 'unit_id', 'tenant_id', 'title', 'description', 'priority', 'status', 'assigned_to', 'completed_at'];
    protected $casts = ['completed_at'=>'datetime'];
}
