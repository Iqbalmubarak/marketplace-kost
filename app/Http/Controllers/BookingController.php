<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Booking; 
use App\Models\Room; 
use App\Models\RoomType; 
use App\Models\Kost; 
use App\Models\History; 
use App\Models\Tenant; 
use App\Models\Rent; 
use App\Models\RentDetail; 
use App\Models\KostSeeker; 
use App\Http\Resources\BookingList;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try {
            if(Auth::user()->isOwner())
            {
                $room = Room::pluck('name', 'id');
                return view('backend.kostOwner.manageBooking.index', compact('room'));
            }
            elseif(Auth::user()->isAdmin())
            {
                $room = Room::all();
                return view('backend.admin.manageBooking.index', compact('room'));
            }
            
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back();
        }
    }

    public function indexCustomer()
    {
        //
        try {
            $bookings = Booking::where('kost_seeker_id', Auth::user()->kostSeeker->id)->orderby('id','desc')->get();
            return view('backend.kostSeeker.manageBooking.index', compact('bookings'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {       
            $booking = Booking::find($id);

            return view('backend.kostOwner.manageBooking.show', compact('booking'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.index.failed.message'));
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function payment(Request $request)
    {
        try {
            $booking = Booking::find($request->booking_id);

            $rent = new Rent;
            $rent->room_id = $booking->room_id;
            $rent->status = 1;
            $rent->save();

            $rentDetail = new RentDetail;
            $rentDetail->rent_id = $rent->id;
            $rentDetail->status = 1;
            $rentDetail->total_price = $booking->total_price;
            $rentDetail->started_at = $booking->started_at;
            $rentDetail->ended_at = $booking->ended_at;
            $rentDetail->price_list_id = $booking->price_list_id;
            
            $json = json_decode($request->get('json'));
            $rentDetail->transaction_status = $json->transaction_status;
            $rentDetail->transaction_id = $json->transaction_id;
            $rentDetail->id = $json->order_id;
            $rentDetail->gross_amount = $json->gross_amount;
            $rentDetail->payment_type = $json->payment_type;
            $rentDetail->payment_code = isset($json->payment_code) ? $json->payment_code : null;
            $rentDetail->pdf_url = isset($json->pdf_url) ? $json->pdf_url : null;
            $rentDetail->save();

            $history = new History;
            $history->kost_seeker_id = $booking->kost_seeker_id;
            $history->rent_id = $rent->id;
            $history->save();

            $room = Room::find($booking->room_id);
            $kostSeeker = KostSeeker::find($booking->kost_seeker_id);

            $tenant = new Tenant;
            $tenant->name = $kostSeeker->first_name.' '.$kostSeeker->last_name;
            $tenant->handphone = $kostSeeker->handphone;
            $tenant->avatar = $kostSeeker->avatar;
            $tenant->gender = $kostSeeker->gender;
            $tenant->birth_place = $kostSeeker->birth_place;
            $tenant->birth_day = $kostSeeker->birth_day;
            $tenant->emergency = $kostSeeker->emergency;
            $tenant->job = $kostSeeker->job;
            $tenant->job_name = $kostSeeker->job_name;
            $tenant->job_description = $kostSeeker->job_description;
            $tenant->kost_id = $room->kost_id;
            $tenant->save();
                
            
            return redirect()->back()->with('success', __('toast.confirm.success.message')) ;
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', __('toast.confirm.failed.message'));
        }
    }

    public function accept(Request $request, $id)
    {
        try {
            $booking = Booking::find($id);
            $booking->status = 2;
            $booking->save();

            $rent = new Rent;
            $rent->room_id = $request->room;
            $rent->status = 1;
            $rent->save();

            $rentDetail = new RentDetail;
            $rentDetail->rent_id = $rent->id;
            $rentDetail->status = 1;
            $rentDetail->total_price = $booking->total_price;
            $rentDetail->started_at = $booking->started_at;
            $rentDetail->ended_at = $booking->ended_at;
            $rentDetail->price_list_id = $booking->price_list_id;
            $rentDetail->payment = $booking->payment;
            $rentDetail->save();

            $history = new History;
            $history->kost_seeker_id = $booking->kost_seeker_id;
            $history->rent_id = $rent->id;
            $history->save();

            $room = Room::find($request->room);
            $kostSeeker = KostSeeker::find($booking->kost_seeker_id);

            $tenant = new Tenant;
            $tenant->name = $kostSeeker->first_name.' '.$kostSeeker->last_name;
            $tenant->handphone = $kostSeeker->handphone;
            $tenant->avatar = $kostSeeker->avatar;
            $tenant->gender = $kostSeeker->gender;
            $tenant->birth_place = $kostSeeker->birth_place;
            $tenant->birth_day = $kostSeeker->birth_day;
            $tenant->emergency = $kostSeeker->emergency;
            $tenant->job = $kostSeeker->job;
            $tenant->job_name = $kostSeeker->job_name;
            $tenant->job_description = $kostSeeker->job_description;
            $tenant->kost_id = $room->kost_id;
            $tenant->save();

            return redirect()->route('owner.booking.index')->with('success', __('toast.confirm.success.message'));     
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.confirm.failed.message'));
        }
    }

    public function reject($id)
    {
        try {
            $booking = Booking::find($id);
            $booking->status = 3;
            $booking->save();

            return redirect()->route('owner.booking.index')->with('success', __('toast.reject.success.message'));     
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.reject.failed.message'));
        }
    }

    public function getData(Request $request)
    {
        $data = [];
        //?data=all
        if($request->data=="all"){
            $data = Booking::orderby('id','desc')->get();
        }
        //?data=all
        if($request->data=="owner"){
            $kosts = Kost::where('kost_owner_id', Auth::user()->kostOwner->id)->get();
            $kost_id = collect([]);
            foreach($kosts as $kost){
                $kost_id->push($kost->id);
            }
            $roomTypes = RoomType::whereIn('kost_id', $kost_id)->get();
            $room_type_id = collect([]);
            foreach($roomTypes as $roomType){
                $room_type_id->push($roomType->id);
            }
            $data = Booking::whereIn('room_type_id', $room_type_id)->orderby('id','desc')->get();
        }
        //?data=customer
        if($request->data=="customer"){
            $data = Booking::where('kost_seeker_id', Auth::user()->kostSeeker->id)->orderby('id','desc')->get();
        }
        //?data=id&id=
        elseif($request->data=="id"){
            $data = Booking::find($request->id);
        }
        //data=select&id=
        elseif($request->data=="select"){
            $id = explode(',',$request->id);
            $data = Booking::wherenotin('id', $id)->get();
        }

        if($data)return response()->json(BookingList::collection($data));
        return $data;
    }
}
