<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'latitude',
        'longitude',
        'kost_owner_id',
        'type_id'
    ];

    public function kostOwner()
    {
        return $this->hasOne(kostOwner::class, 'id', 'kost_owner_id');
    }

    public function type()
    {
        return $this->hasOne(Type::class, 'id', 'type_id');
    }

    public function room()
    {
        return $this->hasMany(room::class, 'kost_id', 'id');
    }
}
