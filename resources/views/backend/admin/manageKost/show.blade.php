@extends('layouts.admin.main')
@section('css')
<link href="{{ asset('templates/css/plugins/slick/slick.css') }}" rel="stylesheet">
<link href="{{ asset('templates/css/plugins/slick/slick-theme.css') }}" rel="stylesheet">
<link href="{{ asset('templates/css/plugins/blueimp/css/blueimp-gallery.min.css') }}" rel="stylesheet">
<link href="{{ asset('templates/css/mine.css') }}" rel="stylesheet">
<link href="{{ asset('templates/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}"
    rel="stylesheet">
@endsection
@section('content')
<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdGrzi3vv43yyxfcFiBRoGVqvtZcJ2lIM"></script>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>Detail Kost</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home.index') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('owner.kost.index') }}">Kelola Kost</a>
            </li>
            <li class="breadcrumb-item">
                <strong>
                    <a>Detail Kost</a>
                </strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3">

    </div>
</div> <br>
@if ($kost->status == 2)
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12" style="color:red; text-align:center;">
        <h2>Permohonan Kost Ditolak !</h2>
        @if($kost->reject_note != NULL)
            <h4>{{$kost->reject_note}}</h4>
        @else
            <h4>Mohon Lengkapi Kembali Data Kost Anda</h4>
        @endif
    </div>
</div>
@endif
<div class="row wrapper wrapper-content animated fadeInRight justify-content-md-center">
    <div class="col-lg-12">
        <div class="ibox product-detail">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-5">
                        <div class="google-map" id="map" style="height:600px"></div>
                    </div>
                    <div class="col-md-7">
                        <h2 class="font-bold m-b-xs">
                            {{$kost->name}}&nbsp;
                            @if ($kost->type->id == 1)
                            <span class="badge badge-success">{{$kost->type->name}}</span>
                            @elseif ($kost->type->id == 2)
                            <span class="badge badge-danger">{{$kost->type->name}}</span>
                            @else
                            <span class="badge badge-warning">{{$kost->type->name}}</span>
                            @endif
                        </h2>
                        <div class="m-t-md">
                            <h2 class="product-main-price"><small class="text-muted">Berdiri sejak tahun</small>
                                <strong>{{$kost->exist}}</strong></h2>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-8">
                                <h4>Deskripsi kos</h4>
                                <div class="small text-muted">
                                    @if ($kost->note)
                                    <?php echo nl2br(htmlspecialchars($kost->note)); ?>
                                    @else
                                    Belum ada deskripsi kos
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <h4>Metode Pembayaran</h4>
                                <div class="small text-muted">
                                    @foreach ($kost->paymentMethodDetail as $paymentMethodDetail)
                                        <div>
                                            <i class="fa fa-credit-card-alt"></i>
                                                {{$paymentMethodDetail->paymentMethod->name}} <b>( 
                                                {{$paymentMethodDetail->no_rek}} )</b> 
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <dl class="small m-t-md">
                            <dt><i class="fa fa-user"></i> Nama pengelola</dt>
                            <dd>@if ($kost->manager_name)
                                {{$kost->manager_name}}
                                @else
                                -
                                @endif</dd>
                            <dt><i class="fa fa-phone"></i> Nomor pengelola</dt>
                            <dd>@if ($kost->manager_handphone)
                                {{$kost->manager_handphone}}
                                @else
                                -
                                @endif</dd>
                            <dt><i class="fa fa-map-marker"></i> Alamat</dt>
                            <dd><?php echo nl2br(htmlspecialchars($kost->address)); ?> </dd>
                            <dt>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <i class="fa fas fa-plus-square"></i> Fasilitas
                                    </div>
                                    <div class="col-lg-3">
                                        <i class="fa fas fa-plus-square"></i> Fasilitas Lainnya
                                    </div>
                                    @if ($kost->rule_detail)
                                    <div class="col-lg-6">
                                        <i class="fa fa-file-text"></i> Peraturan
                                    </div>
                                    @endif
                                </div>
                            </dt>
                        </dl>
                        <div class="text-muted">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="row">
                                        @foreach ($kost->kostFacilityDetail as $kostFacilityDetail)
                                        @if ($kostFacilityDetail->status == 2)
                                        <div class="col-lg-12">
                                            @if ($kostFacilityDetail->facility->icon)
                                            <div class="row">
                                                <div class="col-lg-10">
                                                    <abbr title="{{$kostFacilityDetail->facility->name}}"><i
                                                            class="{{$kostFacilityDetail->facility->icon}}"></i> </abbr>
                                                            {{$kostFacilityDetail->facility->name}}
                                                </div>
                                            </div>
                                            @else
                                            <div class="row">
                                                <div class="col-lg-10">
                                                    <abbr title="{{$kostFacilityDetail->facility->name}}"><i
                                                            class="fa fas fa-plus"></i></abbr>
                                                            {{$kostFacilityDetail->facility->name}}
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row">
                                        @foreach ($kost->otherKostFacility as $otherKostFacility )
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-10">
                                                    <abbr title="{{$otherKostFacility->name}}"><i
                                                            class="fa fas fa-plus"></i> </abbr>
                                                            {{$otherKostFacility->name}}
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            @foreach ($kost->rule_detail as $rule_detail)
                                            @if ($rule_detail->status == 2)
                                            <i class="fa fa-check"> {{$rule_detail->rule->name}}</i><br>
                                            @endif
                                            @endforeach
                                        </div>
                                        <div class="col-lg-6">
                                            @if ($kost->rule_upload)
                                            <img id="myImg"
                                                src="{{ asset('storage/images/rule/'.$kost->rule_upload->image) }}"
                                                alt="Snow" style="width:100%;max-width:300px">
                                            @else
                                            <img id="myImg" src="{{ asset('templates/img/input_image.png') }}"
                                                alt="Snow" style="width:100%;max-width:300px">
                                            @endif

                                            <!-- The Modal -->
                                            <div id="myModal" class="modal">

                                                <!-- The Close Button -->
                                                <span class="close">&times;</span>

                                                <!-- Modal Content (The Image) -->
                                                <img class="modal-content" id="img01">

                                                <!-- Modal Caption (Image Text) -->
                                                <div id="caption"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="ibox-footer">
                <span class="float-right">
                    Dibuat pada tanggal - <i class="fa fa-clock-o"></i> {{$kost->created_at}}
                </span>
                @if ($kost->status == 0)
                <span class="badge badge-warning">Menunggu konfirmasi admin</span>
                @elseif ($kost->status == 1)
                <span class="badge badge-primary">Aktif</span>
                @else
                <span class="badge badge-danger">Ditolak</span>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <h2 class="text-center m">
            <strong>Foto Kos</strong>
        </h2>
        <div class="slick_demo_2">
            @foreach ($kost->kostImage as $kostImage)
            <div>
                <div class="ibox-content">
                    <h5>{{$kostImage->section->name}}</h5>
                    <img src="{{ asset('storage/images/kost/'.$kostImage->image) }}" alt="">
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @include('backend.kostOwner.manageRoom.create')
    @include('backend.kostOwner.manageRoom.edit')

    <div class="col-lg-7">
        <div class="ibox ">
            <div class="ibox-title">
                <div class="row">
                    <div class="col-10">
                        <h5>Daftar kamar</h5>
                    </div>
                    <div class="col-2 d-flex justify-content-end">
                        <!-- <a href="javascript:void(0)" onclick="$('#room-create').toggle(500);$('#room-edit').hide(500);">
                            <button class="btn btn-primary btn-outline" type="button">Tambah kamar</button>
                        </a> -->
                    </div>
                </div>
            </div>
            <div class="ibox-content">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-room" id="tbl_room">
                        <thead>
                            <tr>
                                <th>Kamar</th>
                                <th>Tipe kamar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="ibox ">
            <div class="ibox-title">
                <div class="row">
                    <div class="col-10">
                        <h5>Daftar tipe kamar</h5>
                    </div>
                    <div class="col-2 d-flex justify-content-end">
                        <!-- <a href="{{ route('owner.kost.room_type.create', $kost->id) }}">
                            <button class="btn btn-primary btn-outline" type="button">Tambah tipe kamar</button>
                        </a> -->
                    </div>
                </div>
            </div>
            <div class="ibox-content">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-room-type"
                        id="tbl_room_type">
                        <thead>
                            <tr>
                                <th>Tipe kamar</th>
                                <th>Luas kamar</th>
                                <th>Total kamar</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach ($rooms as $room)
    <div class="col-lg-4">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>{{$room->roomType->name}}</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#" class="dropdown-item">Config option 1</a>
                        </li>
                        <li><a href="#" class="dropdown-item">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content ">
                <div id="carouselExampleIndicators{{$room->room_type_id}}" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php $i=0 ; ?>
                        @foreach ($room->roomType->roomImage as $roomImage)
                        @if ($i == 0)
                        <li data-target="#carouselExampleIndicators{{$room->room_type_id}}" data-slide-to="{{$i}}"
                            class="active"></li>
                        @else
                        <li data-target="#carouselExampleIndicators{{$room->room_type_id}}" data-slide-to="{{$i}}"></li>
                        @endif
                        <?php $i++ ; ?>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        <?php $i=0 ; ?>
                        @foreach ($room->roomType->roomImage as $roomImage)
                        @if ($i == 0)
                        <div class="carousel-item active">
                            <p>{{$roomImage->section->name}}</p>
                            <img class="d-block w-100" src="{{ asset('storage/images/room/'.$roomImage->image) }}"
                                alt="First slide">
                        </div>
                        @else
                        <div class="carousel-item">
                            <p>{{$roomImage->section->name}}</p>
                            <img class="d-block w-100" src="{{ asset('storage/images/room/'.$roomImage->image) }}"
                                alt="First slide">
                        </div>
                        @endif
                        <?php $i++ ; ?>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators{{$room->room_type_id}}"
                        role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators{{$room->room_type_id}}"
                        role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

            </div>
        </div>
    </div>
    @endforeach
</div>


{!! Form::open(['method'=>'GET', 'route' => ['owner.kost.room_type.edit', 0], 'style' =>
'display:none','id'=>'edit_roomType']) !!}
{!! Form::close() !!}

{!! Form::open(['method'=>'POST', 'route' => ['owner.kost.request', 0], 'style' =>
'display:none','id'=>'request']) !!}
{!! Form::close() !!}

@endsection

@section('script')
<!-- slick carousel-->
<script src="{{ asset('templates/js/plugins/slick/slick.min.js') }}"></script>

<!-- blueimp gallery -->
<script src="{{ asset('templates/js/plugins/blueimp/jquery.blueimp-gallery.min.js') }}"></script>

<style>
    .slick_demo_2 .ibox-content {
        margin: 0 10px;
    }

</style>

<script>
    $(document).ready(function () {
        $('.dataTables-room').DataTable({
            pageLength: 5,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
            ],
            responsive: true,
            searchDelay: 500,
            processing: true,
            // serverSide: true,
            ajax: {
                url: "{{url('api/kost/room')}}?data=all&&id={{$kost->id}}",
                dataSrc: ''
            },
            columns: [{
                    data: 'name'
                },
                {
                    data: 'room_type'
                },
                {
                    data: 'status'
                },
            ],
            columnDefs: [ ],
        });

    });

    function editRoom(id, name, room_type_id, e_status) {
        if ($('#room-edit').is(":visible")) {
            $('#room-edit').hide('500');
        } else {
            $('#room-edit').show('500');
            $('#e_room_name').val(name);
            $('#e_room_type').val(room_type_id).change();
            if (e_status == 1) {
                $('#e_availability').prop("checked", true);
            } else {
                $('#e_availability').prop("checked", false);
            }
            $('#room-update').attr('action', "{{route('owner.kost.index')}}/" + id + "/room-update");
        }

        $('#create').hide('500');
    }

    $(document).ready(function () {
        $('.dataTables-room-type').DataTable({
            pageLength: 5,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [],
            responsive: true,
            searchDelay: 500,
            processing: true,
            // serverSide: true,
            ajax: {
                url: "{{url('api/kost/room-type')}}?data=all&&id={{$kost->id}}",
                dataSrc: ''
            },
            columns: [{
                    data: 'name'
                },
                {
                    data: 'wide'
                },
                {
                    data: 'total'
                },
            ],
            columnDefs: [],
        });

    });

    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function () {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

    $(document).ready(function () {
        $('.slick_demo_1').slick({
            dots: true
        });

        $('.slick_demo_2').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            centerMode: true,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });

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
        var mapElement1 = document.getElementById('map');

        // Create the Google Map using elements
        var map = new google.maps.Map(mapElement1, mapOptions1);


        // Variabel untuk menyimpan batas kordinat
        bounds = new google.maps.LatLngBounds();

        $.ajax({
            url: "{{url('api/kost/get-location')}}?id={{$kost->id}}",
            dataType: 'json',
            cache: false,
            dataSrc: '',

            success: function (data) {
                var latitude = data.map(function (item) {
                    return item.latitude;
                });
                var longitude = data.map(function (item) {
                    return item.longitude;
                });
                var latlng = new google.maps.LatLng(parseFloat(latitude), parseFloat(longitude));
                for (i = 0; i < data.length; i++) {
                    var pos = {
                        lat: parseFloat(latitude[i]),
                        lng: parseFloat(longitude[i])
                    };
                    var marker = new google.maps.Marker({
                        position: pos,
                        map: map,
                        title: 'Lokasi Anda',
                        icon: 'https://img.icons8.com/external-kmg-design-outline-color-kmg-design/32/000000/external-map-map-and-navigation-kmg-design-outline-color-kmg-design-3.png',
                        draggable: true,
                        animation: google.maps.Animation.DROP
                    });
                    marker.setMap(map);
                    map.setCenter(latlng);
                    // for(i=0; i<arrays.length; i++){
                    //     var data = arrays
                    //     console.log(data.properties.center['latitude']);
                    // }                   
                }
            }

        });
    }

    function editRoomType(id) {
        $('#edit_roomType').attr('action', "{{route('owner.kost.index')}}/" + id + "/room_type-edit");
        $('#edit_roomType').submit();
    }

    function request(id) {
        swal({
                title: "Apakah kamu yakin?",
                text: "Permohonan kos akan diajukan ke admin untuk dikonfirmasi",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, ajukan!",
                cancelButtonText: "Tidak, batalkan!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    swal("Dikajukan!", "Permohonan telah diajukan ke admin.", "success");
                    $('#request').attr('action', "/owner/kost/" + id + "/request");
                    $('#request').submit();
                } else {
                    swal("Batal", "Kamu batal mengajukan permohonan kos", "error");
                }
            });
    }

</script>
@endsection
