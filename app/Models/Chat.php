<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
    use HasFactory;

    public function kostOwner()
    {
        return $this->hasOne(KostOwner::class, 'id', 'kost_owner_id');
    }

    public function kostSeeker()
    {
        return $this->hasOne(KostSeeker::class, 'id', 'kost_seeker_id');
    }

    public function kost()
    {
        return $this->hasOne(Kost::class, 'id', 'kost_id');
    }

    public function chatDetail()
    {
        return $this->hasMany(ChatDetail::class, 'chat_id', 'id');
    }

    public function newMessage(){
        $result = ChatDetail::where('chat_id', $this->id)
                            ->where('receiver', Auth::user()->id)
                            ->orderby('created_at', 'desc')
                            ->first();
        return $result;
    }
}
