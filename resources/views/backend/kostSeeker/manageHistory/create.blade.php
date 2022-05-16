@extends('layouts.kostOwner.main')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{ asset('templates/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}"
    rel="stylesheet">
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

@section('content') <div class="row wrapper wrapper-content animated fadeInRight">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Menambah penyewaan kamar</h5>
            </div>
            <div class="ibox-content">
                {{ Form::open(array('method'=>'POST', 'url' => route('owner.rent.store'),'class' => 'wizard-big', 'files' => true, 'id'=>'form', 'enctype' => 'multipart/form-data')) }}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Pilih kost</label>
                    <div class="col-lg-9">
                        {!! Form::select('kost', $kost,null, ['class' => 'form-control kt-select2
                        myselect2','required'=>'required','id'=>'c_kost']) !!}
                        @error('kost')
                        <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Pilih tipe kamar</label>
                    <div class="col-lg-9">
                        {!! Form::select('room_type', $room_type,null, ['class' => 'form-control kt-select2
                        myselect2','required'=>'required','id'=>'c_room_type']) !!}
                        @error('room_type')
                        <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Pilih kamar</label>
                    <div class="col-lg-9">
                        {!! Form::select('room', $room,null, ['class' => 'form-control kt-select2
                        myselect2','required'=>'required','id'=>'c_room']) !!}
                        @error('room')
                        <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Pilih durasi penyewaan</label>
                    <div class="col-lg-9">
                        {!! Form::select('price_list', $price_list,null, ['class' => 'form-control kt-select2
                        myselect2 c_tenant','required'=>'required','id'=>'c_price_list']) !!}
                        @error('price_list')
                        <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Biaya tambahan</label>
                    <div class="col-lg-9" id="row-optional">
                        
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Total biaya</label>
                    <div class="col-lg-9">
                        <input id="c_total_price" name="total_price" type="text" placeholder="Rp. 0,00"
                                class="form-control @error('total_price') is-invalid @enderror" readonly> <span
                                class="form-text m-b-none"></span>
                            @error('total_price')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                    </div>
                </div>
                <div class="form-group row row-tenant" id="row-tenant">
                    <label class="col-lg-3 col-form-label label-tenant" id="label-tenant">Pilih penyewa</label>
                    <div class="col-lg-9">
                        {!! Form::select('tenant[]', $tenant,null, ['class' => 'form-control kt-select2
                        myselect2 c_tenant','required'=>'required', 'multiple' => 'multiple', 'id' => 'c_tenant']) !!}
                        @error('tenant')
                        <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 col-form-label">
                        <button type="submit" class="btn btn-outline-primary">Simpan</button>
                    </div>

                </div>
                

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#c_room_type').prop("disabled", true);
    $('#c_room').prop("disabled", true);
    $('#c_price_list').prop("disabled", true);
    $('#c_tenant').prop("disabled", true);

    $(".myselect2").select2({
        placeholder: "Select a state",
        allowClear: true
    });
    $('.myselect2').val(0).change();

    $('#c_kost').on('select2:select', function (e) {
        let kost = $('#c_kost').val();
        if (kost) {
            $('#c_room_type').val(0).change();
            $('#c_room').val(0).change();
            $('#c_price_list').val(0).change();
            $('.c_tenant').val(0).change();
            fethDataType(kost);
            fethDataTenant(kost);
            $('#c_room_type').prop("disabled", false);
            $('#c_tenant').prop("disabled", false);
            $('#c_room').prop("disabled", true);
            $('#c_price_list').prop("disabled", true);
            while($('.row-tenant').length > 1){
                $('.row-tenant:last').remove();
            }
        } else {
            $('#c_room_type').prop("disabled", true);
        }
    });

    $('#c_room_type').on('select2:select', function (e) {
        let room_type = $('#c_room_type').val();
        if (room_type) {
            fethDataRoom(room_type);
            fethDataOptional(room_type);
            $('#c_room').prop("disabled", false);
        } else {
            $('#c_room').prop("disabled", true);
        }
    });

    $('#c_room').on('select2:select', function (e) {
        let room_type = $('#c_room_type').val();
        if (room_type) {
            fethDataDuration(room_type);
            $('#c_price_list').prop("disabled", false);
        } else {
            $('#c_price_list').prop("disabled", true);
        }
    });

    $('#c_price_list').on('select2:select', function (e) {
        let duration_price = $('#c_price_list').val();
        $('#c_total_price').val(0);
        var total_price = $('#c_total_price').val();
        total_price = parseInt(total_price);

        let base_url = "{{URL('api/select/duration_price')}}";
        $.ajax({
            url: base_url + "/" + duration_price,
            dataType: 'json',
            cache: false,
            dataSrc: '',

            success: function (data) {
                var price = data.price;
                total_price = total_price + price;

                for(i = 0; i < $('.optional-checkbox').length; i++){
                    if($('#optional'+i).prop("checked") == true){
                        var optional = $('#input-checkbox'+i).val();
                        
                        optional = parseInt(optional);
                        total_price = total_price + optional;
                    }
                }

                total_price = String(total_price);
                var convert = convertRupiah(total_price, "Rp. ");
                $('#c_total_price').val(convert);
            }
        });
        
    });

    function checkOptional(){
        console.log('sudah');
        let duration_price = $('#c_price_list').val();
        $('#c_total_price').val(0);
        var total_price = $('#c_total_price').val();
        total_price = parseInt(total_price);

        let base_url = "{{URL('api/select/duration_price')}}";
        $.ajax({
            url: base_url + "/" + duration_price,
            dataType: 'json',
            cache: false,
            dataSrc: '',

            success: function (data) {
                var price = data.price;
                total_price = total_price + price;

                for(i = 0; i < $('.optional-checkbox').length; i++){
                    if($('#optional'+i).prop("checked") == true){
                        var optional = $('#input-checkbox'+i).val();
                        
                        optional = parseInt(optional);
                        total_price = total_price + optional;
                    }
                }

                total_price = String(total_price);
                var convert = convertRupiah(total_price, "Rp. ");
                $('#c_total_price').val(convert);
            }
        });
    }

    function convertRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = angka.split(","),
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

    function fethDataType(kost) {
        let base_url = "{{URL('api/select/room-type')}}";
        $("#c_room_type").select2({
            placeholder: "Select a state",
            allowClear: true,
            language: {
                noResults: function (params) {
                    return "Tidak ada tipe room yang sesuai pada kos ini";
                }
            },
            tokenSeparators: [',', ' '],
            ajax: {
                url: base_url + "/" + kost,
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

    function fethDataTenant(kost) {
        let base_url = "{{URL('api/select/tenant')}}";
        $(".c_tenant").select2({
            placeholder: "Select a state",
            allowClear: true,
            language: {
                noResults: function (params) {
                    return "Tidak ada tipe room yang sesuai pada kos ini";
                }
            },
            tokenSeparators: [',', ' '],
            ajax: {
                url: base_url + "/" + kost,
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

    function fethDataOptional(room_type) {
        let base_url = "{{URL('api/select/optional')}}";
        $('.checkbox').remove();
        $.ajax({
            url: base_url + "/" + room_type,
            dataType: 'json',
            cache: false,
            dataSrc: '',

            success: function (data) {
                var id = data.map(function (item) {
                    return item.id;
                });
                var name = data.map(function (item) {
                    return item.name;
                });
                var price = data.map(function (item) {
                    return item.price;
                });
                for (i = 0; i < data.length; i++) {
                    var row = (`<div class="checkbox checkbox-primary">
                            <input class="optional-checkbox" id="optional`+i+`" name="optional[]" type="checkbox"
                                value="`+id[i]+`" onclick="checkOptional()" checked disabled>
                            <label for="optional`+i+`">
                                `+name[i]+`
                            </label>
                            <input type="hidden" name="input_checkbox" id="input-checkbox`+i+`" value="`+price[i]+`">
                        </div>`);
                    
                    $('#row-optional').append(row);
                }
            }

        });
    }

    function fethDataRoom(room_type) {
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

    function fethDataDuration(room_type) {
        let base_url = "{{URL('api/select/duration')}}";
        console.log('duration');
        $("#c_price_list").select2({
            placeholder: "Select a state",
            allowClear: true,
            language: {
                noResults: function (params) {
                    return "Tidak ada durasi yang tersedia pada tipe kamar ini";
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

    function tenantClone() {
        $("#row-tenant")
            .eq(0)
            .clone()
            .find("input").val("").end()// ***
            .show()
            .insertAfter(".row-tenant:last");

        $(".c_tenant:last").attr("data-select2-id","dsada");
        $(".label-tenant:last").html("");
    }

    function delTenantClone(data) {
        if ($('.row-tenant').length > 1) data.closest('.row-tenant').remove();
    }

</script>
@endsection
