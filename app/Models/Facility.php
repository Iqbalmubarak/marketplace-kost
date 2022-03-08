<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'name',
        'facility_type_id'
    ];

    public function type()
    {
        return $this->hasOne(FacilityType::class, 'id', 'facility_type_id');
    }
}
