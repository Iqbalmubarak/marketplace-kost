<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    public function rent()
    {
        return $this->hasOne(Rent::class, 'id', 'rent_id');
    }

    public function kostSeeker()
    {
        return $this->hasOne(KostSeeker::class, 'id', 'kost_seeker_id');
    }

}
