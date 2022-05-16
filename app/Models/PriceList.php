<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'room_type_id'
    ];

    public function roomType()
    {
        return $this->hasOne(RoomType::class, 'id', 'room_type_id');
    }

    public function rentDuration()
    {
        return $this->hasOne(RentDuration::class, 'id', 'rent_duration_id');
    }

    
    
}
