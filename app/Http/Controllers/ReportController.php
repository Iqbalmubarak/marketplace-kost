<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kost;
use Illuminate\Support\Facades\Auth;
use PDF;

class ReportController extends Controller
{
    public function index(){
        $kosts = Kost::where('kost_owner_id', Auth::user()->kostOwner->id)->where('status', 1)->pluck('name','id');
        $type = ['Harian', 'Mingguan', 'Tahunan', 'Bulanan'];

        return view('backend.kostOwner.manageReport.index', compact('type','kosts'));
    }

    public function print(Request $request){
        try {
            $kosts = Kost::whereIn('id', $request->kosts)->get();
            $start = $request->start;
            $end = $request->end;
            $time = strtotime($start);
            $start_format = date('d/m/Y', $time);
            $time = strtotime($end);
            $end_format = date('d/m/Y', $time);
            $data = [
                'kosts' => $kosts,
                'start' => $request->start,
                'end' => $request->end
            ];
            
            $pdf = PDF::loadView('backend.kostOwner.manageReport.print', $data);
        
            return $pdf->download('Laporan Transaksi ('.$start_format.' - '.$end_format.').pdf');
            //return view('backend.kostOwner.manageReport.print', compact('kosts', 'start', 'end'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', __('toast.index.failed.message'));
        }
    }
}
