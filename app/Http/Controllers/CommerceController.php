<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kost; 
use App\Models\RoomType; 
use App\Models\PriceList; 
use App\Models\Booking; 
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CommerceController extends Controller
{
    public function index(){
        try {    
            $kosts = Kost::select('id')->where('status', 1)->get();
            $kost_id = collect([]);;
            foreach($kosts as $kost){
                $kost_id->push($kost->id);
            }
            $roomTypes = RoomType::whereIn('kost_id', $kost_id)->get();
            return view('backend.kostSeeker.commerce.index', compact('roomTypes')); 
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.index.failed.message'));
        }
    }

    public function show($id){
        try {    
            $roomType = RoomType::find($id);
            $duration = PriceList::select('price_lists.id as id', 'rent_durations.name as name')
            ->join('rent_durations', 'price_lists.rent_duration_id', '=', 'rent_durations.id')
            ->where('price_lists.room_type_id', $roomType->id)
            ->get()
            ->pluck('name', 'id');
            $today = Carbon::today();
            $today = $today->format('m/d/Y');
            return view('backend.kostSeeker.commerce.show', compact('roomType', 'duration', 'today')); 
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.index.failed.message'));
        }
    }

    public function store(Request $request){
        try {   
            $total_price = preg_replace("/[^0-9]/", "", $request->price);
            $total_price = (int) $total_price;

            $booking = new Booking;
            $booking->kost_seeker_id = Auth::user()->kostSeeker->id;
            $booking->room_type_id = $request->room_type;
            $booking->price_list_id = $request->price_list_id;
            $booking->total_price = $total_price;
            $booking->started_at = Carbon::create($request->start)->format('Y-m-d');
            $booking->ended_at = Carbon::create($request->end)->format('Y-m-d');

            //Payment upload
            $dir = storage_path().'/app/public/images/payment';
            $filePayment = $request->file('payment');                

            $fileName = Time().".".$filePayment->getClientOriginalName();
            $filePayment->move($dir, $fileName);

            if($filePayment){
                $booking->payment = $fileName;
            }

            $booking->save();
            return redirect()->route('customer.booking.indexCustomer', $request->room_type)->with('success', __('Berhasil melakukan penyewaan kamar')); 
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', __('Gagal melakukan penyewaan kamar'));
        }
    }
}
