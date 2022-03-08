<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
            $kosts = Kost::where('status', 2)->get();
            return view('backend.kostSeeker.dashboard', compact('kosts'));
        }

    }
}
