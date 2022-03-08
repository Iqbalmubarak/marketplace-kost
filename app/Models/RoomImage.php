<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomImage extends Model
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
 
    public function section()
    {
        return $this->hasOne(Section::class, 'id', 'section_id');
    }
}
