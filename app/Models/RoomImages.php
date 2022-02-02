<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'src',
        'room_id'
    ];

    public function room()
    {
        return $this->hasOne(Room::class, 'id', 'room_id');
    }
}
