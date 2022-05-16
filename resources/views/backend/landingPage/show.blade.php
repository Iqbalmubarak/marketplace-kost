@extends('layouts.landingPage.main')

@section('css')
<link href="{{ asset('templates/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link href="{{ asset('templates/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdGrzi3vv43yyxfcFiBRoGVqvtZcJ2lIM"></script>
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
            <div class='col-xs-12 col-sm-12 col-md-3 sidebar'>
                <div class="sidebar-module-container">
                    <div class="home-banner outer-top-n outer-bottom-xs">
                        <img src="{{ asset('templateLandings/assets/images/banners/LHS-banner.jpg') }}" alt="Image">
                    </div>
                </div>
            </div><!-- /.sidebar -->
            <div class='col-xs-12 col-sm-12 col-md-9 rht-col'>
                <div class="detail-block">
                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 gallery-holder">
                            <div class="product-item-holder size-big single-product-gallery small-gallery">

                                <div id="owl-single-product">
                                    @foreach ($roomType->roomImage as $roomImage)
                                    <div class="single-product-gallery-item" id="slide{{$loop->iteration}}">
                                        <a data-lightbox="image-1" data-title="Gallery"
                                            href="{{ asset('storage/images/room/'.$roomImage->image) }}">
                                            <img class="img-responsive" alt=""
                                                src="{{ asset('templateLandings/assets/images/blank.gif') }}"
                                                data-echo="{{ asset('storage/images/room/'.$roomImage->image) }}" />
                                        </a>
                                    </div><!-- /.single-product-gallery-item -->
                                    @endforeach
                                </div><!-- /.single-product-slider -->


                                <div class="single-product-gallery-thumbs gallery-thumbs">

                                    <div id="owl-single-product-thumbnails">
                                        @foreach ($roomType->roomImage as $roomImage)
                                        <div class="item">
                                            <a class="horizontal-thumb active" data-target="#owl-single-product"
                                                data-slide="1" href="#slide{{$loop->iteration}}">
                                                <img class="img-responsive" alt=""
                                                    src="{{ asset('templateLandings/assets/images/blank.gif') }}"
                                                    data-echo="{{ asset('storage/images/room/'.$roomImage->image) }}" />
                                            </a>
                                        </div>
                                        @endforeach
                                    </div><!-- /#owl-single-product-thumbnails -->
                                </div><!-- /.gallery-thumbs -->

                            </div><!-- /.single-product-gallery -->
                        </div><!-- /.gallery-holder -->
                        <div class='col-sm-12 col-md-8 col-lg-8 product-info-block'>
                            <div class="product-info">
                                <h1 class="name">{{$roomType->name}} &diams; {{$roomType->kost->name}}</h1>

                                <div class="stock-container info-container m-t-10">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="pull-left">
                                                <div class="stock-box">
                                                    <span class="label">Availability :</span>
                                                </div>
                                            </div>
                                            <div class="pull-left">
                                                <div class="stock-box">
                                                    <span class="value">Sisa {{$roomType->roomLeft()}} Kamar</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div><!-- /.stock-container -->

                                <div class="description-container m-t-20">
                                    <?php echo nl2br(htmlspecialchars($roomType->kost->note)); ?>
                                </div><!-- /.description-container -->

                                <div class="price-container info-container m-t-30">
                                    <div class="row">


                                        <div class="col-sm-6 col-xs-6">
                                            <div class="price-box">
                                                <span class="price">{{Helper::rupiah($roomType->month()->price)}}</span>
                                                <span class="product-price"> Per Bulan</span>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-xs-6">
                                            <div class="favorite-button m-t-5">
                                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                                    title="Wishlist" href="#">
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                                    title="Add to Compare" href="#">
                                                    <i class="fa fa-signal"></i>
                                                </a>
                                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                                    title="E-mail" href="#">
                                                    <i class="fa fa-envelope"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div><!-- /.row -->
                                </div><!-- /.price-container -->

                                <div class="quantity-container info-container">
                                    <div class="row">>

                                        <div class="add-btn">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bookingModal"><i
                                                    class="fa fa-shopping-cart inner-right-vs"></i> Sewa</button>
                                        </div>

                                        
                                    </div><!-- /.row -->
                                </div><!-- /.quantity-container -->

                                @include('backend.kostSeeker.commerce.create')
                            </div><!-- /.product-info -->
                        </div><!-- /.col-sm-7 -->
                    </div><!-- /.row -->
                </div>

                <div class="product-tabs inner-bottom-xs">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                <li class="active"><a data-toggle="tab" href="#description">FASILITAS</a></li>
                                <li><a data-toggle="tab" href="#review">LOKASI</a></li>
                                <li><a data-toggle="tab" href="#tags">PERATURAN</a></li>
                            </ul><!-- /.nav-tabs #product-tabs -->
                        </div>
                        <div class="col-sm-12 col-md-9 col-lg-9">

                            <div class="tab-content">

                                <div id="description" class="tab-pane in active">
                                    <div class="product-tab">
                                        <p class="text">
                                            <h4>Fasilitas Umum :</h4><br>
                                            @foreach ($roomType->kost->kostFacilityDetail as $kostFacilityDetail)
                                            @if ($kostFacilityDetail->facility->type->id == 1)
                                            <a class="button btn btn-primary" data-toggle="tooltip"
                                                data-placement="right" title="{{$kostFacilityDetail->facility->name}}"
                                                href="#">
                                                {{$kostFacilityDetail->facility->name}}
                                            </a>
                                            @endif
                                            @endforeach
                                            <br><br>
                                            <h4>Fasilitas Lainnya :</h4><br>
                                            @foreach ($roomType->kost->kostFacilityDetail as $kostFacilityDetail)
                                            @if ($kostFacilityDetail->facility->type->id != 1)
                                            <a class="button btn btn-primary" data-toggle="tooltip"
                                                data-placement="right" title="{{$kostFacilityDetail->facility->name}}"
                                                href="#">
                                                {{$kostFacilityDetail->facility->name}}
                                            </a>
                                            @endif
                                            @endforeach
                                            <br><br>
                                        </p>
                                    </div>
                                </div><!-- /.tab-pane -->

                                <div id="review" class="tab-pane">
                                    <div class="product-tab">

                                        <div class="product-reviews">

                                            <div class="reviews">




                                            </div><!-- /.reviews -->
                                        </div><!-- /.product-reviews -->



                                        <div class="product-add-review"><br>
                                            <h4 class="title">Berdekatan dengan :</h4>
                                            <a class="button btn btn-primary" data-toggle="tooltip"
                                                data-placement="right" title="Add to Compare" href="#">
                                                <i class="fa fa-location"></i> UNP
                                            </a>
                                            <a class="button btn btn-primary" data-toggle="tooltip"
                                                data-placement="right" title="Add to Compare" href="#">
                                                <i class="fa fa-location"></i> ByPass
                                            </a>
                                            <a class="button btn btn-primary" data-toggle="tooltip"
                                                data-placement="right" title="Add to Compare" href="#">
                                                <i class="fa fa-location"></i> Budiman Bypass
                                            </a>
                                            <a class="button btn btn-primary" data-toggle="tooltip"
                                                data-placement="right" title="Add to Compare" href="#">
                                                <i class="fa fa-location"></i> SMK 10 Padang
                                            </a>
                                            <br><br>
                                            <h4 class="title">Peta lokasi :</h4>
                                            <div class="review-table">
                                                <div style="width: 100%" class="google-map" id="map"></div>
                                            </div><!-- /.review-table -->


                                        </div><!-- /.product-add-review -->

                                    </div><!-- /.product-tab -->
                                </div><!-- /.tab-pane -->

                                <div id="tags" class="tab-pane">
                                    <div class="product-tag">

                                        <h3>Peraturan Kos</h3>
                                        <ol>
                                            @foreach ($roomType->kost->rule_detail as $rule_detail)
                                            <li>{{$rule_detail->rule->name}}</li>
                                            @endforeach
                                            <br>
                                            @if ($roomType->kost->rule_upload)
                                            <img id="myImg"
                                                src="{{ asset('storage/images/rule/'.$roomType->kost->rule_upload->image) }}"
                                                alt="Snow" style="width:100%;max-width:100%">
                                            @else
                                            <img id="myImg" src="{{ asset('templates/img/input_image.png') }}"
                                                alt="Snow" style="width:100%;max-width:100%">
                                            @endif
                                        </ol>
                                    </div><!-- /.product-tab -->
                                </div><!-- /.tab-pane -->

                            </div><!-- /.tab-content -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.product-tabs -->

                <!-- ============================================== UPSELL PRODUCTS ============================================== -->
                <section class="section new-arriavls">
                    <h4 class="section-title">Tipe Kamar Lainnya </h4>

                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                        @foreach ($others as $other)
                        <div class="item item-carousel">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image">
                                            <a href="{{ route('landingPage.show', $other->id) }}">
                                                @foreach ($other->image() as $image)
                                                @if($loop->iteration == 1)
                                                <img src="{{ asset('storage/images/room/'.$image->image) }}" alt="">
                                                @elseif($loop->iteration == 2)
                                                <img src="{{ asset('storage/images/room/'.$image->image) }}" alt=""
                                                    class="hover-image">
                                                @endif
                                                @endforeach
                                            </a>
                                        </div>
                                    </div>
                                    <!-- /.product-image -->

                                    <div class="product-info text-left">
                                        <h3 class="name"><a
                                                href="{{ route('landingPage.show', $other->id) }}">{{$other->name}}
                                                &diams;{{$other->kost->name}}</a></h3>
                                        @if ($other->kost->type->id == 1)
                                        <span class="badge badge-success">{{$other->kost->type->name}}</span>
                                        @elseif ($other->kost->type->id == 2)
                                        <span class="badge badge-danger">{{$other->kost->type->name}}</span>
                                        @else
                                        <span class="badge badge-warning">{{$other->kost->type->name}}</span>
                                        @endif
                                        <div class="description"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            {{$other->kost->address}}</div>
                                        <div class="description" style="font-style: italic; color: red;">Sisa
                                            {{$other->roomLeft()}} Kamar</div><br>
                                        <div class="product-price"> <span class="price">
                                                {{Helper::rupiah($other->month()->price)}}
                                            </span> <span class="product-info">Per Bulan</span> </div>
                                        <!-- /.product-price -->

                                    </div>
                                    <!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">

                                        </div>
                                        <!-- /.action -->
                                    </div>
                                    <!-- /.cart -->
                                </div>
                                <!-- /.product -->

                            </div>
                            <!-- /.products -->
                        </div>
                        @endforeach


                    </div>
                    <!-- /.home-owl-carousel -->
                </section><!-- /.section -->
                <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

            </div><!-- /.col -->
            <div class="clearfix"></div>
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.body-content -->
@endsection

@section('script')
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js">
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
            url: "{{url('api/kost/get-location')}}?id={{$roomType->kost->id}}",
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
    

</script>
@endsection
