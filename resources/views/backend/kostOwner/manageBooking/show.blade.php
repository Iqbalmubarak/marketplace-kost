@extends('layouts.kostOwner.main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Booking</h2>
        <div class="row">
            <div class="col-lg-10">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('owner.booking.index') }}">Booking</a>
                    </li>
                    <li class="breadcrumb-item">
                        <strong>
                            <a>Detail Booking Penyewa</a>
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
                    <h5>Profil Penyewa</h5>
                </div>
                <div>
                    <div class="ibox-content no-padding border-left-right">
                        @if ($booking->kostSeeker->avatar != NULL)
                        <img alt="image" src="{{ asset('storage/images/avatar/'.$tenant->avatar) }}" class="img-fluid">
                        @else
                        <?php $random = rand(1,5); ?>
                        <img alt="image" src="{{ asset('templates/img/profile/profil'.$random.'.jpeg') }}"
                            class="img-fluid">
                        @endif
                    </div>
                    <div class="ibox-content profile-content">
                        <h4>
                            <strong>{{$booking->kostSeeker->first_name}} {{$booking->kostSeeker->last_name}}</strong>
                            @if ($booking->kostSeeker->gender == 1)
                            <span class="badge badge-success">Pria</span>
                            @else
                            <span class="badge badge-warning">Wanita</span>
                            @endif
                        </h4>
                        <address>
                            <i class="fa fa-phone"></i> {{$booking->kostSeeker->handphone}} <br>
                            <i class="fa fa-calendar"></i> {{$booking->kostSeeker->birth_place}},
                            <?php echo date("j F Y", strtotime($booking->kostSeeker->birth_day)) ; ?>
                        </address>
                        <h5>
                            @if ($booking->kostSeeker->job == 1)
                            Mahasiswa
                            @elseif ($booking->kostSeeker->job == 2)
                            Karyawan
                            @endif
                        </h5>
                        <p>
                            @if ($booking->kostSeeker->job == 3)
                            {{$booking->kostSeeker->job_description}}
                            @else
                            {{$booking->kostSeeker->job_name}}
                            @endif
                        </p>
                        <h5>Phone Emergency</h5>
                        <p><i class="fa fa-phone"></i> {{$booking->kostSeeker->handphone}}</p>

                        <div class="user-button">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary btn-sm btn-block"><i
                                            class="fa fa-envelope"></i> Send Message</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-default btn-sm btn-block"><i
                                            class="fa fa-coffee"></i> Buy a coffee</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Detail Pemesanan Booking</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div>
                        <div class="feed-activity-list">
                                <div class="feed-element">
                                    <div class="row">
                                      <div class="col-md-3">
                                        <strong>
                                          Nama Kost
                                        </strong>
                                      </div>
                                      <div class="col-md-9">
                                          <p>{{$booking->roomType->kost->name}}</p>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-3">
                                        <strong>
                                          Tipe Kamar
                                        </strong>
                                      </div>
                                      <div class="col-md-9">
                                          <p>{{$booking->roomType->name}}</p>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-3">
                                          <strong>Mulai Booking</strong>
                                      </div>
                                      <div class="col-md-9">
                                          <p>{{$booking->started_at}}</p>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-3">
                                          <strong>Berakhir</strong>
                                      </div>
                                      <div class="col-md-9">
                                          <p>{{$booking->ended_at}}</p>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-3">
                                          <strong>Total Harga</strong>
                                      </div>
                                      <div class="col-md-9">
                                          <p>{{Helper::rupiah($booking->total_price)}}</p>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-3">
                                          <strong>Bukti Pembayaran</strong>
                                      </div>
                                      <div class="col-md-9">
                                          <img src="{{ asset('storage/images/payment/'.$booking->payment) }}" alt="" class="img-fluid"><br>
                                      </div>
                                    </div>
                                    <br>
                                </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
