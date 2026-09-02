<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadFollowUp extends Model
{
    protected $fillable = [
        'lead_id', 'agent', 'contact_date', 'contact_method', 'outcome',
        'next_action', 'next_follow_up_date', 'reminder', 'call_notes',
    ];

    protected $casts = [
        'contact_date' => 'date',
        'next_follow_up_date' => 'date',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }

    public function agentUser()
    {
        return $this->belongsTo(User::class, 'agent');
    }
}
