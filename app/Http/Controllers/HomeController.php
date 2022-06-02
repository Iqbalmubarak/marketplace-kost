<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Kost; 
use App\Models\RoomType; 
use App\Models\RentDetail;
use DB; 

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        if (Gate::allows('isAdmin')) {
            return view('backend.admin.dashboard');
        }
        if (Gate::allows('isOwner')) {
            return view('backend.kostOwner.dashboard');
        }
        if (Gate::allows('isCustomer')) {
            try {    
            return redirect()->route('landingPage.home'); 
            } catch (\Exception $e) {
                return redirect()->back()->with('error', __('toast.index.failed.message'));
            }
        }

    }
}
