@extends('layouts.landingPage.main')

@section('content')
<br>
<div class="body-content">
    <div class="container">
        <div class="blog-page">
            <div class="col-xs-12 col-sm-12 col-md-12 rht-col">

                @foreach ($kosts as $kost)
                <div class="blog-post @if ($loop->iteration > 1)
                    outer-top-bd
                @endif  wow fadeInUp">
                    <a href="blog-details.html"><img class="img-responsive" style="width: 1000px; height: 600px;"
                            src="{{ asset('storage/images/kost/'.$kost->firstKostImage()->image) }}" alt=""></a>
                    <h1><a href="berita-detail.php">{{$kost->name}}</a></h1>
                    <span class="author">{{$kost->kostOwner->first_name}} {{$kost->kostOwner->last_name}}</span>
                    <span class="review">6 Comments</span>
                    <span class="date-time">{{$kost->created_at->format('d/m/Y h.mA')}}</span>
                    <p>@if ($kost->note)
                        <?php echo nl2br(htmlspecialchars($kost->note)); ?>
                        @else
                        Belum ada deskripsi kos
                        @endif</p>
                    <a href="berita-detail.php" class="btn btn-upper btn-primary read-more">read more</a>
                </div>
                @endforeach

                <div class="clearfix blog-pagination filters-container  wow fadeInUp"
                    style="padding:0px; background:none; box-shadow:none; margin-top:15px; border:none">

                    <div class="text-right">
                        <div class="pagination-container">
                            {{ $kosts->appends(Request::except('page'))->links('layouts.vendor.pagination1') }}
                        </div>
                    </div><!-- /.text-right -->

                </div><!-- /.filters-container -->
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 sidebar">
                <div class="sidebar-module-container">
                    <div class="search-area outer-bottom-small">
                        <form>
                            <div class="control-group">
                                <input placeholder="Type to search" class="search-field">
                                <a href="#" class="search-button"></a>
                            </div>
                        </form>
                    </div>

                    <div class="home-banner outer-top-n outer-bottom-xs">
                        <img src="{{ asset('templateLandings/assets/images/banners/LHS-banner.jpg') }}" alt="Image">
                    </div>
                    <!-- ==============================================CATEGORY============================================== -->
                    <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
                        <h3 class="section-title">Category</h3>
                        <div class="sidebar-widget-body m-t-10">
                            <div class="accordion">
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a href="#collapseOne" data-toggle="collapse"
                                            class="accordion-toggle collapsed">
                                            Camera
                                        </a>
                                    </div><!-- /.accordion-heading -->
                                    <div class="accordion-body collapse" id="collapseOne" style="height: 0px;">
                                        <div class="accordion-inner">
                                            <ul>
                                                <li><a href="#">gaming</a></li>
                                                <li><a href="#">office</a></li>
                                                <li><a href="#">kids</a></li>
                                                <li><a href="#">for women</a></li>
                                            </ul>
                                        </div><!-- /.accordion-inner -->
                                    </div><!-- /.accordion-body -->
                                </div><!-- /.accordion-group -->

                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a href="#collapseTwo" data-toggle="collapse"
                                            class="accordion-toggle collapsed">
                                            Desktops
                                        </a>
                                    </div><!-- /.accordion-heading -->
                                    <div class="accordion-body collapse" id="collapseTwo" style="height: 0px;">
                                        <div class="accordion-inner">
                                            <ul>
                                                <li><a href="#">gaming</a></li>
                                                <li><a href="#">office</a></li>
                                                <li><a href="#">kids</a></li>
                                                <li><a href="#">for women</a></li>
                                            </ul>
                                        </div><!-- /.accordion-inner -->
                                    </div><!-- /.accordion-body -->
                                </div><!-- /.accordion-group -->

                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a href="#collapseThree" data-toggle="collapse"
                                            class="accordion-toggle collapsed">
                                            Pants
                                        </a>
                                    </div><!-- /.accordion-heading -->
                                    <div class="accordion-body collapse" id="collapseThree" style="height: 0px;">
                                        <div class="accordion-inner">
                                            <ul>
                                                <li><a href="#">gaming</a></li>
                                                <li><a href="#">office</a></li>
                                                <li><a href="#">kids</a></li>
                                                <li><a href="#">for women</a></li>
                                            </ul>
                                        </div><!-- /.accordion-inner -->
                                    </div><!-- /.accordion-body -->
                                </div><!-- /.accordion-group -->

                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a href="#collapseFour" data-toggle="collapse"
                                            class="accordion-toggle collapsed">
                                            Bags
                                        </a>
                                    </div><!-- /.accordion-heading -->
                                    <div class="accordion-body collapse" id="collapseFour" style="height: 0px;">
                                        <div class="accordion-inner">
                                            <ul>
                                                <li><a href="#">gaming</a></li>
                                                <li><a href="#">office</a></li>
                                                <li><a href="#">kids</a></li>
                                                <li><a href="#">for women</a></li>
                                            </ul>
                                        </div><!-- /.accordion-inner -->
                                    </div><!-- /.accordion-body -->
                                </div><!-- /.accordion-group -->

                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a href="#collapseFive" data-toggle="collapse"
                                            class="accordion-toggle collapsed">
                                            Hats
                                        </a>
                                    </div><!-- /.accordion-heading -->
                                    <div class="accordion-body collapse" id="collapseFive" style="height: 0px;">
                                        <div class="accordion-inner">
                                            <ul>
                                                <li><a href="#">gaming</a></li>
                                                <li><a href="#">office</a></li>
                                                <li><a href="#">kids</a></li>
                                                <li><a href="#">for women</a></li>
                                            </ul>
                                        </div><!-- /.accordion-inner -->
                                    </div><!-- /.accordion-body -->
                                </div><!-- /.accordion-group -->

                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a href="#collapseSix" data-toggle="collapse"
                                            class="accordion-toggle collapsed">
                                            Accessories
                                        </a>
                                    </div><!-- /.accordion-heading -->
                                    <div class="accordion-body collapse" id="collapseSix" style="height: 0px;">
                                        <div class="accordion-inner">
                                            <ul>
                                                <li><a href="#">gaming</a></li>
                                                <li><a href="#">office</a></li>
                                                <li><a href="#">kids</a></li>
                                                <li><a href="#">for women</a></li>
                                            </ul>
                                        </div><!-- /.accordion-inner -->
                                    </div><!-- /.accordion-body -->
                                </div><!-- /.accordion-group -->

                            </div><!-- /.accordion -->
                        </div><!-- /.sidebar-widget-body -->
                    </div><!-- /.sidebar-widget -->
                    <!-- ============================================== CATEGORY : END ============================================== -->
                    
                    <!-- ============================================== PRODUCT TAGS ============================================== -->
                    <div class="sidebar-widget product-tag wow fadeInUp">
                        <h3 class="section-title">Product Tags</h3>
                        <div class="sidebar-widget-body outer-top-xs">
                            <div class="tag-list">
                                <a class="item" title="Phone" href="category.html">Phone</a>
                                <a class="item active" title="Vest" href="category.html">Vest</a>
                                <a class="item" title="Smartphone" href="category.html">Smartphone</a>
                                <a class="item" title="Furniture" href="category.html">Furniture</a>
                                <a class="item" title="T-shirt" href="category.html">T-shirt</a>
                                <a class="item" title="Sweatpants" href="category.html">Sweatpants</a>
                                <a class="item" title="Sneaker" href="category.html">Sneaker</a>
                                <a class="item" title="Toys" href="category.html">Toys</a>
                                <a class="item" title="Rose" href="category.html">Rose</a>
                            </div><!-- /.tag-list -->
                        </div><!-- /.sidebar-widget-body -->
                    </div><!-- /.sidebar-widget -->
                    <!-- ============================================== PRODUCT TAGS : END ============================================== -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
