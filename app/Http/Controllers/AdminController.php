<?php

namespace App\Http\Controllers;
use App\Models\User; 
use App\Models\Admin; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Resources\AdminList;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('backend.admin.manageAdmin.index');
            
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
            return view('backend.admin.create'); 
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

            $admin = new Admin;
            $admin->first_name = $request->first_name;
            $admin->last_name = $request->last_name;
            $admin->handphone = $request->handphone;
            $admin->address = $request->address;
            $admin->user_id = $user->id;
            $admin->save();

            return redirect()->route('admin.admin.manageAdmin.index')->with('success', __('toast.create.success.message'));     
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
            $admin = Admin::find($id);
            return view('backend.admin.manageAdmin.edit', compact('admin'));
            
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
            $admin = Admin::find($id);
            $admin->first_name = $request->first_name;
            $admin->last_name = $request->last_name;
            $admin->address = $request->address;
            $admin->handphone = $request->handphone;
            $admin->save();
            return redirect()->route('admin.admin.manageAdmin.index')->with('success', __('toast.update.success.message'));          
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
            $admins = Admin::find($id);
            $admins->delete();
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
            $data = Admin::orderby('id','desc')->get();
        }
        //?data=id&id=
        elseif($request->data=="id"){
            $data = Admin::find($request->id);
        }
        //data=select&id=
        elseif($request->data=="select"){
            $id = explode(',',$request->id);
            $data = Admin::wherenotin('id', $id)->get();
        }

        if($data)return response()->json(AdminList::collection($data));
        return $data;
    }
}
