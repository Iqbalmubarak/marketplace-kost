<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KostFacility extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'facility',
        'kost_id'
    ];

    public function kost()
    {
        return $this->hasOne(Room::class, 'id', 'kost');
    }

}
