<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'title',
        'type',
        'message',
        'total_users',
        'from_user_id',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];
}