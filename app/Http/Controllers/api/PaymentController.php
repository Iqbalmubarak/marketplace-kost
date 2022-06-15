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
use App\Models\PaymentMethodDetail;
use Helper;
use DB;
use Carbon\Carbon;

class PaymentController extends Controller
{
  public function addPaymentMethod(Request $request){
    $datas = PaymentMethod::whereIn('id', $request->id)->get();
    if($request->kost_id){
      foreach($datas as $data){
        $detail = PaymentMethodDetail::where('payment_method_id', $data->id)
                                      ->where('kost_id', $request->kost_id)
                                      ->first();
        if($detail){
          $data->no_rek = $detail->no_rek;
        }else{
          $data->no_rek = 'null';
        }
      }
    }

    return response()->json($datas);
  }

  public function getPaymentMethod(Request $request){
    $data = PaymentMethodDetail::find($request->id);
    
    return response()->json($data);
  }

  public function bookingPayment($id){
    $booking = Booking::find($id);
    $datas = PaymentMethodDetail::where('kost_id', $booking->roomType->kost_id)->get();
    foreach($datas as $data){
      $data->payment_method_name = $data->paymentMethod->name;
      $data->count_down = $booking->created_at;
    }

    return response()->json($datas);
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

