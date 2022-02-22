<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Kost; 
use App\Models\Rule; 
use App\Models\KostType; 
use App\Models\KostFacility; 
use App\Http\Resources\KostList;
use Illuminate\Support\Facades\Auth;

class KostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {       
            $locations = Kost::select(['latitude', 'longitude'])
                        ->where('kost_owner_id', Auth::user()->kostOwner->id)->get();
            $type = KostType::pluck('name','id');
            return view('backend.kostOwner.manageKost.index', compact('type','locations'));
        } catch (\Exception $e) {
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
            $kost_type = KostType::pluck('name','id');
            $rules = Rule::all();
            return view('backend.kostOwner.manageKost.create', compact('kost_type','rules'));
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
            $request->validate([
                'name' => 'required|string',
                'address' => 'required|string',
                'latitude' => 'required|string',
                'longitude' => 'required|string'
            ]);
            

            $kost = new Kost;
            $kost->name = $request->name;
            $kost->address = $request->address;
            $kost->latitude = $request->latitude;
            $kost->longitude = $request->longitude;
            $kost->type_id = $request->type;
            $kost->kost_owner_id = Auth::user()->kostOwner->id;
            $kost->save();

            if($kost->id){
                for($i=0; $i < count($request->facility); $i++){
                    $kostFacility = new KostFacility;
                    $kostFacility->kost_id = $kost->id;
                    $kostFacility->facility = $request->facility[$i];
                    $kostFacility->save();
                }
            }

            return redirect()->route('owner.kost.index')->with('success', __('toast.create.success.message'));     
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
        dd($id);
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
        try {
            $request->validate([
                'name' => 'required|string',
                'address' => 'required|string',
                'latitude' => 'required|string',
                'longitude' => 'required|string'
            ]);

            $kost = Kost::find($id);
            $kost->name = $request->name;
            $kost->address = $request->address;
            $kost->latitude = $request->latitude;
            $kost->longitude = $request->longitude;
            $kost->type_id = $request->type;
            $kost->save();

            return redirect()->route('owner.kost.index')->with('success', __('toast.update.success.message'));     
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
            $kost = Kost::find($id);
            $kost->delete();
            return redirect()->back()->with('success', __('toast.delete.success.message'));
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.delete.failed.message'));
        }
    }

    public function getLocation(Request $request)
    {
        $data = [];
        $data = Kost::select(['latitude', 'longitude'])
        ->where('kost_owner_id', $request->user)
        ->get();

        return response()->json($data);
    }

    public function getData(Request $request)
    {
        $data = [];
        //?data=all
        if($request->data=="all"){
            $data = Kost::where('kost_owner_id', $request->user)
            ->orderby('id','desc')
            ->get();
        }
        //?data=id&id=
        elseif($request->data=="id"){
            $data = Kost::find($request->id);
        }
        //data=select&id=
        elseif($request->data=="select"){
            $id = explode(',',$request->id);
            $data = Kost::wherenotin('id', $id)->get();
        }

        if($data)return response()->json(KostList::collection($data));
        return $data;
    }
}
