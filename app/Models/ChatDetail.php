<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatDetail extends Model
{
    use HasFactory;

    public function chat()
    {
        return $this->hasOne(Chat::class, 'id', 'chat_id');
    }

    public function kostOwner()
    {
        return $this->hasOne(KostOwner::class, 'id', 'sender');
    }

    public function kostSeeker()
    {
        return $this->hasOne(KostSeeker::class, 'id', 'sender');
    }

}
