<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentDetail extends Model
{
    use HasFactory;

    public function rent()
    {
        return $this->hasOne(Rent::class, 'id', 'rent_id');
    }

    public function priceList()
    {
        return $this->hasOne(PriceList::class, 'id', 'price_list_id');
    }
}
