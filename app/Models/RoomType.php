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
        return $this->hasMany(PriceList::class, 'room_type_id', 'id');
    }

    public function roomFacilityDetail()
    {
        return $this->hasMany(RoomFacilityDetail::class, 'room_type_id', 'id');
    }

    public function roomImage()
    {
        return $this->hasMany(RoomImage::class, 'room_type_id', 'id');
    }

    public function booking()
    {
        return $this->hasMany(Booking::class, 'room_type_id', 'id');
    }

    public function optionalPrice()
    {
        return $this->hasMany(optionalPrice::class, 'room_type_id', 'id');
    }
    
    public function kost()
    {
        return $this->hasOne(Kost::class, 'id', 'kost_id');
    }
    
    public function findKost()
    {
        return $this->hasOne(Kost::class, 'id', 'kost_id');
    }

    public function room()
    {
        return $this->hasMany(Room::class, 'room_type_id', 'id');
    }

    public function month()
    {
        $month = PriceList::where('room_type_id', $this->id)->where('rent_duration_id', 1)->first();
        return $month;
    }

    public function image()
    {
        $image = RoomImage::where('room_type_id', $this->id)->where('section_id', 5)->orderBy('created_at', 'desc')->take(2)->get();
        return $image;
    }

    public function sectionImage($val)
    {
        $image = RoomImage::where('room_type_id', $this->id)->where('section_id', $val)->get();
        return $image;
    }

    public function firstImage()
    {
        $image = RoomImage::where('room_type_id', $this->id)->where('section_id', 5)->orderBy('created_at', 'desc')->first();
        return $image;
    }

    
    public function roomLeft()
    {
        $rents = Rent::join('rooms', 'rooms.id', '=', 'rents.room_id')
        ->where('rents.status', 1)
        ->where('rooms.room_type_id', $this->id)
        ->get();

        $room_id = collect([]);;
        foreach($rents as $rent){
            $room_id->push($rent->room_id);
        }

        $room = Room::select('id','name')
        ->where('room_type_id', $this->id)
        ->whereNotIn('id', $room_id)
        ->get();
        return $room->count();
    }
}
