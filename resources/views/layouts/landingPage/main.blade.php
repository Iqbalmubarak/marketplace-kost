<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title>KOSANKU - Sekarang cari kos udah gampang!</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('templateLandings/assets/css/bootstrap.min.css') }}">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ asset('templateLandings/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('templateLandings/assets/css/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('templateLandings/assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('templateLandings/assets/css/owl.transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('templateLandings/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templateLandings/assets/css/rateit.css') }}">
    <link rel="stylesheet" href="{{ asset('templateLandings/assets/css/bootstrap-select.min.css') }}">
    <!-- Sweet Alert -->
    <link href="{{ asset('templates/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
    <!-- Toastr style -->
    <link href="{{ asset('templates/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">

    @yield('css')

    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{ asset('templateLandings/assets/css/font-awesome.css') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Barlow:200,300,300i,400,400i,500,500i,600,700,800"
        rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800'
        rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>

<body class="cnt-home">
    <!-- ============================================== HEADER ============================================== -->
    <header class="header-style-1">

        <!-- ============================================== TOP MENU ============================================== -->
        @include('layouts.landingPage.navbar')
        <!-- /.header-nav -->
        <!-- ============================================== NAVBAR : END ============================================== -->

    </header>

    <!-- ============================================== HEADER : END ============================================== -->

    @yield('content')
    <!-- /.body-content -->
    <!-- ============================================================= FOOTER ============================================================= -->

    <!-- ============================================== INFO BOXES ============================================== -->
    <div class="row our-features-box">
        <div class="container">
            <ul>
                <li>
                    <div class="feature-box">
                        <div class="icon-truck"></div>
                        <div class="content-blocks">We ship worldwide</div>
                    </div>
                </li>
                <li>
                    <div class="feature-box">
                        <div class="icon-support"></div>
                        <div class="content-blocks">call
                            +1 800 789 0000</div>
                    </div>
                </li>
                <li>
                    <div class="feature-box">
                        <div class="icon-money"></div>
                        <div class="content-blocks">Money Back Guarantee</div>
                    </div>
                </li>
                <li>
                    <div class="feature-box">
                        <div class="icon-return"></div>
                        <div class="content">30 days return</div>
                    </div>
                </li>

            </ul>
        </div>
    </div>
    <!-- /.info-boxes -->
    <!-- ============================================== INFO BOXES : END ============================================== -->

    <!-- ============================================================= FOOTER ============================================================= -->
    <footer id="footer" class="footer color-bg">

        <div class="copyright-bar">
            <div class="container">
                <div class="col-xs-12 col-sm-4 no-padding social">
                    <ul class="link">
                        <li class="fb pull-left"><a target="_blank" rel="nofollow" href="#" title="Facebook"></a></li>
                        <li class="tw pull-left"><a target="_blank" rel="nofollow" href="#" title="Twitter"></a></li>
                        <li class="googleplus pull-left"><a target="_blank" rel="nofollow" href="#"
                                title="GooglePlus"></a></li>
                        <li class="rss pull-left"><a target="_blank" rel="nofollow" href="#" title="RSS"></a></li>
                        <li class="pintrest pull-left"><a target="_blank" rel="nofollow" href="#" title="PInterest"></a>
                        </li>
                        <li class="linkedin pull-left"><a target="_blank" rel="nofollow" href="#" title="Linkedin"></a>
                        </li>
                        <li class="youtube pull-left"><a target="_blank" rel="nofollow" href="#" title="Youtube"></a>
                        </li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-4 no-padding copyright"><a target="_blank"
                        href="https://www.templateshub.net">Templates Hub</a> </div>
                <div class="col-xs-12 col-sm-4 no-padding">
                    <div class="clearfix payment-methods">
                        <ul>
                            <li><img src="{{ asset('templateLandings/assets/images/payments/1.png') }}" alt=""></li>
                            <li><img src="{{ asset('templateLandings/assets/images/payments/2.png') }}" alt=""></li>
                            <li><img src="{{ asset('templateLandings/assets/images/payments/3.png') }}" alt=""></li>
                            <li><img src="{{ asset('templateLandings/assets/images/payments/4.png') }}" alt=""></li>
                            <li><img src="{{ asset('templateLandings/assets/images/payments/5.png') }}" alt=""></li>
                        </ul>
                    </div>
                    <!-- /.payment-methods -->
                </div>
            </div>
        </div>
    </footer>
    <!-- ============================================================= FOOTER : END============================================================= -->

    <!-- For demo purposes – can be removed on production -->

    <!-- For demo purposes – can be removed on production : End -->

    <!-- JavaScripts placed at the end of the document so the pages load faster -->

    <script src="{{ asset('templateLandings/assets/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('templateLandings/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('templateLandings/assets/js/bootstrap-hover-dropdown.min.js') }}"></script>
    <script src="{{ asset('templateLandings/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('templateLandings/assets/js/echo.min.js') }}"></script>
    <script src="{{ asset('templateLandings/assets/js/jquery.easing-1.3.min.js') }}"></script>
    <script src="{{ asset('templateLandings/assets/js/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('templateLandings/assets/js/jquery.rateit.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('templateLandings/assets/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('templateLandings/assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('templateLandings/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('templateLandings/assets/js/scripts.js') }}"></script>
    <!-- Sweet alert -->
    <script src="{{ asset('templates/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <!-- Toastr script -->
    <script src="{{ asset('templates/js/plugins/toastr/toastr.min.js') }}"></script>

    <script type="text/javascript">
        function logout() {
            event.preventDefault();
            $("#logout-form").submit();
        }

        @if(Session::has('success'))
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
        toastr.success("{{ session('success') }}");
        @endif

        @if(Session::has('error'))
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
        toastr.error("{{ session('error') }}");
        @endif

        @if(Session::has('warning'))
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
        toastr.warning("{{ session('warning') }}");
        @endif

        @if(Session::has('info'))
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
        toastr.info("{{ session('info') }}");
        @endif
    </script>
    @yield('script')
</body>

</html>
