<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuleDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'kost_id',
        'rule_id'
    ];

    public function rule()
    {
        return $this->belongsTo(Rule::class);
    }
}
