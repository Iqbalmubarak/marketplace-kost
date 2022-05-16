<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Rent extends Model
{
    use HasFactory;

    public function rentDetail()
    {
        return $this->hasMany(RentDetail::class, 'rent_id', 'id');
    }

    public function tenantDetail()
    {
        return $this->hasMany(TenantDetail::class, 'rent_id', 'id');
    }

    public function room()
    {
        return $this->hasOne(Room::class, 'id', 'room_id');
    }

    public function booking()
    {
        return $this->hasMany(Booking::class, 'rent_id', 'id');
    }

    public function history()
    {
        return $this->hasOne(History::class, 'rent_id', 'id');
    }

    public function percentage()
    {
        $percentage = RentDetail::where('rent_id', $this->id)->where('status', 1)->first();
        return $percentage;
    }

    public function started()
    {
        $started = RentDetail::where('rent_id', $this->id)->orderBy('started_at', 'asc')->first();
        return $started;
    }

    public function ended()
    {
        $ended = RentDetail::where('rent_id', $this->id)->orderBy('ended_at', 'desc')->first();
        return $ended;
    }

    public function duration()
    {
        $rentDetail = RentDetail::where('rent_id', $this->id)->where('status', 1)->first();
        $priceList = PriceList::find($rentDetail->price_list_id);
        $day = $priceList->rentDuration->day;
        return $day;
    }
}
