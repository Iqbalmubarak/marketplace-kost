<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KostImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'image',
        'kost_id'
    ];

    public function kost()
    {
        return $this->hasOne(Room::class, 'id', 'kost_id');
    }

    public function section()
    {
        return $this->hasOne(Section::class, 'id', 'section_id');
    }

}
