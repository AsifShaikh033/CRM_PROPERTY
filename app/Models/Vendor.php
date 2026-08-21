<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'company', 'status'];
    protected $casts = [];
}
