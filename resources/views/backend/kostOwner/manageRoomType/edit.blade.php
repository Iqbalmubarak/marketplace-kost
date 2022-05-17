@extends('layouts.kostOwner.main')

@section('css')
<link href="{{ asset('templates/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}"
    rel="stylesheet">
<link href="{{ asset('templates/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">

@endsection

@section('content')
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
                <a href="{{ route('owner.kost.show', $kost_id) }}">Detail Kost</a>
            </li>
            <li class="breadcrumb-item">
                <strong>
                    <a>Tambah Kamar</a>
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
                {{ Form::open(array('method'=>'PATCH', 'url' => route('owner.kost.room_type.update', $room_type->id),'class' => 'wizard-big', 'files' => true, 'id'=>'form', 'enctype' => 'multipart/form-data')) }}

                <h1>Informasi kamar</h1>
                <fieldset>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Tipe Kamar</label>
                        <div class="col-lg-10">
                            <input id="room_type" name="room_type" type="text" placeholder="Tipe kamar"
                                value="{{$room_type->name}}"
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
                                value="{{$room_type->lenght}}"
                                class="form-control @error('lenght') is-invalid @enderror required"> <span
                                class="form-text m-b-none"></span>
                            @error('lenght')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-5">
                            <input id="wide" name="wide" type="number" placeholder="Lebar" value="{{$room_type->wide}}"
                                class="form-control @error('wide') is-invalid @enderror required"> <span
                                class="form-text m-b-none"></span>
                            @error('wide')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                </fieldset>

                <h1>Fasilitas Kos</h1>
                <fieldset>
                    <?php $i = 3; ?>
                    @foreach ($room_type->roomFacilityDetail as $detail)
                    <div class="form-group row"><label class="col-lg-3 col-form-label">
                            @if ($detail->facility->facility_type_id == $i)
                            {{$detail->facility->type->name}}
                            <?php $i++ ; ?>
                            @endif</label>
                        <div class="col-lg-9">
                            <div class="checkbox checkbox-primary">
                                <input id="room_facility[{{$detail->id}}]" name="room_facility[]" type="checkbox"
                                    value="{{$detail->facility_id}}" @if ($detail->status == 2)
                                checked
                                @endif>
                                <label for="room_facility[{{$detail->id}}]">
                                    {{$detail->facility->name}}
                                </label>
                            </div>
                        </div>
                    </div>
                    @endforeach
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
                        @foreach ($room_images1 as $room_image1)
                        <div class="col-lg-3 clone-4" id="clone-4">
                            <div @if ($room_image1) class="fileinput fileinput-exists" @else
                                class="fileinput fileinput-new" @endif data-provides="fileinput">
                                <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                    <img src="{{ asset('templates/img/input_image.png') }} "
                                        style="width: 200px; height: 150px;" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists img-thumbnail"
                                    style="max-width: 200px; max-height: 150px;">@if ($room_image1)
                                    <img src="{{ asset('storage/images/room/'.$room_image1->image) }}"
                                        style="width: 200px; height: 150px;">
                                    @endif</div>
                                <br>
                                <div class="d-flex justify-content-center">
                                    <a href="javascript:void(0)" onclick="delImage1(this,{{$room_image1->id}})"
                                        class="btn btn-outline-secondary delete">Delete</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-lg-3 clone-4" id="clone-4">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                    <img src="{{ asset('templates/img/input_image.png') }} "
                                        style="width: 200px; height: 150px;" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists img-thumbnail"
                                    style="max-width: 200px; max-height: 150px;"></div>
                                <br>
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
                        @foreach ($room_images2 as $room_image2)
                        <div class="col-lg-3 clone-5" id="clone-5">
                            <div @if ($room_image2) class="fileinput fileinput-exists" @else
                                class="fileinput fileinput-new" @endif data-provides="fileinput">
                                <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                    <img src="{{ asset('templates/img/input_image.png') }} "
                                        style="width: 200px; height: 150px;" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists img-thumbnail"
                                    style="max-width: 200px; max-height: 150px;">@if ($room_image2)
                                    <img src="{{ asset('storage/images/room/'.$room_image2->image) }}"
                                        style="width: 200px; height: 150px;">
                                    @endif</div>
                                <br>
                                <div class="d-flex justify-content-center">
                                    <a href="javascript:void(0)" onclick="delImage2(this,{{$room_image2->id}})"
                                        class="btn btn-outline-secondary delete">Delete</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-lg-3 clone-5" id="clone-5">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                    <img src="{{ asset('templates/img/input_image.png') }} "
                                        style="width: 200px; height: 150px;" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists img-thumbnail"
                                    style="max-width: 200px; max-height: 150px;"></div>
                                <br>
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
                        @foreach ($room_images3 as $room_image3)
                        <div class="col-lg-3 clone-6" id="clone-6">
                            <div @if ($room_image3) class="fileinput fileinput-exists" @else
                                class="fileinput fileinput-new" @endif data-provides="fileinput">
                                <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                    <img src="{{ asset('templates/img/input_image.png') }} "
                                        style="width: 200px; height: 150px;" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists img-thumbnail"
                                    style="max-width: 200px; max-height: 150px;">@if ($room_image3)
                                    <img src="{{ asset('storage/images/room/'.$room_image3->image) }}"
                                        style="width: 200px; height: 150px;">
                                    @endif</div>
                                <br>
                                <div class="d-flex justify-content-center">
                                    <a href="javascript:void(0)" onclick="delImage3(this,{{$room_image3->id}})"
                                        class="btn btn-outline-secondary delete">Delete</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-lg-3 clone-6" id="clone-6">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                    <img src="{{ asset('templates/img/input_image.png') }} "
                                        style="width: 200px; height: 150px;" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists img-thumbnail"
                                    style="max-width: 200px; max-height: 150px;"></div>
                                <br>
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
                        @foreach ($room_images4 as $room_image4)
                        <div class="col-lg-3 clone-7" id="clone-7">
                            <div @if ($room_image4) class="fileinput fileinput-exists" @else
                                class="fileinput fileinput-new" @endif data-provides="fileinput">
                                <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                    <img src="{{ asset('templates/img/input_image.png') }} "
                                        style="width: 200px; height: 150px;" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists img-thumbnail"
                                    style="max-width: 200px; max-height: 150px;">@if ($room_image4)
                                    <img src="{{ asset('storage/images/room/'.$room_image4->image) }}"
                                        style="width: 200px; height: 150px;">
                                    @endif</div>
                                <br>
                                <div class="d-flex justify-content-center">
                                    <a href="javascript:void(0)" onclick="delImage4(this,{{$room_image4->id}})"
                                        class="btn btn-outline-secondary delete">Delete</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-lg-4 clone-7" id="clone-7">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                    <img src="{{ asset('templates/img/input_image.png') }} "
                                        style="width: 200px; height: 150px;" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists img-thumbnail"
                                    style="max-width: 200px; max-height: 150px;"></div>
                                <br>
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
                            <input id="duration_price{{$duration->id}}" onchange="convert(this, {{$duration->id}})"
                                name="duration_price[{{$duration->id}}]" type="text"
                                placeholder="Harga {{$duration->name}}" class="form-control" @if($duration->id == 1)
                            required @endif
                            @foreach ($price_lists as $price_list)
                            @if($price_list->rent_duration_id == $duration->id)
                            value = "{{Helper::rupiah($price_list->price)}}"
                            @endif
                            @endforeach
                            >
                        </div>
                        @endforeach
                    </div>

                    <div class="form-group row"><label class="col-lg-2 col-form-label">Biaya tambahan lainnya</label>
                        <div class="col-lg-10">
                            <div class="checkbox checkbox-success">
                                <input id="check-optional" type="checkbox" onclick="checkOptional()">
                                <label for="check-optional">
                                </label>
                            </div>
                        </div>
                    </div>

                    @foreach ($room_type->optionalPrice as $optionalPrice)
                    <div class="form-group row row-optional" style="display:none" id="row-optional">
                        <div class="col-lg-5 col-form-label">
                            <input id="price_name[]" name="price_name[]" type="text" placeholder="Nama biaya"
                                value="{{$optionalPrice->name}}"
                                class="form-control @error('price_name[]') is-invalid @enderror"> <span
                                class="form-text m-b-none"></span>
                            @error('price_name[]')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-5 col-form-label">
                            <input id="price[]" name="price[]" type="text" placeholder="Total biaya"
                                onchange="convertPrice(this)" value="{{Helper::rupiah($optionalPrice->price)}}"
                                class="form-control @error('price[]') is-invalid @enderror"> <span
                                class="form-text m-b-none"></span>
                            @error('price[]')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-2 col-form-label">
                            <a href="javascript:0" class="btn btn-outline-danger"
                                onclick="delPriceClone(this)">Hapus</a>
                        </div>
                    </div>
                    @endforeach
                    <div class="form-group row row-optional" style="display:none" id="row-optional">
                        <div class="col-lg-5 col-form-label">
                            <input id="price_name[]" name="price_name[]" type="text" placeholder="Nama biaya"
                                class="form-control @error('price_name[]') is-invalid @enderror"> <span
                                class="form-text m-b-none"></span>
                            @error('price_name[]')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-5 col-form-label">
                            <input id="price[]" name="price[]" type="text" placeholder="Total biaya"
                                onchange="convertPrice(this)"
                                class="form-control @error('price[]') is-invalid @enderror"> <span
                                class="form-text m-b-none"></span>
                            @error('price[]')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-2 col-form-label">
                            <a href="javascript:0" class="btn btn-outline-danger"
                                onclick="delPriceClone(this)">Hapus</a>
                        </div>
                    </div>

                    <div class="form-group row" id="button-optional" style="display:none">
                        <div class="col-lg-6 col-form-label">
                            <a href="javascript:0" class="btn btn-outline-success" onclick="priceClone()">Tambah</a>
                        </div>
                    </div>
                </fieldset>

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
    function delImage1(data, id) {
        //var $ele = data.parent().parent();
        //var id= $(this).val();
        //var id= 20;
        var url = "{{URL('api/kost')}}";
        var dltUrl = url + "/" + id + "/destroy-roomTypeImage";
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
                    data.closest('.clone-4').remove();
                }
            }
        });
    }

    function delImage2(data, id) {
        //var $ele = data.parent().parent();
        //var id= $(this).val();
        //var id= 20;
        var url = "{{URL('api/kost')}}";
        var dltUrl = url + "/" + id + "/destroy-roomTypeImage";
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
                    data.closest('.clone-5').remove();
                }
            }
        });
    }

    function delImage3(data, id) {
        //var $ele = data.parent().parent();
        //var id= $(this).val();
        //var id= 20;
        var url = "{{URL('api/kost')}}";
        var dltUrl = url + "/" + id + "/destroy-roomTypeImage";
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
                    data.closest('.clone-6').remove();
                }
            }
        });
    }

    function delImage4(data, id) {
        //var $ele = data.parent().parent();
        //var id= $(this).val();
        //var id= 20;
        var url = "{{URL('api/kost')}}";
        var dltUrl = url + "/" + id + "/destroy-roomTypeImage";
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
                    data.closest('.clone-7').remove();
                }
            }
        });
    }

    function convert(data, id) {
        var convert = convertRupiah(data.value, "Rp. ");
        $('#duration_price' + id).val(convert)
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
        $("#row-day").toggle(this.checked);
        $("#row-week").toggle(this.checked);
        $("#row-year").toggle(this.checked);
    }

    function checkOptional() {
        $(".row-optional").toggle(this.checked);
        $("#button-optional").toggle();
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

</script>
@endsection
