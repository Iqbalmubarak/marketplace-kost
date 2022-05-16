<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    public function kost()
    {
        return $this->hasOne(Kost::class, 'id', 'kost_id');
    }

    public function tenantDetail()
    {
        return $this->hasMany(tenantDetail::class, 'tenant_id', 'id');
    }
}
