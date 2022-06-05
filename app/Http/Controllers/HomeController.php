<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Kost; 
use App\Models\RoomType; 
use App\Models\RentDetail;
use DB; 
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        if (Gate::allows('isAdmin')) {
            return redirect()->route('log-viewer::dashboard');
        }
        if (Gate::allows('isOwner')) {
            Log::info("User ".Auth::user()->kostOwner->first_name." ".Auth::user()->kostOwner->last_name." Berhasil melakukan login ke dalam aplikaasi");
            return view('backend.kostOwner.dashboard');
        }
        if (Gate::allows('isCustomer')) {
            try {    
            Log::info("User ".Auth::user()->kostSeeker->first_name." ".Auth::user()->kostSeeker->last_name." Berhasil melakukan login ke dalam aplikaasi");
            return redirect()->route('landingPage.home'); 
            } catch (\Exception $e) {
                return redirect()->back()->with('error', __('toast.index.failed.message'));
            }
        }

    }
}
