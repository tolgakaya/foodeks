@extends('frontend.layouts.layout')
@section('extracss')
<!-- Radio and check inputs -->
<link href="{{asset('frontend/css/skins/square/grey.css')}}" rel="stylesheet">
{{-- <link href="{{asset('frontend/css/ion.rangeSlider.css')}}" rel="stylesheet"> --}}
{{-- <link href="{{asset('frontend/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet"> --}}
<link href="{{asset('frontend/css/loader.css')}}" rel="stylesheet">
{{-- <link href="{{asset('frontend/cart/css/style.css')}}" rel="stylesheet"> --}}
<meta name="_token" content="{{csrf_token()}}" />
<style>
    .app_loader {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
@endsection

@section('subheader')
<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll"
    data-image-src="{{$page !=null ? $page->paralax() : asset('frontend/img/adana_web.jpg')}}" data-natural-width="1400"
    data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
            <h1>{{strtoupper($restaurantMenu->name)}} Menü</h1>
            <div><i class="icon_pin"></i> {{$restaurantMenu->address}}</div>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->
@endsection
@section('main')
<!-- Content ================================================== -->
<div class="container">
    <div class="row">
        <div id='loadergif' class='app_loader' style='display: none; z-index:9999'>
            <div id="cooking">
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div id="area">
                    <div id="sides">
                        <div id="pan"></div>
                        <div id="handle"></div>
                    </div>
                    <div id="pancake">
                        <div id="pastry"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <input type="hidden" value="{{$restaurantMenu->isAvailable()}}" id="isAvailable">
        <input type="hidden" value="{{$menu->id}}" id="menuid">
        <div class="col-md-7">
            <div class="box_style_2" id="main_menu">
                <h2 class="inner">Menu</h2>

                @foreach ($meals as $category=> $meal)

                <h3 class="nomargin_top" id="{{$category}}">{{$category}}</h3>
                <p>
                    Aşağıda + butonunu kullanarak {{$category}} kategorisnden sepete ekleme yapabilirsiniz.
                </p>

                <table class="table table-striped cart-list">
                    <thead>
                        <tr>
                            <th>
                                Ürün
                            </th>
                            <th>
                                Fiyat
                            </th>
                            <th>
                                Sipariş
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($meal as $m)
                        <tr>
                            <td>
                                <figure class="thumb_menu_list"><img src="{{$m->path()}}" alt="thumb">
                                </figure>
                                <h5>{{$m->name}}</h5>
                                <p>
                                    {{$m->description}}
                                </p>
                            </td>
                            <td>
                                <strong>{{$m->pivot->fee}} TL</strong>
                                <input type="hidden" id="fiyat{{$m->id}}" value="{{$m->pivot->fee}}">
                            </td>

                            @if (count($m->options) >0 && count($m->extras) >0)
                            <td class="options">
                                <div class="dropdown dropdown-options">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i
                                            class="icon_plus_alt2"></i></a>
                                    <div class="dropdown-menu">
                                        @if (count($m->options) >0)
                                        <h5>Seçenekler</h5>
                                        @foreach ($m->options as $op)
                                        <label>
                                            <input type="radio" value="{{$op->id}}" name="option{{$m->id}}"
                                                checked>{{$op->option}}
                                            <span>+ {{$op->fee}} TL</span>
                                        </label>
                                        @endforeach
                                        @endif
                                        @if (count($m->extras) >0)
                                        <h5>Ekstralar</h5>
                                        @foreach ($m->extras as $ex)
                                        <label>
                                            <input type="checkbox" value="{{$ex->id}}"
                                                name="extra{{$m->id}}">{{$ex->extra}}
                                            <span>+
                                                {{$ex->fee}}
                                                TL</span>
                                        </label>
                                        @endforeach
                                        @endif
                                        <a id="{{$m->id}}" href="#" class="add_to_basket">Sepete Ekle</a>
                                    </div>
                                </div>
                            </td>
                            @else
                            <td class="options">
                                <div class="dropdown dropdown-options">
                                    <a id="{{$m->id}}" href="#" class="add_to_basket dropdown-toggle "
                                        data-toggle="dropdown" aria-expanded="true"><i class="icon_plus_alt2"></i></a>
                                </div>
                            </td>

                            @endif


                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <hr>
                @endforeach


            </div><!-- End box_style_1 -->
        </div><!-- End col-md-6 -->
        <!-- Image loader -->

        <!-- Image loader -->
        <div class="col-md-5" id="sidebar">
            @include('frontend.restaurants.sidecart')
        </div><!-- End col-md-3 -->

    </div><!-- End row -->
</div><!-- End container -->

<!-- End Content =============================================== -->
@endsection

@section('specialscript')
{{-- <script src="{{asset('frontend/cart/js/util.js')}}"></script>
<script src="{{asset('frontend/cart/js/main.js')}}"></script> --}}
<script src="{{asset('frontend/js/cat_nav_mobile.js')}}"></script>
<script>
    $('#cat_nav').mobileMenu();
</script>
<script src="{{asset('frontend/js/theia-sticky-sidebar.js')}}"></script>
<script>
    jQuery('#sidebar').theiaStickySidebar({
    			additionalMarginTop: 80
    		});
</script>
<script>
    $('#cat_nav a[href^="#"]').on('click', function (e) {
    			e.preventDefault();
    			var target = this.hash;
    			var $target = $(target);
    			$('html, body').stop().animate({
    				'scrollTop': $target.offset().top - 70
    			}, 900, 'swing', function () {
    				window.location.hash = target;
    			});
    		});
</script>

@endsection