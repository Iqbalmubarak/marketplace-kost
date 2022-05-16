<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomFacilityDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'room_id',
        'room_facility_id'
    ];

    public function roomType()
    {
        return $this->hasOne(RoomType::class, 'id', 'room_type_id');
    }

    public function facility()
    {
        return $this->hasOne(Facility::class, 'id', 'facility_id');
    }
}
