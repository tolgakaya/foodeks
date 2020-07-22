@extends('frontend.layouts.layout')
@section('extracss')
<!-- Radio and check inputs -->
<link href="{{asset('frontend/css/skins/square/grey.css')}}" rel="stylesheet">
<link href="{{asset('frontend/css/ion.rangeSlider.css')}}" rel="stylesheet">
<link href="{{asset('frontend/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">
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

<!-- Content ================================================== -->
<div class="container margin_60_35">
    <div class="row">

        <div class="col-md-3">
            <p><a href="list_page.html" class="btn_side">Back to search</a></p>
            <div class="box_style_1">
                <ul id="cat_nav">
                    @foreach ($meals as $category=> $meal)
                    <li><a href="#{{$category}}" class="active">{{$category}} <span></span></a></li>
                    @endforeach
                </ul>
            </div><!-- End box_style_1 -->

            <div class="box_style_2 hidden-xs" id="help">
                <i class="icon_lifesaver"></i>
                <h4>Need <span>Help?</span></h4>
                <a href="tel://004542344599" class="phone">+45 423 445 99</a>
                <small>Monday to Friday 9.00am - 7.30pm</small>
            </div>
        </div><!-- End col-md-3 -->

        <div class="col-md-6">
            <div class="box_style_2" id="main_menu">
                <h2 class="inner">Menu</h2>

                @foreach ($meals as $category=> $meal)

                <h3 class="nomargin_top" id="{{$category}}">{{$category}}</h3>
                <p>
                    Te ferri iisque aliquando pro, posse nonumes efficiantur in cum. Sensibus reprimique eu pro.
                    Fuisset mentitum deleniti sit ea.
                </p>

                <table class="table table-striped cart-list">
                    <thead>
                        <tr>
                            <th>
                                Item
                            </th>
                            <th>
                                Price
                            </th>
                            <th>
                                Order
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($meal as $m)
                        <tr>
                            <td>
                                <figure class="thumb_menu_list"><img src="img/menu-thumb-1.jpg" alt="thumb">
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
                                        <h5>Extralar</h5>
                                        @foreach ($m->extras as $ex)
                                        <label>
                                            <input type="checkbox" value="{{$ex->id}}"
                                                name="extra{{$m->id}}">{{$ex->extra}} <span>+
                                                {{$ex->fee}}
                                                TL</span>
                                        </label>
                                        @endforeach
                                        @endif
                                        <a id="{{$m->id}}" class="add_to_basket">Sepete Ekle</a>
                                    </div>
                                </div>
                            </td>


                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <hr>
                @endforeach


            </div><!-- End box_style_1 -->
        </div><!-- End col-md-6 -->

        <div class="col-md-3" id="sidebar">
            <div class="theiaStickySidebar">
                <div id="cart_box">
                    <h3>Siparişiniz<i class="icon_cart_alt pull-right"></i></h3>
                    <table class="table table_summary">
                        <tbody>
                            <tr>
                                <td>
                                    <a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a>
                                    <strong>1x</strong> Enchiladas
                                </td>
                                <td>
                                    <strong class="pull-right">$11</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <div class="row" id="options_2">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                            <label><input type="radio" value="" checked name="option_2" class="icheck">Delivery</label>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                            <label><input type="radio" value="" name="option_2" class="icheck">Take Away</label>
                        </div>
                    </div><!-- Edn options 2 -->

                    <hr>
                    <table class="table table_summary">
                        <tbody>
                            <tr>
                                <td>
                                    Subtotal <span class="pull-right">$56</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Delivery fee <span class="pull-right">$10</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="total">
                                    TOTAL <span class="pull-right">$66</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <a class="btn_full" href="cart.html">Order now</a>
                </div><!-- End cart_box -->
            </div><!-- End theiaStickySidebar -->
        </div><!-- End col-md-3 -->

    </div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->
@endsection

@section('specialscript')
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
<script>
    $(document).ready(function () {
  
        $(".add_to_basket").click(function() {
           var mealid=$(this).attr('id');
           var fiyat=$("#fiyat"+mealid).val();
           var idd="option"+mealid;
           var optionid=$("input[name = " + idd+ "]:checked").val();

           var exid="extra"+mealid;
           var extras = [];
            $.each($("input[name = " + exid+ "]:checked"), function(){
            extras.push($(this).val());
            console.log($(this).val());
            });
                    var mealModel = {
                    mealid: mealid,
                    fiyat:fiyat,
                    miktar:1,
                    optionid:optionid,
                    extras:extras
                    };
                    $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    url: "/cart/add",
                    data:JSON.stringify( mealModel),
                    type: "POST",
                    contentType: "application/json;charset=UTF-8",
                    dataType: "json",
                    success: function (result) {
                    // var bosalt=$('#tekil'+silinecekMeal);
                    // bosalt.empty();
                    console.log(result);
                    },
                    error: function (errormessage) {
                    alert(errormessage.responseText);
                    }
                    });
        });
});
</script>
@endsection