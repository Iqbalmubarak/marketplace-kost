<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rent;
use App\Models\Room;
use App\Models\Tenant;
use App\Models\RoomType;
use App\Models\PriceList;
use App\Models\Booking;
use App\Models\KostSeeker;
use App\Models\PaymentMethod;
use Helper;
use DB;
use Carbon\Carbon;

class PaymentController extends Controller
{
  public function addPaymentMethod(Request $request){
    $data = PaymentMethod::whereIn('id', $request->id)->get();

    return response()->json($data);
  }

  public function rentPayment($id){
    $booking = Booking::find($id);
    $kostSeeker = KostSeeker::find($booking->kost_seeker_id);

    // Set your Merchant Server Key
    \Midtrans\Config::$serverKey = 'SB-Mid-server-1uVUFxhGQNf7kmB1mHx94IZb';
    // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    \Midtrans\Config::$isProduction = false;
    // Set sanitization on (default)
    \Midtrans\Config::$isSanitized = true;
    // Set 3DS transaction for credit card to true
    \Midtrans\Config::$is3ds = true;
    
    $params = array(
        'transaction_details' => array(
            'order_id' => rand(),
            'gross_amount' => 10000,
        ),
        'item_details' => array(
            [
              'id' => $booking->room_type_id,
              'price' => $booking->total_price,
              'quantity' => 1,
              'name' => $booking->roomType->name,
            ]
        ),
        'customer_details' => array(
            'first_name' => $kostSeeker->first_name,
            'last_name' => $kostSeeker->last_name,
            'email' => $kostSeeker->user->email,
            'phone' => $kostSeeker->handphone,
        ),
    );
    
    $snapToken = \Midtrans\Snap::getSnapToken($params);

    return response()->json($snapToken);
  }
}

