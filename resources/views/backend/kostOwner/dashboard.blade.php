@extends('layouts.kostOwner.main')

@section('content')
<?php 
    $kosts = \App\Models\Kost::select('id')
                                ->where('kost_owner_id', Auth::user()->kostOwner->id)
                                ->where('status', 1)
                                ->get();
    $kost_id = collect([]);;
    foreach($kosts as $kost){
        $kost_id->push($kost->id);
    }

    if($kosts->count() > 0)
    {
        $rooms = \App\Models\Room::select('id')
                                    ->whereIn('kost_id', $kost_id)
                                    ->get();

        $room_id = collect([]);;
        foreach($rooms as $room){
            $room_id->push($room->id);
        }

        $this_month = (int)Carbon\Carbon::now()->format('n');
        $this_year = (int)Carbon\Carbon::now()->format('Y');
        $last_year = $this_year;
        $last_month = $this_month - 1;
        if($last_month < 1){
            $last_month = 12;
            $last_year = $this_year-1;
        }
        if($last_month < 10){
            $last_month = "0".(string)$last_month;
        }else{
            $last_month = (string)$last_month;
        }
        $last_date = (string)$last_year."-".$last_month;

        //Month Income
        $income_this_month = \App\Models\Rent::join('rent_details', 'rents.id', '=', 'rent_details.rent_id')
                                    ->whereIn('rents.room_id', $room_id)
                                    ->where(DB::raw("DATE_FORMAT(rent_details.started_at, '%Y-%m')"), Carbon\Carbon::now()->format('Y-m'))
                                    ->sum('rent_details.total_price');
        $income_last_month = \App\Models\Rent::join('rent_details', 'rents.id', '=', 'rent_details.rent_id')
                                    ->whereIn('rents.room_id', $room_id)
                                    ->where(DB::raw("DATE_FORMAT(rent_details.started_at, '%Y-%m')"), $last_date)
                                    ->sum('rent_details.total_price');
        
        if($income_last_month > 0 && $income_this_month > 0){
            if($income_this_month >= $income_last_month){
                $month_percentage = (($income_this_month - $income_last_month) / $income_last_month) * 100;
            }else{
                $month_percentage = (($income_last_month - $income_this_month) / $income_this_month) * 100;
            }
        }elseif($income_this_month == 0 && $income_last_month > 0){
            $month_percentage = 100;
        }else{
            $month_percentage = 0;
        }

        //Year Rent
        $rent_this_year = \App\Models\Rent::whereIn('rents.room_id', $room_id)
                                            ->where(DB::raw("DATE_FORMAT(created_at, '%Y')"), Carbon\Carbon::now()->format('Y'))
                                            ->count();
        $rent_last_year = \App\Models\Rent::whereIn('rents.room_id', $room_id)
                                            ->where(DB::raw("DATE_FORMAT(created_at, '%Y')"), Carbon\Carbon::now()->subYear(1)->format('Y'))
                                            ->count();
        
        if($rent_last_year > 0 && $rent_this_year > 0){
            if($rent_this_year >= $rent_last_year){
                $new_rent_percentage = (($rent_this_year - $rent_last_year) / $rent_last_year) * 100;
            }else{
                $new_rent_percentage = (($rent_last_year - $rent_this_year) / $rent_this_year) * 100;
            }
        }elseif($rent_this_year == 0 && $rent_last_year > 0){
            $new_rent_percentage = 100;
        }else{
            $new_rent_percentage = 0;
        }

        //Year Tenant
        $tenant_this_year = \App\Models\Tenant::whereIn('kost_id', $kost_id)
                                                ->where(DB::raw("DATE_FORMAT(created_at, '%Y')"), Carbon\Carbon::now()->format('Y'))
                                                ->count();
        $tenant_last_year = \App\Models\Tenant::whereIn('kost_id', $kost_id)
                                                ->where(DB::raw("DATE_FORMAT(created_at, '%Y')"), Carbon\Carbon::now()->subYear(1)->format('Y'))
                                                ->count();
        
        if($tenant_last_year > 0 && $tenant_this_year > 0){
            if($tenant_this_year >= $tenant_last_year){
                $new_tenant_percentage = (($tenant_this_year - $tenant_last_year) / $tenant_last_year) * 100;
            }else{
                $new_tenant_percentage = (($tenant_last_year - $tenant_this_year) / $tenant_this_year) * 100;
            }
        }elseif($tenant_this_year == 0 && $tenant_last_year > 0){
            $new_tenant_percentage = 100;
        }else{
            $new_tenant_percentage = 0;
        }

        //Room In Use
        $room_in_use = \App\Models\Rent::select('room_id')
                                        ->whereIn('room_id', $room_id)
                                        ->where('status',1)
                                        ->count();

        $room_total = \App\Models\Room::whereIn('kost_id', $kost_id)->count();
        if($room_total > 0 && $room_in_use > 0){
            $room_percentage = ($room_in_use / $room_total) * 100;
        }else{
            $room_percentage = 0;
        }
    }
?>
@if ($kosts->count() > 0)
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-4">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-success float-right">Bulanan</span>
                    <h5>Pendapatan</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">
                        {{Helper::rupiah($income_this_month)}}
                    </h1>
                    @if ($income_this_month >= $income_last_month)
                    <div class="stat-percent font-bold text-info">
                        {{round($month_percentage,2)}}% <i class="fa fa-level-up"></i>
                    </div>
                    @else
                        <div class="stat-percent font-bold text-danger">
                        {{round($month_percentage,2)}}% <i class="fa fa-level-down"></i>
                    </div>
                    @endif
                    <small>Total pemasukan</small>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-info float-right">Tahunan</span>
                    <h5>Penyewaan</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{$rent_this_year}}</h1>
                    @if ($rent_this_year >= $rent_last_year)
                    <div class="stat-percent font-bold text-info">
                        {{round($new_rent_percentage,2)}}% <i class="fa fa-level-up"></i>
                    </div>
                    @else
                        <div class="stat-percent font-bold text-danger">
                        {{round($new_rent_percentage,2)}}% <i class="fa fa-level-down"></i>
                    </div>
                    @endif
                    <small>Penyewaan kamar baru</small>
                </div>
            </div>
        </div>
        <!-- <div class="col-lg-4">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-info float-right">Tahunan</span>
                    <h5>Penyewa</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{$tenant_this_year}}</h1>
                    @if ($tenant_this_year >= $tenant_last_year)
                    <div class="stat-percent font-bold text-info">
                        {{round($new_tenant_percentage,2)}}% <i class="fa fa-level-up"></i>
                    </div>
                    @else
                        <div class="stat-percent font-bold text-danger">
                        {{round($new_tenant_percentage,2)}}% <i class="fa fa-level-down"></i>
                    </div>
                    @endif
                    <small>Penyewa baru</small>
                </div>
            </div>
        </div> -->
        <div class="col-lg-4">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-primary float-right">Hari ini</span>
                    <h5>Kamar disewa</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{$room_in_use}}</h1>
                    @if ($room_percentage > 50)
                    <div class="stat-percent font-bold text-info">
                        {{round($room_percentage,2)}}% <i class="fa fa-level-up"></i>
                    </div>
                    @else
                        <div class="stat-percent font-bold text-danger">
                        {{round($room_percentage,2)}}% <i class="fa fa-level-down"></i>
                    </div>
                    @endif
                    <small>Dari keseluruhan kamar</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-content">
                    <div>
                        <span class="float-right text-right">
                            <?php 
                                $highest_income_this_month = \App\Models\Rent::select('rooms.kost_id', DB::raw('SUM(rent_details.total_price) as total_price'))
                                ->join('rent_details', 'rents.id', '=', 'rent_details.rent_id')
                                ->join('rooms', 'rooms.id', '=', 'rents.room_id')
                                ->whereIn('rents.room_id', $room_id)
                                ->where(DB::raw("DATE_FORMAT(rent_details.started_at, '%Y-%m')"), Carbon\Carbon::now()->format('Y-m'))
                                ->groupby('rooms.kost_id')
                                ->orderby('total_price', 'desc')
                                ->first();

                                $highest_kost_income_this_month = \App\Models\Kost::find($highest_income_this_month->kost_id);
                            ?>
                            <small>Transaksi terbanyak bulan ini terdapat pada: <strong>{{$highest_kost_income_this_month->name}}</strong></small>
                            <br />
                            Total pendapatan: {{Helper::rupiah($highest_income_this_month->total_price)}}
                        </span>
                        <div id="total_income">

                        </div>
                    </div>

                    <div>
                        <canvas id="lineChart" height="70"></canvas>
                    </div>

                    <div class="m-t-md">
                        <small class="float-right">
                            <i class="fa fa-clock-o"> </i>
                            Data diupdate pada {{Carbon\Carbon::now()->format('d-m-Y')}}
                        </small>
                        <small>
                            <strong>Analisis pendapatan:</strong> The value has been changed over time, and last month
                            reached a level over $50,000.
                        </small>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="wrapper wrapper-content animated fadeInRight">

                        <div class="ibox-content m-b-sm border-bottom">
                            <div class="text-center p-lg">
                                <h2>Silahkan daftarkan kost anda terlebih dahulu... </h2><br>
                                <a href="{{ route('owner.kost.create') }}">
                                    <button title="Tambah kost baru" class="btn btn-primary btn-sm"
                                    type=" button"><i class="fa fa-plus"></i>
                                    <span class="bold">Tambah Kost</span></button>
                                </a>
                            </div>
                        </div>
                    </div>
@endif

</div>
@endsection

@section('script')
<!-- ChartJS-->
<script src="{{ asset('templates/js/plugins/chartJs/Chart.min.js') }}"></script>
<script>
    $(document).ready(function () {
        let base_url = "{{URL('api/chart/chart_income')}}";
        $.ajax({
            url: base_url,
            dataType: 'json',
            cache: false,
            dataSrc: '',

            success: function (data) {
                console.log(data[1].income);
                var rgba_backgroundColor = [
                                    "rgba(26,179,148,0.5)",
                                    "rgba(176, 0, 0, 0.5)",
                                    "rgba(0, 99, 221, 0.5)",
                                    "rgba(255, 127, 80, 0.5)",
                                    "rgba(100, 149, 237, 0.5)",
                                    "rgba(220, 20, 60, 0.5)",
                                    "rgba(0, 139, 139, 0.5)",
                                    "rgba(189, 183, 107, 0.5)",
                                    "rgba(0, 0, 139, 0.5)",
                                    "rgba(169, 169, 169, 0.5)",
                                    "rgba(143, 188, 143, 0.5)",
                                    "rgba(47, 79, 79, 0.5)",
                                    "rgba(105, 105, 105, 0.5)",
                                    "rgba(30, 144, 255, 0.5)",
                                    "rgba(178, 34, 34, 0.5)",
                                    "rgba(205, 92, 92, 0.5)",
                                    "rgba(70, 130, 180, 0.5)",
                                    "rgba(32, 178, 170, 0.5)",
                                    "rgba(135, 206, 250, 0.5)",
                                    "rgba(127, 255, 212, 0.5)"
                                ];
                var rgba_borderColor = [
                                    "rgba(26,179,148,0.7)",
                                    "rgba(176, 0, 0, 0.7)",
                                    "rgba(0, 99, 221, 0.7)",
                                    "rgba(255, 127, 80, 0.7)",
                                    "rgba(100, 149, 237, 0.7)",
                                    "rgba(220, 20, 60, 0.7)",
                                    "rgba(0, 139, 139, 0.7)",
                                    "rgba(189, 183, 107, 0.7)",
                                    "rgba(0, 0, 139, 0.7)",
                                    "rgba(169, 169, 169, 0.7)",

                                    "rgba(143, 188, 143, 0.7)",
                                    "rgba(47, 79, 79, 0.7)",
                                    "rgba(105, 105, 105, 0.7)",
                                    "rgba(30, 144, 255, 0.7)",
                                    "rgba(178, 34, 34, 0.7)",
                                    "rgba(205, 92, 92, 0.7)",
                                    "rgba(70, 130, 180, 0.7)",
                                    "rgba(32, 178, 170, 0.7)",
                                    "rgba(135, 206, 250, 0.7)",
                                    "rgba(127, 255, 212, 0.7)",
                                ];
                var rgba_pointBackgroundColor = [
                                    "rgba(26,179,148,1)",
                                    "rgba(176, 0, 0, 1)",
                                    "rgba(0, 99, 221, 1)",
                                    "rgba(255, 127, 80, 1)",
                                    "rgba(100, 149, 237, 1)",
                                    "rgba(220, 20, 60, 1)",
                                    "rgba(0, 139, 139, 1)",
                                    "rgba(189, 183, 107, 1)",
                                    "rgba(0, 0, 139, 1)",
                                    "rgba(169, 169, 169, 1)",
                                    "rgba(143, 188, 143, 1)",
                                    "rgba(47, 79, 79, 1)",
                                    "rgba(105, 105, 105, 1)",
                                    "rgba(30, 144, 255, 1)",
                                    "rgba(178, 34, 34,, 1)",
                                    "rgba(205, 92, 92, 1)",
                                    "rgba(70, 130, 180, 1)",
                                    "rgba(32, 178, 170, 1)",
                                    "rgba(135, 206, 250, 1)",
                                    "rgba(127, 255, 212, 1)",
                                ];
                var line = [];
                //var month_incame = [[]];
                for(var i=0; i<data.length; i++){
                    line.push({
                                label: data[i].name,
                                backgroundColor: rgba_backgroundColor[i],
                                borderColor: rgba_borderColor[i],
                                pointBackgroundColor: rgba_pointBackgroundColor[i],
                                pointBorderColor: "#fff",
                                data: data[i].income
                            });
                    // for(var x=0; x<12; x++){
                    //     month_income[x][i] = data[i].income[x];
                    // }
                }
                var lineData = {
                    labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
                    datasets: line
                };

                var lineOptions = {
                    responsive: true
                };


                var ctx = document.getElementById("lineChart").getContext("2d");
                new Chart(ctx, {
                    type: 'line',
                    data: lineData,
                    options: lineOptions
                });
                $('#total_income').append(`<h1 class="m-b-xs" ><b>`+data[data.length - 1].total_income+`</b></h1>`);
            }
        });
    });

</script>
@endsection
