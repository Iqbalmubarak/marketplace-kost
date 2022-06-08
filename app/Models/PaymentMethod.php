<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    public function isChecked($kost_id){
        $result = PaymentMethodDetail::where('payment_method_id', $this->id)
                                        ->where('kost_id', $kost_id)
                                        ->first();

        return $result;
    }
}
