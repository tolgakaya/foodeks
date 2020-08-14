@extends('frontend.layouts.layout')
@section('extracss')
<meta name="_token" content="{{csrf_token()}}" />
<!-- Radio and check inputs -->
<link href="{{asset('css/skins/square/grey.css')}}" rel="stylesheet">
{{-- <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="{{asset('backend/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" /> --}}
<link href='https://fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic,300,300italic' rel='stylesheet'
    type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Gochi+Hand' rel='stylesheet' type='text/css'>
@endsection
@section('subheader')
<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="img/sub_header_cart.jpg"
    data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
            <h1>Place your order</h1>
            <div class="bs-wizard">
                <div class="col-xs-4 bs-wizard-step active">
                    <div class="text-center bs-wizard-stepnum"><strong>1.</strong> Your details</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="#0" class="bs-wizard-dot"></a>
                </div>

                <div class="col-xs-4 bs-wizard-step disabled">
                    <div class="text-center bs-wizard-stepnum"><strong>2.</strong> Payment</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="cart_2.html" class="bs-wizard-dot"></a>
                </div>

                <div class="col-xs-4 bs-wizard-step disabled">
                    <div class="text-center bs-wizard-stepnum"><strong>3.</strong> Finish!</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="cart_3.html" class="bs-wizard-dot"></a>
                </div>
            </div><!-- End bs-wizard -->
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

        <div class="col-md-5">
            @guest
            <div class="box_style_2 hidden-xs info">
                <h4 class="nomargin_top">Üye misiniz?<i class="icon_clock_alt pull-right"></i></h4>
                <p>
                    Üye iseniz şuradan<a href="#" data-toggle="modal" data-target="#login_2"
                        class="btn btn-primary">giriş
                        yapabilir</a>ve kayıtlı bilgilerinizle hızlıca
                    sipariş verebilirsiniz. Üye
                    olmadan sipariş vermek için ilgili alanları doldurup siparişinizi tamamlayınız.
                </p>
                <hr>
                <h4>Üye değil misiniz? <i class="icon_creditcard pull-right"></i></h4>
                <p>
                    Üyelik avantajlarından faydalanmak ve hızlı sipariş verebilmek için hemen<a href="#"
                        data-toggle="modal" data-target="#register" class="btn btn-primary">üye olun.</a>
                </p>
            </div><!-- End box_style_2 -->
            @endguest
            <div class="box_style_2 hidden-xs" id="help">
                <i class="icon_lifesaver"></i>
                <h4>Need <span>Help?</span></h4>
                <a href="tel://004542344599" class="phone">+45 423 445 99</a>
                <small>Monday to Friday 9.00am - 7.30pm</small>
            </div>
        </div><!-- End col-md-3 -->


        <div class="col-md-7">
            <div class="box_style_2" id="order_process">
                <h2 class="inner">Sipariş Bilgileri</h2>
                <form action="{{route('orders.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>İsminiz</label>
                        <input type="hidden" value="anonim adres" name="address_name">
                        <input type="text" class="form-control" id="firstname_order" name="contact_name"
                            value="{{$firstAdres==null ? '' :  $firstAdres->contact_name}}"
                            placeholder="İsminizi giriniz">
                    </div>

                    <div class="form-group">
                        <label>Telephone/mobile</label>
                        <input type="text" id="tel_order" name="phone" class="form-control"
                            value="{{$firstAdres==null ? ' ' :  $firstAdres->phone}}" placeholder="Telephone/mobile">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="email_booking_2" name="email" class="form-control"
                            value="{{$firstAdres==null ? ' ' :  $firstAdres->email}}" placeholder="Your email">
                    </div>
                    <div class="form-group">
                        <label>Teslimat adresi</label>
                        @guest
                        {{-- <input type="text" class="form-control" name="address" placeholder="Teslimat adresi giriniz..."> --}}
                        <textarea class="form-control" style="height:150px" placeholder="Ex. Allergies, cash change..."
                            name="address" id="address"></textarea>
                        @endguest
                        @auth
                        {{-- <div class="input-group"> --}}
                        {{-- <input type="text" class="form-control" name="address"
                                placeholder="Teslimat adresi giriniz..."> --}}
                        <textarea class="form-control" style="height:150px" id="address"
                            placeholder="Ex. Allergies, cash change..." name="address"
                            id="address">{{$firstAdres ==null ? '':$firstAdres->address}}</textarea>
                        <input type="hidden" name="address_id" id="address_id"
                            value="{{$firstAdres ==null ? '':$firstAdres->id}}">
                        {{-- <span class="input-group-btn"> --}}
                        {{-- <button class="btn btn-outline-secondary" type="button">Bir adres seçin</button> --}}
                        {{-- data-val={{$meal->id}} --}}
                        <a href="#" data-toggle="modal" data-target="#optionModal" class="btn btn-primary">Adres
                            seçin</a>
                        {{-- </span> --}}
                        {{-- </div><!-- /input-group --> --}}
                        @endauth
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" id="city_order" name="city" class="form-control"
                                    placeholder="Semtinizi giriniz"
                                    value="{{$firstAdres ==null ? '':$firstAdres->city}}">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>Postal code</label>
                                <input type="text" id="pcode_oder" name="pcode_oder" class="form-control"
                                    placeholder=" Your postal code">
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <label>Sipariş notu</label>
                            <textarea class="form-control" style="height:150px"
                                placeholder="Ex. Allergies, cash change..." name="notes" id="notes"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-primary btn-block" value="Gönder">
                        </div>
                    </div>
                </form>
            </div><!-- End box_style_1 -->
        </div><!-- End col-md-6 -->
        <div class="col-md-4 hidden-lg hidden-md" id="sidebar">
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
                    {{-- <div class="row" id="options_2">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                            <label><input type="radio" value="" checked name="option_2" class="icheck">Delivery</label>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                            <label><input type="radio" value="" name="option_2" class="icheck">Take Away</label>
                        </div>
                    </div><!-- Edn options 2 --> --}}
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
                    <a class="btn_full" href="cart.html">Sipariş Ver</a>
                </div><!-- End cart_box -->
            </div><!-- End theiaStickySidebar -->
        </div><!-- End col-md-3 -->

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

<div class="modal fade" id="optionModal" tabindex="-1" role="dialog" aria-labelledby="optionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="optionModalLabel">Kayıtlı adresleriniz</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($addresses!==null)
                @foreach ($addresses as $adres)
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="feature">
                            <i><input type="radio" name="addressid" class="form-control" value="{{$adres->id}}"></i>
                            <h3><span>{{$adres->address_name}}</span> </h3>
                            <p>
                                {{$adres->address}}
                            </p>
                        </div>
                    </div>

                </div><!-- End row -->
                @endforeach
                @endif

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                <button type="button" id="btnOptionSave" class="btn btn-primary">Kaydet</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('specialscript')
<!-- SPECIFIC SCRIPTS -->
<script src="js/theia-sticky-sidebar.js"></script>
<script>
    jQuery('#sidebar').theiaStickySidebar({
        			additionalMarginTop: 80
        		});
</script>
<!-- Data tables -->
{{-- <script src="{{asset('backend/plugins/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script> --}}
<script>
    $(document).ready(function() {
 $("#address").change(function(){
    console.log('adres değişti');
    $('#address_id').val('');
    console.log('yeni adresid miz'+$('#address_id').val());
    });
//option modal işlemleri
$('#optionModal').on('show.bs.modal', function(event) {
    //  var meal = $(event.relatedTarget).data('val');
    // console.log('iliskiid' + meal);
    $('#btnOptionSave').off('click');
    $('#btnOptionSave').click(function() {
       var radioValue = $("input[name='addressid']:checked"). val();
        var optionModel={
        id: radioValue
            }
        $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        url: "/address/" + radioValue,
        // data: JSON.stringify(optionModel),
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        success: function(result) {
        $('address_id').value=result.id;
       $('#address').html(result.address);
        $('#optionModal').modal('hide');
         },
        error: function(errormessage) {
        alert(errormessage.responseText);
        }
        });
        
        
        });
});
//option modal bittti

    });
</script>
@endsection