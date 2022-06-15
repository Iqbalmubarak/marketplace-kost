<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\KostSeeker;
use App\Models\KostOwner;
use App\Models\History;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        try {
            if(Auth::user()->isCustomer()){
                $user = Auth::user();
                $cities = City::pluck('city_name','city_id');
                $job = [];
                $job = ['1' => 'Mahasiswa', '2' => 'Karyawan', '3' => 'Lainnya'];
                $histories = History::where('kost_seeker_id', Auth::user()->kostSeeker->id)->get();
                $bookings = Booking::where('kost_seeker_id', Auth::user()->kostSeeker->id)->orderby('id','desc')->get();
                return view('backend.kostSeeker.profile.index', compact('user','cities','job','histories','bookings'));
            }elseif(Auth::user()->isOwner()){
                $user = Auth::user()->kostOwner;
                return view('backend.kostOwner.manageProfile.index', compact('user'));
            }
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back();
        }
    }

    public function update(Request $request){
        try {
            if(Auth::user()->isCustomer()){
                $kostSeeker = KostSeeker::where('user_id', Auth::user()->kostSeeker->user_id)->first();
                $kostSeeker->first_name = $request->first_name;
                $kostSeeker->last_name = $request->last_name;
                $kostSeeker->gender = $request->gender;
                $kostSeeker->birth_place = $request->birth_place;
                $kostSeeker->birth_day = $request->birth_day;
                $kostSeeker->handphone = $request->handphone;
                $kostSeeker->emergency = $request->emergency;
                $kostSeeker->job = $request->job;
                $kostSeeker->job_name = $request->job_name;
                $kostSeeker->job_description = $request->description;

                $dir = storage_path().'/app/public/images/avatar';
                $file = $request->file('avatar');
                if($file){
                    $fileName = Time().".".$file->getClientOriginalName();
                    $file->move($dir, $fileName);

                    $kostSeeker->avatar = $fileName;
                }

                $kostSeeker->save();

                return redirect()->route('profile.index')->with('success', __('toast.update.success.message')); 
            }elseif(Auth::user()->isOwner()){
                $kostOwner = KostOwner::find(Auth::user()->kostOwner->id);
                $kostOwner->first_name = $request->first_name;
                $kostOwner->last_name = $request->last_name;
                $kostOwner->handphone = $request->handphone;
                $kostOwner->address = $request->address;
                $dir = storage_path().'/app/public/images/avatar';
                $file = $request->file('avatar');
                if($file){
                    $fileName = Time().".".$file->getClientOriginalName();
                    $file->move($dir, $fileName);
                    $kostOwner->avatar = $fileName;
                }
                $kostOwner->save();

                return redirect()->route('profile.index')->with('success', __('toast.update.success.message')); 
            }
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
}
