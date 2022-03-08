<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'lenght',
        'wide'
    ];

    public function priceList()
    {
        return $this->hasOne(PriceList::class, 'room_type_id', 'id');
    }

    public function roomImage()
    {
        return $this->hasMany(RoomImage::class, 'room_type_id', 'id');
    }
    
    public function kost()
    {
        return $this->hasOne(Kost::class, 'id', 'kost_id');
    }

    public function room()
    {
        return $this->hasMany(Room::class, 'room_type_id', 'id');
    }
}
