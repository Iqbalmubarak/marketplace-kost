@extends('layouts.kostOwner.main')

@section('css')
<link href="{{ asset('templates/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}"
    rel="stylesheet">
<link href="{{ asset('templates/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdGrzi3vv43yyxfcFiBRoGVqvtZcJ2lIM"></script>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>Manage Kost</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home.index') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('owner.kost.index') }}">Kelola Kost</a>
            </li>
            <li class="breadcrumb-item">
                <strong>
                    <a>Perbaharui Data Kost</a>
                </strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3">

    </div>
</div>

<div class="row wrapper wrapper-content animated fadeInRight">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Perbaharui Data kost</h5>
            </div>
            <div class="ibox-content">
                {{ Form::open(array('method'=>'PATCH', 'url' => route('owner.kost.request-update', $kost->id),'class' => 'wizard-big', 'files' => true, 'id'=>'form', 'enctype' => 'multipart/form-data')) }}

                <h1>Informasi Kost</h1>
                <fieldset>
                    <div class="form-group row"><label class="col-lg-3 col-form-label">Nama kos</label>
                        <div class="col-lg-9">
                            <input id="e_name" name="name" type="text" placeholder="Name" value="{{$kost->name}}"
                                class="form-control @error('phone') is-invalid @enderror required"> <span
                                class="form-text m-b-none"></span>
                            @error('name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-3 col-form-label">Tipe kos</label>
                        <div class="col-lg-9">
                            {!! Form::select('kost_type', $kost_type, $kost->kost_type_id, ['class' => 'form-control
                            selectpicker',
                            'data-live-search'=>'true', 'required'=>'required', 'id'=>'c_kost_type']) !!}
                            @error('kost_type')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-3 col-form-label">Peraturan kos</label>
                        <div class="col-lg-9">
                            @foreach ($rule_details as $rule_detail)
                            <div class="checkbox checkbox-primary">
                                <input id="rule_detail[{{$rule_detail->rule_id}}]" name="rule_detail[]" type="checkbox"
                                    value="{{$rule_detail->rule_id}}" @if ($rule_detail->status == 2)
                                checked
                                @endif>
                                <label for="rule_detail[{{$rule_detail->rule_id}}]">
                                    {{$rule_detail->rule->name}}
                                </label>
                            </div>
                            @endforeach
                            <br>
                            <div @if ($rule_upload) class="fileinput fileinput-exists" @else
                                class="fileinput fileinput-new" @endif data-provides="fileinput">
                                <span class="btn btn-block btn-outline btn-primary btn-file"><span
                                        class="fileinput-new">Upload Peraturan</span>
                                    <span class="fileinput-exists">Change</span><input type="file" id="rule_upload"
                                        name="rule_upload" onchange="return fileValidation()" @if ($rule_upload)
                                        value="{{$rule_upload->image}}" file="{{$rule_upload->image}}" @endif /></span>
                                <span class="fileinput-filename">
                                    @if ($rule_upload)
                                    {{$rule_upload->image}}
                                    @endif
                                </span>
                                <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none"
                                    onclick="removeImage()">×</a>
                            </div>
                            <!-- Image preview -->
                            <div id="imagePreview">
                                @if ($rule_upload)
                                <img id="image" src="{{ asset('storage/images/rule/'.$rule_upload->image) }}" alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-3 col-form-label">Tahun berdiri</label>
                        <div class="col-lg-9">
                            <select name="exist" class="form-control selectpicker" id="e_exist" data-live-search="true">
                                @error('exist')
                                <div class="form-text text-danger">{{$message}}</div>
                                @enderror
                            </select>
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-3 col-form-label">Tambah data pengelola</label>
                        <div class="col-lg-9">
                            <div class="checkbox checkbox-success">
                                <input id="check-manager" type="checkbox" onclick="check()" @if ($kost->manager_name !=
                                NULL || $kost->manager_handphone != NULL)
                                checked
                                @endif>
                                <label for="check-manager">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row" @if ($kost->manager_name == NULL || $kost->manager_handphone == NULL)
                        style="display:none"
                        @endif id="row-manager"><label class="col-lg-3 col-form-label">Nama
                            pengelola</label>
                        <div class="col-lg-9">
                            <input id="e_manager" name="manager" value="{{$kost->manager_name}}" type="text"
                                placeholder="Nama Pengelola"
                                class="form-control @error('manager') is-invalid @enderror required"> <span
                                class="form-text m-b-none"></span>
                            @error('manager')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row" @if ($kost->manager_name == NULL || $kost->manager_handphone == NULL)
                        style="display:none"
                        @endif id="row-handphone"><label class="col-lg-3 col-form-label">Nomor
                            handphone pengelola</label>
                        <div class="col-lg-9">
                            <input id="e_handphone" name="handphone" type="phone" value="{{$kost->manager_handphone}}"
                                placeholder="Nomor Handphone Pengelola"
                                class="form-control @error('handphone') is-invalid @enderror required"> <span
                                class="form-text m-b-none"></span>
                            @error('handphone')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-3 col-form-label">Catatan lainnya</label>
                        <div class="col-lg-9">
                            <textarea id="e_note" name="note" type="textarea" placeholder="Catatan Lainnya"
                                class="form-control @error('note') is-invalid @enderror required"> {{$kost->note}}</textarea>
                            <span class="form-text m-b-none"></span>
                            @error('note')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                </fieldset>

                <h1>Alamat Kos</h1>
                <fieldset>
                    <div class="form-group row"><label class="col-lg-3 col-form-label">Alamat</label>
                        <div class="col-lg-9">
                            <textarea id="c_address" name="address" type="textarea" placeholder="Alamat Kos"
                                class="form-control @error('address') is-invalid @enderror required">{{$kost->address}}</textarea>
                            <span class="form-text m-b-none"></span>
                            @error('address')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-3 col-form-label">Koordinat</label>
                        <div class="col-lg-3">
                            <input id="c_latitude" value="{{$kost->latitude}}" name="latitude" type="text"
                                placeholder="latitude"
                                class="form-control @error('phone') is-invalid @enderror required" readonly> <span
                                class="form-text m-b-none"></span>
                            @error('latitude')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-3">
                            <input id="c_longitude" value="{{$kost->longitude}}" name="longitude" type="text"
                                placeholder="Longitude"
                                class="form-control @error('longitude') is-invalid @enderror required" readonly> <span
                                class="form-text m-b-none"></span>
                            @error('longitude')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-3 d-flex justify-content-left">
                            <Button class="btn btn-default  dim" title="Get Your Location" id="get-location"
                                type="button"><i class="fa fa-map-marker"></i></Button>
                            <Button class="btn btn-default  dim" title="Mark Your Location"
                                onclick="$('#map-create').toggle(500);" type="button"><img
                                    src="https://img.icons8.com/external-those-icons-lineal-those-icons/24/000000/external-map-maps-locations-those-icons-lineal-those-icons-2.png" /></Button>
                        </div>
                    </div>
                    <div class="google-map" id="map-create" style="height:400px" style="display:none"></div>
                </fieldset>

                <h1>Fasilitas</h1>
                <fieldset>
                    <?php $i = 1; ?>
                    @foreach ($kost_facility_details as $detail)
                    <div class="form-group row"><label class="col-lg-3 col-form-label">
                            @if ($detail->facility->facility_type_id == $i)
                            {{$detail->facility->type->name}}
                            <?php $i++ ; ?>
                            @endif</label>
                        <div class="col-lg-9">
                            <div class="checkbox checkbox-primary">
                                <input id="detail[{{$detail->facility_id}}]" name="detail[]" type="checkbox"
                                    value="{{$detail->facility_id}}" @if ($detail->status == 2)
                                checked
                                @endif>
                                <label for="detail[{{$detail->id}}]">
                                    {{$detail->facility->name}}
                                </label>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </fieldset>

                <h1>Foto Kos</h1>
                <fieldset>
                    <div class="form-group row ">
                        <div class="col-lg-12">
                            <h4><b>Foto bangunan dari depan</b></h4>
                            <a href="javascript:;" onclick="cloneImageKost1()" class="btn btn-outline-secondary btn-sm">
                                <i class="fa fa-plus-square"></i> Tambah gambar
                            </a>
                        </div>
                    </div>
                    <div class="form-group row">
                        @foreach ($kost_images1 as $kost_image1)
                        <div class="col-lg-3 clone-1" id="clone-1">
                            <div @if ($kost_image1) class="fileinput fileinput-exists" @else
                                class="fileinput fileinput-new" @endif data-provides="fileinput">
                                <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                    <img src="{{ asset('templates/img/input_image.png') }} "
                                        style="width: 200px; height: 150px;" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists img-thumbnail"
                                    style="max-width: 200px; max-height: 150px;">@if ($kost_image1)
                                    <img src="{{ asset('storage/images/kost/'.$kost_image1->image) }}">
                                    @endif</div>
                                <div class="d-flex justify-content-center">
                                    <a href="javascript:void(0)" onclick="delImage1(this,{{$kost_image1->id}})"
                                        class="btn btn-outline-secondary delete">Delete</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-lg-3 clone-1" id="clone-1">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                    <img src="{{ asset('templates/img/input_image.png') }} "
                                        style="width: 200px; height: 140px;" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists img-thumbnail"
                                    style="max-width: 200px; max-height: 150px;"></div>
                                <div>
                                    <span class="btn btn-outline-secondary btn-file"><span class="fileinput-new">Select
                                            image</span><span class="fileinput-exists">Change</span><input type="file"
                                            name="kost_image1[]"></span>
                                    <a href="#" class="btn btn-outline-secondary fileinput-exists"
                                        data-dismiss="fileinput">Remove</a>
                                    <a href="javascript:;" onclick="delCloneKost1(this)"
                                        class="btn btn-outline-secondary">
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="col-lg-12">
                            <h4><b>Foto bagian dalam bangunan</b></h4>
                            <a href="javascript:;" onclick="cloneImageKost2()" class="btn btn-outline-secondary btn-sm">
                                <i class="fa fa-plus-square"></i> Tambah gambar
                            </a>
                        </div>
                    </div>
                    <div class="form-group row">
                        @foreach ($kost_images2 as $kost_image2)
                        <div class="col-lg-3 clone-2" id="clone-2">
                            <div @if ($kost_image2) class="fileinput fileinput-exists" @else
                                class="fileinput fileinput-new" @endif data-provides="fileinput">
                                <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                    <img src="{{ asset('templates/img/input_image.png') }} "
                                        style="width: 200px; height: 150px;" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists img-thumbnail"
                                    style="max-width: 200px; max-height: 150px;">@if ($kost_image2)
                                    <img src="{{ asset('storage/images/kost/'.$kost_image2->image) }}">
                                    @endif</div>
                                <div class="d-flex justify-content-center">
                                    <a href="javascript:void(0)" onclick="delImage2(this,{{$kost_image2->id}})"
                                        class="btn btn-outline-secondary delete">Delete</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-lg-3 clone-2" id="clone-2">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                    <img src="{{ asset('templates/img/input_image.png') }} "
                                        style="width: 200px; height: 140px;" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists img-thumbnail"
                                    style="max-width: 200px; max-height: 150px;"></div>
                                <div>
                                    <span class="btn btn-outline-secondary btn-file"><span class="fileinput-new">Select
                                            image</span><span class="fileinput-exists">Change</span><input type="file"
                                            name="kost_image2[]"></span>
                                    <a href="#" class="btn btn-outline-secondary fileinput-exists"
                                        data-dismiss="fileinput">Remove</a>
                                    <a href="javascript:;" onclick="delCloneKost2(this)"
                                        class="btn btn-outline-secondary">
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="col-lg-12">
                            <h4><b>Foto bangunan dari jalan</b></h4>
                            <a href="javascript:;" onclick="cloneImageKost3()" class="btn btn-outline-secondary btn-sm">
                                <i class="fa fa-plus-square"></i> Tambah gambar
                            </a>
                        </div>
                    </div>
                    <div class="form-group row">
                        @foreach ($kost_images3 as $kost_image3)
                        <div class="col-lg-3 clone-3" id="clone-3">
                            <div @if ($kost_image3) class="fileinput fileinput-exists" @else
                                class="fileinput fileinput-new" @endif data-provides="fileinput">
                                <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                    <img src="{{ asset('templates/img/input_image.png') }} "
                                        style="width: 200px; height: 150px;" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists img-thumbnail"
                                    style="max-width: 200px; max-height: 150px;">@if ($kost_image3)
                                    <img src="{{ asset('storage/images/kost/'.$kost_image3->image) }}">
                                    @endif</div>
                                <div class="d-flex justify-content-center">
                                    <a href="javascript:void(0)" onclick="delImage3(this,{{$kost_image3->id}})"
                                        class="btn btn-outline-secondary delete">Delete</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-lg-3 clone-3" id="clone-3">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                    <img src="{{ asset('templates/img/input_image.png') }} "
                                        style="width: 200px; height: 140px;" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists img-thumbnail"
                                    style="max-width: 200px; max-height: 150px;"></div>
                                <div>
                                    <span class="btn btn-outline-secondary btn-file"><span class="fileinput-new">Select
                                            image</span><span class="fileinput-exists">Change</span><input type="file"
                                            name="kost_image3[]"></span>
                                    <a href="#" class="btn btn-outline-secondary fileinput-exists"
                                        data-dismiss="fileinput">Remove</a>
                                    <a href="javascript:;" onclick="delCloneKost3(this)"
                                        class="btn btn-outline-secondary">
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>


                <div hidden id="kost_exist">{{$kost->exist}}</div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

</div>
</div>


@endsection

@section('script')
<!-- Jasny -->
<script src="{{ asset('templates/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>

<script>

    $('#e_exist').each(function () {
        var exist = document.querySelector('div[id=kost_exist]').textContent
        var year = (new Date()).getFullYear();
        var current = year;
        year += 3;
        for (var i = 0; i < 100; i++) {
            if ((year - i) == exist)
                $(this).append('<option selected value="' + exist + '">' + exist + '</option>');
            else
                $(this).append('<option value="' + (year - i) + '">' + (year - i) + '</option>');
        }
    });

    function delImage1(data, id) {
        //var $ele = data.parent().parent();
        //var id= $(this).val();
        //var id= 20;
        var url = "{{URL('owner/kost')}}";
        var dltUrl = url + "/" + id + "/destroy-image";
        $.ajax({
            url: dltUrl,
            type: "DELETE",
            cache: false,
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function (dataResult) {
                var dataResult = JSON.parse(dataResult);
                if (dataResult.statusCode == 200) {
                    //$ele.fadeOut().remove();
                    data.closest('.clone-1').remove();
                }
            }
        });
    }

    function delImage2(data, id) {
        //var $ele = data.parent().parent();
        //var id= $(this).val();
        //var id= 20;
        var url = "{{URL('owner/kost')}}";
        var dltUrl = url + "/" + id + "/destroy-image";
        $.ajax({
            url: dltUrl,
            type: "DELETE",
            cache: false,
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function (dataResult) {
                var dataResult = JSON.parse(dataResult);
                if (dataResult.statusCode == 200) {
                    //$ele.fadeOut().remove();
                    data.closest('.clone-2').remove();
                }
            }
        });
    }

    function delImage3(data, id) {
        //var $ele = data.parent().parent();
        //var id= $(this).val();
        //var id= 20;
        var url = "{{URL('owner/kost')}}";
        var dltUrl = url + "/" + id + "/destroy-image";
        $.ajax({
            url: dltUrl,
            type: "DELETE",
            cache: false,
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function (dataResult) {
                var dataResult = JSON.parse(dataResult);
                if (dataResult.statusCode == 200) {
                    //$ele.fadeOut().remove();
                    data.closest('.clone-3').remove();
                }
            }
        });
    }

    function check() {
        $("#row-manager").toggle(this.checked);
        $("#row-handphone").toggle(this.checked);
    }

    function fileValidation() {
        var fileInput = document.getElementById('rule_upload');
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
                        '"/>';
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
    
    function myclone() {
        $("#repet")
            .eq(0)
            .clone()
            .find("input").val("").end() // ***
            .show()
            .insertAfter(".repet:last");
    }

    function cloneImageKost1() {
        $("#clone-1")
            .eq(0)
            .clone()
            .find("input").val("").end() // ***
            .show()
            .insertAfter(".clone-1:last");
    }

    function delCloneKost1(data) {
        console.log(data.closest('.clone-1'));
        if ($('.clone-1').length > 1) {
            data.closest('.clone-1').remove()
        } else {
            swal({
                title: "Warning!",
                text: "Select at least one image",
                type: "warning",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "OK",
                closeOnConfirm: false,
                closeOnCancel: false
            });
        };
    }

    function cloneImageKost2() {
        $("#clone-2")
            .eq(0)
            .clone()
            .find("input").val("").end() // ***
            .show()
            .insertAfter(".clone-2:last");
    }

    function delCloneKost2(data) {
        if ($('.clone-2').length > 1) {
            data.closest('.clone-2').remove()
        } else {
            swal({
                title: "Warning!",
                text: "Select at least one image",
                type: "warning",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "OK",
                closeOnConfirm: false,
                closeOnCancel: false
            });
        };
    }

    function cloneImageKost3() {
        $("#clone-3")
            .eq(0)
            .clone()
            .find("input").val("").end() // ***
            .show()
            .insertAfter(".clone-3:last");
    }

    function delCloneKost3(data) {
        if ($('.clone-3').length > 1) {
            data.closest('.clone-3').remove()
        } else {
            swal({
                title: "Warning!",
                text: "Select at least one image",
                type: "warning",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "OK",
                closeOnConfirm: false,
                closeOnCancel: false
            });
        };
    }

    function cloneImageRoom1() {
        $("#clone-4")
            .eq(0)
            .clone()
            .find("input").val("").end() // ***
            .show()
            .insertAfter(".clone-4:last");
    }

    function delCloneRoom1(data) {
        if ($('.clone-4').length > 1) {
            data.closest('.clone-4').remove()
        } else {
            swal({
                title: "Warning!",
                text: "Select at least one image",
                type: "warning",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "OK",
                closeOnConfirm: false,
                closeOnCancel: false
            });
        };
    }

    function cloneImageRoom2() {
        $("#clone-5")
            .eq(0)
            .clone()
            .find("input").val("").end() // ***
            .show()
            .insertAfter(".clone-5:last");
    }

    function delCloneRoom2(data) {
        if ($('.clone-5').length > 1) {
            data.closest('.clone-5').remove()
        } else {
            swal({
                title: "Warning!",
                text: "Select at least one image",
                type: "warning",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "OK",
                closeOnConfirm: false,
                closeOnCancel: false
            });
        };
    }

    function cloneImageRoom3() {
        $("#clone-6")
            .eq(0)
            .clone()
            .find("input").val("").end() // ***
            .show()
            .insertAfter(".clone-6:last");
    }

    function delCloneRoom3(data) {
        if ($('.clone-6').length > 1) {
            data.closest('.clone-6').remove()
        } else {
            swal({
                title: "Warning!",
                text: "Select at least one image",
                type: "warning",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "OK",
                closeOnConfirm: false,
                closeOnCancel: false
            });
        };
    }

    function cloneImageRoom4() {
        $("#clone-7")
            .eq(0)
            .clone()
            .find("input").val("").end() // ***
            .show()
            .insertAfter(".clone-6:last");
    }

    function delCloneRoom4(data) {
        if ($('.clone-7').length > 1) {
            data.closest('.clone-7').remove()
        } else {
            swal({
                title: "Warning!",
                text: "Select at least one image",
                type: "warning",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "OK",
                closeOnConfirm: false,
                closeOnCancel: false
            });
        };
    }

    function delmyclone(data) {
        console.log(data.closest('.repet'));
        if ($('.repet').length > 1) data.closest('.repet').remove();
    }

    $(document).ready(function () {
        $("#wizard").steps();
        $("#form").steps({
            bodyTag: "fieldset",
            onStepChanging: function (event, currentIndex, newIndex) {
                // Always allow going backward even if the current step contains invalid fields!
                if (currentIndex > newIndex) {
                    return true;
                }

                // Forbid suppressing "Warning" step if the user is to young
                if (newIndex === 3 && Number($("#age").val()) < 18) {
                    return false;
                }

                var form = $(this);

                // Clean up if user went backward before
                if (currentIndex < newIndex) {
                    // To remove error styles
                    $(".body:eq(" + newIndex + ") label.error", form).remove();
                    $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                }

                // Disable validation on fields that are disabled or hidden.
                form.validate().settings.ignore = ":disabled,:hidden";

                // Start validation; Prevent going forward if false
                return form.valid();
            },
            onStepChanged: function (event, currentIndex, priorIndex) {
                // Suppress (skip) "Warning" step if the user is old enough.
                if (currentIndex === 2 && Number($("#age").val()) >= 18) {
                    $(this).steps("next");
                }

                // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                if (currentIndex === 2 && priorIndex === 3) {
                    $(this).steps("previous");
                }
            },
            onFinishing: function (event, currentIndex) {
                var form = $(this);

                // Disable validation on fields that are disabled.
                // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                form.validate().settings.ignore = ":disabled";

                // Start validation; Prevent form submission if false
                return form.valid();
            },
            onFinished: function (event, currentIndex) {
                var form = $(this);

                // Submit form input
                form.submit();
            }
        }).validate({
            errorPlacement: function (error, element) {
                element.before(error);
            },
            rules: {
                confirm: {
                    equalTo: "#password"
                }
            }
        });
    });

    let mapCreate;
    let markers = [];
    // When the window has finished loading google map
    google.maps.event.addDomListener(window, 'load', init);

    function init() {
        // More info see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
        var mapOptions1 = {
            zoom: 13,
            center: new google.maps.LatLng(-0.9111111111111111, 100.34972222222221),
            // Style for Google Maps
            styles: [{
                "featureType": "water",
                "stylers": [{
                    "saturation": 43
                }, {
                    "lightness": -11
                }, {
                    "hue": "#0088ff"
                }]
            }, {
                "featureType": "road",
                "elementType": "geometry.fill",
                "stylers": [{
                    "hue": "#ff0000"
                }, {
                    "saturation": -100
                }, {
                    "lightness": 99
                }]
            }, {
                "featureType": "road",
                "elementType": "geometry.stroke",
                "stylers": [{
                    "color": "#808080"
                }, {
                    "lightness": 54
                }]
            }, {
                "featureType": "landscape.man_made",
                "elementType": "geometry.fill",
                "stylers": [{
                    "color": "#ece2d9"
                }]
            }, {
                "featureType": "poi.park",
                "elementType": "geometry.fill",
                "stylers": [{
                    "color": "#ccdca1"
                }]
            }, {
                "featureType": "road",
                "elementType": "labels.text.fill",
                "stylers": [{
                    "color": "#767676"
                }]
            }, {
                "featureType": "road",
                "elementType": "labels.text.stroke",
                "stylers": [{
                    "color": "#ffffff"
                }]
            }, {
                "featureType": "poi",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "landscape.natural",
                "elementType": "geometry.fill",
                "stylers": [{
                    "visibility": "on"
                }, {
                    "color": "#b8cb93"
                }]
            }, {
                "featureType": "poi.park",
                "stylers": [{
                    "visibility": "on"
                }]
            }, {
                "featureType": "poi.sports_complex",
                "stylers": [{
                    "visibility": "on"
                }]
            }, {
                "featureType": "poi.medical",
                "stylers": [{
                    "visibility": "on"
                }]
            }, {
                "featureType": "poi.business",
                "stylers": [{
                    "visibility": "simplified"
                }]
            }]
        };
        // Get all html elements for map
        var mapElement2 = document.getElementById('map-create');
        var mapCreate = new google.maps.Map(mapElement2, mapOptions1);

        google.maps.event.addListener(mapCreate, 'click', function (e) {
            if (markers.length > 0) {
                for (let i = 0; i < markers.length; i++) {
                    markers[i].setMap(null);
                }
            }

            $('#c_latitude').val(e.latLng.lat);
            $('#c_longitude').val(e.latLng.lng);

            var marker = new google.maps.Marker({
                position: e["latLng"],
                icon: 'https://img.icons8.com/external-kmg-design-outline-color-kmg-design/32/000000/external-map-map-and-navigation-kmg-design-outline-color-kmg-design-4.png',
                title: "Hello world!"
            });
            markers.push(marker);
            marker.setMap(mapCreate);
        });

        // Variabel untuk menyimpan batas kordinat
        bounds = new google.maps.LatLngBounds();

        document
            .getElementById("get-location")
            .addEventListener("click", function () {
                getLocation(mapCreate);
            });
        console.log($('#c_latitude').val());
        console.log($('#c_longitude').val());

        var pos = {
            lat: parseFloat($('#c_latitude').val()),
            lng: parseFloat($('#c_longitude').val())
        };

        console.log(pos);
        var marker = new google.maps.Marker({
            position: pos,
            map: mapCreate,
            title: 'Lokasi Anda',
            icon: 'https://img.icons8.com/external-kmg-design-outline-color-kmg-design/32/000000/external-map-map-and-navigation-kmg-design-outline-color-kmg-design-3.png',

            animation: google.maps.Animation.DROP
        });
        marker.setMap(mapCreate);
    }

    function getLocation(mapCreate) {
        // Geolokasi / lokasi sendiri
        var infoWindow = new google.maps.InfoWindow({
            map: mapCreate
        });

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                $('#c_latitude').val(position.coords.latitude);
                $('#c_longitude').val(position.coords.longitude);

                if (markers.length > 0) {
                    for (let i = 0; i < markers.length; i++) {
                        markers[i].setMap(null);
                    }
                }


                var marker = new google.maps.Marker({
                    position: pos,
                    map: mapCreate,
                    title: 'Lokasi Anda',
                    icon: 'https://img.icons8.com/external-kmg-design-outline-color-kmg-design/32/000000/external-map-map-and-navigation-kmg-design-outline-color-kmg-design-6.png',

                    animation: google.maps.Animation.DROP
                });
                markers.push(marker);

                marker.addListener('click', toggleBounce);

                function toggleBounce() {
                    if (marker.getAnimation() !== null) {
                        marker.setAnimation(null);
                    } else {
                        marker.setAnimation(google.maps.Animation.BOUNCE);
                    }
                }
                infoWindow.setPosition(pos);
                infoWindow.setContent('Anda Disini');
                map.setCenter(pos);
            }, function () {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Jika browser tidak mendukung geolokasi pindah ke lokasi ketetapan diatas (center)
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }

</script>
@endsection
