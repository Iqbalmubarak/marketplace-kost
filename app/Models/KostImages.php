<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KostImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'img',
        'kost_id'
    ];

    public function kost()
    {
        return $this->hasOne(Room::class, 'id', 'kost');
    }
}
