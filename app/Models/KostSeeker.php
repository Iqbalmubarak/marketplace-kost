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
}
