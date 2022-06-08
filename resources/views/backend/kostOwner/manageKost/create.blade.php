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
        <h2>Kelola Kost</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home.index') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('owner.kost.index') }}">Kelola Kost</a>
            </li>
            <li class="breadcrumb-item">
                <strong>
                    <a>Tambah Kost</a>
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
                <h5>Menambah kost</h5>
            </div>
            <div class="ibox-content">
                {{ Form::open(array('method'=>'POST', 'url' => route('owner.kost.store'),'class' => 'wizard-big', 'files' => true, 'id'=>'form', 'enctype' => 'multipart/form-data')) }}

                <h1>Informasi Kost</h1>
                <fieldset>
                    <div class="form-group row"><label class="col-lg-3 col-form-label">Nama kos</label>
                        <div class="col-lg-9">
                            <input id="c_name" name="name" type="text" placeholder="Name"
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
                            {!! Form::select('kost_type', $kost_type, null, ['class' => 'form-control selectpicker',
                            'data-live-search'=>'true', 'required'=>'required', 'id'=>'c_kost_type']) !!}
                            @error('kost_type')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-3 col-form-label">Peraturan kos</label>
                        <div class="col-lg-9">
                            @foreach ($rules as $rule)
                            <div class="checkbox checkbox-primary">
                                <input id="rule[{{$rule->id}}]" name="rule[]" type="checkbox" value="{{$rule->id}}">
                                <label for="rule[{{$rule->id}}]">
                                    {{$rule->name}}
                                </label>
                            </div>
                            @endforeach
                            <br>
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <span class="btn btn-block btn-outline btn-primary btn-file"><span
                                        class="fileinput-new">Upload Peraturan</span>
                                    <span class="fileinput-exists">Change</span><input type="file" id="rule_upload"
                                        name="rule_upload" onchange="return fileValidation()" /></span>
                                <span class="fileinput-filename"></span>
                                <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none"
                                    onclick="removeImage()">×</a>
                            </div>
                            <!-- Image preview -->
                            <div id="imagePreview"></div>
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-3 col-form-label">Tahun berdiri</label>
                        <div class="col-lg-9">
                            <select name="exist" class="form-control selectpicker" id="c_exist"
                                onchange="getProjectReportFunc()" data-live-search="true">
                                @error('exist')
                                <div class="form-text text-danger">{{$message}}</div>
                                @enderror
                            </select>
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-3 col-form-label">Tambah data pengelola</label>
                        <div class="col-lg-9">
                            <div class="checkbox checkbox-success">
                                <input id="check-manager" type="checkbox" onclick="check()">
                                <label for="check-manager">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row" style="display:none" id="row-manager"><label
                            class="col-lg-3 col-form-label">Nama
                            pengelola</label>
                        <div class="col-lg-9">
                            <input id="c_manager" name="manager" type="text" placeholder="Nama Pengelola"
                                class="form-control @error('manager') is-invalid @enderror"> <span
                                class="form-text m-b-none"></span>
                            @error('manager')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row" style="display:none" id="row-handphone"><label
                            class="col-lg-3 col-form-label">Nomor
                            handphone pengelola</label>
                        <div class="col-lg-9">
                            <input id="c_handphone" name="handphone" type="phone"
                                placeholder="Nomor Handphone Pengelola"
                                class="form-control @error('handphone') is-invalid @enderror"> <span
                                class="form-text m-b-none"></span>
                            @error('handphone')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-3 col-form-label">Metode pembayaran</label>
                        <div class="col-lg-9">
                            <div class="row g-2">
                                @foreach ($payment_methods as $payment_method)
                                <div class="col-4">
                                    <div class="checkbox checkbox-primary">
                                        <input class="checkbox-paymentMethod" id="payment_method[{{$payment_method->id}}]" type="checkbox"
                                            value="{{$payment_method->id}}" onclick="addPaymentMethod()">
                                        <label for="payment_method[{{$payment_method->id}}]">
                                            {{$payment_method->name}}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div id="row-paymentMethod">
                        <!-- Add Payment Method -->
                    </div>
                    <div class="form-group row"><label class="col-lg-3 col-form-label">Catatan lainnya</label>
                        <div class="col-lg-9">
                            <textarea id="c_note" name="note" type="textarea" placeholder="Catatan Lainnya"
                                class="form-control @error('note') is-invalid @enderror required"> </textarea>
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
                                class="form-control @error('address') is-invalid @enderror required"> </textarea>
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
                            <input id="c_latitude" name="latitude" type="text" placeholder="latitude"
                                class="form-control @error('phone') is-invalid @enderror required" readonly> <span
                                class="form-text m-b-none"></span>
                            @error('latitude')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-3">
                            <input id="c_longitude" name="longitude" type="text" placeholder="Longitude"
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

                <h1>Fasilitas Kos</h1>
                <fieldset>
                    @foreach ($facility_types1 as $facility_type)
                    <div class="form-group row"><label class="col-lg-3 col-form-label">{{$facility_type->name}}</label>
                        <div class="col-lg-9">
                            <div class="row g-2">
                                @foreach ($facility_type->facility as $facility)
                                <div class="col-4">
                                    <div class="checkbox checkbox-primary">
                                        <input id="facility[{{$facility->id}}]" name="facility[]" type="checkbox"
                                            value="{{$facility->id}}">
                                        <label for="facility[{{$facility->id}}]">
                                            {{$facility->name}}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="form-group row"><label class="col-lg-3 col-form-label">Fasilitas Lainnya</label>
                        <div class="col-lg-9">
                            <div class="checkbox checkbox-primary">
                                <input id="other_kost_facility" onclick="otherKostFacility()" type="checkbox">
                                <label for="other_kost_facility"></label>
                            </div>
                        </div>
                    </div>
                    <div class="toggle-kostFacility" style="display:none">
                        <div class="form-group row row-kostFacility" id="row-kostFacility">
                            <div class="col-lg-10 col-form-label">
                                <input id="other_kost_facility[]" name="other_kost_facility[]" type="text" placeholder="Nama Fasilitas"
                                    class="form-control @error('other_kost_facility[]') is-invalid @enderror "> <span
                                    class="form-text m-b-none"></span>
                                @error('other_kost_facility[]')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-2 col-form-label">
                                <a href="javascript:0" class="btn btn-outline-danger"
                                    onclick="delKostFacilityClone(this)">Hapus</a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-form-label">
                                <a href="javascript:0" class="btn btn-outline-success" onclick="kostFacilityClone()">Tambah</a>
                            </div>
                        </div>
                    </div>
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

                <h1>Informasi kamar</h1>
                <fieldset>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Tipe Kamar</label>
                        <div class="col-lg-10">
                            <input id="room_type" name="room_type" type="text" placeholder="Tipe kamar"
                                class="form-control @error('room_type') is-invalid @enderror required"> <span
                                class="form-text m-b-none"></span>
                            @error('room_type')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Luas kamar ( /m )</label>
                        <div class="col-lg-5">
                            <input id="lenght" name="lenght" type="number" placeholder="Panjang"
                                class="form-control @error('lenght') is-invalid @enderror required"> <span
                                class="form-text m-b-none"></span>
                            @error('lenght')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-5">
                            <input id="wide" name="wide" type="number" placeholder="Lebar"
                                class="form-control @error('wide') is-invalid @enderror required"> <span
                                class="form-text m-b-none"></span>
                            @error('wide')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Total kamar</label>
                        <div class="col-lg-10">
                            <input id="room_total" name="room_total" type="number" min="1" max="500"
                                placeholder="Total kamar"
                                class="form-control @error('room_total') is-invalid @enderror required"> <span
                                class="form-text m-b-none"></span>
                            @error('room_total')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                </fieldset>
                
                <h1>Fasilitas Kamar</h1>
                <fieldset>
                    @foreach ($facility_types2 as $facility_type)
                    <div class="form-group row"><label class="col-lg-3 col-form-label">{{$facility_type->name}}</label>
                        <div class="col-lg-9">
                            <div class="row g-2">
                                @foreach ($facility_type->facility as $facility)
                                <div class="col-4">
                                    <div class="checkbox checkbox-primary">
                                        <input id="room_facility[{{$facility->id}}]" name="room_facility[]" type="checkbox"
                                            value="{{$facility->id}}">
                                        <label for="room_facility[{{$facility->id}}]">
                                            {{$facility->name}}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="form-group row"><label class="col-lg-3 col-form-label">Fasilitas Lainnya</label>
                        <div class="col-lg-9">
                            <div class="checkbox checkbox-primary">
                                <input id="other_room_facility" onclick="otherRoomFacility()" type="checkbox">
                                <label for="other_room_facility"></label>
                            </div>
                        </div>
                    </div>
                    <div class="toggle-roomFacility" style="display:none">
                        <div class="form-group row row-roomFacility" id="row-roomFacility">
                            <div class="col-lg-10 col-form-label">
                                <input id="other_room_facility[]" name="other_room_facility[]" type="text" placeholder="Nama Fasilitas"
                                    class="form-control @error('other_room_facility[]') is-invalid @enderror "> <span
                                    class="form-text m-b-none"></span>
                                @error('other_room_facility[]')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-2 col-form-label">
                                <a href="javascript:0" class="btn btn-outline-danger"
                                    onclick="delRoomFacilityClone(this)">Hapus</a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-form-label">
                                <a href="javascript:0" class="btn btn-outline-success" onclick="roomFacilityClone()">Tambah</a>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <h1>Foto Kamar</h1>
                <fieldset>
                    <div class="form-group row ">
                        <div class="col-lg-12">
                            <h4><b>Foto bagian depan kamar</b></h4>
                            <a href="javascript:;" onclick="cloneImageRoom1()" class="btn btn-outline-secondary btn-sm">
                                <i class="fa fa-plus-square"></i> Tambah gambar
                            </a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3 clone-4" id="clone-4">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                    <img src="{{ asset('templates/img/input_image.png') }} "
                                        style="width: 200px; height: 150px;" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists img-thumbnail"
                                    style="max-width: 200px; max-height: 150px;"></div>
                                <div>
                                    <span class="btn btn-outline-secondary btn-file"><span class="fileinput-new">Select
                                            image</span><span class="fileinput-exists">Change</span><input type="file"
                                            name="image_room1[]"></span>
                                    <a href="#" class="btn btn-outline-secondary fileinput-exists"
                                        data-dismiss="fileinput">Remove</a>
                                    <a href="javascript:;" onclick="delCloneRoom1(this)"
                                        class="btn btn-outline-secondary">
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="col-lg-12">
                            <h4><b>Foto bagian dalam kamar</b></h4>
                            <a href="javascript:;" onclick="cloneImageRoom2()" class="btn btn-outline-secondary btn-sm">
                                <i class="fa fa-plus-square"></i> Tambah gambar
                            </a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3 clone-5" id="clone-5">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                    <img src="{{ asset('templates/img/input_image.png') }} "
                                        style="width: 200px; height: 150px;" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists img-thumbnail"
                                    style="max-width: 200px; max-height: 150px;"></div>
                                <div>
                                    <span class="btn btn-outline-secondary btn-file"><span class="fileinput-new">Select
                                            image</span><span class="fileinput-exists">Change</span><input type="file"
                                            name="image_room2[]"></span>
                                    <a href="#" class="btn btn-outline-secondary fileinput-exists"
                                        data-dismiss="fileinput">Remove</a>
                                    <a href="javascript:;" onclick="delCloneRoom2(this)"
                                        class="btn btn-outline-secondary">
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="col-lg-12">
                            <h4><b>Foto kamar mandi</b></h4>
                            <a href="javascript:;" onclick="cloneImageRoom3()" class="btn btn-outline-secondary btn-sm">
                                <i class="fa fa-plus-square"></i> Tambah gambar
                            </a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3 clone-6" id="clone-6">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                    <img src="{{ asset('templates/img/input_image.png') }} "
                                        style="width: 200px; height: 150px;" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists img-thumbnail"
                                    style="max-width: 200px; max-height: 150px;"></div>
                                <div>
                                    <span class="btn btn-outline-secondary btn-file"><span class="fileinput-new">Select
                                            image</span><span class="fileinput-exists">Change</span><input type="file"
                                            name="image_room3[]"></span>
                                    <a href="#" class="btn btn-outline-secondary fileinput-exists"
                                        data-dismiss="fileinput">Remove</a>
                                    <a href="javascript:;" onclick="delCloneRoom3(this)"
                                        class="btn btn-outline-secondary">
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="col-lg-12">
                            <h4><b>Foto tambahan</b></h4>
                            <a href="javascript:;" onclick="cloneImageRoom4()" class="btn btn-outline-secondary btn-sm">
                                <i class="fa fa-plus-square"></i> Tambah gambar
                            </a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4 clone-7" id="clone-7">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                    <img src="{{ asset('templates/img/input_image.png') }} "
                                        style="width: 200px; height: 150px;" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists img-thumbnail"
                                    style="max-width: 200px; max-height: 150px;"></div>
                                <div>
                                    <span class="btn btn-outline-secondary btn-file"><span class="fileinput-new">Select
                                            image</span><span class="fileinput-exists">Change</span><input type="file"
                                            name="image_room4[]"></span>
                                    <a href="#" class="btn btn-outline-secondary fileinput-exists"
                                        data-dismiss="fileinput">Remove</a>
                                    <a href="javascript:;" onclick="delCloneRoom4(this)"
                                        class="btn btn-outline-secondary">
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <h1>Harga Kamar</h1>
                <fieldset>
                    <div class="form-group row">
                        @foreach ($rent_durations as $duration)
                        <label class="col-lg-2 col-form-label">Harga {{$duration->name}}</label>
                        <div class="col-lg-10 col-form-label">
                            <input id="duration_price{{$duration->id}}" onchange="convert(this, {{$duration->id}})" name="duration_price[{{$duration->id}}]" type="text"
                                placeholder="Harga {{$duration->name}}" class="form-control" @if($duration->id == 1) required @endif>
                        </div>
                        @endforeach
                    </div>
                </fieldset>

                {!! Form::close() !!}
            </div>
        </div>
        
    </div>
</div>


@endsection

@section('script')
<!-- Jasny -->
<script src="{{ asset('templates/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>

<script>
    function addPaymentMethod(){
        let checked = [];
        for(var i=0; i<$('.checkbox-paymentMethod').length ;i++)
        {  
            if ($('.checkbox-paymentMethod').eq(i).prop('checked')==true){ 
                checked.push($('.checkbox-paymentMethod').eq(i).val());
            }
        }
        console.log(checked);
        $.post(
            "{{url('api/payment/add-paymentMethod')}}", 
            {
                "_token": "{{ csrf_token() }}",
                id: checked
            }, 
            function(result){
                console.log(result.length)
                $('.method').remove();
                for(var i=0; i<result.length; i++)
                {
                    var div = $(`<div class="form-group row method"><label class="col-lg-3 col-form-label">`+result[i].name+`</label>
                                    <div class="col-lg-9">
                                        <input name="no_rek[]" type="text"
                                        placeholder="Nomor rekening"
                                        class="form-control">
                                    </div>
                                    <div class="col-lg-12">
                                        <input name="payment_methods[]" type="hidden"
                                        value="`+result[i].id+`"
                                        class="form-control">
                                    </div>
                                </div>`);

                    $('#row-paymentMethod').append(div);
                }
                
            }
        )
    }

    function otherKostFacility() {
        $(".toggle-kostFacility").toggle(this.checked);
    }

    function otherRoomFacility() {
        $(".toggle-roomFacility").toggle(this.checked);
    }

    function convert(data, id) {
        var convert = convertRupiah(data.value, "Rp. ");
        $('#duration_price'+id).val(convert)
    }

    function convertPrice(data) {
        var convert = convertRupiah(data.value, "Rp. ");
        $(data).val(convert)
    }

    function convertRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
    }

    function isNumberKey(evt) {
        key = evt.which || evt.keyCode;
        if (key != 188 // Comma
            &&
            key != 8 // Backspace
            &&
            key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
            &&
            (key < 48 || key > 57) // Non digit
        ) {
            evt.preventDefault();
            return;
        }
    }
    
    $('#c_exist').each(function () {
        var year = (new Date()).getFullYear();
        var current = year;
        year += 3;
        for (var i = 0; i < 100; i++) {
            if ((year - i) == current)
                $(this).append('<option selected value="' + (year - i) + '">' + (year - i) + '</option>');
            else
                $(this).append('<option value="' + (year - i) + '">' + (year - i) + '</option>');
        }
    });



    function check() {
        $("#row-manager").toggle(this.checked);
        $("#row-handphone").toggle(this.checked);
    }

    function checkPrice() {
        $("#row-day").toggle(this.checked);
        $("#row-week").toggle(this.checked);
        $("#row-year").toggle(this.checked);
    }

    function checkOptional() {
        $(".row-optional").toggle(this.checked);
    }

    function priceClone() {
        $("#row-optional")
            .eq(0)
            .clone()
            .find("input").val("").end() // ***
            .show()
            .insertAfter(".row-optional:last");
    }

    function delPriceClone(data) {
        if ($('.row-optional').length > 1) data.closest('.row-optional').remove();
    }

    function kostFacilityClone() {
        $("#row-kostFacility")
            .eq(0)
            .clone()
            .find("input").val("").end() // ***
            .show()
            .insertAfter(".row-kostFacility:last");
    }

    function delKostFacilityClone(data) {
        if ($('.row-kostFacility').length > 1) data.closest('.row-kostFacility').remove();
    }

    function roomFacilityClone() {
        $("#row-roomFacility")
            .eq(0)
            .clone()
            .find("input").val("").end() // ***
            .show()
            .insertAfter(".row-roomFacility:last");
    }

    function delRoomFacilityClone(data) {
        if ($('.row-roomFacility').length > 1) data.closest('.row-roomFacility').remove();
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
    // Dropzone.options.myDropzone = {

    //     // Prevents Dropzone from uploading dropped files immediately
    //     autoProcessQueue: false,
    //     uploadMultiple: true,
    //     maxFilesize: 10,
    //     maxFiles: 2,
    //     addRemoveLinks: true,
    //     acceptedFiles: ".png, .jpg",

    //     init: function () {
    //         var submitButton = document.querySelector("#submit-all")
    //         myDropzone = this; // closure

    //         submitButton.addEventListener("click", function (e) {
    //             console.log(myDropzone.processQueue());
    //             e.preventDefault();
    //             e.stopPropagation();
    //             myDropzone.processQueue(); // Tell Dropzone to process all queued files.
    //         });

    //         // You might want to show the submit button only when 
    //         // files are dropped here:
    //         // this.on("addedfile", function() {
    //         //   // Show submit button here and/or inform user to click it.
    //         //   alert("se agrego un archivo");
    //         // });

    //         this.on("complete", function (file) {
    //             myDropzone.removeFile(file);
    //         });

    //     }
    // };



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
            .insertAfter(".clone-7:last");
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
                    draggable: true,
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
