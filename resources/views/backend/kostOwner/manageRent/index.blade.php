@extends('layouts.kostOwner.main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Penyewaan kamar</h2>
        <div class="row">
            <div class="col-lg-10">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <strong>
                            <a>Penyewaan kamar</a>
                        </strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2 d-flex justify-content-end">
                <a href="{{ route('owner.rent.create') }}">
                    <button class="btn btn-primary btn-sm btn-outline" type=" button">Tambah Penyewaan</button>
                </a>
            </div>
        </div>

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        @foreach ($rents as $rent)
        <?php 
            $today = new DateTime("today");
            $ended_at = new DateTime($rent->ended()->ended_at);
            $started_at = new DateTime($rent->started()->started_at);
            $d = $ended_at->diff($today)->days;
            $day = $ended_at->diff($started_at)->days;

            if($ended_at){
                $percent = 100 - ($d/$day * 100);
            }else{
                $percent = 100;
            }
        ?>
        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-title">
                    @if ($today == $started_at)
                    <span class="label label-primary float-right">NEW</span>
                    @endif
                    <h5>{{$rent->room->name}} - {{$rent->room->kost->name}}</h5>
                </div>
                <div class="ibox-content">
                    <div class="team-members">
                        @foreach ($rent->tenantDetail as $tenantDetail)
                            @if ($tenantDetail->tenant->avatar != NULL)
                            <a href="{{route('owner.tenant.show', $tenantDetail->tenant->id)}}"><img alt="member" class="rounded-circle" src="{{ asset('storage/images/avatar/'.$tenantDetail->tenant->avatar) }}" title="{{$tenantDetail->tenant->name}}"></a>
                            @else
                            <?php $random = rand(1,5); ?>
                            <a href="{{route('owner.tenant.show', $tenantDetail->tenant->id)}}"><img alt="member" class="rounded-circle" src="{{ asset('templates/img/profile/profil'.$random.'.jpeg') }}" title="{{$tenantDetail->tenant->name}}"></a>
                            @endif
                        @endforeach
                    </div>
                    @if ($rent->history)
                        <span class="label label-primary float-right">Online</span>
                    @else
                        <span class="label label-success float-right">Offline</span>
                    @endif
                    <h4>{{$rent->room->roomType->name}}</h4>
                    <p>
                        Ukuran kamar : {{$rent->room->roomType->lenght}}x{{$rent->room->roomType->wide}} <br>
                        Penyewaan yang ke : {{$rent->rentDetail->count()}}
                    </p>
                    <div><a class="btn btn-xs btn-white" href="{{ route('owner.rent.show', $rent->id) }}"><i class="fa fa-eye"></i> Detail</a></div>
                    <div>
                        <span>Waktu berakhir sewa:</span>
                        <div class="stat-percent">{{$d}} hari</div>
                        <div class="progress progress-mini">
                            <div style="width: {{$percent}}%;" class="progress-bar"></div>
                        </div>
                    </div>
                    <div class="row  m-t-sm">
                        <div class="col-sm-4">
                            <div class="font-bold">MULAI SEWA</div>
                            <?php echo date("d-m-Y", strtotime($rent->started()->started_at)); ?>
                        </div>
                        <div class="col-sm-4">
                            <div class="font-bold">BERAKHIR SEWA</div>
                            <?php echo date("d-m-Y", strtotime($rent->ended()->ended_at)); ?>
                        </div>
                        <div class="col-sm-4 text-right">
                            <div class="font-bold">BIAYA SEWA</div>
                            {{Helper::rupiah($rent->percentage()->total_price)}} <i class="fa fa-level-up text-navy"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection

@section('script')
<!-- Mainly scripts -->
    <script src="{{ asset('templates/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('templates/js/popper.min.js') }}"></script>
    <script src="{{ asset('templates/js/bootstrap.js') }}"></script>
    <script src="{{ asset('templates/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('templates/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('templates/js/inspinia.js') }}"></script>
    <script src="{{ asset('templates/js/plugins/pace/pace.min.js') }}"></script>
@endsection
