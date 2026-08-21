<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
     protected $table = 'services';
    protected $fillable = [
        'title',
        'slug',
        'icon',
        'short_description',
        'details',
        'priority',
        'status',
        'user_id',
    ];
   
    protected $casts = [
        'status' => 'boolean',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
