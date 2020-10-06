@extends('frontend.layouts.layout')
@section('extracss')
<!-- Radio and check inputs -->
<link href="{{asset('css/skins/square/grey.css')}}" rel="stylesheet">
@endsection
@section('subheader')
<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll"
    data-image-src="{{$paralax !=null ? $paralax->paralax() : asset('frontend/img/adana_web.jpg')}}"
    data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
            <h1>{{$settings->company ?? 'Hakkımızda'}}</h1>
            <p>{{$page->title ?? 'Eşsiz Adana Lezzetleri'}}</p>
            <p></p>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->
@endsection

@section('main')

<div class="collapse" id="collapseMap">
    <div id="map" class="map"></div>
</div><!-- End Map -->

<div class="container">
    <div class="row">

        <div class="col-md-4">
            <p>
                <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false"
                    aria-controls="collapseMap">Haritada Gör</a>
            </p>
            <div class="box_style_2">
                <h4 class="nomargin_top">Servis Zamanları <i class="icon_clock_alt pull-right"></i></h4>
                <ul class="opening_list">

                    @if (!empty($bookRestaurant->RestaurantTimes))
                    @for($i = 1; $i <= count($bookRestaurant->RestaurantTimes); $i++)

                        <li>{{$bookRestaurant->dayName($i)}}<span>
                                {{$bookRestaurant->RestaurantTimes[$i-1]->openning_time}} -
                                {{$bookRestaurant->RestaurantTimes[$i-1]->closing_time}}
                            </span></li>
                        @endfor
                        @endif
                </ul>
            </div>
            <div class="box_style_2 hidden-xs" id="help">
                <i class="icon_lifesaver"></i>
                <h4>Yardıma mı <span>İhtiyacınız var?</span></h4>
                <a href="tel://{{$bookRestaurant->phone}}" class="phone">{{$bookRestaurant->phone}}</a>
                @if (count($bookRestaurant->RestaurantTimes)>0)
                <small>{{$bookRestaurant->RestaurantTimes[0]->openning_time}} -
                    {{$bookRestaurant->RestaurantTimes[0]->closing_time}}</small>
                @endif
            </div>
        </div>

        <div class="col-md-8">
            <div class="box_style_2">
                <h2 class="inner">{{$page !=null ? $page->title: '%100 Adana Lezzetleri'}}</h2>
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        @foreach ($medias as $key=> $media)
                        <li data-target="#myCarousel" data-slide-to="{{$key}}" class="{{$key==0 ? 'active' : ''}}"></li>
                        @endforeach
                    </ol>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        @foreach ($medias as $key =>$media)
                        <div class="item {{$key==0 ? 'active': ''}}">
                            <img src="{{$media->path()}}" alt="Adanadayım">
                        </div>
                        @endforeach
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Geri</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">İleri</span>
                    </a>
                </div>
                {!! $page->text ?? 'Hakkımızda' !!}
            </div><!-- End box_style_1 -->
        </div>
    </div><!-- End row -->
</div><!-- End container -->


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