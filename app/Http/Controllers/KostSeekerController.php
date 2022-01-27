<?php

namespace App\Http\Controllers;
use App\Models\User; 
use App\Models\Admin; 
use App\Models\kostSeeker; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Resources\KostSeekerList;

class KostSeekerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('backend.admin.manageKostSeeker.index');
            
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
        try {
            return view('backend.admin.manageKostSeeker.create'); 
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

            $kost_seeker = new KostSeeker;
            $kost_seeker->first_name = $request->first_name;
            $kost_seeker->last_name = $request->last_name;
            $kost_seeker->handphone = $request->handphone;
            $kost_seeker->address = $request->address;
            $kost_seeker->user_id = $user->id;
            $kost_seeker->save();

            return redirect()->route('admin.kost-seeker.index')->with('success', __('toast.create.success.message'));     
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
        try {
            $kost_seeker = KostSeeker::find($id);
            return view('backend.admin.manageKostSeeker.edit', compact('kost_seeker'));
            
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
        try {
            $kost_seeker = KostSeeker::find($id);
            $kost_seeker->first_name = $request->first_name;
            $kost_seeker->last_name = $request->last_name;
            $kost_seeker->address = $request->address;
            $kost_seeker->handphone = $request->handphone;
            $kost_seeker->save();
            return redirect()->route('admin.kost-seeker.index')->with('success', __('toast.update.success.message'));          
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
            $kost_seekers = KostSeeker::find($id);
            $kost_seekers->delete();
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
            $data = KostSeeker::orderby('id','desc')->get();
        }
        //?data=id&id=
        elseif($request->data=="id"){
            $data = KostSeeker::find($request->id);
        }
        //data=select&id=
        elseif($request->data=="select"){
            $id = explode(',',$request->id);
            $data = KostSeeker::wherenotin('id', $id)->get();
        }

        if($data)return response()->json(KostSeekerList::collection($data));
        return $data;
    }
}
