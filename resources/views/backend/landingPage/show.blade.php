@extends('layouts.landingPage.main')

@section('css')
<link href="{{ asset('templates/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link href="{{ asset('templates/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('templates/css/plugins/blueimp/css/blueimp-gallery.min.css') }}" rel="stylesheet">
<style>
    .small-chat-box {
        display: none;
        position: fixed;
        bottom: 20px;
        right: 75px;
        background: #fff;
        border: 1px solid #e7eaec;
        width: 230px;
        height: 320px;
        border-radius: 4px;
    }

    .small-chat-box.ng-small-chat {
        display: block;
    }

    .body-small .small-chat-box {
        bottom: 70px;
        right: 20px;
    }

    .small-chat-box.active {
        display: block;
    }

    .small-chat-box .heading {
        background: #2f4050;
        padding: 8px 15px;
        font-weight: bold;
        color: #fff;
    }

    .small-chat-box .chat-date {
        opacity: 0.6;
        font-size: 10px;
        font-weight: normal;
    }

    .small-chat-box .content {
        padding: 15px 15px;
    }

    .small-chat-box .content .author-name {
        font-weight: bold;
        margin-bottom: 3px;
        font-size: 11px;
    }

    .small-chat-box .content>div {
        padding-bottom: 20px;
    }

    .small-chat-box .content .chat-message {
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 11px;
        line-height: 14px;
        max-width: 80%;
        background: #f3f3f4;
        margin-bottom: 10px;
    }

    .small-chat-box .content .chat-message.active {
        background: #1ab394;
        color: #fff;
    }

    .small-chat-box .content .left {
        text-align: left;
        clear: both;
    }

    .small-chat-box .content .left .chat-message {
        float: left;
    }

    .small-chat-box .content .right {
        text-align: right;
        clear: both;
    }

    .small-chat-box .content .right .chat-message {
        float: right;
    }

    .small-chat-box .form-chat {
        padding: 10px 10px;
    }

</style>
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
                                            <img style="max-height: 250px;" class="img-responsive" alt=""
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
                                @if ($roomType->kost->type->id == 1)
                                <span class="badge badge-success"
                                    style="background-color:blue;">{{$roomType->kost->type->name}}</span>
                                @elseif ($roomType->kost->type->id == 2)
                                <span class="badge badge-danger"
                                    style="background-color:red;">{{$roomType->kost->type->name}}</span>
                                @else
                                <span class="badge badge-warning"
                                    style="background-color:green;">{{$roomType->kost->type->name}}</span>
                                @endif
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
                                        <div class="col-lg-12">
                                            <div class="pull-left">
                                                <div class="stock-box">
                                                    <span class="label"><i class="fa fa-map-marker"
                                                            aria-hidden="true"></i> {{$roomType->kost->address}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="pull-left">
                                                <div class="stock-box">
                                                    <span class="label">Berdiri pada tahun {{$roomType->kost->exist}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div><!-- /.stock-container -->

                                <div class="stock-container info-container m-t-10">
                                    <div class="row">
                                        @if ($roomType->kost->manager_name != NULL)
                                            <div class="col-lg-12">
                                                <div class="pull-left">
                                                    <div class="stock-box">
                                                        <span class="label">Manajer Kost : </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-lg-12">
                                            <div class="pull-left">
                                                <div class="stock-box">
                                                    <span class="label"><b>{{$roomType->kost->manager_name}} - </b></span>
                                                    <span class="label"><b>{{$roomType->kost->manager_handphone}}</b></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="pull-left">
                                                <div class="stock-box">
                                                    <span class="label">Pemilik : </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="pull-left">
                                                <div class="stock-box">
                                                    <span class="label"><b>{{$roomType->kost->kostOwner->first_name}} {{$roomType->kost->kostOwner->last_name}} -</b> </span>
                                                    <span class="label"><b> {{$roomType->kost->kostOwner->handphone}} </b></span>
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
                                                @if (Auth::user())
                                                    <a class="btn btn-primary open-small-chat" data-toggle="tooltip" data-placement="right"
                                                        title="Kirim pesan" href="#">
                                                        <i class="fa fa-comments"></i>
                                                    </a>
                                                @else
                                                    <a class="btn btn-primary login-notification" data-toggle="tooltip" data-placement="right"
                                                        title="Kirim pesan" href="#">
                                                        <i class="fa fa-comments"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>

                                    </div><!-- /.row -->
                                </div><!-- /.price-container -->

                                <div class="quantity-container info-container">
                                    <div class="row">

                                        <div class="add-btn">
                                            @if (Auth::user())
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#bookingModal"><i
                                                    class="fa fa-shopping-cart inner-right-vs"></i> Sewa</button>
                                            @else
                                                <button type="button" class="btn btn-primary login-notification"><i
                                                    class="fa fa-shopping-cart inner-right-vs"></i> Sewa</button>
                                            @endif
                                            
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
                                <li><a data-toggle="tab" href="#image">GALERI</a></li>
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
                                                href="#" style="margin:2px;">
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
                                                href="#" style="margin:2px;">
                                                {{$kostFacilityDetail->facility->name}}
                                            </a>
                                            @endif
                                            @endforeach
                                            @foreach ($roomType->roomFacilityDetail as $roomFacilityDetail)
                                            <a class="button btn btn-primary" data-toggle="tooltip"
                                                data-placement="right" title="{{$roomFacilityDetail->facility->name}}"
                                                href="#" style="margin:2px;">
                                                {{$roomFacilityDetail->facility->name}}
                                            </a>
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
                                                <i class="fa fa-location"></i> UNAND
                                            </a>
                                            <a class="button btn btn-primary" data-toggle="tooltip"
                                                data-placement="right" title="Add to Compare" href="#">
                                                <i class="fa fa-location"></i> UNP
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

                                <div id="image" class="tab-pane">
                                    <div class="product-tag">
                                        <div class="lightBoxGallery">
                                            <h3>Foto bangunan dari depan</h3>
                                            @foreach ($roomType->kost->sectionImage(1) as $image)
                                            <a href="{{ asset('storage/images/kost/'.$image->image) }}"
                                                title="Image from Unsplash" data-gallery=""><img
                                                    style="width: 100px; height:100px;"
                                                    src="{{ asset('storage/images/kost/'.$image->image) }}"></a>
                                            @endforeach
                                            <h3>Foto bagian dalam bangunan</h3>
                                            @foreach ($roomType->kost->sectionImage(2) as $image)
                                            <a href="{{ asset('storage/images/kost/'.$image->image) }}"
                                                title="Image from Unsplash" data-gallery=""><img
                                                    style="width: 100px; height:100px;"
                                                    src="{{ asset('storage/images/kost/'.$image->image) }}"></a>
                                            @endforeach
                                            <h3>Foto bangunan dari jalan</h3>
                                            @foreach ($roomType->kost->sectionImage(3) as $image)
                                            <a href="{{ asset('storage/images/kost/'.$image->image) }}"
                                                title="Image from Unsplash" data-gallery=""><img
                                                    style="width: 100px; height:100px;"
                                                    src="{{ asset('storage/images/kost/'.$image->image) }}"></a>
                                            @endforeach
                                            <h3>Foto bagian depan kamar</h3>
                                            @foreach ($roomType->sectionImage(4) as $image)
                                            <a href="{{ asset('storage/images/room/'.$image->image) }}"
                                                title="Image from Unsplash" data-gallery=""><img
                                                    style="width: 100px; height:100px;"
                                                    src="{{ asset('storage/images/room/'.$image->image) }}"></a>
                                            @endforeach
                                            <h3>Foto bagian dalam kamar</h3>
                                            @foreach ($roomType->sectionImage(5) as $image)
                                            <a href="{{ asset('storage/images/room/'.$image->image) }}"
                                                title="Image from Unsplash" data-gallery=""><img
                                                    style="width: 100px; height:100px;"
                                                    src="{{ asset('storage/images/room/'.$image->image) }}"></a>
                                            @endforeach
                                            <h3>Foto kamar mandi</h3>
                                            @foreach ($roomType->sectionImage(6) as $image)
                                            <a href="{{ asset('storage/images/room/'.$image->image) }}"
                                                title="Image from Unsplash" data-gallery=""><img
                                                    style="width: 100px; height:100px;"
                                                    src="{{ asset('storage/images/room/'.$image->image) }}"></a>
                                            @endforeach
                                            <h3>Foto tambahan</h3>
                                            @foreach ($roomType->sectionImage(7) as $image)
                                            <a href="{{ asset('storage/images/room/'.$image->image) }}"
                                                title="Image from Unsplash" data-gallery=""><img
                                                    style="width: 100px; height:100px;"
                                                    src="{{ asset('storage/images/room/'.$image->image) }}"></a>
                                            @endforeach

                                            <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
                                            <div id="blueimp-gallery" class="blueimp-gallery">
                                                <div class="slides"></div>
                                                <h3 class="title"></h3>
                                                <a class="prev">‹</a>
                                                <a class="next">›</a>
                                                <a class="close">×</a>
                                                <a class="play-pause"></a>
                                                <ol class="indicator"></ol>
                                            </div>

                                        </div>
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
@if (Auth::user())
<div class="small-chat-box fadeInRight animated">

    <div class="heading" draggable="true">
        <small class="chat-date float-right">
            {{Carbon\Carbon::today()->format('d M Y')}}
        </small>
        {{$roomType->kost->kostOwner->first_name}} {{$roomType->kost->kostOwner->last_name}}
    </div>

    <div class="content" id="chat-content">
        @if ($chat)
            @foreach ($chat->chatDetail as $chatDetail)
                @if($chatDetail->sender == Auth::user()->kostSeeker->id)
                    <div class="right">
                        <div class="author-name">
                            {{$chatDetail->kostSeeker->first_name}} {{$chatDetail->kostSeeker->last_name}}
                            <br>
                            <small class="chat-date">
                                {{$chatDetail->created_at->format('d M Y h.i A')}}
                            </small>
                        </div>
                        <div class="chat-message active">
                            {{$chatDetail->message}} 
                        </div>
                    </div>
                @elseif($chatDetail->sender != Auth::user()->kostSeeker->id)
                    <div class="left">
                        <div class="author-name">
                            {{$chat->kostOwner->first_name}} {{$chat->kostOwner->last_name}}
                            <br>
                            <small class="chat-date">
                                {{$chatDetail->created_at->format('d M Y h.i A')}}
                            </small>
                        </div>
                        <div class="chat-message">
                            {{$chatDetail->message}}
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
    <div class="form-chat">
        <div class="input-group input-group-sm"><input type="text" id="send-message" class="form-control"> <span class="input-group-btn">
                <button class="btn btn-primary" type="button" onclick="sendMessage({{Auth::user()->kostSeeker->id}}, {{$roomType->kost->kostOwner->id}}, {{$roomType->kost->id}}, {{Auth::user()->isCustomer()}})">Send
                </button> </span>
        </div>
    </div>
    

</div>
@endif

@endsection

@section('script')
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<!-- Data picker -->
<script src="{{ asset('templates/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('templates/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
<script src="{{ asset('templates/js/plugins/blueimp/jquery.blueimp-gallery.min.js') }}"></script>
<script src="{{ asset('templates/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('templates/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>

<script>
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
    
    function sendMessage(kostSeeker, kostOwner, kost, status) {
        let message = $('#send-message').val();
        console.log(kostSeeker);
        console.log(kostOwner);
        console.log(kost);

        let base_url = "{{URL('api/message/send_message')}}";
        $.ajax({
            
            url: base_url + "?kostSeeker=" + kostSeeker + "&kostOwner=" + kostOwner + "&kost=" + kost +  "&message=" + message + "&status=" + status,
            dataType: 'json',
            cache: false,
            dataSrc: '',
            success: function (data) {
                var div = $(`<div class="right">
                    <div class="author-name">
                        `+ data.name +`
                        <br>
                        <small class="chat-date">
                            `+ data.created_at +`
                        </small>
                    </div>
                    <div class="chat-message active">
                        `+ data.message +`
                    </div>
                </div>`);

                $('#chat-content').append(div);
                $('#send-message').value = '';

                $('#chat-content').scrollTop($('#chat-content')[0].scrollHeight);
            }
        });
    }

    // Open close small chat
    $('.open-small-chat').on('click', function (e) {
        e.preventDefault();
        $(this).children().toggleClass('fa-comments').toggleClass('fa-times');
        $('.small-chat-box').toggleClass('active');
        $('#chat-content').scrollTop($('#chat-content')[0].scrollHeight);
    });

    $('.login-notification').on('click', function (e) {
        toastr.options = {
            "closeButton": true,
            "debug": true,
            "progressBar": true,
            "preventDuplicates": true,
            "positionClass": "toast-top-right",
            "showDuration": "400",
            "hideDuration": "1000",
            "timeOut": "7000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        toastr.warning("Silahkan login terlebih dahulu");
    });

    // Initialize slimscroll for small chat
    $('.small-chat-box .content').slimScroll({
        height: '234px',
        railOpacity: 0.4
    });


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

</script>
@endsection
