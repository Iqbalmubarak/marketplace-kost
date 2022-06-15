<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\ChatDetail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Twilio\Rest\Client;

class MessageController extends Controller
{
  public function sendMessage(Request $request){
    $chat = Chat::where('kost_seeker_id', $request->kostSeeker)
                        ->where('kost_owner_id', $request->kostOwner)
                        ->where('kost_id', $request->kost)
                        ->first();
    if($chat){
      $chatDetail = new ChatDetail;
      $chatDetail->chat_id = $chat->id;
      if($request->status){
        $chatDetail->sender = $request->sender;
        $chatDetail->receiver = $request->receiver;
      }else{
        $chatDetail->sender = $request->sender;
        $chatDetail->receiver = $request->receiver;
      }
      $chatDetail->message = $request->message;
      $chatDetail->save();

      $today = Carbon::now();
      $chat->updated_at = $today->format('Y-m-d H:i:s');
      $chat->save();
    }else{
      $chat = new Chat;
      $chat->kost_owner_id = $request->kostOwner;
      $chat->kost_seeker_id = $request->kostSeeker;
      $chat->kost_id = $request->kost;
      $chat->save();

      $chatDetail = new ChatDetail;
      $chatDetail->chat_id = $chat->id;
      if($request->status){
        $chatDetail->sender = $request->sender;
        $chatDetail->receiver = $request->receiver;
      }else{
        $chatDetail->sender = $request->sender;
        $chatDetail->receiver = $request->receiver;
      }
      $chatDetail->message = $request->message;
      $chatDetail->save();
    }
    $data = [
      "name" => $chatDetail->chat->kostSeeker->first_name." ".$chatDetail->chat->kostSeeker->last_name,
      "avatar" => $chatDetail->chat->kostSeeker->avatar,
      "message" => $request->message,
      "created_at" =>$chatDetail->created_at->format('d M Y h.i A'),
      "created_atV2" =>$chatDetail->created_at->format('D M d Y - H:i:s')
    ];
    return response()->json($data);
  }
}

