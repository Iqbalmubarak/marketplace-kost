@extends('layouts.kostOwner.main')

@section('css')
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
                <h5>Edit Penyewa</h5>
            </div>
            <div class="ibox-content">
                {{ Form::open(array('method'=>'PATCH', 'url' => route('owner.tenant.update', $tenant->id),'class' => 'wizard-big', 'files' => true, 'id'=>'form', 'enctype' => 'multipart/form-data')) }}

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Pilih kost</label>
                    <div class="col-lg-10">
                        {!! Form::select('kost', $kost, $tenant->kost_id, ['class' => 'form-control selectpicker',
                        'data-live-search'=>'true', 'required'=>'required', 'id'=>'c_kost']) !!}
                        @error('kost')
                        <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div id="row-tenant" class="row-tenant">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <div class="avatar-wrapper"><img class="profile-pic" 
                            @if ($tenant->avatar != NULL)
                                src="{{ asset('storage/images/avatar/'.$tenant->avatar) }}"
                            @else
                                src=""
                            @endif  />

                                <div class="upload-button"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                                </div>
                                <input name="avatar" class="file-upload" type="file" accept="image/*" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Nama</label>
                        <div class="col-lg-4">
                            <input name="name"  value="{{$tenant->name}}" type="text" placeholder="Nama Penyewa"
                                class="form-control @error('name') is-invalid @enderror required" required> <span
                                class="form-text m-b-none"></span>
                            @error('name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <label class="col-lg-2 col-form-label">Jenis kelamin</label>
                        <div class="col-lg-4">
                            {!! Form::select('gender', $gender, $tenant->gender, ['class' => 'form-control selectpicker', 'title' => 'pilih',
                            'data-live-search'=>'true', 'required'=>'required', 'id'=>'c_gender']) !!}
                            @error('gender')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Tempat Lahir</label>
                        <div class="col-lg-4">
                            <input name="birth_place" value="{{$tenant->birth_place}}" type="text" placeholder="Tempat Lahir Penyewa"
                                class="form-control @error('birth_place') is-invalid @enderror required" required> <span
                                class="form-text m-b-none"></span>
                            @error('birth_place')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <label class="col-lg-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-lg-4">
                            <input name="birth_day" value="{{$tenant->birth_day}}" type="date" placeholder="Tanggal Lahir Penyewa"
                                class="form-control @error('birth_day') is-invalid @enderror required" required> <span
                                class="form-text m-b-none"></span>
                            @error('birth_day')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">No. Handphone</label>
                        <div class="col-lg-4">
                            <input name="handphone" value="{{$tenant->handphone}}" type="phone" placeholder="No Hp Penyewa"
                                class="form-control @error('handphone') is-invalid @enderror required" required> <span
                                class="form-text m-b-none"></span>
                            @error('handphone')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <label class="col-lg-2 col-form-label">No. Handphone darurat</label>
                        <div class="col-lg-4">
                            <input name="emergency" value="{{$tenant->emergency}}" type="text" placeholder="No Hp Wali Penyewa"
                                class="form-control @error('emergency') is-invalid @enderror required" required> <span
                                class="form-text m-b-none"></span>
                            @error('emergency')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Pekerjaan</label>
                        <div class="col-lg-10">
                            {!! Form::select('job', $job, $tenant->job, ['class' => 'form-control selectpicker', 'title' => 'Pilih',
                            'data-live-search'=>'true', 'required'=>'required', 'id'=>'c_job']) !!}
                            @error('job')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row" id="desc-row" style="display:none"><label class="col-lg-2 col-form-label">Deskripsi</label>
                        <div class="col-lg-10">
                            <textarea id="c_job_description" name="job_description" type="textarea"
                                placeholder="Alamat Instansi / Sekolah Penyewa"
                                class="form-control @error('job_description') is-invalid @enderror"> </textarea>
                            <span class="form-text m-b-none"></span>
                            @error('job_description')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row" id="job-row" style="display:none"><label class="col-lg-2 col-form-label">Nama Instansi / Sekolah</label>
                        <div class="col-lg-10">
                            <input id="c_job_name" name="job_name" type="text" placeholder="Nama Instansi / Sekolah Penyewa"
                                class="form-control @error('job_name') is-invalid @enderror"> <span
                                class="form-text m-b-none"></span>
                            @error('job_name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 col-form-label">
                        <button type="submit" class="btn btn-outline-success">Simpan</button>
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
