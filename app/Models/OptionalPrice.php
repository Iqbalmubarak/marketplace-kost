<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionalPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'price',
        'price_list_id'
    ];

    public function priceList()
    {
        return $this->hasOne(PriceList::class, 'id', 'price_list_id');
    }
}
