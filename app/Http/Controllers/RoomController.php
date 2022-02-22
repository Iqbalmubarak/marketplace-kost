<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Room; 
use App\Http\Resources\RoomList;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {       
            return view('backend.kostOwner.manageRoom.index');
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
        try {       
            return view('backend.kostOwner.manageRoom.index', compact('id'));
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
