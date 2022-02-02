<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomFacility extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    ];

    public function detail()
    {
        return $this->hasMany(RoomFacilityDetail::class, 'room_facility_id', 'id');
    }
}
