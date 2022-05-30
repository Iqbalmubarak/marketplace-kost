<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Kost;
use App\Models\Room;
use App\Models\Rent;
use App\Models\RentDetail;
use App\Models\Tenant;
use App\Models\History;
use App\Models\TenantDetail;
use App\Models\RoomType;
use App\Models\PriceList;
use App\Models\OptionalPrice;
use App\Http\Resources\HistoryList;
use DB;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class HistoryController extends Controller
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
            $room = Room::pluck('name', 'id');
            $histories = History::where('kost_seeker_id', Auth::user()->kostSeeker->id)->get();
            //dd($histories->rent->room->roomType->firstImage()->image);
            return view('backend.kostSeeker.manageHistory.index', compact('room','histories'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            $history = History::find($id);
            $rent = Rent::find($history->rent_id);
            $price_list = PriceList::select('price_lists.id',DB::RAW("concat(rent_durations.name,'/ ',concat('Rp. ', format(price_lists.price,2, 'id_ID'))) as name"))
            ->join('rent_durations','price_lists.rent_duration_id','=','rent_durations.id')
            ->where('room_type_id', $rent->room->roomType->id)
            ->get()
            ->pluck('name','id');
            $optionals = OptionalPrice::where('room_type_id', $rent->room->roomType->id)->get();
            return view('backend.kostSeeker.manageHistory.show', compact('history','rent','price_list','optionals'));
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.index.failed.message'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function detailStore(Request $request, $id)
    {
        try {    
            $detail = RentDetail::where('rent_id', $id)->orderBy('ended_at', 'desc')->first();
            $price_list = PriceList::find($request->price_list);
            $total_price = preg_replace("/[^0-9]/", "", $request->total_price);
            $total_price = (int) $total_price;
            $rent_detail = new RentDetail;
            $rent_detail->rent_id = $id;
            $rent_detail->total_price = $total_price;
            $rent_detail->started_at = date('Y-m-d', strtotime('+1days', strtotime($detail->ended_at)));;
            $ended_at = new Carbon($rent_detail->started_at);
            $rent_detail->ended_at = $ended_at->addDays($price_list->rentDuration->day);
            $rent_detail->price_list_id = $request->price_list;
            $rent_detail->status = 2;

            //Rule upload
            $dir = storage_path().'/app/public/images/payment';
            $filePayment = $request->file('payment');                

            $fileName = Time().".".$filePayment->getClientOriginalName();
            $filePayment->move($dir, $fileName);

            if($filePayment){
                $rent_detail->document = $fileName;
            }

            $rent_detail->save();

            $history = History::where('rent_id', $id)->first();

            return redirect()->route('customer.history.show', $history->id)->with('success', __('toast.create.success.message'));      
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', __('toast.create.failed.message'));
        }
    }

    public function getData(Request $request)
    {
        $data = [];
        //?data=all
        if($request->data=="all"){
            $data = History::orderby('id','desc')->get();
        }
        //?data=customer
        if($request->data=="customer"){
            $data = History::where('kost_seeker_id', 1)->orderby('id','desc')->get();
        }
        //?data=id&id=
        elseif($request->data=="id"){
            $data = History::find($request->id);
        }
        //data=select&id=
        elseif($request->data=="select"){
            $id = explode(',',$request->id);
            $data = History::wherenotin('id', $id)->get();
        }

        if($data)return response()->json(HistoryList::collection($data));
        return $data;
    }
}
