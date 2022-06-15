<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingPayment extends Model
{
    use HasFactory;

    public function paymentMethodDetail()
    {
        return $this->hasOne(PaymentMethodDetail::class, 'id', 'payment_method_detail_id');
    }
}
