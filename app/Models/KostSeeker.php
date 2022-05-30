<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KostSeeker extends Model
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

    public function booking()
    {
        return $this->hasMany(Booking::class, 'kost_seeker_id', 'id');
    }

    public function chat()
    {
        return $this->hasMany(Chat::class, 'kost_seeker_id', 'id');
    }
}
