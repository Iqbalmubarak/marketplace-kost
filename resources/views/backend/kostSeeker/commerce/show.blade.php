@extends('layouts.kostSeeker.main')

@section('css')
<link href="{{ asset('templates/css/plugins/slick/slick.css') }}" rel="stylesheet">
<link href="{{ asset('templates/css/plugins/slick/slick-theme.css') }}" rel="stylesheet">
<link href="{{ asset('templates/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-hsd_bZKO7trRc-pi"></script>
<link href="{{ asset('templates/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
<style>
    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {
        opacity: 0.7;
    }

    /* The Modal (background) */
    .modalImg {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.9);
        /* Black w/ opacity */
    }

    /* Modal Content (Image) */
    .modalImg-content {
        margin: auto;
        display: block;
        width: 100%;
        max-width: 1000px;
    }

    /* Caption of Modal Image (Image Text) - Same Width as the Image */
    #captionImg {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation - Zoom in the Modal */
    .modalImg-content,
    #captionImg {
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    /* The Close Button */
    .closeImg {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .closeImg:hover,
    .closeImg:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px) {
        .modalImg-content {
            width: 100%;
        }
    }

</style>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox product-detail">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-5">
                        <div class="product-images">
                            @foreach ($roomType->roomImage as $roomImage)
                            <div>
                                <img alt="image" class="img-fluid"
                                    src="{{ asset('storage/images/room/'.$roomImage->image) }}">
                            </div>
                            @endforeach
                            @foreach ($roomType->kost->kostImage as $kostImage)
                            <div>
                                <img alt="image" class="img-fluid"
                                    src="{{ asset('storage/images/kost/'.$kostImage->image) }}">
                            </div>
                            @endforeach
                        </div>
                        <div class="google-map" id="map" style="height:250px"></div>
                    </div>
                    <div class="col-md-7">
                        <h2 class="font-bold m-b-xs">
                            {{$roomType->kost->name}}&nbsp;
                            @if ($roomType->kost->type->id == 1)
                            <span class="badge badge-success">{{$roomType->kost->type->name}}</span>
                            @elseif ($roomType->kost->type->id == 2)
                            <span class="badge badge-danger">{{$roomType->kost->type->name}}</span>
                            @else
                            <span class="badge badge-warning">{{$roomType->kost->type->name}}</span>
                            @endif
                        </h2>
                        <small>{{$roomType->name}}</small>
                        <hr>
                        <div>
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                data-target="#bookingModal">
                                Pesan kamar
                            </button>
                            <!-- <button type="button" class="btn btn-primary float-right" id="pay-button">
                                Pay
                            </button> -->
                            @include('backend.kostSeeker.commerce.create')
                            <h1 class="product-main-price">{{ Helper::rupiah($roomType->month()->price) }} <small
                                    class="text-muted">{{$roomType->month()->rentDuration->name}}</small>
                            </h1>
                        </div>
                        <hr>
                        <h4>Deskripsi kos</h4>

                        <div class="small text-muted">
                            @if ($roomType->kost->note)
                            <?php echo nl2br(htmlspecialchars($roomType->kost->note)); ?>
                            @else
                            Belum ada deskripsi kos
                            @endif
                        </div>
                        <dl class="row m-t-md small">
                            <dt class="col-md-4 text-right">Luas kamar</dt>
                            <dd class="col-md-8">{{$roomType->lenght}} x {{$roomType->wide}}</dd>
                            <dt class="col-md-4 text-right">Kapasitas kamar</dt>
                            <dd class="col-md-8">{{$roomType->capacity}} orang</dd>
                            <dt class="col-md-4 text-right">Fasilitas kos</dt>
                            <dd class="col-md-8">
                                <div class="row">
                                    @foreach ($roomType->kost->kostFacilityDetail as $kostFacilityDetail)
                                    <div class="col-lg-6">
                                        @if ($kostFacilityDetail->facility->icon)
                                        <div class="row">
                                            <div class="col-lg-1">
                                                <abbr title="{{$kostFacilityDetail->facility->name}}"><i
                                                        class="{{$kostFacilityDetail->facility->icon}}"></i> </abbr>
                                            </div>
                                            <div class="col-lg-10">
                                                {{$kostFacilityDetail->facility->name}}
                                            </div>
                                        </div>
                                        @else
                                        <div class="row">
                                            <div class="col-lg-1">
                                                <abbr title="{{$kostFacilityDetail->facility->name}}"><i
                                                        class="fa fa-question"></i></abbr>
                                            </div>
                                            <div class="col-lg-10">
                                                {{$kostFacilityDetail->facility->name}}
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </dd>
                            <dt class="col-md-4 text-right">Fasilitas kamar</dt>
                            <dd class="col-md-8">
                                <div class="row">
                                    @foreach ($roomType->roomFacilityDetail as $roomFacilityDetail)
                                    <div class="col-lg-6">
                                        @if ($roomFacilityDetail->facility->icon)
                                        <div class="row">
                                            <div class="col-lg-1">
                                                <abbr title="{{$roomFacilityDetail->facility->name}}"><i
                                                        class="{{$roomFacilityDetail->facility->icon}}"></i> </abbr>
                                            </div>
                                            <div class="col-lg-10">
                                                {{$roomFacilityDetail->facility->name}}
                                            </div>
                                        </div>
                                        @else
                                        <div class="row">
                                            <div class="col-lg-1">
                                                <abbr title="{{$roomFacilityDetail->facility->name}}"><i
                                                        class="fa fa-question"></i></abbr>
                                            </div>
                                            <div class="col-lg-10">
                                                {{$roomFacilityDetail->facility->name}}
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </dd>
                            <dt class="col-md-4 text-right">Peraturan kos</dt>
                            <dd class="col-md-8">
                                <div class="row">
                                    <div class="col-lg-6">
                                        @foreach ($roomType->kost->rule_detail as $rule_detail)
                                        <i class="fa fa-check"> {{$rule_detail->rule->name}}</i><br>
                                        @endforeach
                                    </div>
                                    <div class="col-lg-6">
                                        @if ($roomType->kost->rule_upload)
                                        <img id="myImg"
                                            src="{{ asset('storage/images/rule/'.$roomType->kost->rule_upload->image) }}"
                                            alt="Snow" style="width:100%;max-width:100px">
                                        @else
                                        <img id="myImg" src="{{ asset('templates/img/input_image.png') }}" alt="Snow"
                                            style="width:100%;max-width:100px">
                                        @endif

                                        <!-- The Modal -->
                                        <div id="myModal" class="modalImg">

                                            <!-- The Close Button -->
                                            <span class="closeImg">&times;</span>

                                            <!-- Modal Content (The Image) -->
                                            <img class="modalImg-content" id="img01">

                                            <!-- Modal Caption (Image Text) -->
                                            <div id="captionImg"></div>
                                        </div>
                                    </div>
                                </div>
                            </dd>
                        </dl>
                        <div class="text-right">
                            <div class="btn-group">
                                <button class="btn btn-white btn-sm"><i class="fa fa-star"></i> Add to wishlist
                                </button>
                                <button class="btn btn-white btn-sm"><i class="fa fa-envelope"></i> Contact with
                                    author </button>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
            <div class="ibox-footer">
                <span class="float-right">
                    Full stock - <i class="fa fa-clock-o"></i> 14.04.2016 10:04 pm
                </span>
                The generated Lorem Ipsum is therefore always free
            </div>
        </div>

    </div>
</div>
@endsection

@section('script')
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js">
</script>
<script src="{{ asset('templates/js/plugins/slick/slick.min.js') }}"></script>
<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdGrzi3vv43yyxfcFiBRoGVqvtZcJ2lIM"></script>
<!-- Data picker -->
<script src="{{ asset('templates/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('templates/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
<script>
    function fileValidation() {
        var fileInput = document.getElementById('payment');
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

    $('#c_start').prop("disabled", true);
    $('#c_start').datepicker({
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true
    });
    $('#c_duration').on('change', function (e) {
        durationPrice();
        rentRange();
    });

    $('#c_start').on('change', function (e) {
        rentRange();
    });

    function durationPrice() {
        let duration_price = $('#c_duration').val();
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
                var price_list_id = data.id;
                total_price = total_price + price;

                total_price = String(total_price);
                var convert = convertRupiah(total_price, "Rp. ");
                $('#c_total_price').val(convert);
                $('#c_price_list_id').val(price_list_id);
                $('#c_start').prop("disabled", false);
            }
        });
    }

    function rentRange() {
        let duration = $('#c_duration').val();
        let start = $('#c_start').val();
        let base_url = "{{URL('api/select/rentRange')}}";
        $.ajax({
            url: base_url + "/" + duration + "?start=" + start,
            dataType: 'json',
            cache: false,
            dataSrc: '',

            success: function (data) {
                $('#c_end').val(data);
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


    $(document).ready(function () {
        $('.product-images').slick({
            dots: true
        });
    });

    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("captionImg");
    img.onclick = function () {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("closeImg")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

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

    }

</script>
@endsection
