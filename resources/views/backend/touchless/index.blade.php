@extends('backend/layouts/touchlessmain')

@section('extracss')

<link href="{{asset('backend/css/style.css')}}" rel="stylesheet" />

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
@section('content')

<div class="container-fluid">

    <div class="btn-group" role="group">

        @if ($beforeCategoryId!=null)

        <a class="btn btn-primary"
            href="{{route('touchless.paging',['masaid'=>$masaid,'restaurant'=>1,'category'=>$currentCategoryId,'next'=>0])}}"
            aria-label="Previous">
            <i class="fa fa-angle-left"></i>
            <span>{{$kategoriler[$beforeIndex]->category}}</span>
        </a>

        @endif

        {{-- <a class="btn btn-warning" href="#">{{$kategoriler[$currentIndex]->category}}</a> --}}


        @if ($nextCategoryId!=null)
        <a class="btn btn-primary"
            href="{{route('touchless.paging',['masaid'=>$masaid,'restaurant'=>1,'category'=>$currentCategoryId,'next'=>1])}}"
            aria-label="Next">
            <i class="fa fa-angle-right"></i>
            <span>{{$kategoriler[$nextIndex]->category}}</span>
        </a>
        @endif

    </div>
    <div class="card-shadow">
        <div class="cd-cart  js-cd-cart">
            <a href="#0" class="cd-cart__trigger text-replace">

                <ul class="cd-cart__count">
                    <!-- cart items count -->
                    <li id='quantity'>{{$quantity}}</li>
                    <li>0</li>
                </ul> <!-- .cd-cart__count -->
            </a>

            <div class="cd-cart__content">
                <div class="cd-cart__layout">
                    <header class="cd-cart__header">
                        <h3>Siparişiniz</h3><i class="icon_cart_alt"></i>

                    </header>

                    <div class="cd-cart__body">

                        <div class="table table-responsive" id="cart_box">
                            <input type="hidden" id="masaid" value="{{$masaid}}">
                            <table class="table table_summary">
                                <tbody id="cd_cartbody" class="cartbody">
                                    @foreach($cartItems as $rowid => $row)
                                    <tr class="info">
                                        <td>
                                            <a href="#0" class="remove_item" id="{{$row->id}}"><i
                                                    class="fas fa-exclamation-circle"></i></a>
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
                        </div><!-- End cart_box -->
                    </div>

                    <footer class="cd-cart__footer">

                        <a href="{{ route('orders.masaStore',['masaid'=>$masaid,'menuid'=>$menu->id]) }}"
                            class="cd-cart__checkout">
                            <em>Toplam <span class="total">{{ $total}}</span>
                                <svg class="icon icon--sm" viewBox="0 0 24 24">
                                    <g fill="none" stroke="currentColor">
                                        <line stroke-width="2" stroke-linecap="round" stroke-linejoin="round" x1="3"
                                            y1="12" x2="21" y2="12" />
                                        <polyline stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            points="15,6 21,12 15,18 " />
                                    </g>
                                </svg>
                            </em>
                        </a>
                    </footer>
                </div>
            </div> <!-- .cd-cart__content -->
        </div> <!-- cd-cart -->
    </div>
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
    <div class="row">
        <input type="hidden" id="menuid" value="{{$menu->id}}">
        @foreach ($meals as $meal)
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="snip1492 card shadow">
                <img src="{{asset('backend/img/products/1.jpg')}}" alt="sample85" />
                <div class="figcaption">
                    @if (count($meal->options) >0 && count($meal->extras) >0)
                    <div class="options">
                        <div class="dropdown dropdown-options">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i
                                    class="ion-ios-cart">Sipariş</i></a>
                            <div class="dropdown-menu">
                                @if (count($meal->options) >0)
                                <h5>Seçenekler</h5>
                                @foreach ($meal->options as $op)
                                <label>
                                    <input type="radio" value="{{$op->id}}" name="option{{$meal->id}}"
                                        checked>{{$op->option}}
                                    <span>+ {{$op->fee}} TL</span>
                                </label>
                                @endforeach
                                @endif
                                @if (count($meal->extras) >0)
                                <h5>Ekstralar</h5>
                                @foreach ($meal->extras as $ex)
                                <label>
                                    <input type="checkbox" value="{{$ex->id}}" name="extra{{$meal->id}}">{{$ex->extra}}
                                    <span>+
                                        {{$ex->fee}}
                                        TL</span>
                                </label>
                                @endforeach
                                @endif
                                <a id="{{$meal->id}}" href="#" class="add_to_basket">Sepete Ekle</a>
                            </div>
                        </div>

                    </div>
                    @else
                    <div class="options">
                        <div class="dropdown dropdown-options">
                            <a id="{{$meal->id}}" href="#" class="add_to_basket dropdown-toggle " data-toggle="dropdown"
                                aria-expanded="true"><i class="ion-ios-cart">Sipariş</i></a>
                        </div>
                    </div>
                    @endif

                    <h3>{{$meal->name}}</h3>

                    <p>{{$meal->description}}</p>
                    <div class="price">
                        {{$meal->pivot->fee}} TL
                        <input type="hidden" id="fiyat{{$meal->id}}" value="{{$meal->pivot->fee}}">
                    </div>
                </div>


                <!-- </div> -->
            </div>
        </div>
        @endforeach

    </div>


</div>
@endsection
@section('specialscript')
<script src="{{asset('frontend/cart/js/util.js')}}"></script>
<script src="{{asset('frontend/cart/js/main.js')}}"></script>
<script src="{{asset('frontend/js/cat_nav_mobile.js')}}"></script>
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
        var masaid=$('#masaid').val();
        var menuid=$('#menuid').val();
        var ans = confirm("Kaydı silmek istiyor musunuz?");
        if (ans) {
        var mealModel = {
        rowid: silRow
        };
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                url: "/cart/delete/"+masaid+'/'+menuid,
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
                                            html+= '<a href="#0" class="remove_item" id="'+item.id+'"><i class="fas fa-exclamation-circle"></i></a>';
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
            console.log('clickledim');
           var mealid=$(this).attr('id');
            var menuid=$('#menuid').val();
           var fiyat=$("#fiyat"+mealid).val();
           var idd="option"+mealid;
           var optionid=$("input[name = " + idd+ "]:checked").val();
            var masaid=$('#masaid').val();
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
                    extras:extras,
                    masaid:masaid
                     };
                    $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    url: "/cart/add/"+masaid+'/'+menuid,
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
                                       html+= '<a href="#0" class="remove_item" id="'+item.id+'"><i class="fas fa-exclamation-circle"></i></a>';
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