<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebConfig extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'web_config';

    // Fillable fields for mass assignment
    protected $fillable = [
        'name',
        'value',
    ];

}
