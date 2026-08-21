<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'property_id', 'source', 'status', 'notes'];
    protected $casts = [];
}
