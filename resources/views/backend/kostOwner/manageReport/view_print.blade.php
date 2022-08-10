@extends('layouts.kostOwner.main')

@section('css')
<!-- FooTable -->
<link href="{{ asset('templates/css/plugins/footable/footable.core.css') }}" rel="stylesheet">
<style>
    @media print {
        @page {
            size: landscape
        }
    }

    @page {
        size: A4 landscape;
    }


    h1 {
        font-weight: bold;
        font-size: 20pt;
        text-align: center;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    .table th {
        padding: 8px 8px;
        border: 1px solid #000000;
        text-align: center;
        color: rgb(242, 242, 242);
        background-color: rgb(105, 105, 105);
    }

    .table td {
        padding: 3px 3px;
        border: 1px solid #000000;
        text-align: center;
        background-color: white;
    }

    .text-center {
        text-align: center;
    }

</style>
<style type="text/css" media="print">
    .page {
        -webkit-transform: rotate(-90deg);
        -moz-transform: rotate(-90deg);
        filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
    }

</style>

@endsection

@section('content')
<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdGrzi3vv43yyxfcFiBRoGVqvtZcJ2lIM"></script>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Manage Kost</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home.index') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <strong>
                    <a>Manage Kost</a>
                </strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <section class="sheet padding-10mm">
        <div class="row">
            <div class="col-12">
                {{ Form::open(array('method'=>'POST', 'url' => route('owner.report.print'))) }}
                <input type="hidden" name="start" value="{{$start}}">
                <input type="hidden" name="end" value="{{$end}}">
                @foreach ($kost_id as $id)
                <input type="hidden" name="kost_id[]" value="{{$id}}">
                @endforeach
                <button type="submit" class="btn btn-success">Print</button>
                {!! Form::close() !!}
            </div>
            <div class="col-12">
                <center>
                    <h4><b>Laporan Transaksi Penyewaan</b></h4>
                </center>
            </div>
        </div>
        <br>
        <hr>


        
        @foreach ($kosts as $kost)
        <div class="row">
            <div class="col-12">
                <p><strong>Nama Kos : {{$kost->name}}</strong></p>
                <?php 
            $time = strtotime($start);
            $start_format = date('d/m/Y', $time);
            $time = strtotime($end);
            $end_format = date('d/m/Y', $time);
          ?>
                <p><strong>Transaksi pada : {{$start_format}} - {{$end_format}}</strong></p>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Penyewa</th>
                    <th>Kamar</th>
                    <th>Tanggal pembayaran</th>
                    <th>Mulai - berakhir sewa</th>
                    <th>Durasi sewa</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
            $room_id = collect([]); 
            foreach($kost->room as $room){
              $room_id->push($room->id);
            }

            $rents = App\Models\Rent::select('rents.*', 'rent_details.*', 'rent_details.created_at as payment_date','rent_details.id as detail_id')
                                    ->join('rent_details', 'rents.id', '=', 'rent_details.rent_id')
                                    ->whereIn('rents.room_id', $room_id)
                                    ->where('rent_details.status', '!=', 3)
                                    ->where(DB::raw('date_format(rent_details.created_at, "%Y-%m-$d")'), '>=', $start)
                                    ->where(DB::raw('date_format(rent_details.created_at, "%Y-%m-$d")'), '<=', $end)
                                    ->orderby('rent_details.created_at', 'asc')
                                    ->get();
          ?>
                @foreach ($rents as $rent)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        @foreach ($rent->tenantDetail as $key=>$tenantDetail)
                        {{$tenantDetail->tenant->name}}
                        @if($key <= (count($rent->tenantDetail) - 1))
                            <br>
                            @endif
                            @endforeach

                    </td>
                    <td>{{$rent->room->name}}-{{$rent->room->roomType->name}}</td>
                    <td>
                        <?php 
                $time = strtotime($rent->payment_date);
                $payment_date = date('d/m/Y', $time);
              ?>
                        {{$payment_date}}
                    </td>
                    <td>
                        <?php 
                $time = strtotime($rent->started_at);
                $started_at = date('d/m/Y', $time);
                $time = strtotime($rent->ended_at);
                $ended_at = date('d/m/Y', $time);
              ?>
                        {{$started_at}} - {{$ended_at}}
                    </td>
                    <td>{{$rent->printDuration()}}</td>
                    <td>{{Helper::rupiah($rent->total_price)}}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="6">Total Pemasukan</th>
                    <th>{{Helper::rupiah($rents->sum('total_price'))}}</th>
                </tr>
            </tbody>
        </table>
        <hr>
        @endforeach
    </section>
    <br>

</div>

@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
@endsection
