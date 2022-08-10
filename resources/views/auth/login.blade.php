@extends('layouts.landingPage.main')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link href="{{ asset('templates/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<?php 
    $cities = App\Models\City::pluck('cities_name','cities_id');
    $job = [];
    $job = ['1' => 'Mahasiswa', '2' => 'Karyawan', '3' => 'Lainnya'];
?>
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Home</a></li>
                <li class='active'>Login</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
            <div class="row">
                <!-- Sign-in -->
                <div class="col-md-6 col-sm-6 sign-in">
                    <h4 class="">Sign in</h4>
                    <p class="">Hello, Welcome to your account.</p>
                    <form method="POST" class="register-form outer-top-xs" role="form" action="{{ route('login') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="info-title" for="email">Email Address <span>*</span></label>
                            <input type="email"
                                class="form-control unicase-form-control text-input @error('email') is-invalid @enderror"
                                id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="password">Password <span>*</span></label>
                            <input type="password"
                                class="form-control unicase-form-control text-input @error('password') is-invalid @enderror"
                                id="password" name="password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="radio outer-xs">
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
                            <a href="#" class="forgot-password pull-right">Forgot your Password?</a>
                        </div>

                    </form>
                </div>
                <!-- Sign-in -->

                <!-- create a new account -->
                <div class="col-md-6 col-sm-6 create-new-account">
                    <h4 class="checkout-subtitle">Create a new account </h4>
                    <p class="text title-tag-line">Create your new account.</p>
                    <form method="POST" class="register-form outer-top-xs" role="form" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group col-md-12 col-sm-12">
                            <label class="info-title" for="email">Email Address <span>@error('email')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror</span></label>
                            <input type="email"
                                class="form-control unicase-form-control text-input @error('email') is-invalid @enderror"
                                id="email" name="email">
                        </div>
                        <div class="form-group col-md-6 col-sm-6">
                            <label class="info-title" for="first_name">First Name <span>@error('first_name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror</span></label>
                            <input type="text"
                                class="form-control unicase-form-control text-input @error('first_name') is-invalid @enderror"
                                id="first_name" name="first_name">
                        </div>
                        <div class="form-group col-md-6 col-sm-6">
                            <label class="info-title" for="last_name">Last Name <span>@error('last_name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror</span></label>
                            <input type="text"
                                class="form-control unicase-form-control text-input @error('last_name') is-invalid @enderror"
                                id="last_name" name="last_name">
                        </div>
                        @if($_GET['role']=='owner')
                        <div class="form-group col-md-12 col-sm-12">
                            <label class="info-title" for="handphone">Phone Number <span>@error('handphone')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror</span></label>
                            <input type="phone"
                                class="form-control unicase-form-control text-input @error('handphone') is-invalid @enderror"
                                id="handphone" name="handphone">
                        </div>
                        
                        
                        @elseif($_GET['role']=='customer')
                        <div class="form-group col-md-6 col-sm-6">
                            <label class="info-title" for="handphone">Phone Number <span>@error('handphone')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror</span></label>
                            <input type="phone"
                                class="form-control unicase-form-control text-input @error('handphone') is-invalid @enderror"
                                id="handphone" name="handphone">
                        </div>
                        <div class="form-group col-md-6 col-sm-6">
                            <label class="info-title" for="handphone">Phone Number Emergency <span>@error('emergency')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror</span></label>
                            <input type="phone"
                                class="form-control unicase-form-control text-input @error('emergency') is-invalid @enderror"
                                id="emergency" name="emergency">
                        </div>
                        <div class="form-group col-md-6 col-sm-6">
                            <label class="info-title" for="cities">Tempat Lahir
                                <span>@error('cities')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror</span></label>
                            {!! Form::select('cities', $cities, null, ['class' => 'form-control
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
                            <input name="birth_day" type="date" placeholder="Tanggal Lahir Penyewa"
                                class="form-control @error('birth_day') is-invalid @enderror required" required> <span
                                class="form-text m-b-none"></span>

                        </div>
                        <div class="form-group col-md-12 col-sm-12">
                            <label class="info-title">Jenis Kelamin
                                <span>@error('gender')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror</span>
                            </label>
                        </div>
                        <div class="form-group col-md-12 col-sm-12">
                            <div class="form-group col-md-1 col-sm-1">
                                <input type="radio"
                                    class="form-control unicase-form-control text-input @error('gender') is-invalid @enderror"
                                    id="gender1" name="gender" value="1">
                            </div>
                            <div class="form-group col-md-1 col-sm-1"><label for="gender1">Pria</label>
                            </div>
                            <div class="form-group col-md-1 col-sm-1">
                                <input type="radio"
                                    class="form-control unicase-form-control text-input @error('gender') is-invalid @enderror"
                                    id="gender2" name="gender" value="2">
                            </div>
                            <div class="form-group col-md-1 col-sm-1"><label for="gender2">Wanita</label>
                            </div>
                        </div>

                        <div class="form-group col-md-12 col-sm-12">
                            <label class="info-title" for="c_job">Pekerjaan
                                <span>@error('job')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror</span></label>
                            {!! Form::select('job', $job, null, ['class' => 'form-control selectpicker',
                            'title' => 'Pilih',
                            'data-live-search'=>'true', 'required'=>'required', 'id'=>'c_job']) !!}
                        </div>
                        <div class="form-group col-md-12 col-sm-12" id="desc-row" style="display:none">
                            <label class="info-title" for="c_job_description">Deskripsi
                                <span>@error('job_description')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror</span></label>
                            <textarea id="c_job_description" name="job_description" type="textarea"
                                placeholder="Alamat Instansi / Sekolah Penyewa"
                                class="form-control @error('job_description') is-invalid @enderror"> </textarea>
                        </div>
                        <div class="form-group col-md-12 col-sm-12" id="job-row" style="display:none">
                            <label class="info-title" for="job_name">Nama Instansi / Sekolah
                                <span>@error('job_name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror</span></label>
                            <input id="c_job_name" name="job_name" type="text"
                                placeholder="Nama Instansi / Sekolah Penyewa"
                                class="form-control @error('job_name') is-invalid @enderror"> <span
                                class="form-text m-b-none"></span>
                        </div>
                        @endif
                        <div class="form-group col-md-12 col-sm-12">
                            <label class="info-title" for="address">Address <span>@error('address')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror</span></label>
                            <textarea name="address" id="address"
                                class="form-control unicase-form-control text-input @error('handphone') is-invalid @enderror"></textarea>
                        </div>
                        <div class="form-group col-md-6 col-sm-6">
                            <label class="info-title" for="password">Password <span>@error('password')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror</span></label>
                            <input type="password"
                                class="form-control unicase-form-control text-input @error('password') is-invalid @enderror"
                                id="password" name="password">
                        </div>
                        <div class="form-group col-md-6 col-sm-6">
                            <label class="info-title" for="password">Confirm Password <span>@error('password')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror</span></label>
                            <input type="password"
                                class="form-control unicase-form-control text-input @error('password') is-invalid @enderror"
                                id="password" name="password_confirmation">
                        </div>
                        <div class="form-group col-md-12 col-sm-12">
                            @if($_GET['role']=='owner')
                            <input type="hidden" name="role" value="owner">
                            @elseif($_GET['role']=='customer')
                            <input type="hidden" name="role" value="customer">
                            @else
                            <input type="hidden" name="role" value="admin">
                            @endif
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Sign
                                Up</button>
                        </div>

                    </form>


                </div>
                <!-- create a new account -->
            </div><!-- /.row -->
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<!-- Jasny -->
<script src="{{ asset('templates/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
<script>
    function fileValidation() {
        var fileInput = document.getElementById('ktp');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        if (!allowedExtensions.exec(filePath)) {
            alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
            fileInput.value = '';
            return false;
        } else {
            //Image preview
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('imagePreview').innerHTML = '<img id="image" src="' + e.target.result +
                        '" style="width: 200px; height: 150px;"/>';
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    }

    function removeImage() {
        var image = document.getElementById('image');
        var preview = document.getElementById('imagePreview');
        preview.removeChild(image);
    }

    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("modalImg");

    function showImg(src) {
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
