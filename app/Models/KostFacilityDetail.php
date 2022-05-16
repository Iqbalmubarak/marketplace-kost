<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KostFacilityDetail extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'facility_id',
        'kost_id'
    ];

    public function kost()
    {
        return $this->hasOne(Kost::class, 'id', 'kost_id');
    }

    public function facility()
    {
        return $this->hasOne(Facility::class, 'id', 'facility_id');
    }

}
