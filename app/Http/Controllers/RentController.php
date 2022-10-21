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
use App\Models\TenantDetail;
use App\Models\RoomType;
use App\Models\PriceList;
use App\Models\OptionalPrice;
use App\Http\Resources\RentList;
use DB;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use App\Mail\NotifyRent;
use Mail;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {       
            if(Auth::user()->isOwner())
                {
                    $kosts = Kost::select('id')->where('kost_owner_id', Auth::user()->kostOwner->id)->get();
                    $room_id = collect([]);;
                    foreach($kosts as $kost){
                        foreach ($kost->room as $room) {
                            
                            $room_id->push($room->id);
                        }
                    }
                    
                    $rents = Rent::whereIn('room_id', $room_id)->orderBy('created_at', 'desc')->get();
                    //dd($rents);
                    //dd($rents[19]->ended()->ended_at);
                    // foreach($rents as $rent){
                    //     $ended_at = new DateTime($rent->ended()->ended_at);
                    //     dd($ended_at);
                    // }
                    return view('backend.kostOwner.manageRent.index', compact('rents'));
                } 
            elseif(Auth::user()->isAdmin())
                {
                    $kosts = Kost::all();
                    $room_id = collect([]);;
                    foreach($kosts as $kost){
                        foreach ($kost->room as $room) {
                            
                            $room_id->push($room->id);
                        }
                    }
                    $rents = Rent::whereIn('room_id', $room_id)->orderBy('created_at', 'desc')->get();
                    return view('backend.admin.manageRent.index', compact('rents'));
                }
            
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', __('toast.index.failed.message'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $kost = Kost::where('kost_owner_id', Auth::user()->kostOwner->id)->where('status', 1)->get()->pluck('name', 'id');
            $room_type = RoomType::get()->pluck('name', 'id');
            $room = Room::get()->pluck('name', 'id');
            $price_list = PriceList::select('price_lists.id',DB::RAW("concat(rent_durations.name,'/ ',concat('Rp. ', format(price_lists.price,2, 'id_ID'))) as name"))
            ->join('rent_durations','price_lists.rent_duration_id','=','rent_durations.id')
            ->get()
            ->pluck('name','id');
            $tenant = Tenant::pluck('name', 'id');
            $optionals = OptionalPrice::all();
            return view('backend.kostOwner.manageRent.create', compact('tenant','kost','room_type','room','price_list','optionals'));
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
    public function store(Request $request)
    {
        try {    
            //dd($request);
            $price_list = PriceList::find($request->price_list);

            $rent = new Rent;
            $rent->room_id = $request->room;
            $rent->save();

            $total_price = preg_replace("/[^0-9]/", "", $request->total_price);
            $total_price = (int) $total_price;

            $rent_detail = new RentDetail;
            $rent_detail->rent_id = $rent->id;
            $rent_detail->total_price = $total_price;
            $rent_detail->started_at = Carbon::today();
            $rent_detail->ended_at = Carbon::today()->addDays($price_list->rentDuration->day);
            $rent_detail->price_list_id = $request->price_list;
            $rent_detail->status = 1;
            $rent_detail->save();

            foreach($request->tenant as $tenant){
                $tenant_detail = new TenantDetail;
                $tenant_detail->tenant_id = $tenant;
                $tenant_detail->rent_id = $rent->id;
                $tenant_detail->save();
            }

            return redirect()->route('owner.rent.index')->with('success', __('toast.create.success.message'));    
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.create.failed.message'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {       
            $rent = Rent::find($id);
            $price_list = PriceList::select('price_lists.id',DB::RAW("concat(rent_durations.name,'/ ',concat('Rp. ', format(price_lists.price,2, 'id_ID'))) as name"))
            ->join('rent_durations','price_lists.rent_duration_id','=','rent_durations.id')
            ->where('room_type_id', $rent->room->roomType->id)
            ->get()
            ->pluck('name','id');
            $optionals = OptionalPrice::where('room_type_id', $rent->room->roomType->id)->get();
            return view('backend.kostOwner.manageRent.show', compact('rent','price_list','optionals'));
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
        try {       
            $rent = Rent::find($id);
            $tenant_id = collect([]);
            foreach ($rent->tenantDetail as $tenantDetail){
                $tenant_id->push($tenantDetail->tenant->id);
            }
            $kost = Kost::where('kost_owner_id', Auth::user()->kostOwner->id)->get()->pluck('name', 'id');
            $room_type = RoomType::where('kost_id', $rent->room->kost->id)->get()->pluck('name', 'id');
            $room = Room::where('room_type_id', $rent->room->room_type_id)->get()->pluck('name', 'id');
            $tenant = Tenant::where('kost_id', $rent->room->kost->id)->get()->pluck('name', 'id');
            return view('backend.kostOwner.manageRent.edit', compact('rent','tenant','kost','room_type','room','tenant_id'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.index.failed.message'));
        }
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
        try {    
            $rent = Rent::find($id);
            $rent->room_id = $request->room;
            $rent->save();

            $tenantDetails = TenantDetail::where('rent_id', $id)->get();
            foreach($tenantDetails as $tenantDetail){
                $tenantDetail->delete();
            }
            
            foreach($request->tenant as $tenant){
                $tenant_detail = new TenantDetail;
                $tenant_detail->tenant_id = $tenant;
                $tenant_detail->rent_id = $rent->id;
                $tenant_detail->save();
            }

            return redirect()->route('owner.rent.show', $id)->with('success', __('toast.update.success.message'));    
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.update.failed.message'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {    
            $rent = Rent::find($id);
            $rent->delete();

            return redirect()->route('owner.rent.index')->with('success', __('toast.delete.success.message'));    
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.delete.failed.message'));
        }
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
            $rent_detail->started_at = date('Y-m-d', strtotime('+1days', strtotime($detail->ended_at)));
            $ended_at = new Carbon($rent_detail->started_at);
            $rent_detail->ended_at = $ended_at->addDays($price_list->rentDuration->day);
            $rent_detail->price_list_id = $request->price_list;
            $rent_detail->status = 1;
            $rent_detail->save();

            return redirect()->route('owner.rent.show', $id)->with('success', __('toast.create.success.message'));      
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.create.failed.message'));
        }
    }

    public function stopRent($id)
    {
        try {    
            $rent = Rent::find($id);
            $rent->status = 2;
            $rent->save();

            return redirect()->route('owner.rent.show', $id)->with('success', __('toast.update.success.message'));      
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.update.failed.message'));
        }
    }

    public function notify($id){
        try {    
            $rent = Rent::find($id);

            Mail::to($rent->history->kostSeeker->user->email)->send(new NotifyRent($rent));

            return redirect()->route('owner.rent.show', $id)->with('success', __('toast.update.success.message'));      
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.update.failed.message'));
        }
    }

    public function getData(Request $request)
    {
        $data = [];
        //?data=all
        if($request->data=="all"){
            $data = Rent::orderby('id','desc')->get();
        }
        
        if($data)return response()->json(RentList::collection($data));
        return $data;
    }
    
}
