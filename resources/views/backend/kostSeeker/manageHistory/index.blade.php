@extends('layouts.landingPage.main')

@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content">
    <div class="container">
        <div class="my-wishlist-page">
            <div class="row">
                <div class="col-md-12 my-wishlist">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="4" class="heading-title">Riwayat Pemesanan Kamar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($histories as $history)
                                <tr>
                                    <td class="col-md-2 col-sm-6 col-xs-6"><img
                                            src="{{ asset('storage/images/room/'.$history->rent->room->roomType->firstImage()->image) }}"
                                            alt="image"></td>
                                    <td class="col-md-7 col-sm-6 col-xs-6">
                                        <div class="product-name"><a href="#">{{$history->rent->room->roomType->name}}
                                                &diams;{{$history->rent->room->roomType->kost->name}}</a></div>
                                        <div class="description"><i class="fa fa-calendar" aria-hidden="true"></i>
                                            {{$history->rent->started()->started_at}} hingga
                                            {{$history->rent->ended()->ended_at}}</div>
                                        <div class="description"> {{$history->rent->rentDetail->count()}} kali melakukan
                                            pemesanan</div>
                                        <?php 
                                          $today = new DateTime("today");
                                          $ended = new DateTime($history->rent->ended()->ended_at);
                                        ?>
                                        <div class="description">
                                            @if($today < $ended)
                                            <p><span class="label label-primary">Berjalan</span></p>
                                            @else
                                            <p><span class="label label-danger">Selesai</span></p>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="col-md-2 ">
                                        <a href="{{ route('customer.history.show', $history->id) }}" id="myImg"
                                            class="btn-upper btn btn-primary">Detail Pemesanan</a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.sigin-in-->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        <div id="brands-carousel" class="logo-slider wow fadeInUp">

            <div class="logo-slider-inner">
                <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                    <div class="item m-t-15">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item m-t-10">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand3.png" src="assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand6.png" src="assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->
                </div><!-- /.owl-carousel #logo-slider -->
            </div><!-- /.logo-slider-inner -->

        </div><!-- /.logo-slider -->
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div><!-- /.container -->
</div><!-- /.body-content -->
@endsection

@section('script')
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("modalImg");

    function showImg(src) {
        console.log(src);
        modalImg.src = src;
    }
    // img.onclick = function () {
    //     modal.style.display = "block";
    //     modalImg.src = this.src;
    // }

</script>
@endsection
