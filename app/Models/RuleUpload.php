<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuleUpload extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'image',
        'kost_id'
    ];
}
