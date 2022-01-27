<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KostOwner extends Model
{
    use HasFactory;

    protected $fillable = [
        'handphone',
        'first_name',
        'last_name',
        'address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kost()
    {
        return $this->hasMany(Kost::class, 'kost_owner_id', 'id');
    }
}
