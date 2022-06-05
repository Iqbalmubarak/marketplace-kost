<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kost;
use App\Models\Rent;
use Carbon\Carbon;
use DB;

class ChartController extends Controller
{
    public function chartIncome(){
        $kosts = Kost::select('id','name')
                        ->where('kost_owner_id', 1)
                        ->where('status', 1)
                        ->get();
        $data = new \stdClass();
        $data = $kosts;
        $total = 0;
        foreach($data as $index => $value){
            $room_id = collect([]);
            $income = collect([]);
            foreach($data[$index]->room as $room){
                $room_id->push($room->id);
            }
            $this_year = (int)Carbon::now()->format('Y');
            $month_index = 1;
            while($month_index <= 12){
                $month = "0".(string)$month_index;
                $date = (string)$this_year."-".$month;

                $income_this_month = Rent::join('rent_details', 'rents.id', '=', 'rent_details.rent_id')
                            ->whereIn('rents.room_id', $room_id)
                            ->where(DB::raw("DATE_FORMAT(rent_details.started_at, '%Y-%m')"), $date)
                            ->sum('rent_details.total_price');
                $total = $total + $income_this_month; 
                $analyst[$index][$month_index] = $income_this_month;
                $income->push($income_this_month);
                
                $month_index = $month_index + 1;
            }
            $data[$index]->income = $income;
            $total_income = "Rp. ".number_format($total, 0, ',', '.'). ",00";
            $data[$index]->total_income = $total_income;
        }
        
        return response()->json($data);
    }
}
