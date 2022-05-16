<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'price',
        'kost_id'
    ];

    

    public function image()
    {
        return $this->hasMany(RoomImage::class, 'room_id', 'id');
    }

    public function kost()
    {
        return $this->hasOne(Kost::class, 'id', 'kost_id');
    }

    public function roomType()
    {
        return $this->hasOne(RoomType::class, 'id', 'room_type_id');
    }


    
}
