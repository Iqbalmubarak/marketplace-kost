@extends('layouts.landingPage.main')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<style>
    .avatar-wrapper {
        position: relative;
        height: 200px;
        width: 200px;
        margin: 50px auto;
        border-radius: 50%;
        overflow: hidden;
        box-shadow: 1px 1px 15px -5px black;
        transition: all 0.3s ease;
    }

    .avatar-wrapper:hover {
        transform: scale(1.05);
        cursor: pointer;
    }

    .avatar-wrapper:hover .profile-pic {
        opacity: 0.5;
    }

    .avatar-wrapper .profile-pic {
        height: 100%;
        width: 100%;
        transition: all 0.3s ease;
    }

    .avatar-wrapper .profile-pic:after {
        font-family: FontAwesome;
        content: "\f007";
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        position: absolute;
        font-size: 190px;
        background: #ecf0f1;
        color: #34495e;
        text-align: center;
    }

    .avatar-wrapper .upload-button {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
    }

    .avatar-wrapper .upload-button .fa-arrow-circle-up {
        position: absolute;
        font-size: 234px;
        top: -17px;
        left: 0;
        text-align: center;
        opacity: 0;
        transition: all 0.3s ease;
        color: #34495e;
    }

    .avatar-wrapper .upload-button:hover .fa-arrow-circle-up {
        opacity: 0.9;
    }

</style>
@endsection

@section('content')
<div class="modal inmodal" id="imageModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title">Bukti pembayaran</h4>
            </div>
            <div class="modal-body">
                <img id="modalImg" src="{{ asset('templates/img/input_image.png') }}"
                                                alt="Snow" style="width:100%;max-width:100%">
            </div>
        </div>
    </div>
</div>
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('landingPage.home') }}">Home</a></li>
                <li class='active'>Detail kos</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row single-product'>
            <div class='col-xs-12 col-sm-12 col-md-9 rht-col'>
                <div class="product-tabs inner-bottom-xs">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <div class="home-banner outer-top-n outer-bottom-xs">
                                @if (Auth::user()->kostSeeker->avatar != NULL)
                                <img style="heigth:260px;width:260px" src="{{ asset('storage/images/avatar/'.$user->kostSeeker->avatar) }}" alt="Image">
                                @else
                                <img style="heigth:260px;width:260px" src="{{ asset('templates/img/profile/profil1.jpeg') }}" alt="Image">
                                @endif
                                <h4 class="name">{{Auth::user()->kostSeeker->first_name}} {{Auth::user()->kostSeeker->last_name}}</h4>
                            </div>
                            <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                <li class="active"><a data-toggle="tab" href="#description">Profil</a></li>
                                <li><a data-toggle="tab" href="#password">Ubah Password</a></li>
                                <li><a data-toggle="tab" href="#booking">PEMESANAN KAMAR</a></li>
                                <li><a data-toggle="tab" href="#rent">PENYEWAAN KAMAR</a></li>
                            </ul><!-- /.nav-tabs #product-tabs -->
                        </div>
                        <div class="col-sm-12 col-md-9 col-lg-9">

                            <div class="tab-content">

                                <div id="description" class="tab-pane in active">
                                    {{ Form::open(array('method'=>'POST', 'url' => route('profile.update'), 'files' => true)) }}
                                    <div class="form-group col-md-12 col-sm-12">
                                        <div class="avatar-wrapper"><img class="profile-pic" @if ($user->kostSeeker->avatar !=
                                            NULL)
                                            src="{{ asset('storage/images/avatar/'.$user->kostSeeker->avatar) }}"
                                            @else
                                            src=""
                                            @endif />
                                            <div class="upload-button"><i class="fa fa-arrow-circle-up"
                                                    aria-hidden="true"></i>
                                            </div>
                                            <input name="avatar" class="file-upload" type="file" accept="image/*" />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6">
                                        <label class="info-title" for="first_name">Nama Depan
                                            <span>@error('first_name')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror</span></label>
                                        <input type="text"
                                            class="form-control unicase-form-control text-input @error('first_name') is-invalid @enderror"
                                            id="first_name" name="first_name" value="{{$user->kostSeeker->first_name}}">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6">
                                        <label class="info-title" for="last_name">Nama Belakang
                                            <span>@error('last_name')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror</span></label>
                                        <input type="text"
                                            class="form-control unicase-form-control text-input @error('last_name') is-invalid @enderror"
                                            id="last_name" name="last_name" value="{{$user->kostSeeker->last_name}}">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6">
                                        <label class="info-title" for="handphone">No. Handphone
                                            <span>@error('handphone')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror</span></label>
                                        <input type="phone"
                                            class="form-control unicase-form-control text-input @error('handphone') is-invalid @enderror"
                                            id="handphone" name="handphone" value="{{$user->kostSeeker->handphone}}">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6">
                                        <label class="info-title" for="emergency">No. Handphone Darurat
                                            <span>@error('emergency')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror</span></label>
                                        <input type="phone"
                                            class="form-control unicase-form-control text-input @error('emergency') is-invalid @enderror"
                                            id="emergency" name="emergency" value="{{$user->kostSeeker->emergency}}">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6">
                                        <label class="info-title" for="cities">Tempat Lahir
                                            <span>@error('cities')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror</span></label>
                                        {!! Form::select('cities', $cities, $user->kostSeeker->birth_place, ['class' => 'form-control
                                        selectpicker',
                                        'data-live-search'=>'true', 'required'=>'required', 'id'=>'c_cities',
                                        'title' => 'Pilih tempat lahir']) !!}
                                        @error('cities')
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6">
                                        <label class="info-title" for="birth_day">Tanggal Lahir
                                            <span>@error('birth_day')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror</span></label>
                                        <input name="birth_day" value="{{$user->kostSeeker->birth_day}}" type="date" placeholder="Tanggal Lahir Penyewa"
                                            class="form-control @error('birth_day') is-invalid @enderror required"
                                            required> <span class="form-text m-b-none"></span>

                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label class="info-title">Jenis Kelamin
                                            <span>@error('gender')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror</span></label>
                                    </div>
                                    <div class="form-group col-md-3 col-sm-3">
                                        <div class="form-group col-md-3 col-sm-3">
                                            <input type="radio"
                                                class="form-control unicase-form-control text-input @error('gender') is-invalid @enderror"
                                                id="gender1" name="gender" value="1" @if ($user->kostSeeker->gender
                                            == 1)
                                            checked
                                            @endif>
                                        </div>
                                        <div class="form-group col-md-3 col-sm-3"><label for="gender1">Pria</label>
                                        </div>
                                        <div class="form-group col-md-3 col-sm-3">
                                            <input type="radio"
                                                class="form-control unicase-form-control text-input @error('gender') is-invalid @enderror"
                                                id="gender2" name="gender" value="2" @if ($user->kostSeeker->gender
                                            == 2)
                                            checked
                                            @endif>
                                        </div>
                                        <div class="form-group col-md-3 col-sm-3"><label for="gender2">Wanita</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label class="info-title" for="c_job">Pekerjaan
                                            <span>@error('job')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror</span></label>
                                        {!! Form::select('job', $job, $user->kostSeeker->job, ['class' => 'form-control selectpicker',
                                        'title' => 'Pilih',
                                        'data-live-search'=>'true', 'required'=>'required', 'id'=>'c_job']) !!}
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12" id="desc-row" @if ($user->kostSeeker->job != 3)
                                        style="display:none"
                                    @endif >
                                        <label class="info-title" for="c_job_description">Deskripsi
                                            <span>@error('job_description')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror</span></label>
                                        <textarea id="c_job_description" name="job_description" type="textarea"
                                            placeholder="Alamat Instansi / Sekolah Penyewa"
                                            class="form-control @error('job_description') is-invalid @enderror">{{$user->kostSeeker->job_description}} </textarea>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12" id="job-row" @if ($user->kostSeeker->job == 3)
                                        style="display:none"
                                    @endif>
                                        <label class="info-title" for="job_name">Nama Instansi / Sekolah
                                            <span>@error('job_name')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror</span></label>
                                        <input id="c_job_name" name="job_name" type="text" value="{{$user->kostSeeker->job_name}}"
                                            placeholder="Nama Instansi / Sekolah Penyewa"
                                            class="form-control @error('job_name') is-invalid @enderror"> <span
                                            class="form-text m-b-none"></span>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label class="info-title" for="address">Address <span>@error('address')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror</span></label>
                                        <textarea name="address" id="address"
                                            class="form-control unicase-form-control text-input @error('handphone') is-invalid @enderror">{{$user->kostSeeker->address}}</textarea>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <button type="submit"
                                            class="btn-upper btn btn-primary checkout-page-button">Simpan</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div><!-- /.tab-pane -->
                                <div id="password" class="tab-pane">
                                    {{ Form::open(array('method'=>'POST', 'url' => route('customer.auth.changePassword.store'))) }}
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label class="info-title" for="password">New Password
                                            <span>@error('password')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror</span></label>
                                        <input name="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror"> <span
                                            class="form-text m-b-none"></span>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label class="info-title" for="password_confirmation">Confirm Password
                                            <span>@error('password_confirmation')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror</span></label>
                                        <input name="password_confirmation" type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"> <span
                                            class="form-text m-b-none"></span>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <button type="submit"
                                            class="btn-upper btn btn-primary checkout-page-button">Simpan</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div><!-- /.tab-pane -->

                                <div id="booking" class="tab-pane">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th colspan="4" class="heading-title">Riwayat Pemesanan Kamar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($bookings as $booking)
                                                <tr>
                                                    <td class="col-md-2 col-sm-6 col-xs-6"><img style="width:150px" src="{{ asset('storage/images/room/'.$booking->roomType->firstImage()->image) }}"
                                                            alt="image"></td>
                                                    <td class="col-md-7 col-sm-6 col-xs-6">
                                                        <div class="product-name"><a href="#">{{$booking->roomType->name}}
                                                                                &diams;{{$booking->roomType->kost->name}}</a></div>
                                                        <div class="description"><i class="fa fa-calendar"
                                                                                aria-hidden="true"></i> {{$booking->started_at}} hingga {{$booking->ended_at}}</div>
                                                        <div class="price">
                                                            {{Helper::rupiah($booking->total_price)}}
                                                        </div>
                                                        <div class="description">
                                                        @if($booking->status == 1)
                                                        <p><span class="label label-warning">Sedang diajukan</span></p>
                                                        @elseif($booking->status == 2)
                                                        <p><span class="label label-primary">Diterima</span></p>
                                                        @else
                                                        <p><span class="label label-danger">Ditolak</span></p>
                                                        @endif
                                                        </div>
                                                    </td>
                                                    <td class="col-md-2 ">
                                                        <button onclick="showImg(`{{ asset('storage/images/payment/'.$booking->payment) }}`)" id="myImg" class="btn-upper btn btn-primary" data-toggle="modal" data-target="#imageModal">Bukti pembayaran</button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- /.tab-pane -->

                                <div id="rent" class="tab-pane">
                                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="4" class="heading-title">Riwayat Pemesanan Kamar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($histories as $history)
                                <tr>
                                    <td class="col-md-2 col-sm-6 col-xs-6"><img style="width:150px"
                                            src="{{ asset('storage/images/room/'.$history->rent->room->roomType->firstImage()->image) }}"
                                            alt="image"></td>
                                    <td class="col-md-7 col-sm-6 col-xs-6">
                                        <div class="product-name"><a href="#">{{$history->rent->room->roomType->name}}
                                                &diams;{{$history->rent->room->roomType->kost->name}}</a></div>
                                        <div class="description"><i class="fa fa-calendar" aria-hidden="true"></i>
                                            {{$history->rent->started()->started_at}} hingga
                                            {{$history->rent->ended()->ended_at}}</div>
                                        <div class="description"> {{$history->rent->rentDetail->count()}} kali melakukan
                                            pemesanan</div>
                                        <?php 
                                            $today = new DateTime("today");
                                            $ended = new DateTime($history->rent->ended()->ended_at);
                                        ?>
                                        <div class="description">
                                            @if($today < $ended)
                                            <p><span class="label label-primary">Berjalan</span></p>
                                            @else
                                            <p><span class="label label-danger">Selesai</span></p>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="col-md-2 ">
                                        <a href="{{ route('customer.history.show', $history->id) }}" id="myImg"
                                            class="btn-upper btn btn-primary">Detail Pemesanan</a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                                </div><!-- /.tab-pane -->

                            </div><!-- /.tab-content -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.product-tabs -->
            </div><!-- /.col -->
            <div class="clearfix"></div>
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.body-content -->
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script>
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("modalImg");

    function showImg(src){
        console.log(src);
        modalImg.src = src;
    }

    $('#c_job').on('change', function (e) {
        let job = $('#c_job').val();
        if (job == 3) {
            $('#desc-row').show();
            $('#job-row').hide();
        } else {
            $('#desc-row').hide();
            $('#job-row').show();
        }
    });
    $(document).ready(function () {

        var readURL = function (input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.profile-pic').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".file-upload").on('change', function () {
            readURL(this);
        });

        $(".upload-button").on('click', function () {
            $(".file-upload").click();
        });
    });

</script>
@endsection
