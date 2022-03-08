<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Room; 
use App\Models\Kost; 
use App\Http\Resources\RoomList;

class RoomController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function roomStore(Request $request, $id)
    {
        try {
            if(!Room::where('kost_id', $id)->whereRaw("UPPER(name) = '".strtoupper($request->room_name)."'")->first()){
                $room = new Room;
                $room->name = $request->room_name;
                $room->room_type_id = $request->room_type;
                $room->kost_id = $id;
                if($request->availability){
                    $room->status = 1;
                }
                $room->save();
            }else{
                return redirect()->back()->with('error', __('toast.create.unique.message'));
            }
            

            $kost = Kost::find($id);    
            $rooms = Room::groupBy('rooms.room_type_id')
            ->join('room_types', 'room_types.id', '=', 'rooms.room_type_id')
            ->select('rooms.room_type_id', \DB::raw('count(*) as total'))
            ->where('rooms.kost_id', $id)
            ->get();
            $room_type = Room::groupBy('rooms.room_type_id')->groupBy('room_types.name')
            ->join('room_types', 'room_types.id', '=', 'rooms.room_type_id')
            ->select('rooms.room_type_id', \DB::raw('count(*) as total'), 'room_types.name')
            ->where('rooms.kost_id', $id)
            ->pluck('room_types.name','rooms.room_type_id');

            return redirect()->route('owner.kost.show', compact('kost','rooms','room_type'))->with('success', __('toast.create.success.message'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.create.failed.message'));
        }
    }

    public function roomUpdate(Request $request, $id)
    {
        try {
            $room = Room::find($id);
            if(!Room::where('kost_id', $room->kost_id)->whereRaw("UPPER(name) = '".strtoupper($request->room_name)."'")->first()){
                $room->name = $request->room_name;
                $room->room_type_id = $request->room_type;
                if($request->availability){
                    $room->status = 1;
                }else{
                    $room->status = 0;
                }
                $room->save();
            }else{
                return redirect()->back()->with('error', __('toast.create.unique.message'));
            }

            $kost = Kost::find($room->kost_id);    
            $rooms = Room::groupBy('rooms.room_type_id')
            ->join('room_types', 'room_types.id', '=', 'rooms.room_type_id')
            ->select('rooms.room_type_id', \DB::raw('count(*) as total'))
            ->where('rooms.kost_id', $id)
            ->get();
            $room_type = Room::groupBy('rooms.room_type_id')->groupBy('room_types.name')
            ->join('room_types', 'room_types.id', '=', 'rooms.room_type_id')
            ->select('rooms.room_type_id', \DB::raw('count(*) as total'), 'room_types.name')
            ->where('rooms.kost_id', $id)
            ->pluck('room_types.name','rooms.room_type_id');

            return redirect()->route('owner.kost.show', compact('kost','rooms','room_type'))->with('success', __('toast.update.success.message'));
        } catch (\Exception $e) {
            dd($e);
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
        //
    }

    public function getData(Request $request)
    {
        $data = [];
        //?data=all
        if($request->data=="all"){
            $data = Room::where('kost_id', $request->id)
            ->orderby('id','desc')
            ->get();
        }
        //?data=id&id=
        elseif($request->data=="id"){
            $data = Room::find($request->id);
        }
        //data=select&id=
        elseif($request->data=="select"){
            $id = explode(',',$request->id);
            $data = Room::wherenotin('id', $id)->get();
        }

        if($data)return response()->json(RoomList::collection($data));
        return $data;
    }
}
