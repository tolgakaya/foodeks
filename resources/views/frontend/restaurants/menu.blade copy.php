@extends('frontend.layouts.layout')
@section('extracss')
<!-- Radio and check inputs -->
<link href="{{asset('frontend/css/skins/square/grey.css')}}" rel="stylesheet">
<link href="{{asset('frontend/css/ion.rangeSlider.css')}}" rel="stylesheet">
<link href="{{asset('frontend/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">
<link href="{{asset('frontend/css/loader.css')}}" rel="stylesheet">
<link href="{{asset('frontend/cart/css/style.css')}}" rel="stylesheet">
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
        <input type="hidden" value="{{$menu->id}}" id="menuid">
        <div class="col-md-7">
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
            <div class="theiaStickySidebar">
                <div class="table table-responsive" id="cart_box">
                    <h3>Siparişiniz<i class="icon_cart_alt pull-right"></i></h3>
                    <table class="table table_summary">
                        <tbody id="cartbody" class="cartbody">
                            @foreach($cartItems as $rowid => $row)
                            <tr class="info">
                                <td>
                                    <a href="#0" class="remove_item" id="{{$row->id}}"><i
                                            class="icon_minus_alt"></i></a>
                                    <strong>{{$row->quantity}}X</strong>
                                    @if($row->attributes['option']!==null)

                                    <strong>{{$row->attributes['option']->option}}</strong>

                                    @endif
                                    {{$row->name}}
                                </td>
                                <td>
                                    @if($row->attributes['option']!==null)
                                    <strong
                                        class="pull-right">{{ $row->quantity * ($row->price + $row->attributes['option']->fee)}}
                                        TL</strong>
                                    @else
                                    <strong class="pull-right">{{$row->quantity * $row->price}} TL</strong>
                                    @endif
                                </td>

                            </tr>
                            @foreach($row->attributes['extras'] as $key => $extra)
                            <tr>

                                <td class="pull-right">
                                    {{-- <a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> --}}
                                    <strong>Ekstra </strong>
                                    {{$extra->extra}}
                                </td>
                                <td>
                                    <strong class="pull-right">{{$extra->fee}}</strong>
                                </td>

                            </tr>
                            @endforeach

                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <hr>

                    <table class="table table_summary">
                        <tbody>
                            <tr>
                                <td class="total">
                                    TOPLAM <span class="pull-right">{{$total}} TL</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>

                    <a class="btn_full"
                        href="{{$restaurant->isAvailable()== true ? route('orders.create') : '#'}}">{{$restaurant->isAvailable()== false ? 'Servis Zamanı Dışında' : 'Sipariş Ver'}}</a>
                </div><!-- End cart_box -->
            </div><!-- End theiaStickySidebar -->
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
<script>
    $(document).ready(function () {
  $('body').on('click', '.remove_item', function () {
        var silRow=$(this).attr('id');
     
        var ans = confirm("Kaydı silmek istiyor musunuz?");
        if (ans) {
        var mealModel = {
        rowid: silRow
        };
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                url: "/cart/delete",
                data:JSON.stringify( mealModel),
                type: "POST",
                contentType: "application/json;charset=UTF-8",
                dataType: "json",
                beforeSend: function(){
                        // Show image container
                        $("#loadergif").show();
                        },
                success: function (result) {
                console.log(result);
                                    $('.cartbody').empty();
                                    // $('#cd_cartbody').empty();
                                    $('.total').empty();
                                    var html = '';
                                    var htmlTotal = '';
                                    var htmlQuantity='';
                                    $.each(result.cart, function (key, item) {
                                    var rowPrice=0;
                                    if(item.attributes.option){
                                    rowPrice=parseInt(item.quantity,10) *(parseFloat(item.price) + parseFloat(item.attributes.option.fee));
                                    
                                    }else{
                                    rowPrice=parseInt(item.quantity,10)*parseFloat(item.price);
                                    
                                    }
                                    
                                    html += '<tr class="info">';
                                        html += '<td>';
                                            html+= '<a href="#0" class="remove_item" id="'+item.id+'"><i class="icon_minus_alt"></i></a>';
                                            html+='<strong>'+item.quantity+'X</strong>;'
                                            if(item.attributes.option){
                                            html+= '<strong>'+item.attributes.option.option+'</strong>';
                                            }
                                    
                                            html+= item.name;
                                            html+='</td>';
                                        // $row->quantity * ($row->price + $row->attributes['option']->fee
                                    
                                        html +='<td> <strong class="pull-right">'+rowPrice+'TL</strong> </td> </tr>';
                                    if(item.attributes.extras){
                                    $.each(item.attributes.extras, function (k, ex) {
                                    html+='<tr>';
                                        html+=' <td class="pull-right"><strong>Ekstra </strong>';
                                    
                                            // html+=' <a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a>';
                                            html+= ex.extra;
                                            html+= '</td>';
                                        html+= '<td>';
                                            html+= '<strong class="pull-right">'+ex.fee+'</strong>';
                                            html+='</td>';
                                        html+='</tr>';
                                    });
                                    }
                                    
                                    
                                    });
                                    
                                    htmlTotal +=' <span class="pull-right">'+result.total+'TL</span>';

                                    htmlQuantity +=result.quantity;
                                    $('#quantity').empty();
                                   $('#quantity').append(htmlQuantity);
                                    $('.total').append(htmlTotal);
                                    $('.cartbody').append(html);
                },
                complete:function(data){
                // Hide image container
                $("#loadergif").hide();
                },
        
                error: function (errormessage) {
                alert(errormessage.responseText);
                }
                });

        }
        });

        $(".add_to_basket").click(function(e) {
            e.preventDefault();
           var mealid=$(this).attr('id');
            var menuid=$('#menuid').val();
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
                    menuid:menuid,
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
                    beforeSend: function(){
                            // Show image container
                            $("#loadergif").show();
                            },
                    success: function (result) {
                            // console.log(result);
                            if(result.code=='mix'){
                                // ask for clear cart
                                // var conf=confirm(result.message);
                                if(confirm(result.message)){
                                    console.log('okeeeeeeeeeeey');
                                    return;
                                }
                            }
                              $('.cartbody').empty();
                              $('.total').empty();
                    
                            //   addToCart();
                             var html = '';
                             var htmlTotal = '';
                             var htmlQuantity='';
                            $.each(result.cart, function (key, item) {
                                var rowPrice=0;
                                if(item.attributes.option){
                                                      rowPrice=parseInt(item.quantity,10) *(parseFloat(item.price) + parseFloat(item.attributes.option.fee));
                                                      
                                                        }else{
                                                       rowPrice=parseInt(item.quantity,10)*parseFloat(item.price);
                                               
                                                        }

                                            html += '<tr class="info">';
                                            html += '<td>';
                                       html+= '<a href="#0" class="remove_item" id="'+item.id+'"><i class="icon_minus_alt"></i></a>';
                                            html+='<strong>'+item.quantity+'X</strong>;'
                                            if(item.attributes.option){
                                                html+= '<strong>'+item.attributes.option.option+'</strong>';
                                            }
                                        
                                            html+=  item.name;
                                            html+='</td>';
                                            // $row->quantity * ($row->price + $row->attributes['option']->fee
                  
                                       html +='<td> <strong class="pull-right">'+rowPrice+'TL</strong> </td></tr>';
                                      if(item.attributes.extras){
                                          $.each(item.attributes.extras, function (k, ex) {
                                          html+='<tr>';
                                          html+='  <td class="pull-right"><strong>Ekstra </strong>';

                                                // html+=' <a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a>';
                                               html+= ex.extra;
                                           html+= '</td>';
                                           html+= '<td>';
                                              html+=  '<strong class="pull-right">'+ex.fee+'</strong>';
                                            html+='</td>';
                                        html+='</tr>';
                                          });
                                      }
                                      
                      
                            });

                                htmlTotal +='<span class="pull-right">'+result.total+'TL</span>';
                                $('.total').append(htmlTotal);
                                htmlQuantity +=result.quantity;
                                        $('#quantity').empty();
                                        $('#quantity').append(htmlQuantity);
                              $('.cartbody').append(html);
        
                    },
                    complete:function(data){
                                // Hide image container
                                $("#loadergif").hide();
                                },
                    error: function (errormessage) {
                    alert(errormessage.responseText);
                    }
                    });
        });
});
</script>

@endsection