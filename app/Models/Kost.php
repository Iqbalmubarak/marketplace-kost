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
        return $this->hasOne(KostOwner::class, 'id', 'kost_owner_id');
    }

    public function type()
    {
        return $this->hasOne(KostType::class, 'id', 'kost_type_id');
    }

    public function room()
    {
        return $this->hasMany(Room::class, 'kost_id', 'id');
    }

    public function tenant()
    {
        return $this->hasMany(Tenant::class, 'kost_id', 'id');
    }

    public function roomType()
    {
        return $this->hasMany(RoomType::class, 'kost_id', 'id');
    }

    public function paymentMethodDetail()
    {
        return $this->hasMany(PaymentMethodDetail::class, 'kost_id', 'id');
    }

    public function otherKostFacility()
    {
        return $this->hasMany(OtherKostFacility::class, 'kost_id', 'id');
    }

    public function firstRoomType()
    {
        $roomType = RoomType::where('kost_id', $this->id)->first();
        return $roomType;
    }

    public function firstKostImage()
    {
        $kostImage = KostImage::where('kost_id', $this->id)->first();
        return $kostImage;
    }

    public function kostImage()
    {
        return $this->hasMany(KostImage::class, 'kost_id', 'id');
    }

    public function sectionImage($val)
    {
        $image = KostImage::where('kost_id', $this->id)->where('section_id', $val)->get();
        return $image;
    }

    public function kostFacilityDetail()
    {
        return $this->hasMany(KostFacilityDetail::class, 'kost_id', 'id');
    }

    public function rule_detail()
    {
        return $this->hasMany(RuleDetail::class, 'kost_id', 'id');
    }

    public function rule_upload()
    {
        return $this->hasOne(RuleUpload::class, 'kost_id', 'id');
    }

    public function chat()
    {
        return $this->hasMany(Chat::class, 'kost_id', 'id');
    }
}
