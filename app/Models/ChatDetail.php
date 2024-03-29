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

}
