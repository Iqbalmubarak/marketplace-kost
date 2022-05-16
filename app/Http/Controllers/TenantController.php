<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kost;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {       
            $kosts = Kost::select('id')->where('kost_owner_id', Auth::user()->kostOwner->id)->get();

            $tenants = Tenant::whereIn('kost_id', $kosts)
            ->orderby('id','desc')
            ->get();

            return view('backend.kostOwner.manageTenant.index', compact('tenants'));
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
            $gender = [];
            $gender = ['1' => 'Pria', '2' => 'Wanita'];
            $job = [];
            $job = ['1' => 'Mahasiswa', '2' => 'Karyawan', '3' => 'Lainnya'];
            $kost = Kost::where('kost_owner_id', Auth::user()->kostOwner->id)->get()->pluck('name', 'id');
            return view('backend.kostOwner.manageTenant.create', compact('kost','gender','job'));
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
            $tenant = new Tenant;
            $tenant->name = $request->name;
            $tenant->gender = $request->gender;
            $tenant->birth_place = $request->birth_place;
            $tenant->birth_day = $request->birth_day;
            $tenant->handphone = $request->handphone;
            $tenant->emergency = $request->emergency;
            $tenant->job = $request->job;
            $tenant->job_name = $request->job_name;
            $tenant->job_description = $request->description;
            $tenant->kost_id = $request->kost;

            $dir = storage_path().'/app/public/images/avatar';
            $file = $request->file('avatar');
            if($file){
                $fileName = Time().".".$file->getClientOriginalName();
                $file->move($dir, $fileName);

                $tenant->avatar = $fileName;
            }
            
            $tenant->save();
            return redirect()->route('owner.tenant.index')->with('success', __('toast.create.success.message'));    
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
            $tenant = Tenant::find($id);
            return view('backend.kostOwner.manageTenant.show', compact('tenant'));
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
        try {
            $tenant = Tenant::find($id);
            $gender = [];
            $gender = ['1' => 'Pria', '2' => 'Wanita'];
            $job = [];
            $job = ['1' => 'Mahasiswa', '2' => 'Karyawan', '3' => 'Lainnya'];
            $kost = Kost::where('kost_owner_id', Auth::user()->kostOwner->id)->get()->pluck('name', 'id');
            return view('backend.kostOwner.manageTenant.edit', compact('tenant','kost','job','gender'));
            
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
            $tenant = Tenant::find($id);
            $tenant->name = $request->name;
            $tenant->gender = $request->gender;
            $tenant->birth_place = $request->birth_place;
            $tenant->birth_day = $request->birth_day;
            $tenant->handphone = $request->handphone;
            $tenant->emergency = $request->emergency;
            $tenant->job = $request->job;
            $tenant->job_name = $request->job_name;
            $tenant->job_description = $request->description;
            $tenant->kost_id = $request->kost;

            $dir = storage_path().'/app/public/images/avatar';
            $file = $request->file('avatar');
            if($file){
                $fileName = Time().".".$file->getClientOriginalName();
                $file->move($dir, $fileName);

                $tenant->avatar = $fileName;
            }
            
            $tenant->save();
            return redirect()->route('owner.tenant.index')->with('success', __('toast.update.success.message'));    
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
        //
        try {
            $tenant = Tenant::find($id);
            $tenant->delete();
            return redirect()->back()->with('success', __('toast.delete.success.message'));
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.delete.failed.message'));
        }
    }
}
