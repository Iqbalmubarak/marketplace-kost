<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Dashboard v.2</title>
    @notifyCss

    <link href="{{ asset('templates/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('templates/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('templates/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('templates/css/plugins/steps/jquery.steps.css') }}" rel="stylesheet">

    <link href="{{ asset('templates/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('templates/css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('templates/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">

    <!-- Sweet Alert -->
    <link href="{{ asset('templates/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ asset('templates/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- Css dropzone image -->
    <link href="{{ asset('templates/css/plugins/dropzone/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('templates/css/plugins/dropzone/basic.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css"
        integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css"
        integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Create css -->
    @yield('css')
</head>

<body>

    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    @include('layouts.kostOwner.sidebar.menu')
                </ul>
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    @include('layouts.kostOwner.navbar.header')
                </nav>
            </div>
            <div class="wrapper wrapper-content">
                @yield('content')
            </div>


            <script type="text/javascript">
                function logout() {
                    event.preventDefault();
                    $("#logout-form").submit();
                }

            </script>

            <!-- Mainly scripts -->
            <script src="{{ asset('templates/js/jquery-3.1.1.min.js') }}"></script>
            <script src="{{ asset('templates/js/popper.min.js') }}"></script>
            <script src="{{ asset('templates/js/bootstrap.js') }}"></script>
            <script src="{{ asset('templates/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
            <script src="{{ asset('templates/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>



            <!-- Flot -->
            <script src="{{ asset('templates/js/plugins/flot/jquery.flot.js') }}"></script>
            <script src="{{ asset('templates/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
            <script src="{{ asset('templates/js/plugins/flot/jquery.flot.spline.js') }}"></script>
            <script src="{{ asset('templates/js/plugins/flot/jquery.flot.resize.js') }}"></script>
            <script src="{{ asset('templates/js/plugins/flot/jquery.flot.pie.js') }}"></script>
            <script src="{{ asset('templates/js/plugins/flot/jquery.flot.symbol.js') }}"></script>
            <script src="{{ asset('templates/js/plugins/flot/jquery.flot.time.js') }}"></script>


            <!-- Peity -->
            <script src="{{ asset('templates/js/plugins/peity/jquery.peity.min.js') }}"></script>
            <script src="{{ asset('templates/js/demo/peity-demo.js') }}"></script>

            <!-- Custom and plugin javascript -->
            <script src="{{ asset('templates/js/inspinia.js') }}"></script>
            <script src="{{ asset('templates/js/plugins/pace/pace.min.js') }}"></script>

            <!-- jQuery UI -->
            <script src="{{ asset('templates/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

            <!-- Jvectormap -->
            <script src="{{ asset('templates/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
            <script src="{{ asset('templates/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

            <!-- EayPIE -->
            <script src="{{ asset('templates/js/plugins/easypiechart/jquery.easypiechart.js') }}"></script>

            <!-- Sparkline -->
            <script src="{{ asset('templates/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

            <!-- Sparkline demo data  -->
            <script src="{{ asset('templates/js/demo/sparkline-demo.js') }}"></script>

            <!-- Data tables -->
            <script src="{{ asset('templates/js/plugins/dataTables/datatables.min.js') }}"></script>
            <script src="{{ asset('templates/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>


            <!-- Sweet alert -->
            <script src="{{ asset('templates/js/plugins/sweetalert/sweetalert.min.js') }}"></script>

            <!-- Toastr script -->
            <script src="{{ asset('templates/js/plugins/toastr/toastr.min.js') }}"></script>

            <!-- Latest compiled and minified JavaScript -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js">
            </script>

            <!-- Steps -->
            <script src="{{ asset('templates/js/plugins/steps/jquery.steps.min.js') }}"></script>

            <!-- Jquery Validate -->
            <script src="{{ asset('templates/js/plugins/validate/jquery.validate.min.js') }}"></script>
            <script src="{{ asset('templates/js/dropzone.js') }}"></script>
            <!-- <script src="{{ asset('templates/js/dropzone.js') }}"></script> -->
            <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.js" integrity="sha512-8l10HpXwk93V4i9Sm38Y1F3H4KJlarwdLndY9S5v+hSAODWMx3QcAVECA23NTMKPtDOi53VFfhIuSsBjjfNGnA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->



            <!-- Image uploader -->

            <!-- Create scripts -->
            @yield('script')
            <script>
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

                $(document).ready(function () {
                    $('.chart').easyPieChart({
                        barColor: '#f8ac59',
                        //                scaleColor: false,
                        scaleLength: 5,
                        lineWidth: 4,
                        size: 80
                    });

                    $('.chart2').easyPieChart({
                        barColor: '#1c84c6',
                        //                scaleColor: false,
                        scaleLength: 5,
                        lineWidth: 4,
                        size: 80
                    });

                    var data2 = [
                        [gd(2012, 1, 1), 7],
                        [gd(2012, 1, 2), 6],
                        [gd(2012, 1, 3), 4],
                        [gd(2012, 1, 4), 8],
                        [gd(2012, 1, 5), 9],
                        [gd(2012, 1, 6), 7],
                        [gd(2012, 1, 7), 5],
                        [gd(2012, 1, 8), 4],
                        [gd(2012, 1, 9), 7],
                        [gd(2012, 1, 10), 8],
                        [gd(2012, 1, 11), 9],
                        [gd(2012, 1, 12), 6],
                        [gd(2012, 1, 13), 4],
                        [gd(2012, 1, 14), 5],
                        [gd(2012, 1, 15), 11],
                        [gd(2012, 1, 16), 8],
                        [gd(2012, 1, 17), 8],
                        [gd(2012, 1, 18), 11],
                        [gd(2012, 1, 19), 11],
                        [gd(2012, 1, 20), 6],
                        [gd(2012, 1, 21), 6],
                        [gd(2012, 1, 22), 8],
                        [gd(2012, 1, 23), 11],
                        [gd(2012, 1, 24), 13],
                        [gd(2012, 1, 25), 7],
                        [gd(2012, 1, 26), 9],
                        [gd(2012, 1, 27), 9],
                        [gd(2012, 1, 28), 8],
                        [gd(2012, 1, 29), 5],
                        [gd(2012, 1, 30), 8],
                        [gd(2012, 1, 31), 25]
                    ];

                    var data3 = [
                        [gd(2012, 1, 1), 800],
                        [gd(2012, 1, 2), 500],
                        [gd(2012, 1, 3), 600],
                        [gd(2012, 1, 4), 700],
                        [gd(2012, 1, 5), 500],
                        [gd(2012, 1, 6), 456],
                        [gd(2012, 1, 7), 800],
                        [gd(2012, 1, 8), 589],
                        [gd(2012, 1, 9), 467],
                        [gd(2012, 1, 10), 876],
                        [gd(2012, 1, 11), 689],
                        [gd(2012, 1, 12), 700],
                        [gd(2012, 1, 13), 500],
                        [gd(2012, 1, 14), 600],
                        [gd(2012, 1, 15), 700],
                        [gd(2012, 1, 16), 786],
                        [gd(2012, 1, 17), 345],
                        [gd(2012, 1, 18), 888],
                        [gd(2012, 1, 19), 888],
                        [gd(2012, 1, 20), 888],
                        [gd(2012, 1, 21), 987],
                        [gd(2012, 1, 22), 444],
                        [gd(2012, 1, 23), 999],
                        [gd(2012, 1, 24), 567],
                        [gd(2012, 1, 25), 786],
                        [gd(2012, 1, 26), 666],
                        [gd(2012, 1, 27), 888],
                        [gd(2012, 1, 28), 900],
                        [gd(2012, 1, 29), 178],
                        [gd(2012, 1, 30), 555],
                        [gd(2012, 1, 31), 993]
                    ];


                    var dataset = [{
                        label: "Number of orders",
                        data: data3,
                        color: "#1ab394",
                        bars: {
                            show: true,
                            align: "center",
                            barWidth: 24 * 60 * 60 * 600,
                            lineWidth: 0
                        }

                    }, {
                        label: "Payments",
                        data: data2,
                        yaxis: 2,
                        color: "#1C84C6",
                        lines: {
                            lineWidth: 1,
                            show: true,
                            fill: true,
                            fillColor: {
                                colors: [{
                                    opacity: 0.2
                                }, {
                                    opacity: 0.4
                                }]
                            }
                        },
                        splines: {
                            show: false,
                            tension: 0.6,
                            lineWidth: 1,
                            fill: 0.1
                        },
                    }];


                    var options = {
                        xaxis: {
                            mode: "time",
                            tickSize: [3, "day"],
                            tickLength: 0,
                            axisLabel: "Date",
                            axisLabelUseCanvas: true,
                            axisLabelFontSizePixels: 12,
                            axisLabelFontFamily: 'Arial',
                            axisLabelPadding: 10,
                            color: "#d5d5d5"
                        },
                        yaxes: [{
                            position: "left",
                            max: 1070,
                            color: "#d5d5d5",
                            axisLabelUseCanvas: true,
                            axisLabelFontSizePixels: 12,
                            axisLabelFontFamily: 'Arial',
                            axisLabelPadding: 3
                        }, {
                            position: "right",
                            clolor: "#d5d5d5",
                            axisLabelUseCanvas: true,
                            axisLabelFontSizePixels: 12,
                            axisLabelFontFamily: ' Arial',
                            axisLabelPadding: 67
                        }],
                        legend: {
                            noColumns: 1,
                            labelBoxBorderColor: "#000000",
                            position: "nw"
                        },
                        grid: {
                            hoverable: false,
                            borderWidth: 0
                        }
                    };

                    function gd(year, month, day) {
                        return new Date(year, month - 1, day).getTime();
                    }

                    var previousPoint = null,
                        previousLabel = null;

                    $.plot($("#flot-dashboard-chart"), dataset, options);

                    var mapData = {
                        "US": 298,
                        "SA": 200,
                        "DE": 220,
                        "FR": 540,
                        "CN": 120,
                        "AU": 760,
                        "BR": 550,
                        "IN": 200,
                        "GB": 120,
                    };

                    $('#world-map').vectorMap({
                        map: 'world_mill_en',
                        backgroundColor: "transparent",
                        regionStyle: {
                            initial: {
                                fill: '#e4e4e4',
                                "fill-opacity": 0.9,
                                stroke: 'none',
                                "stroke-width": 0,
                                "stroke-opacity": 0
                            }
                        },

                        series: {
                            regions: [{
                                values: mapData,
                                scale: ["#1ab394", "#22d6b1"],
                                normalizeFunction: 'polynomial'
                            }]
                        },
                    });
                });

            </script>
</body>

</html>
