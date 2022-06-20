@extends('layouts.landingPage.main')

@section('content')
<script src="http://maps.googleapis.com/maps/api/js"></script>
<!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row'>
            <div class='col-xs-12 col-sm-12 col-md-3 sidebar'>
                <!-- ================================== TOP NAVIGATION ================================== -->

                <!-- /.side-menu -->
                <!-- ================================== TOP NAVIGATION : END ================================== -->
                <div class="sidebar-module-container">
                    <div class="sidebar-filter">
                        <!-- ============================================== SIDEBAR CATEGORY ============================================== -->
                        <div class="sidebar-widget">
                            <h3 class="section-title">Shop by</h3>
                            <div class="widget-header">
                                <h4 class="widget-title">Category</h4>
                            </div>
                            <div class="sidebar-widget-body">
                                <div class="accordion">
                                    <div class="accordion-group">
                                        <div class="accordion-heading"> <a href="#collapseOne" data-toggle="collapse"
                                                class="accordion-toggle collapsed"> Tipe kos </a> </div>
                                        <!-- /.accordion-heading -->
                                        <div class="accordion-body collapse" id="collapseOne" style="height: 0px;">
                                            <div class="accordion-inner">
                                                <ul>
                                                    <li><a
                                                            href="{{ route('landingPage.sortType') }}?type=putra">Putra</a>
                                                    </li>
                                                    <li><a
                                                            href="{{ route('landingPage.sortType') }}?type=putri">Putri</a>
                                                    </li>
                                                    <li><a
                                                            href="{{ route('landingPage.sortType') }}?type=campur">Campur</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- /.accordion-inner -->
                                        </div>
                                        <!-- /.accordion-body -->
                                    </div>
                                    <!-- /.accordion-group -->

                                    <div class="accordion-group">
                                        <div class="accordion-heading"> <a href="#collapseTwo" data-toggle="collapse"
                                                class="accordion-toggle collapsed"> Kampus terdekat </a> </div>
                                        <!-- /.accordion-heading -->
                                        <div class="accordion-body collapse" id="collapseTwo" style="height: 0px;">
                                            <div class="accordion-inner">
                                                <ul>
                                                    <li><a
                                                            href="{{ route('landingPage.sortAround') }}?latitude= -0.914518 & longitude=100.459526">Universitas
                                                            Andalas</a></li>
                                                    <li><a
                                                            href="{{ route('landingPage.sortAround') }}?latitude= -0.8969444444444444 & longitude=100.35027777777778">Universitas
                                                            Negeri Padang</a></li>
                                                    <li><a
                                                            href="{{ route('landingPage.sortAround') }}?latitude= -0.9574999999999999 & longitude=100.39555555555556">Universitas
                                                            Putra Indonesia</a></li>
                                                    <li><a
                                                            href="{{ route('landingPage.sortAround') }}?latitude= -0.87 & longitude=100.38333333333334">Universitas
                                                            Baiturrahmah </a></li>
                                                    <li><a
                                                            href="{{ route('landingPage.sortAround') }}?latitude= -0.9444444444444444 & longitude=100.37555555555555">Universitas
                                                            Dharma Andalas </a></li>
                                                    <li><a
                                                            href="{{ route('landingPage.sortAround') }}?latitude= -0.9097222222222222 & longitude=100.36722222222221">Universitas
                                                            PGRI </a></li>
                                                    <li><a
                                                            href="{{ route('landingPage.sortAround') }}?latitude= -0.9302777777777778 & longitude=100.3863888888889">Universitas
                                                            Islam Negeri Imam Bonjol</a></li>
                                                    <li><a
                                                            href="{{ route('landingPage.sortAround') }}?latitude= -0.8555555555555555 & longitude=100.33277777777778">Universitas
                                                            Muhammadiyah</a></li>
                                                    <li><a
                                                            href="{{ route('landingPage.sortAround') }}?latitude= -0.9144444444444445 & longitude=100.46611111111112">Politeknik
                                                            Negeri Padang</a></li>
                                                    <li><a
                                                            href="{{ route('landingPage.sortAround') }}?latitude= -0.8694444444444445 & longitude=100.37888888888888">Institut
                                                            Teknologi Padang</a></li>
                                                </ul>
                                            </div>
                                            <!-- /.accordion-inner -->
                                        </div>
                                        <!-- /.accordion-body -->
                                    </div>
                                    <!-- /.accordion-group -->

                                </div>
                                <!-- /.accordion -->
                            </div>
                            <!-- /.sidebar-widget-body -->
                        </div>
                        <!-- /.sidebar-widget -->
                        <!-- ============================================== SIDEBAR CATEGORY : END ============================================== -->

                        <!-- ============================================== PRICE SILDER============================================== -->
                        <div class="sidebar-widget">
                            <div class="widget-header">
                                <h4 class="widget-title">Rentangan harga</h4>
                            </div>
                            <div class="sidebar-widget-body m-t-10">
                                <div class="price-range-holder"> <span class="min-max"> <span class="pull-left">Rp.
                                            100.000,00</span> <span class="pull-right">Rp. 2.000.000,00</span>
                                    </span>
                                    <input type="text" id="amount"
                                        style="border:0; color:#666666; font-weight:bold;text-align:center;">
                                    <input type="text" class="price-slider" value="" id="priceRange">
                                </div>
                                <!-- /.price-range-holder -->
                                <a href="#" class="lnk btn btn-primary" id="sortPrice">Tampilkan</a>
                            </div>
                            <!-- /.sidebar-widget-body -->
                        </div>
                        <!-- /.sidebar-widget -->
                        <!-- ============================================== PRICE SILDER : END ============================================== -->
                        
                        <!-- ============================================== COLOR: END ============================================== -->
                       
                        <!-- ============================================== COMPARE: END ============================================== -->
                        <!-- ============================================== PRODUCT TAGS ============================================== -->
                        <div class="sidebar-widget product-tag outer-top-vs">
                            <h3 class="section-title">Product tags</h3>
                            <div class="sidebar-widget-body outer-top-xs">
                                <div class="tag-list">
                                    <span class="item" title="Phone" href="category.html"><input type="checkbox" value="1">Phone</span>
                                    <a class="item active" title="Vest" href="category.html">Vest</a> <a class="item"
                                        title="Smartphone" href="category.html">Smartphone</a> <a class="item"
                                        title="Furniture" href="category.html">Furniture</a> <a class="item"
                                        title="T-shirt" href="category.html">T-shirt</a> <a class="item"
                                        title="Sweatpants" href="category.html">Sweatpants</a> <a class="item"
                                        title="Sneaker" href="category.html">Sneaker</a> <a class="item" title="Toys"
                                        href="category.html">Toys</a> <a class="item" title="Rose"
                                        href="category.html">Rose</a> </div>
                                <!-- /.tag-list -->
                            </div>
                            <!-- /.sidebar-widget-body -->
                        </div>
                        <!-- /.sidebar-widget -->
                       
                        <!-- ============================================== Testimonials: END ============================================== -->

                        <!-- ============================================== NEWSLETTER ============================================== -->
                       
                        <!-- /.sidebar-widget -->
                        <!-- ============================================== NEWSLETTER: END ============================================== -->


                    </div>
                    <!-- /.sidebar-filter -->
                </div>
                <!-- /.sidebar-module-container -->
            </div>
            <!-- /.sidebar -->
            <div class="col-xs-12 col-sm-12 col-md-9 rht-col">
                <!-- ========================================== SECTION – HERO ========================================= -->

                <div id="category" class="category-carousel hidden-xs">
                    <div class="item">
                        <div class="image"> <img
                                src="{{ asset('templateLandings/assets/images/banners/cat-banner-1.jpg') }}" alt=""
                                class="img-responsive"> </div>
                        <div class="container-fluid">
                            <div class="caption vertical-top text-left">
                                <div class="big-text">KOSANKU </div>
                                <div class="excerpt-normal hidden-sm hidden-md"> Cari kos sesuai kebutuhan anda disini! </div>
                            </div>
                            <!-- /.caption -->
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                </div>


                <div class="clearfix filters-container m-t-10">
                    <div class="row">
                        <div class="col col-sm-6 col-md-3 col-lg-3 col-xs-6">
                            <div class="filter-tabs">
                                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                                    <li class="active"> <a data-toggle="tab" href="#grid-container"><i
                                                class="icon fa fa-th-large"></i>Grid</a> </li>
                                    <li><a data-toggle="tab" href="#list-container"><i
                                                class="icon fa fa-bars"></i>List</a></li>
                                </ul>
                            </div>
                            <!-- /.filter-tabs -->
                        </div>
                        <!-- /.col -->
                        <div class="col col-sm-12 col-md-5 col-lg-5 hidden-sm">
                            <div class="col col-sm-6 col-md-6 no-padding">
                                <div class="lbl-cnt"> <span class="lbl">Sort by</span>
                                    <div class="fld inline">
                                        <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                            <button data-toggle="dropdown" type="button" class="btn dropdown-toggle">
                                                Sorting <span class="caret"></span> </button>
                                            <ul role="menu" class="dropdown-menu">
                                                <li role="presentation"><a
                                                        href="{{ route('landingPage.priceAsc') }}?data=1">Price:Lowest
                                                        first</a></li>
                                                <li role="presentation"><a
                                                        href="{{ route('landingPage.priceDesc') }}">Price:Highest
                                                        first</a></li>
                                                <li role="presentation"><a
                                                        href="{{ route('landingPage.nameAsc') }}">Product Name:A to
                                                        Z</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /.fld -->
                                </div>
                                <!-- /.lbl-cnt -->
                            </div>
                            <!-- /.col -->
                            <div class="col col-sm-6 col-md-6 no-padding hidden-sm hidden-md">
                                <div class="lbl-cnt"> <span class="lbl">Show</span>
                                    <div class="fld inline">
                                        <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                            <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 1
                                                <span class="caret"></span> </button>
                                            {{ $roomTypes->appends(Request::except('page'))->links('layouts.vendor.pagination2') }}
                                        </div>
                                    </div>
                                    <!-- /.fld -->
                                </div>
                                <!-- /.lbl-cnt -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.col -->
                        <div class="col col-sm-6 col-md-4 col-xs-6 col-lg-4 text-right">
                            <div class="pagination-container">
                                {{ $roomTypes->appends(Request::except('page'))->links('layouts.vendor.pagination1') }}
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <div class="search-result-container ">
                    <div id="myTabContent" class="tab-content category-list">
                        <div class="tab-pane active " id="grid-container">
                            <div class="category-product">
                                <div class="row">
                                    @if (Route::currentRouteName()=='landingPage.priceAsc' ||
                                    Route::currentRouteName()=='landingPage.priceDesc' ||
                                    Route::currentRouteName()=='landingPage.sortPrice')
                                    @foreach ($roomTypes as $roomType)
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="item">
                                            <div class="products">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <a
                                                                href="{{ route('landingPage.show', $roomType->roomType->id) }}">
                                                                @foreach ($roomType->roomType->image() as $image)
                                                                @if($loop->iteration == 1)
                                                                <img src="{{ asset('storage/images/room/'.$image->image) }}"
                                                                    alt="">
                                                                @elseif($loop->iteration == 2)
                                                                <img src="{{ asset('storage/images/room/'.$image->image) }}"
                                                                    alt="" class="hover-image">
                                                                @endif
                                                                @endforeach
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <!-- /.product-image -->

                                                    <div class="product-info text-left">
                                                        <h3 class="name"><a
                                                                href="{{ route('landingPage.show', $roomType->roomType->id) }}">{{$roomType->roomType->name}}</a>
                                                        </h3>
                                                        <h5 style="font-style: italic; color: red;">
                                                            {{$roomType->roomType->kost->name}}</h5>
                                                        @if ($roomType->roomType->kost->type->id == 1)
                                                        <span class="badge badge-success"
                                                            style="background-color:blue;">{{$roomType->roomType->kost->type->name}}</span>
                                                        @elseif ($roomType->roomType->kost->type->id == 2)
                                                        <span class="badge badge-danger"
                                                            style="background-color:red;">{{$roomType->roomType->kost->type->name}}</span>
                                                        @else
                                                        <span class="badge badge-warning"
                                                            style="background-color:green;">{{$roomType->roomType->kost->type->name}}</span>
                                                        @endif
                                                        <div class="description"><i class="fa fa-map-marker"
                                                                aria-hidden="true"></i>
                                                            <?php 
                                                                $karakter = strlen($roomType->roomType->kost->address);
                                                                if($karakter<20){
                                                                    echo substr($roomType->roomType->kost->address, 0, 20) ; 
                                                                }else{
                                                                    echo substr($roomType->roomType->kost->address, 0, 20).' ...';
                                                                }
                                                            ?></div>
                                                        <div class="description"
                                                            style="font-style: italic; color: red;">Sisa
                                                            {{$roomType->roomType->roomLeft()}} Kamar</div><br>
                                                        <div class="product-price"> <span class="price">
                                                                {{Helper::rupiah($roomType->roomType->month()->price)}}
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
                                    </div>
                                    @endforeach
                                    @else
                                    @foreach ($roomTypes as $roomType)
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="item">
                                            <div class="products">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <a href="{{ route('landingPage.show', $roomType->id) }}">
                                                                @foreach ($roomType->image() as $image)
                                                                @if($loop->iteration == 1)
                                                                <img src="{{ asset('storage/images/room/'.$image->image) }}"
                                                                    alt="">
                                                                @elseif($loop->iteration == 2)
                                                                <img src="{{ asset('storage/images/room/'.$image->image) }}"
                                                                    alt="" class="hover-image">
                                                                @endif
                                                                @endforeach
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <!-- /.product-image -->

                                                    <div class="product-info text-left">
                                                        <h3 class="name"><a
                                                                href="{{ route('landingPage.show', $roomType->id) }}">{{$roomType->name}}</a>
                                                        </h3>
                                                        <h5 style="font-style: italic; color: red;">
                                                            {{$roomType->kost->name}}</h5>
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
                                                        <div class="description"><i class="fa fa-map-marker"
                                                                aria-hidden="true"></i>
                                                            <?php 
                                                                $karakter = strlen($roomType->kost->address);
                                                                if($karakter<20){
                                                                    echo substr($roomType->kost->address, 0, 20) ; 
                                                                }else{
                                                                    echo substr($roomType->kost->address, 0, 20).' ...';
                                                                }
                                                            ?></div>
                                                        <div class="description"
                                                            style="font-style: italic; color: red;">Sisa
                                                            {{$roomType->roomLeft()}} Kamar</div><br>
                                                        <div class="product-price"> <span class="price">
                                                                {{Helper::rupiah($roomType->month()->price)}}
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
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.category-product -->

                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane " id="list-container">
                            <div class="category-product">
                                @if (Route::currentRouteName()=='landingPage.priceAsc' ||
                                Route::currentRouteName()=='landingPage.priceDesc' ||
                                Route::currentRouteName()=='landingPage.sortPrice')
                                @foreach ($roomTypes as $roomType)
                                <div class="category-product-inner">
                                    <div class="products">
                                        <div class="product-list product">
                                            <div class="row product-list-row">
                                                <div class="col col-sm-3 col-lg-3">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            @if ($roomType->roomType->firstImage())
                                                            <img style="height: 150px;"
                                                                src="{{ asset('storage/images/room/'.$roomType->roomType->firstImage()->image) }}"
                                                                alt="">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col col-sm-9 col-lg-9">
                                                    <div class="product-info">
                                                        <h3 class="name"><a
                                                                href="{{ route('landingPage.show', $roomType->roomType->id) }}">{{$roomType->roomType->name}}
                                                                &diams;{{$roomType->roomType->kost->name}}</a>
                                                        </h3>
                                                        <div class="product-price"> <span class="price">
                                                                {{Helper::rupiah($roomType->roomType->month()->price)}}
                                                            </span> <span class="product-info">Per Bulan</span> </div>
                                                        <!-- /.product-price -->
                                                        <div class="description"><i class="fa fa-map-marker"
                                                                aria-hidden="true"></i>
                                                            {{$roomType->roomType->kost->address}}</div>
                                                        <div class="description m-t-10">
                                                            {{$roomType->roomType->kost->note}}
                                                        </div>
                                                        <div class="cart clearfix animate-effect">
                                                            <div class="action">

                                                                </ul>
                                                            </div>
                                                            <!-- /.action -->
                                                        </div>
                                                        <!-- /.cart -->

                                                    </div>
                                                    <!-- /.product-info -->
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.product-list-row -->
                                            <div class="tag new"><span>new</span></div>
                                        </div>
                                        <!-- /.product-list -->
                                    </div>
                                    <!-- /.products -->
                                </div>
                                @endforeach
                                @else
                                @foreach ($roomTypes as $roomType)
                                <div class="category-product-inner">
                                    <div class="products">
                                        <div class="product-list product">
                                            <div class="row product-list-row">
                                                <div class="col col-sm-3 col-lg-3">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            @if ($roomType->firstImage())
                                                            <img style="height: 150px;"
                                                                src="{{ asset('storage/images/room/'.$roomType->firstImage()->image) }}"
                                                                alt="">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col col-sm-9 col-lg-9">
                                                    <div class="product-info">
                                                        <h3 class="name"><a
                                                                href="{{ route('landingPage.show', $roomType->id) }}">{{$roomType->name}}
                                                                &diams;{{$roomType->kost->name}}</a>
                                                        </h3>
                                                        <div class="product-price"> <span class="price">
                                                                {{Helper::rupiah($roomType->month()->price)}}
                                                            </span> <span class="product-info">Per Bulan</span> </div>
                                                        <!-- /.product-price -->
                                                        <div class="description"><i class="fa fa-map-marker"
                                                                aria-hidden="true"></i> {{$roomType->kost->address}}
                                                        </div>
                                                        <div class="description m-t-10">{{$roomType->kost->note}}
                                                        </div>
                                                        <div class="cart clearfix animate-effect">
                                                            <div class="action">

                                                                </ul>
                                                            </div>
                                                            <!-- /.action -->
                                                        </div>
                                                        <!-- /.cart -->

                                                    </div>
                                                    <!-- /.product-info -->
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.product-list-row -->
                                            <div class="tag new"><span>new</span></div>
                                        </div>
                                        <!-- /.product-list -->
                                    </div>
                                    <!-- /.products -->
                                </div>
                                @endforeach
                                @endif

                            </div>
                            <!-- /.category-product -->
                        </div>
                        <!-- /.tab-pane #list-container -->
                    </div>
                    <!-- /.tab-content -->
                    <div class="clearfix filters-container bottom-row">
                        <div class="text-right">
                            <div class="pagination-container">
                                {{ $roomTypes->appends(Request::except('page'))->links('layouts.vendor.pagination1') }}
                            </div>
                            <!-- /.pagination-container -->
                        </div>
                        <!-- /.text-right -->

                    </div>
                    <!-- /.filters-container -->

                </div>
                <!-- /.search-result-container -->
                                                
                <div class="category-carousel hidden-xs">
                    <div class="item">
                        <div class="image"> 
                        </div>
                    </div>
                </div>
                <div class="category-carousel hidden-xs">
                    <div class="item">
                        <div class="image"> 
                            <div id="map" style="width:100%;height:380px;"></div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        <div id="brands-carousel" class="logo-slider">
            <div class="logo-slider-inner">
                <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                    <div class="item m-t-15"> <a href="#" class="image"> <img
                                data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt=""> </a>
                    </div>
                    <!--/.item-->

                    <div class="item m-t-10"> <a href="#" class="image"> <img
                                data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt=""> </a>
                    </div>
                    <!--/.item-->

                    <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand3.png"
                                src="assets/images/blank.gif" alt=""> </a> </div>
                    <!--/.item-->

                    <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand4.png"
                                src="assets/images/blank.gif" alt=""> </a> </div>
                    <!--/.item-->

                    <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand5.png"
                                src="assets/images/blank.gif" alt=""> </a> </div>
                    <!--/.item-->

                    <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand6.png"
                                src="assets/images/blank.gif" alt=""> </a> </div>
                    <!--/.item-->

                    <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand2.png"
                                src="assets/images/blank.gif" alt=""> </a> </div>
                    <!--/.item-->

                    <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand4.png"
                                src="assets/images/blank.gif" alt=""> </a> </div>
                    <!--/.item-->

                    <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand1.png"
                                src="assets/images/blank.gif" alt=""> </a> </div>
                    <!--/.item-->

                    <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand5.png"
                                src="assets/images/blank.gif" alt=""> </a> </div>
                    <!--/.item-->
                </div>
                <!-- /.owl-carousel #logo-slider -->
            </div>
            <!-- /.logo-slider-inner -->

        </div>
        <!-- /.logo-slider -->
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div>
    <!-- /.container -->
<?php 
    if(Route::currentRouteName()=='landingPage.info'){
        $kosts = \App\Models\Kost::select('id')->where('status', 1)->get();
        $kost_id = collect([]);
        foreach($kosts as $kost){
            $kost_id->push($kost->id);
        }
        $roomTypes = \App\Models\RoomType::inRandomOrder('2')->whereIn('kost_id', $kost_id)->orderby('created_at', 'desc')->get();
    }
    $room_type_id = collect([]);;
    foreach($roomTypes as $roomType){
        $room_type_id->push($roomType->id);
    }
?>
</div>
<!-- /.body-content -->
@endsection

@section('script')
<script>
    google.maps.event.addDomListener(window, 'load', init);

    let map;
    let infoWindow;
    let mapOptions;
    let bounds;
    
    function init() {
        infoWindow = new google.maps.InfoWindow;
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
        var room_type_id = {{$room_type_id}};

        $.post(
            "{{url('api/map/get-kost')}}", 
            {
                "_token": "{{ csrf_token() }}",
                room_type_id: {{$room_type_id}}
            }, 
            function(result){
                for(var i=0; i<result.length; i++)
                {
                    var pos = {
                        lat: parseFloat(result[i].latitude),
                        lng: parseFloat(result[i].longitude)
                    };
                    var content = `<div>
                                        <a href="/info/`+result[i].room_type+`">
                                        <h5>`+result[i].name+`</h5>
                                        </a>
                                        <img width="150px" heigth="150px" src="{{asset('storage/images/kost/`+result[i].image+`')}}" alt="">
                                    </div>`;
                    addMarker(result[i].latitude, result[i].longitude, content);
                }
                var location;
                var marker;
                function addMarker(lat, lng, info){
                    location = new google.maps.LatLng(lat, lng);
                    bounds.extend(location);
                    marker = new google.maps.Marker({
                        map: map,
                        position: location,
                        icon: '{{asset("marker/kost.png")}}',
                        animation: google.maps.Animation.DROP
                    });       
                    map.fitBounds(bounds);
                    bindInfoWindow(marker, map, infoWindow, info);
                }
                // Proses ini dapat menampilkan informasi lokasi Kota/Kab ketika diklik dari masing-masing markernya
                function bindInfoWindow(marker, map, infoWindow, html){
                    google.maps.event.addListener(marker, 'click', function() {
                        infoWindow.setContent(html);
                        infoWindow.open(map, marker);
                    });
                }
            }
        )
        // $.ajax({
        //     url: "{{url('api/map/get-kost')}}",
        //     dataType: 'json',
        //     cache: false,
        //     dataSrc: '',

        //     success: function (data) {
        //         var latitude = data.map(function (item) {
        //             return item.latitude;
        //         });
        //         var longitude = data.map(function (item) {
        //             return item.longitude;
        //         });
        //         var name = data.map(function (item) {
        //             return item.name;
        //         });
        //         var image = data.map(function (item) {
        //             return item.image;
        //         });
        //         var room_type = data.map(function (item) {
        //             return item.room_type;
        //         });
        //         var latlng = new google.maps.LatLng(parseFloat(latitude), parseFloat(longitude));
        //         for (i = 0; i < data.length; i++) {
        //             var pos = {
        //                 lat: parseFloat(latitude[i]),
        //                 lng: parseFloat(longitude[i])
        //             };
        //             var content = `<div>
        //                                 <a href="/info/`+room_type[i]+`">
        //                                 <h5>`+name[i]+`</h5>
        //                                 </a>
        //                                 <img width="150px" heigth="150px" src="{{asset('storage/images/kost/`+image[i]+`')}}" alt="">
        //                             </div>`;
        //             addMarker(latitude[i], longitude[i], content);
        //             // for(i=0; i<arrays.length; i++){
        //             //     var data = arrays
        //             //     console.log(data.properties.center['latitude']);
        //             // }                   
        //         }
        //         var location;
        //         var marker;
        //         function addMarker(lat, lng, info){
        //             location = new google.maps.LatLng(lat, lng);
        //             bounds.extend(location);
        //             marker = new google.maps.Marker({
        //                 map: map,
        //                 position: location,
        //                 icon: '{{asset("marker/kost.png")}}',
        //                 animation: google.maps.Animation.DROP
        //             });       
        //             map.fitBounds(bounds);
        //             bindInfoWindow(marker, map, infoWindow, info);
        //         }
        //         // Proses ini dapat menampilkan informasi lokasi Kota/Kab ketika diklik dari masing-masing markernya
        //         function bindInfoWindow(marker, map, infoWindow, html){
        //             google.maps.event.addListener(marker, 'click', function() {
        //                 infoWindow.setContent(html);
        //                 infoWindow.open(map, marker);
        //             });
        //         }
        //     }

        // });

    }

    // Open close small chat
    $('#sortPrice').on('click', function (e) {
        let text = $('#priceRange').val()
        const val = text.split(",");
        console.log(val[0]);
        window.open("{{ route('landingPage.sortPrice') }}?min=" + val[0] + "&max=" + val[1] + "", "_self");
    });

</script>
@endsection
