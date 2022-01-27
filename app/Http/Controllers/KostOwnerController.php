<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\KostOwner; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use App\Http\Resources\KostOwnerList;

class KostOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {     
            return view('backend.admin.manageKostOwner.index');
            
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
            return view('backend.admin.manageKostOwner.create'); 
        } catch (\Exception $e) {
            return redirect()->back();
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
                'first_name' => 'required|string|max:40',
                'last_name' => 'required|string|max:40',
                'email' => 'required|string|max:255|email',
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required|string|min:8'
            ]);

            $user = new User;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $kost_owner = new KostOwner;
            $kost_owner->first_name = $request->first_name;
            $kost_owner->last_name = $request->last_name;
            $kost_owner->handphone = $request->handphone;
            $kost_owner->address = $request->address;
            $kost_owner->user_id = $user->id;
            $kost_owner->save();

            return redirect()->route('admin.kost-owner.index')->with('success', __('toast.create.success.message'));     
        } catch (\Exception $e) {
            // dd($e);
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
        //
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
        try {
            $kost_owner = KostOwner::find($id);
            return view('backend.admin.manageKostOwner.edit', compact('kost_owner'));
            
        } catch (\Exception $e) {
            return redirect()->back();
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
        //
        try {
            $owner = KostOwner::find($id);
            $owner->first_name = $request->first_name;
            $owner->last_name = $request->last_name;
            $owner->address = $request->address;
            $owner->handphone = $request->handphone;
            $owner->save();
            return redirect()->route('admin.kost-owner.index')->with('success', __('toast.update.success.message'));          
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
            $kost_owner = KostOwner::find($id);
            $kost_owner->delete();
            return redirect()->back()->with('success', __('toast.delete.success.message'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.delete.failed.message'));
        }
    }

    public function getData(Request $request)
    {
        $data = [];
        //?data=all
        if($request->data=="all"){
            $data = KostOwner::orderby('id','desc')->get();
        }
        //?data=id&id=
        elseif($request->data=="id"){
            $data = KostOwner::find($request->id);
        }
        //data=select&id=
        elseif($request->data=="select"){
            $id = explode(',',$request->id);
            $data = KostOwner::wherenotin('id', $id)->get();
        }

        if($data)return response()->json(KostOwnerList::collection($data));
        return $data;
    }
}
