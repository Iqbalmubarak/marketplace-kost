<div class="top-bar animate-dropdown">
    <div class="container">

        <!-- /.header-top-inner -->
    </div>
    <!-- /.container -->
</div>
<!-- /.header-top -->
<!-- ============================================== TOP MENU : END ============================================== -->
<div class="main-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                <!-- ============================================================= LOGO ============================================================= -->
                <div class="logo"> <a href="home.html"> <img
                            src="{{ asset('templateLandings/assets/images/logo.png') }}" alt="logo"> </a> </div>
                <!-- /.logo -->
                <!-- ============================================================= LOGO : END ============================================================= -->
            </div>
            <!-- /.logo-holder -->

            <div class="col-lg-7 col-md-6 col-sm-8 col-xs-12 top-search-holder">
                <!-- /.contact-row -->
                <!-- ============================================================= SEARCH AREA ============================================================= -->
                <div class="search-area">
                    <form>
                        <div class="control-group">
                            <ul class="categories-filter animate-dropdown">
                                <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown"
                                        href="category.html">Lokasi <b class="caret"></b></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li class="menu-header">Sumatera Barat</li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">-
                                                Padang</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">-
                                                Pariaman</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">-
                                                Padang Panjang</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">-
                                                Bukittinggi</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <input class="search-field" placeholder="Search here..." />
                            <a class="search-button" href="#"></a>
                        </div>
                    </form>
                </div>
                <!-- /.search-area -->
                <!-- ============================================================= SEARCH AREA : END ============================================================= -->
            </div>
            <!-- /.top-search-holder -->

            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 animate-dropdown top-cart-row">
                <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
                <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart"
                        data-toggle="dropdown">
                        <div class="items-cart-inner">
                            <div class="">
                                @if(Auth::user())
                                <div class="total-price-basket" href=""> <span
                                        class="value" onclick="logout()"><i class="fa fa-user" aria-hidden="true"></i>LOGOUT</span> </div>
                                <form id="logout-form" action="{{route('logout')}}" method="POST">@csrf</form>
                                @else
                                <div class="total-price-basket" href=""> <span
                                        class="value"><i class="fa fa-user" aria-hidden="true"></i> LOG IN</span> </div>
                                @endif
                                
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="cart-item product-summary">
                                <span class="btn btn-upper btn-secondary btn-block m-t-20">Login sebagai</span>
                                <a href="{{ route('login') }}?role=owner" class="btn btn-upper btn-primary btn-block m-t-20">Pemilik kos</a>
                                <a href="{{ route('login') }}?role=customer" class="btn btn-upper btn-primary btn-block m-t-20">Penyewa kos</a>
                            </div>
                        </li>
                    </ul>
                    <!-- /.dropdown-menu-->
                </div>
                <!-- /.dropdown-cart -->

                <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->
            </div>
            <!-- /.top-cart-row -->
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

</div>
<!-- /.main-header -->

<!-- ============================================== NAVBAR ============================================== -->
<div class="header-nav animate-dropdown">
    <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse"
                    class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                        class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <div class="nav-bg-class">
                <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                    <div class="nav-outer">
                        <ul class="nav navbar-nav">
                            <li class="@if(Route::currentRouteName()=='landingPage.home') active  @endif dropdown"> <a href="{{ route('landingPage.home') }}">Home</a> </li>

                            <li class="@if(Route::currentRouteName()=='landingPage.info') active  @endif  dropdown"> <a href="{{ route('landingPage.info') }}">Info Kos</a> </li>
                            <!-- <li class="@if(Route::currentRouteName()=='landingPage.home') active  @endif  dropdown"> <a href="about.php">Tentang</a> </li>
                            <li class="@if(Route::currentRouteName()=='landingPage.home') active  @endif  dropdown"> <a href="berita.php">Berita</a> </li>

                            <li class="@if(Route::currentRouteName()=='landingPage.home') active  @endif  dropdown"> <a href="contact.php">Bantuan</a> </li> -->
                            @if(Auth::user())
                                @if(Auth::user()->isCustomer())
                                <li class="@if(Route::currentRouteName()=='customer.booking.indexCustomer') active  @endif  dropdown"> <a href="{{ route('customer.booking.indexCustomer') }}">Pemesanan kamar</a> </li>
                                <li class="@if(Route::currentRouteName()=='customer.booking.indexCustomer') active  @endif  dropdown"> <a href="{{ route('customer.history.show', 18) }}">Penyewaan kamar</a> </li>
                                @endif
                            @endif
                            


                            <li class="dropdown  navbar-right special-menu"> <a href="#">Dapatkan diskon 30% </a> </li>
                        </ul>
                        <!-- /.navbar-nav -->
                        <div class="clearfix"></div>
                    </div>
                    <!-- /.nav-outer -->
                </div>
                <!-- /.navbar-collapse -->

            </div>
            <!-- /.nav-bg-class -->
        </div>
        <!-- /.navbar-default -->
    </div>
    <!-- /.container-class -->

</div>
