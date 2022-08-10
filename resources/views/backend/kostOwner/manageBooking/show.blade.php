@extends('layouts.kostOwner.main')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

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
            <div class="col-2 d-flex justify-content-end">
                @if ($booking->status == 1)
                    @if($booking->bookingPayment && Carbon\Carbon::now() <= Carbon\Carbon::parse($booking->created_at)->addHour())
                    <a class="btn btn-primary btn-outline" onclick="accept({{$booking->id}},{{$booking->room_type_id}})" href="javascript::void(0)" data-toggle="modal" data-target="#acceptModal"><i class="fa fa-check"></i> Terima</a>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        @include('backend.kostOwner.manageBooking.accept')
        <div class="col-md-4">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Profil Penyewa</h5>
                </div>
                <div>
                    <div class="ibox-content no-padding border-left-right">
                        @if ($booking->kostSeeker->avatar != NULL)
                        <img alt="image" src="{{ asset('storage/images/avatar/'.$booking->kostSeeker->avatar) }}" class="img-fluid">
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
                                        <strong>Rekening</strong>
                                    </div>
                                    <div class="col-md-9"> 
                                        <p></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <strong>Bukti Pembayaran</strong>
                                    </div>
                                    @if ($booking->bookingPayment)
                                    <div class="col-md-9">
                                        <img src="{{ asset('storage/images/payment/'.$booking->bookingPayment->payment) }}" alt="" class="img-fluid"><br>
                                    </div>
                                    @endif
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

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    function accept(id,room_type) {
        if ($('#accept').is(":visible")) {
            $('#accept').hide('500');
        } else {
            $('#accept').show('500');
            fethDataRoom(room_type);
            $('#form-acc').attr('action', "{{route('owner.booking.index')}}/" + id + "/accept");
        }
    }

    function fethDataRoom(room_type) {
        console.log('success');
        let base_url = "{{URL('api/select/room')}}";
        $("#c_room").select2({
            placeholder: "Select a state",
            allowClear: true,
            language: {
                noResults: function (params) {
                    return "Tidak ada ruangan yang tersedia pada tipe kamar ini";
                }
            },
            tokenSeparators: [',', ' '],
            ajax: {
                url: base_url + "/" + room_type,
                dataType: "json",
                type: "GET",
                quietMillis: 50,
                data: function (params) {
                    var queryParameters = {
                        term: params.term
                    }
                    return queryParameters;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });
    }
</script>
@endsection