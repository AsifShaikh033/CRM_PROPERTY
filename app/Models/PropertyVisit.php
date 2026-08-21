<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyVisit extends Model
{
    protected $fillable = ['property_id', 'lead_id', 'visit_date', 'status', 'notes'];
    protected $casts = ['visit_date'=>'datetime'];

      public function property()
    {
        return $this->belongsTo(Property::class);
    }


    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
