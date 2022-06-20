@extends('layouts.landingPage.main')

@section('content')
<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdGrzi3vv43yyxfcFiBRoGVqvtZcJ2lIM"></script>
<div class="body-content outer-top-bd">
    <div class="container">
        <div class="x-page inner-bottom-sm">

            <div class="row">
                <div class="col-md-12 x-text text-center">
                    <div id="hero">
                        <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                            <div class="item"
                                style="background-image: url({{ asset('templateLandings/assets/images/sliders/01.jpg') }});">
                                <div class="container-fluid">
                                    <div class="caption bg-color vertical-center text-left">
                                        <div class="slider-header fadeInDown-1">Apakah kamu</div>
                                        <div class="big-text fadeInDown-1"> Mau Ngekos ? </div>
                                        
                                        <div class="button-holder fadeInDown-3"> <a
                                                href="{{ route('landingPage.info') }}"
                                                class="btn-lg btn btn-uppercase btn-primary shop-now-button"
                                                style="color: white;background-color: #17836d;">Shop Now</a> </div>
                                    </div>
                                    <!-- /.caption -->
                                </div>
                                <!-- /.container-fluid -->
                            </div>
                            <!-- /.item -->

                            <div class="item"
                                style="background-image: url({{ asset('templateLandings/assets/images/sliders/02.jpg') }});">
                                <div class="container-fluid">
                                    <div class="caption bg-color vertical-center text-left">
                                        <div class="slider-header fadeInDown-1">Apakah kamu mau</div>
                                        <div class="big-text fadeInDown-1">Sewa Kosan ? </div>
                                        
                                        <div class="button-holder fadeInDown-3"> <a
                                                href="{{ route('landingPage.info') }}"
                                                class="btn-lg btn btn-uppercase btn-primary shop-now-button"
                                                style="color: white;background-color: #17836d;">Shop Now</a> </div>
                                    </div>
                                    <!-- /.caption -->
                                </div>
                                <!-- /.container-fluid -->
                            </div>
                            <!-- /.item -->

                        </div>
                        <!-- /.owl-carousel -->
                    </div>

                    <div id="product-tabs-slider" class="scroll-tabs outer-top-vs">
                        <div class="more-info-tab clearfix ">
                            <h3 class="new-product-title pull-left">Kamar Terbaru</h3>
                            <!-- /.nav-tabs -->
                        </div>
                        <div class="tab-content outer-top-xs">
                            <div class="tab-pane in active" id="all">
                                <div class="product-slider">
                                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                                        @foreach ($newRoomTypes as $newRoomType)
                                        <div class="item item-carousel">
                                            <div class="products">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <a href="{{ route('landingPage.show', $newRoomType->id) }}">
                                                                @foreach ($newRoomType->image() as $image)
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
                                                                href="{{ route('landingPage.show', $newRoomType->id) }}">{{$newRoomType->name}}
                                                                &diams;{{$newRoomType->kost->name}}</a></h3>
                                                        @if ($newRoomType->kost->type->id == 1)
                                                        <span
                                                            class="badge badge-success">{{$newRoomType->kost->type->name}}</span>
                                                        @elseif ($newRoomType->kost->type->id == 2)
                                                        <span
                                                            class="badge badge-danger">{{$newRoomType->kost->type->name}}</span>
                                                        @else
                                                        <span
                                                            class="badge badge-warning">{{$newRoomType->kost->type->name}}</span>
                                                        @endif
                                                        <div class="description"><i class="fa fa-map-marker"
                                                                aria-hidden="true"></i> {{$newRoomType->kost->address}}
                                                        </div>
                                                        <div class="description"
                                                            style="font-style: italic; color: red;">Sisa
                                                            {{$newRoomType->roomLeft()}} Kamar</div><br>
                                                        <div class="product-price"> <span class="price">
                                                                {{Helper::rupiah($newRoomType->month()->price)}}
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
                                        <!-- /.item -->
                                    </div>
                                    <!-- /.home-owl-carousel -->
                                </div>
                                <!-- /.product-slider -->
                            </div>
                            <!-- /.tab-pane -->

                        </div>
                        <!-- /.tab-content -->
                    </div>


                    <!-- /.scroll-tabs -->
                    <!-- ============================================== SCROLL TABS : END ============================================== -->
                    <!-- ============================================== WIDE PRODUCTS ============================================== -->
                    <div class="wide-banners outer-bottom-xs">
                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <div class="wide-banner cnt-strip">
                                    <a class="image" href="{{ route('landingPage.sortAround') }}?latitude= -0.914518 & longitude=100.459526"> <img class="img-responsive"
                                            src="{{ asset('templateLandings/assets/images/banners/unand.jpg') }}"
                                            alt=""> </a>
                                </div>
                                <!-- /.wide-banner -->
                            </div>

                            <div class="col-md-3 col-sm-3">
                                <div class="wide-banner cnt-strip">
                                    <a class="image" href="{{ route('landingPage.sortAround') }}?latitude= -0.9444444444444444 & longitude=100.37555555555555"> <img class="img-responsive"
                                            src="{{ asset('templateLandings/assets/images/banners/unidha.jpg') }}"
                                            alt=""> </a>
                                </div>
                                <!-- /.wide-banner -->
                            </div>

                            <!-- /.col -->
                            <div class="col-md-3 col-sm-3">
                                <div class="wide-banner cnt-strip">
                                    <a class="image" href="{{ route('landingPage.sortAround') }}?latitude= -0.8969444444444444 & longitude=100.35027777777778"> <img class="img-responsive"
                                            src="{{ asset('templateLandings/assets/images/banners/unp.jpg') }}"
                                            alt=""> </a>
                                </div>
                                <!-- /.wide-banner -->
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                            <div class="col-md-3 col-sm-3">
                                <div class="wide-banner cnt-strip">
                                    <a class="image" href="{{ route('landingPage.sortAround') }}?latitude= -0.9574999999999999 & longitude=100.39555555555556"> <img class="img-responsive"
                                            src="{{ asset('templateLandings/assets/images/banners/upi.jpg') }}"
                                            alt=""> </a>
                                </div>
                                <!-- /.wide-banner -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.wide-banners -->

                    <!-- ============================================== WIDE PRODUCTS : END ============================================== -->
                    <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                    <section class="section featured-product">


                        <!-- /.home-owl-carousel -->
                    </section>
                    <!-- /.section -->
                    <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->
                    <!-- ============================================== WIDE PRODUCTS ============================================== -->
                    <div class="wide-banners outer-bottom-xs">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="wide-banner1 cnt-strip">
                                    <div class="image"> <img class="img-responsive"
                                            src="{{ asset('templateLandings/assets/images/banners/home-banner.jpg') }}"
                                            alt=""> </div>
                                    <div class="strip strip-text">
                                        <div class="strip-inner">
                                            <h2 class="text-right">Daftarkan dirimu<br>
                                                <span class="shopping-needs">Dapatkan 30% Diskon</span></h2>
                                        </div>
                                    </div>
                                    <div class="new-label">
                                        <div class="text">NEW</div>
                                    </div>
                                    <!-- /.new-label -->
                                </div>
                                <!-- /.wide-banner -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <div class="wide-banner cnt-strip">
                                    <div class="image"> <img class="img-responsive"
                                            src="{{ asset('templateLandings/assets/images/banners/home-banner4.jpg') }}"
                                            alt=""> </div>


                                    <!-- /.new-label -->
                                </div>
                                <!-- /.wide-banner -->
                            </div>

                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.wide-banners -->
                    <!-- ============================================== WIDE PRODUCTS : END ============================================== -->



                    <!-- /.sidebar-widget -->
                    <!-- ============================================== BEST SELLER : END ============================================== -->

                    <!-- ============================================== BLOG SLIDER ============================================== -->
                    <section class="section latest-blog outer-bottom-vs">
                        <h3 class="section-title">Kos Terbaru</h3>
                        <div class="blog-slider-container outer-top-xs">
                            <div class="owl-carousel blog-slider custom-carousel">
                                @foreach ($newKosts as $newKost)
                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image"> <a
                                                    href="{{ route('landingPage.show', $newKost->firstRoomType()->id) }}">@if($newKost->firstKostImage())<img
                                                        style="height:350px"  src="{{ asset('storage/images/kost/'.$newKost->firstKostImage()->image) }}"
                                                        alt="">@endif</a> </div>
                                        </div>
                                        <!-- /.blog-post-image -->

                                        <div class="blog-post-info text-left">
                                            <h3 class="name"><a
                                                    href="{{ route('landingPage.show', $newKost->firstRoomType()->id) }}">{{$newKost->name}}</a>
                                            </h3>
                                            <span class="info">{{$newKost->kostOwner->first_name}}
                                                {{$newKost->kostOwner->last_name}}&nbsp;|&nbsp;
                                                {{Helper::dateFormat($newKost->created_at)}}</span>
                                            <p class="text">@if ($newKost->note)
                                                <?php echo nl2br(htmlspecialchars($newKost->note)); ?>
                                                @else
                                                Belum ada deskripsi kos
                                                @endif</p>
                                        </div>
                                        <!-- /.blog-post-info -->

                                    </div>
                                    <!-- /.blog-post -->
                                </div>
                                @endforeach

                            </div>
                            <!-- /.owl-carousel -->
                        </div>
                        <!-- /.blog-slider-container -->
                    </section>
                    <!-- /.section -->
                    <!-- ============================================== BLOG SLIDER : END ============================================== -->

                    <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                    
                    <!-- /.section -->
                    <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.sigin-in-->
    </div><!-- /.container -->
</div>

@endsection

@section('script')
<script>
    // $(document).ready(function () {
    //     if (navigator.geolocation) {
    //         navigator.geolocation.getCurrentPosition(function (position) {
    //             var pos = {
    //                 lat: position.coords.latitude,
    //                 lng: position.coords.longitude
    //             };

    //             var div = $(`
    //             <div class="owl-wrapper-outer">
    //                 <div class="owl-wrapper" style="width: 1228px; left:0px; display:block" id="owl-wrapper">
    //                 </div>
    //             </div>
    //             `);
    //             // $('#owl-carousel').append(div);
    //             //  $('.owl-wrapper').clone().show().insertAfter('.item-carousel:last');
    //             //$( ".item-carousel" ).clone().appendTo( "#around" );
    //             console.log(position.coords.latitude);
    //             console.log(position.coords.longitude);
    //             let base_url = "{{URL('/info/getAround')}}";
    //             $.ajax({
    //                 url: base_url + "?latitude=" + position.coords.latitude + "&longitude=" + position.coords.longitude ,
    //                 dataType: "json",
    //                 cache : false,
    //                 dataSrc : "",
    //                 success: function (data) {
    //                     for(i=0; i<data.length; i++){
    //                         console.log(data[i].name);
    //                         var div = $(`
    //                         <div class="owl-item" style="width:307px;">
    //                         <div class="item item-carousel">
    //                             <div class="products">
    //                                 <div class="product">
    //                                     <div class="product-image">
    //                                         <div class="image">
    //                                             <a href="detail.php">
    //                                                 <img src="{{ asset('templateLandings/assets/images/products/p10.jpg') }}"
    //                                                     alt="">
    //                                                 <img src="{{ asset('templateLandings/assets/images/products/p10_hover.jpg') }}"
    //                                                     alt="" class="hover-image">
    //                                             </a>

    //                                         </div>
    //                                         <!-- /.image -->

    //                                         <div class="tag new"><span>new</span></div>
    //                                     </div>
    //                                     <!-- /.product-image -->

    //                                     <div class="product-info text-left">
    //                                         <h3 class="name"><a href="detail.php">`+data[i].room_type_name+` &diams; `+ data[i].name +`</a></h3>
    //                                         <div class="rating rateit-small"></div>
    //                                         <div class="description"><i class="fa fa-map-marker" aria-hidden="true"></i>
    //                                             `+data[i].address+`</div>
    //                                         <div class="description" style="font-style: italic; color: red;">Sisa 1
    //                                             Kamar</div><br>
    //                                         <div class="product-price"> <span class="price"> Rp 1,600,000 </span> <span
    //                                                 class="product-info">Per Bulan</span> </div>
    //                                         <!-- /.product-price -->

    //                                     </div>
    //                                     <!-- /.product-info -->
    //                                     <div class="cart clearfix animate-effect">
    //                                         <div class="action">

    //                                         </div>
    //                                         <!-- /.action -->
    //                                     </div>
    //                                     <!-- /.cart -->
    //                                 </div>
    //                                 <!-- /.product -->

    //                             </div>
    //                             <!-- /.products -->
    //                         </div>
    //                         </div>
    //                         `);

    //                         $('#around').html(`
    //                         <div class="owl-item" style="width:307px;">
    //                         <div class="item item-carousel">
    //                             <div class="products">
    //                                 <div class="product">
    //                                     <div class="product-image">
    //                                         <div class="image">
    //                                             <a href="detail.php">
    //                                                 <img src="{{ asset('templateLandings/assets/images/products/p10.jpg') }}"
    //                                                     alt="">
    //                                                 <img src="{{ asset('templateLandings/assets/images/products/p10_hover.jpg') }}"
    //                                                     alt="" class="hover-image">
    //                                             </a>

    //                                         </div>
    //                                         <!-- /.image -->

    //                                         <div class="tag new"><span>new</span></div>
    //                                     </div>
    //                                     <!-- /.product-image -->

    //                                     <div class="product-info text-left">
    //                                         <h3 class="name"><a href="detail.php">`+data[i].room_type_name+` &diams; `+ data[i].name +`</a></h3>
    //                                         <div class="rating rateit-small"></div>
    //                                         <div class="description"><i class="fa fa-map-marker" aria-hidden="true"></i>
    //                                             `+data[i].address+`</div>
    //                                         <div class="description" style="font-style: italic; color: red;">Sisa 1
    //                                             Kamar</div><br>
    //                                         <div class="product-price"> <span class="price"> Rp 1,600,000 </span> <span
    //                                                 class="product-info">Per Bulan</span> </div>
    //                                         <!-- /.product-price -->

    //                                     </div>
    //                                     <!-- /.product-info -->
    //                                     <div class="cart clearfix animate-effect">
    //                                         <div class="action">

    //                                         </div>
    //                                         <!-- /.action -->
    //                                     </div>
    //                                     <!-- /.cart -->
    //                                 </div>
    //                                 <!-- /.product -->

    //                             </div>
    //                             <!-- /.products -->
    //                         </div>
    //                         </div>
    //                         `);
    //                         //$('#around').append(div);
    //                     }
    //                 }
    //             });

    //         }, function () {
    //             handleLocationError(true, infoWindow, map.getCenter());
    //         });
    //     } else {
    //         // Jika browser tidak mendukung geolokasi pindah ke lokasi ketetapan diatas (center)
    //         handleLocationError(false, infoWindow, map.getCenter());
    //     }
    // });

</script>
@endsection
