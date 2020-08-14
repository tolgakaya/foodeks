@extends('frontend.layouts.layout')
@section('extracss')
<!-- Radio and check inputs -->
<link href="{{asset('css/skins/square/grey.css')}}" rel="stylesheet">
<link href="{{asset('css/ion.rangeSlider.css')}}" rel="stylesheet">
<link href="{{asset('css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">
@endsection

@section('subheader')
<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll"
    data-image-src="{{asset('img/sub_header_short.jpg')}}" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
            <h1>24 results in your zone</h1>
            <div><i class="icon_pin"></i> 135 Newtownards Road, Belfast, BT4 1AB</div>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->
@endsection
@section('main')
<div id="position">
    <div class="container">
        <ul>
            <li><a href="#0">Home</a></li>
            <li><a href="#0">Category</a></li>
            <li>Page active</li>
        </ul>
        <a href="#0" class="search-overlay-menu-btn"><i class="icon-search-6"></i> Search</a>
    </div>
</div><!-- Position -->

<div class="collapse" id="collapseMap">
    <div id="map" class="map"></div>
</div><!-- End Map -->

<!-- Content ================================================== -->
<div class="container margin_60_35">
    <div class="row">

        <div class="col-md-3">
            <p>
                <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false"
                    aria-controls="collapseMap">View on map</a>
            </p>
            <div id="filters_col">
                <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters"
                    id="filters_col_bt">Filters <i class="icon-plus-1 pull-right"></i></a>
                <div class="collapse" id="collapseFilters">
                    <div class="filter_type">
                        <h6>Distance</h6>
                        <input type="text" id="range" value="" name="range">
                        <h6>Type</h6>
                        <ul>
                            <li><label><input type="checkbox" checked class="icheck">All <small>(49)</small></label>
                            </li>
                            <li><label><input type="checkbox" class="icheck">American <small>(12)</small></label><i
                                    class="color_1"></i></li>
                            <li><label><input type="checkbox" class="icheck">Chinese <small>(5)</small></label><i
                                    class="color_2"></i></li>
                            <li><label><input type="checkbox" class="icheck">Hamburger <small>(7)</small></label><i
                                    class="color_3"></i></li>
                            <li><label><input type="checkbox" class="icheck">Fish <small>(1)</small></label><i
                                    class="color_4"></i></li>
                            <li><label><input type="checkbox" class="icheck">Mexican <small>(49)</small></label><i
                                    class="color_5"></i></li>
                            <li><label><input type="checkbox" class="icheck">Pizza <small>(22)</small></label><i
                                    class="color_6"></i></li>
                            <li><label><input type="checkbox" class="icheck">Sushi <small>(43)</small></label><i
                                    class="color_7"></i></li>
                        </ul>
                    </div>
                    <div class="filter_type">
                        <h6>Rating</h6>
                        <ul>
                            <li><label><input type="checkbox" class="icheck"><span class="rating">
                                        <i class="icon_star voted"></i><i class="icon_star voted"></i><i
                                            class="icon_star voted"></i><i class="icon_star voted"></i><i
                                            class="icon_star voted"></i>
                                    </span></label></li>
                            <li><label><input type="checkbox" class="icheck"><span class="rating">
                                        <i class="icon_star voted"></i><i class="icon_star voted"></i><i
                                            class="icon_star voted"></i><i class="icon_star voted"></i><i
                                            class="icon_star"></i>
                                    </span></label></li>
                            <li><label><input type="checkbox" class="icheck"><span class="rating">
                                        <i class="icon_star voted"></i><i class="icon_star voted"></i><i
                                            class="icon_star voted"></i><i class="icon_star"></i><i
                                            class="icon_star"></i>
                                    </span></label></li>
                            <li><label><input type="checkbox" class="icheck"><span class="rating">
                                        <i class="icon_star voted"></i><i class="icon_star voted"></i><i
                                            class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i>
                                    </span></label></li>
                            <li><label><input type="checkbox" class="icheck"><span class="rating">
                                        <i class="icon_star voted"></i><i class="icon_star"></i><i
                                            class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i>
                                    </span></label></li>
                        </ul>
                    </div>
                    <div class="filter_type">
                        <h6>Options</h6>
                        <ul class="nomargin">
                            <li><label><input type="checkbox" class="icheck">Delivery</label></li>
                            <li><label><input type="checkbox" class="icheck">Take Away</label></li>
                            <li><label><input type="checkbox" class="icheck">Distance 10Km</label></li>
                            <li><label><input type="checkbox" class="icheck">Distance 5Km</label></li>
                        </ul>
                    </div>
                </div>
                <!--End collapse -->
            </div>
            <!--End filters col-->
        </div>
        <!--End col-md -->

        <div class="col-md-9">

            <div id="tools">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="styled-select">
                            <select name="sort_rating" id="sort_rating">
                                <option value="" selected>Sort by ranking</option>
                                <option value="lower">Lowest ranking</option>
                                <option value="higher">Highest ranking</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-9 hidden-xs">
                        <a href="{{$viewType=='list'? route('restaurants.index','grid') :  route('restaurants.index','list')}}"
                            class="bt_filters"><i class="{{$viewType=='list'? 'icon-th' :  'icon-list'}}"></i></a>
                    </div>
                </div>
            </div>
            <!--End tools -->

            @if ($viewType=='list')
            @foreach($restaurants as $restaurant )
            <div class="strip_list wow fadeIn" data-wow-delay="0.1s">
                <div class="ribbon_1">
                    Popular
                </div>
                <div class="row">
                    <div class="col-md-9 col-sm-9">
                        <div class="desc">
                            <div class="thumb_strip">
                                <a href="{{route('restaurants.show',[$restaurant->id])}}"><img
                                        src="{{asset('img/thumb_restaurant.jpg')}}" alt=""></a>
                            </div>
                            <div class="rating">
                                <i class="icon_star voted"></i><i class="icon_star voted"></i><i
                                    class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                                (<small><a href="#0">98 reviews</a></small>)
                            </div>
                            <h3>{{$restaurant->name}}</h3>
                            <div class="type">
                                {{$restaurant->isAvailable()==true ? $restaurant->openCloseTimes()['close'].'a kadar sipariş verin' : 'Servis zamanı dışında'  }}
                            </div>
                            <div class="location">
                                {{-- 135 Newtownards Road, Belfast, BT4. <span class="opening">Opens at 17:00.</span>
                                Minimum order: $15 --}}
                                {{$restaurant->description}} <span class="opening">{{round($restaurant->distance, 2)}}
                                    km</span>
                            </div>
                            <ul>
                                <li>Açılış {{$restaurant->openCloseTimes()['open']}}<i class="icon_check_alt2 ok"></i>
                                </li>
                                <li>Kapanış {{$restaurant->openCloseTimes()['close']}}<i class="icon_check_alt2 no"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="go_to">
                            <div>
                                <a href="{{route('restaurants.menu',['restaurant'=>$restaurant->id])}}"
                                    class="btn_1">Menüye Bakın</a>
                            </div>
                        </div>
                    </div>
                </div><!-- End row-->
            </div><!-- End strip_list-->
            @endforeach

            @endif

            <a href="#0" class="load_more_bt wow fadeIn" data-wow-delay="0.2s">Load more...</a>
        </div><!-- End col-md-9-->

    </div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->

<!-- Search Menu -->
<div class="search-overlay-menu">
    <span class="search-overlay-close"><i class="icon_close"></i></span>
    <form role="search" id="searchform" method="get">
        <input value="" name="q" type="search" placeholder="Search..." />
        <button type="submit"><i class="icon-search-6"></i>
        </button>
    </form>
</div>
<!-- End Search Menu -->
@endsection
@section('specialscript')
<!-- SPECIFIC SCRIPTS -->
<script src="{{asset('js/cat_nav_mobile.js')}}"></script>
<script>
    $('#cat_nav').mobileMenu();
</script>
{{-- <script src="http://maps.googleapis.com/maps/api/js"></script>
<script src="{{asset('js/map.js')}}"></script>
<script src="{{asset('js/infobox.js')}}"></script> --}}
{{-- <script src="{{asset('js/ion.rangeSlider.js')}}"></script> --}}
{{-- <script>
    $(function () {
        			'use strict';
        			$("#range").ionRangeSlider({
        				hide_min_max: true,
        				keyboard: true,
        				min: 0,
        				max: 15,
        				from: 0,
        				to: 5,
        				type: 'double',
        				step: 1,
        				prefix: "Km ",
        				grid: true
        			});
        		});
</script> --}}

<!--GMap Plugin -->
<script src="https://maps.google.com/maps/api/js?key=AIzaSyDudjGDbcq3lKGFqFsHdGWZNgWOsNX4gjs"></script>
<script src="{{asset('frontend/js/restaurants.js')}}"></script>
<script>
    $( document ).ready(function() {
                    // console.log( "document loaded" );
                    // initializeMusteriler();
                });
             $('#collapseMap').on('shown.bs.collapse', function (e) {
            initializeMusteriler();
            
        });
                // $( window ).on( "load", function() {
                //     console.log( "window loaded" );
                //     initializeMusteriler();
                // });
</script>
@endsection