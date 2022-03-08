<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityType extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    ];

    public function facility()
    {
        return $this->hasMany(Facility::class, 'facility_type_id', 'id');
    }
}
