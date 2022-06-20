<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public function history()
    {
        return $this->hasMany(History::class, 'booking_id', 'id');
    }

    public function kostSeeker()
    {
        return $this->hasOne(KostSeeker::class, 'id', 'kost_seeker_id');
    }

    public function priceList()
    {
        return $this->hasOne(PriceList::class, 'id', 'price_list_id');
    }

    public function roomType()
    {
        return $this->hasOne(RoomType::class, 'id', 'room_type_id');
    }

    public function bookingPayment()
    {
        return $this->hasOne(bookingPayment::class, 'booking_id', 'id');
    }


}
