<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function admin()
    {
        return $this->hasOne('App\Models\Admin');
    }

    public function kostSeeker()
    {
        return $this->hasOne('App\Models\KostSeeker');
    }

    public function kostOwner()
    {
        return $this->hasOne('App\Models\KostOwner');
    }

    /**
     *  Mencek apakah user yang login ada pada tabel admin
     * @return bool
     */
    public function isAdmin(){
        return null !== $this->admin()->first();
    }
    /**
     *  Mencek apakah user yang login ada pada tabel owners
     * @return bool
     */
    public function isOwner(){
        return null !== $this->kostOwner()->first();
    }
    /**
     *  Mencek apakah user yang login ada pada tabel customer
     * @return bool
     */
    public function isCustomer(){
        return null !== $this->kostSeeker()->first();
    }
}
