<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'name','property_code','property_type_id','owner_id','phone','email',
        'address','city','state','country','total_units','monthly_rent',
        'status','description','amenities','image'
    ];

    protected $casts = ['amenities'=>'array','monthly_rent'=>'decimal:2'];

    public function units(){ return $this->hasMany(PropertyUnit::class); }
    public function owner(){ return $this->belongsTo(Owner::class); }
    public function propertyType(){ return $this->belongsTo(PropertyType::class); }
}