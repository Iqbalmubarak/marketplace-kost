<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentDetail;

class RentDetailController extends Controller
{
    public function accept($id){
        try {    
            $rentDetail = RentDetail::find($id);

            $update = RentDetail::where('rent_id', $rentDetail->rent_id)
                                ->where('status', 1)
                                ->get();
            $update->status = 3;
            $update->save();

            $rentDetail->status = 1;
            $rentDetail->save();

            return redirect()->route('owner.rent.show', $rentDetail->rent->id)->with('success', __('toast.update.success.message'));  
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.update.failed.message'));
        }
    }

    public function reject($id){
        try {    
            $rentDetail = RentDetail::find($id);
            $rentDetail->status = 3;
            $rentDetail->save();

            return redirect()->route('owner.rent.show', $rentDetail->rent->id)->with('success', __('toast.update.success.message'));  
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.update.failed.message'));
        }
    }
}
