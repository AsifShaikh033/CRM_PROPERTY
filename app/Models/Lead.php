<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'lead_name', 'phone', 'email', 'interested_property', 'assigned_agent',
        'lead_source', 'lead_status', 'next_follow_up_date', 'reminder',
        'call_notes', 'follow_up_status', 'general_notes',
    ];

    protected $casts = [
        'next_follow_up_date' => 'date',
    ];

    public function followUps()
    {
        return $this->hasMany(LeadFollowUp::class, 'lead_id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'interested_property');
    }

    public function assignedAgent()
    {
        return $this->belongsTo(User::class, 'assigned_agent');
    }
}
