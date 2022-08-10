@extends('layouts.kostOwner.main')

@section('css')
<link href="{{ asset('templates/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
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
<div class="row wrapper wrapper-content animated fadeInRight">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Profile</h5>
            </div>
            <div class="ibox-content">
                {{ Form::open(array('method'=>'POST', 'url' => route('profile.update'), 'files' => true)) }}
                <div id="row-tenant" class="row-tenant">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <div class="avatar-wrapper"><img class="profile-pic" 
                            @if ($user->avatar != NULL)
                                src="{{ asset('storage/images/avatar/'.$user->avatar) }}"
                            @else
                                src=""
                            @endif  />/>

                                <div class="upload-button"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                                </div>
                                <input name="avatar" class="file-upload" type="file" accept="image/*" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Nama depan</label>
                        <div class="col-lg-10">
                            <input name="first_name" type="text" placeholder="Nama Depan" value="{{$user->first_name}}"
                                class="form-control @error('first_name') is-invalid @enderror required" required> <span
                                class="form-text m-b-none"></span>
                            @error('first_name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Nama Belakang</label>
                        <div class="col-lg-10">
                            <input name="last_name" type="text" placeholder="Nama Belakang" value="{{$user->last_name}}"
                                class="form-control @error('last_name') is-invalid @enderror required" required> <span
                                class="form-text m-b-none"></span>
                            @error('last_name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">No. handphone</label>
                        <div class="col-lg-10">
                            <input name="handphone" type="phone" placeholder="No. Handphone" value="{{$user->handphone}}"
                                class="form-control @error('handphone') is-invalid @enderror required" required> <span
                                class="form-text m-b-none"></span>
                            @error('handphone')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Alamat</label>
                        <div class="col-lg-10">
                            <textarea name="address" placeholder="Alamat"
                                class="form-control @error('address') is-invalid @enderror required" required>{{$user->address}}</textarea>
                            <span class="form-text m-b-none"></span>
                            @error('address')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Upload KTP</label>
                        <div class="col-lg-10">
                            <div @if ($user->ktp) class="fileinput fileinput-exists" @else
                                class="fileinput fileinput-new" @endif data-provides="fileinput">
                                <span class="btn btn-block btn-outline btn-primary btn-file"><span
                                        class="fileinput-new">Upload KTP</span>
                                    <span class="fileinput-exists">Change</span><input type="file" id="ktp"
                                        name="ktp" onchange="return fileValidation()" @if ($user->ktp)
                                        value="{{$user->ktp}}" file="{{$user->ktp}}" @endif /></span>
                                <span class="fileinput-filename">
                                    @if ($user->ktp)
                                    {{$user->ktp}}
                                    @endif
                                </span>
                                <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none"
                                    onclick="removeImage()">×</a>
                            </div>
                            <!-- Image preview -->
                            <div id="imagePreview">
                                @if ($user->ktp)
                                <img id="image" src="{{ asset('storage/images/ktp/'.$user->ktp) }}" alt="" style="width: 200px; height: 150px;">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 col-form-label">
                        <button type="submit" class="btn btn-outline-primary">Ubah</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
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

    $('.chosen-select').chosen({
        width: "100%"
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
