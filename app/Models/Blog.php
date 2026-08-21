<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'image',
        'short_description',
        'description',
        'author',
        'priority',
        'status',
        'published_at',
        'meta_title',
        'meta_keywords',
        'meta_description',

    ];


    protected $casts = [

        'status' => 'boolean',
        'published_at' => 'date',

    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
