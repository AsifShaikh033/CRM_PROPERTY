<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyVisit extends Model
{
    protected $fillable = [
        'property_id',
        'lead_id',
        'agent_id',
        'visit_date',
        'visit_time',
        'status',
        'customer_status',
        'visit_notes',
    ];

    protected $casts = [
        'visit_date' => 'date',
    ];

      public function property()
    {
        return $this->belongsTo(Property::class);
    }


    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
}
