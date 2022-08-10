@extends('layouts.kostOwner.main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Kelola Kos</h2>
        <div class="row">
            <div class="col-lg-10">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('owner.tenant.index') }}">Kelola Penyewa</a>
                    </li>
                    <li class="breadcrumb-item">
                        <strong>
                            <a>Detail Penyewa</a>
                        </strong>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-md-4">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Profile Detail</h5>
                </div>
                <div>
                    <div class="ibox-content no-padding border-left-right">
                        @if ($tenant->avatar != NULL)
                        <img alt="image" src="{{ asset('storage/images/avatar/'.$tenant->avatar) }}" class="img-fluid">
                        @else
                        <?php $random = rand(1,5); ?>
                        <img alt="image" src="{{ asset('templates/img/profile/profil'.$random.'.jpeg') }}"
                            class="img-fluid">
                        @endif
                    </div>
                    <div class="ibox-content profile-content">
                        <h4>
                            <strong>{{$tenant->name}}</strong>
                            @if ($tenant->gender == 1)
                            <span class="badge badge-success">Pria</span>
                            @else
                            <span class="badge badge-warning">Wanita</span>
                            @endif
                        </h4>
                        <address>
                            <i class="fa fa-phone"></i> {{$tenant->handphone}} <br>
                            <i class="fa fa-calendar"></i> {{$tenant->birth_place}},
                            <?php echo date("j F Y", strtotime($tenant->birth_day)) ; ?>
                        </address>
                        <h5>
                            @if ($tenant->job == 1)
                            Mahasiswa
                            @elseif ($tenant->job == 2)
                            Karyawan
                            @else
                            Lainnya
                            @endif
                        </h5>
                        <p>
                            @if ($tenant->job == 3)
                            {{$tenant->job_description}}
                            @else
                            {{$tenant->job_name}}
                            @endif
                        </p>
                        <h5>Phone Emergency</h5>
                        <p><i class="fa fa-phone"></i> {{$tenant->handphone}}</p>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Riwayat penyewaan kamar</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#" class="dropdown-item">Config option 1</a>
                            </li>
                            <li><a href="#" class="dropdown-item">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div>
                        <div class="feed-activity-list">
                            @foreach ($tenant->tenantDetail as $tenantDetail)
                                @foreach ($tenantDetail->rent->rentDetail as $rentDetail)
                                <?php 
                                    $today = new DateTime("today");
                                    $created_at = new DateTime($rentDetail->created_at);
                                    $y = $today->diff($created_at)->y;
                                    $m = $today->diff($created_at)->m;
                                    $d = $today->diff($created_at)->d;
                                    
                                    if($y > 0){
                                        $duration = $y." tahun ".$m." bulan ".$d." hari yang lalu";
                                    }elseif($m > 0){
                                        $duration = $m." bulan ".$d." hari yang lalu";
                                    }else{
                                        $duration = $d." hari yang lalu";
                                    }
                                ?>
                                <div class="feed-element">
                                    <a href="#" class="float-left">
                                        <img alt="image" class="rounded-circle" src="{{ asset('templates/img/kost.jfif') }}">
                                    </a>
                                    <div class="media-body ">
                                        <small class="float-right text-navy">{{$duration}}</small>
                                        <strong>Kos {{$tenantDetail->rent->room->kost->name}}</strong><br>
                                        <strong>{{$tenant->name}}</strong> menyewa kamar <strong>{{$tenantDetail->rent->room->name}}</strong>. <br>
                                        <small class="text-muted">{{$rentDetail->started_at}} - {{$rentDetail->ended_at}}</small>
                                        <div class="actions">
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endforeach
                        </div>

                        <button class="btn btn-primary btn-block m"><i class="fa fa-arrow-down"></i> Show More</button>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
