@extends('frontend.layouts.layout')
@section('subheader')
<!-- SubHeader =============================================== -->
<section class="header-video">
    <div id="hero_video">
        <div id="sub_content">
            <h1>{{$page->slogan ?? 'Adana Lezzeti Kapınızda'}}</h1>
            <p>
                {{$page->sub_slogan ?? 'Adresinizi yazın ve en yakın şubemizden sipariş verin.'}}
            </p>
            <form method="post" action="{{route('searchresult')}}">
                <div id="custom-search-input">
                    <div class="input-group">
                        @csrf
                        <input type="text" class=" search-query map-input"
                            placeholder="Tam adresinizi yazarak en yakın şubeyi bulabilirsiniz" id="address-input"
                            name="address_address">
                        <input type="hidden" name="address_latitude" id="address-latitude" value="0" />
                        <input type="hidden" name="address_longitude" id="address-longitude" value="0" />
                        <span class="input-group-btn">
                            <input type="submit" class="btn_search" value="submit">
                        </span>
                    </div>
                </div>
            </form>
        </div><!-- End sub_content -->
    </div>
    <img src="{{asset('frontend/img/video_fix.png')}}" alt="" class="header-video--media"
        data-video-src="{{asset('frontend/video/intro')}}" data-teaser-source="{{asset('frontend/video/intro')}}"
        data-provider="Vimeo" data-video-width="1920" data-video-height="960">
    <div id="count" class="hidden-xs">
        <ul>
            <li><span class="number">75</span> Şube</li>
            <li><span class="number">5350</span> Online Servis</li>
            <li><span class="number">12350</span> Kayıtlı Kullanıcı</li>
        </ul>
    </div>
</section><!-- End Header video -->
<!-- End SubHeader ============================================ -->
<div id="address-map-container" style="display:none; ">
    <div style="width: 0%; height: 0%" id="address-map"></div>
</div>
@endsection

@section('main')
<!-- Content ================================================== -->
<div class="container margin_60">

    @if ($page == null || $page->show_how)

    <div class="main_title">
        <h2 class="nomargin_top home_baslik" style="padding-top:0">Nasıl Çalışır</h2>
        <p>
            Adana lezzetleri bir kaç tık uzağınızda
        </p>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="box_home" id="one">
                <span>1</span>
                <h3>Adrese göre arayın</h3>
                <p>
                    En yakın restaurantı bulun.
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box_home" id="two">
                <span>2</span>
                <h3>Restaurantı seçin</h3>
                <p>
                    Restaurantlar size yakınlığına göre sıralanır
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box_home" id="three">
                <span>3</span>
                <h3>Ödeme</h3>
                <p>
                    Ödemeyi teslimatta yapın
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box_home" id="four">
                <span>4</span>
                <h3>Lezzetler Kapınızda</h3>
                <p>
                    Siparişiniz en kısa sürede kapınızda
                </p>
            </div>
        </div>
    </div><!-- End row -->

    @endif
</div><!-- End container -->
@if ($page==null || $page->paralax_show == true)
<section class="parallax-window" data-parallax="scroll"
    data-image-src="{{$page !=null ? $page->paralax() : asset('frontend/img/adana_web.jpg')}}" data-natural-width="1200"
    data-natural-height="600">
    <div class="parallax-content">
        <div class="sub_content">
            <i class="icon_mug"></i>
            <h3>{{$page->paralax_text ??  ' Rezervasyon ve Paket Servis'}}</h3>
            <p>
                {{$page->paralax_sub_text ?? 'Adana lezzetlerini kapınıza getiriyorsunuz. Dilerseniz özel günleriniz için rezervasyon kabul ediyoruz.'}}
            </p>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section>
@endif
<div class="white_bg">
    <div class="container margin_60">

        <div class="main_title">
            <h2 class="nomargin_top home_baslik">Popüler Şubeler</h2>
            <p>
                Şubelerden seçerek menüleri görebilir ve sipariş verebilirsiniz.
            </p>
        </div>
        @if ($page==null || $page->restaurant_list_show)
        <div class="row">
            @foreach ($restaurants as $restaurant)
            <div class="col-md-6">
                <a href="{{$restaurant->menus()->count() != 0 ? route('restaurants.menu',['restaurant'=>$restaurant->id]) : '#'}}"
                    class="strip_list">
                    <div class="ribbon_1">Popular</div>
                    <div class="desc">
                        <div class="thumb_strip">
                            <img src="{{$restaurant->restaurantAvatar()}}" alt="">
                        </div>
                        <div class="rating">
                            <i class="icon_star voted"></i><i class="icon_star voted"></i><i
                                class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                        </div>
                        <h3>{{$restaurant->name}}</h3>
                        <div class="type">
                            {{$restaurant->isAvailable()==true ? $restaurant->openCloseTimes()['close'].'a kadar sipariş verin' : 'Servis zamanı dışında'  }}
                        </div>
                        <div class="location">
                            {{$restaurant->description}}
                        </div>
                        <ul>
                            <li>Açılış {{$restaurant->openCloseTimes()['open']}}<i class="icon_check_alt2 ok"></i>
                            </li>
                            <li>Kapanış {{$restaurant->openCloseTimes()['close']}}<i class="icon_check_alt2 no"></i>
                            </li>
                        </ul>
                    </div><!-- End desc-->
                </a>
            </div>
            @endforeach


        </div><!-- End row -->
        @endif


    </div><!-- End container -->
</div><!-- End white_bg -->

@if ($page==null || $page->paralax_show == true)
<section class="parallax-window" data-parallax="scroll"
    data-image-src="{{$page !=null ? $page->paralax_second() : asset('frontend/img/adana_web.jpg')}}"
    data-natural-width="1200" data-natural-height="600">
    <div class="parallax-content">
        <div class="sub_content">
            <i class="icon_mug"></i>
            <h3>{{$page->paralax_text2 ??  ' Rezervasyon ve Paket Servis'}}</h3>
            <p>
                {{$page->paralax_sub_text2 ?? 'Adana lezzetlerini kapınıza getiriyorsunuz. Dilerseniz özel günleriniz için rezervasyon kabul ediyoruz.'}}
            </p>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section>
@endif
<!-- End Content =============================================== -->

@endsection

@section('specialscript')
<script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize"
    async defer></script>
<script src="{{asset('frontend/js/mapInput.js')}}"></script>

<!-- SPECIFIC SCRIPTS -->
<script src="{{asset('frontend/js/video_header.js')}}"></script>
<script>
    $(document).ready(function () {
    'use strict';
    HeaderVideo.init({
    container: $('.header-video'),
    header: $('.header-video--media'),
    videoTrigger: $("#video-trigger"),
    autoPlayVideo: true
    });
    
    });
    
   
</script>
@endsection