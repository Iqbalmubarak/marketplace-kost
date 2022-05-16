@extends('layouts.landingPage.main')

@section('content')
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
                                        <div class="excerpt fadeInDown-2 hidden-xs"> <span>Lorem ipsum dolor sit amet,
                                                consectetur adipisicing elit.</span> </div>
                                        <div class="button-holder fadeInDown-3"> <a
                                                href="index6c11.html?page=single-product"
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
                                        <div class="excerpt fadeInDown-2 hidden-xs"> <span>Nemo enim ipsam voluptatem
                                                quia voluptas sit aspernatur aut odit aut fugit</span> </div>
                                        <div class="button-holder fadeInDown-3"> <a
                                                href="index6c11.html?page=single-product"
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
                            <h3 class="new-product-title pull-left">Kos Terbaru</h3>
                            <!-- /.nav-tabs -->
                        </div>
                        <div class="tab-content outer-top-xs">
                            <div class="tab-pane in active" id="all">
                                <div class="product-slider">
                                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                                        @foreach ($kosts as $kost)
                                        <div class="item item-carousel">
                                            <div class="products">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <a
                                                                href="{{ route('landingPage.show', $kost->firtsRoomType()->id) }}">
                                                                @foreach ($kost->firtsRoomType()->image() as $image)
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
                                                                href="{{ route('landingPage.show', $kost->firtsRoomType()->id) }}">{{$kost->firtsRoomType()->name}}
                                                                &diams;{{$kost->name}}</a></h3>
                                                        @if ($kost->type->id == 1)
                                                        <span
                                                            class="badge badge-success">{{$kost->type->name}}</span>
                                                        @elseif ($kost->type->id == 2)
                                                        <span
                                                            class="badge badge-danger">{{$kost->type->name}}</span>
                                                        @else
                                                        <span
                                                            class="badge badge-warning">{{$kost->type->name}}</span>
                                                        @endif
                                                        <div class="description"><i class="fa fa-map-marker"
                                                                aria-hidden="true"></i> {{$kost->address}}</div>
                                                        <div class="description"
                                                            style="font-style: italic; color: red;">Sisa
                                                            {{$kost->firtsRoomType()->roomLeft()}} Kamar</div><br>
                                                        <div class="product-price"> <span class="price">
                                                                {{Helper::rupiah($kost->firtsRoomType()->month()->price)}}
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
                                    <a class="image" href="category.php"> <img class="img-responsive"
                                            src="{{ asset('templateLandings/assets/images/banners/home-banner1.jpg') }}"
                                            alt=""> </a>
                                </div>
                                <!-- /.wide-banner -->
                            </div>

                            <div class="col-md-3 col-sm-3">
                                <div class="wide-banner cnt-strip">
                                    <a class="image" href="category.php"> <img class="img-responsive"
                                            src="{{ asset('templateLandings/assets/images/banners/home-banner3.jpg') }}"
                                            alt=""> </a>
                                </div>
                                <!-- /.wide-banner -->
                            </div>

                            <!-- /.col -->
                            <div class="col-md-3 col-sm-3">
                                <div class="wide-banner cnt-strip">
                                    <a class="image" href="category.php"> <img class="img-responsive"
                                            src="{{ asset('templateLandings/assets/images/banners/home-banner2.jpg') }}"
                                            alt=""> </a>
                                </div>
                                <!-- /.wide-banner -->
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                            <div class="col-md-3 col-sm-3">
                                <div class="wide-banner cnt-strip">
                                    <a class="image" href="category.php"> <img class="img-responsive"
                                            src="{{ asset('templateLandings/assets/images/banners/home-banner4b.jpg') }}"
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
                        <h3 class="section-title">Berita Terkini</h3>
                        <div class="blog-slider-container outer-top-xs">
                            <div class="owl-carousel blog-slider custom-carousel">
                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image"> <a href="blog.html"><img
                                                        src="{{ asset('templateLandings/assets/images/blog-post/blog_big_01.jpg') }}"
                                                        alt=""></a> </div>
                                        </div>
                                        <!-- /.blog-post-image -->

                                        <div class="blog-post-info text-left">
                                            <h3 class="name"><a href="berita-detail.php">Voluptatem accusantium
                                                    doloremque laudantium</a></h3>
                                            <span class="info">By Jone Doe &nbsp;|&nbsp; 21 March 2016 </span>
                                            <p class="text">Sed quia non numquam eius modi tempora incidunt ut labore et
                                                dolore magnam aliquam quaerat voluptatem.</p>
                                        </div>
                                        <!-- /.blog-post-info -->

                                    </div>
                                    <!-- /.blog-post -->
                                </div>
                                <!-- /.item -->

                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image"> <a href="blog.html"><img
                                                        src="{{ asset('templateLandings/assets/images/blog-post/blog_big_02.jpg') }}"
                                                        alt=""></a> </div>
                                        </div>
                                        <!-- /.blog-post-image -->

                                        <div class="blog-post-info text-left">
                                            <h3 class="name"><a href="berita-detail.php">Dolorem eum fugiat quo voluptas
                                                    nulla pariatur</a></h3>
                                            <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                            <p class="text">Sed quia non numquam eius modi tempora incidunt ut labore et
                                                dolore magnam aliquam quaerat voluptatem.</p>
                                        </div>
                                        <!-- /.blog-post-info -->

                                    </div>
                                    <!-- /.blog-post -->
                                </div>
                                <!-- /.item -->

                                <!-- /.item -->

                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image"> <a href="berita-detail.php"><img
                                                        src="{{ asset('templateLandings/assets/images/blog-post/blog_big_03.jpg') }}"
                                                        alt=""></a> </div>
                                        </div>
                                        <!-- /.blog-post-image -->

                                        <div class="blog-post-info text-left">
                                            <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla
                                                    pariatur</a></h3>
                                            <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                            <p class="text">Sed ut perspiciatis unde omnis iste natus error sit
                                                voluptatem accusantium</p>
                                        </div>
                                        <!-- /.blog-post-info -->

                                    </div>
                                    <!-- /.blog-post -->
                                </div>
                                <!-- /.item -->

                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image"> <a href="blog.html"><img
                                                        src="{{ asset('templateLandings/assets/images/blog-post/blog_big_01.jpg') }}"
                                                        alt=""></a> </div>
                                        </div>
                                        <!-- /.blog-post-image -->

                                        <div class="blog-post-info text-left">
                                            <h3 class="name"><a href="berita-detail.php">Dolorem eum fugiat quo voluptas
                                                    nulla pariatur</a></h3>
                                            <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                            <p class="text">Sed ut perspiciatis unde omnis iste natus error sit
                                                voluptatem accusantium</p>
                                        </div>
                                        <!-- /.blog-post-info -->

                                    </div>
                                    <!-- /.blog-post -->
                                </div>
                                <!-- /.item -->

                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image"> <a href="blog.html"><img
                                                        src="{{ asset('templateLandings/assets/images/blog-post/blog_big_02.jpg') }}"
                                                        alt=""></a> </div>
                                        </div>
                                        <!-- /.blog-post-image -->

                                        <div class="blog-post-info text-left">
                                            <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla
                                                    pariatur</a></h3>
                                            <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                            <p class="text">Sed ut perspiciatis unde omnis iste natus error sit
                                                voluptatem accusantium</p>
                                        </div>
                                        <!-- /.blog-post-info -->

                                    </div>
                                    <!-- /.blog-post -->
                                </div>
                                <!-- /.item -->

                            </div>
                            <!-- /.owl-carousel -->
                        </div>
                        <!-- /.blog-slider-container -->
                    </section>
                    <!-- /.section -->
                    <!-- ============================================== BLOG SLIDER : END ============================================== -->

                    <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                    <section class="section new-arriavls">
                        <h3 class="section-title">KOSAN TERDEKAT <a href="category.php"
                                style="font-style:italic; text-decoration-line: underline; ">LIHAT SEMUA</a></h3>

                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image">
                                                <a href="detail.php">
                                                    <img src="{{ asset('templateLandings/assets/images/products/p10.jpg') }}"
                                                        alt="">
                                                    <img src="{{ asset('templateLandings/assets/images/products/p10_hover.jpg') }}"
                                                        alt="" class="hover-image">
                                                </a>

                                            </div>
                                            <!-- /.image -->

                                            <div class="tag new"><span>new</span></div>
                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="detail.php">Kosan Bukde</a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="description"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                                Kuranji, Padang</div>
                                            <div class="description" style="font-style: italic; color: red;">Sisa 1
                                                Kamar</div><br>
                                            <div class="product-price"> <span class="price"> Rp 1,600,000 </span> <span
                                                    class="product-info">Per Bulan</span> </div>
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
                            <!-- /.item -->

                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image">
                                                <a href="detail.php">
                                                    <img src="{{ asset('templateLandings/assets/images/products/p2.jpg') }}"
                                                        alt="">
                                                    <img src="{{ asset('templateLandings/assets/images/products/p2_hover.jpg') }}"
                                                        alt="" class="hover-image">
                                                </a>

                                            </div>
                                            <!-- /.image -->

                                            <div class="tag new"><span>new</span></div>
                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="detail.php">Kosan Bukde</a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="description"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                                Kuranji, Padang</div>
                                            <div class="description" style="font-style: italic; color: red;">Sisa 1
                                                Kamar</div><br>
                                            <div class="product-price"> <span class="price"> Rp 1,600,000 </span> <span
                                                    class="product-info">Per Bulan</span> </div>
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
                            <!-- /.item -->

                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image">
                                                <a href="detail.php">
                                                    <img src="{{ asset('templateLandings/assets/images/products/p3.jpg') }}"
                                                        alt="">
                                                    <img src="{{ asset('templateLandings/assets/images/products/p3_hover.jpg') }}"
                                                        alt="" class="hover-image">
                                                </a>

                                            </div>
                                            <!-- /.image -->

                                            <div class="tag hot"><span>hot</span></div>
                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="detail.php">Kosan Bukde</a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="description"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                                Kuranji, Padang</div>
                                            <div class="description" style="font-style: italic; color: red;">Sisa 1
                                                Kamar</div><br>
                                            <div class="product-price"> <span class="price"> Rp 1,600,000 </span> <span
                                                    class="product-info">Per Bulan</span> </div>
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
                            <!-- /.item -->

                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image">
                                                <a href="detail.php">
                                                    <img src="{{ asset('templateLandings/assets/images/products/p1.jpg') }}"
                                                        alt="">
                                                    <img src="{{ asset('templateLandings/assets/images/products/p1_hover.jpg') }}"
                                                        alt="" class="hover-image">
                                                </a>

                                            </div>
                                            <!-- /.image -->

                                            <div class="tag hot"><span>hot</span></div>
                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="detail.php">Kosan Bukde</a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="description"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                                Kuranji, Padang</div>
                                            <div class="description" style="font-style: italic; color: red;">Sisa 1
                                                Kamar</div><br>
                                            <div class="product-price"> <span class="price"> Rp 1,600,000 </span> <span
                                                    class="product-info">Per Bulan</span> </div>
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
                            <!-- /.item -->

                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image">
                                                <a href="detail.php">
                                                    <img src="{{ asset('templateLandings/assets/images/products/p7.jpg') }}"
                                                        alt="">
                                                    <img src="{{ asset('templateLandings/assets/images/products/p7_hover.jpg') }}"
                                                        alt="" class="hover-image">
                                                </a>

                                            </div>
                                            <!-- /.image -->

                                            <div class="tag sale"><span>sale</span></div>
                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="detail.php">Kosan Bukde</a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="description"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                                Kuranji, Padang</div>
                                            <div class="description" style="font-style: italic; color: red;">Sisa 1
                                                Kamar</div><br>
                                            <div class="product-price"> <span class="price"> Rp 1,600,000 </span> <span
                                                    class="product-info">Per Bulan</span> </div>
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
                            <!-- /.item -->

                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image">
                                                <a href="detail.php">
                                                    <img src="{{ asset('templateLandings/assets/images/products/p9.jpg') }}"
                                                        alt="">
                                                    <img src="{{ asset('templateLandings/assets/images/products/p9_hover.jpg') }}"
                                                        alt="" class="hover-image">
                                                </a>

                                            </div>
                                            <!-- /.image -->

                                            <div class="tag sale"><span>sale</span></div>
                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="detail.php">Kosan Bukde</a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="description"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                                Kuranji, Padang</div>
                                            <div class="description" style="font-style: italic; color: red;">Sisa 1
                                                Kamar</div><br>
                                            <div class="product-price"> <span class="price"> Rp 1,600,000 </span> <span
                                                    class="product-info">Per Bulan</span> </div>
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
                            <!-- /.item -->
                        </div>
                        <!-- /.home-owl-carousel -->
                    </section>
                    <!-- /.section -->
                    <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.sigin-in-->
    </div><!-- /.container -->
</div>
@endsection
