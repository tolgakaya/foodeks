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
<section class="parallax-window" id="short" data-parallax="scroll"
    data-image-src="{{$page !=null ? $page->paralax() : asset('frontend/img/adana_web.jpg')}}" data-natural-width="1400"
    data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
            <h1>Siparişi Tamamlayın</h1>
            <div class="bs-wizard">
                <div class="col-xs-4 bs-wizard-step active">
                    <div class="text-center bs-wizard-stepnum"><strong>1.</strong> Bilgileriniz</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="#0" class="bs-wizard-dot"></a>
                </div>

                <div class="col-xs-4 bs-wizard-step disabled">
                    <div class="text-center bs-wizard-stepnum"><strong>2.</strong>Kapıda Ödeme</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="cart_2.html" class="bs-wizard-dot"></a>
                </div>

                <div class="col-xs-4 bs-wizard-step disabled">
                    <div class="text-center bs-wizard-stepnum"><strong>3.</strong> Afiyet Olsun</div>
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
<!-- Content ================================================== -->
<div class="container">
    <div class="row">

        <div class="col-md-4">

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
            <div class="box_style_2 hidden-xs info">
                @if (isset($adds))
                <div>
                    <a href="{{$adds->link ?? '#'}}">
                        <img src="{{$adds->filename !=null ? '/images/'.$adds->filename : asset('frontend/img/reklam-durum.gif')}}"
                            alt="">
                    </a>
                </div>
                <br>
                <br>

                @else
                <div class="filter_type">
                    <img src="{{asset('frontend/img/reklam-durum.gif')}}" alt="">
                </div>
                <br>
                <br>
                @endif
            </div>

        </div><!-- End col-md-3 -->


        <div class="col-md-8">
            {{-- <div class="text-center">
            <div class="btn-group">
                <a href="#" data-toggle="modal" data-target="#login_2" class="btn btn-primary">Giriş</a>
                <a href="#" data-toggle="modal" data-target="#register" class="btn btn-primary">Üyelik</a>
            </div>
        </div> --}}
            <div class="box_style_2" id="order_process">
                <h2 class="inner">Sipariş
                    <div class="btn-group pull-right">
                        <a href="#" data-toggle="modal" data-target="#login_2" class="btn btn-default btn-xs">Giriş</a>
                        <a href="#" data-toggle="modal" data-target="#register"
                            class="btn btn-default btn-xs">Üyelik</a>
                    </div>
                </h2>
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
                        <textarea class="form-control" style="height:150px" placeholder="Teslimat adresini giriniz"
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
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Semt/Şehir</label>
                                <input type="text" id="city_order" name="city" class="form-control"
                                    placeholder="Semtinizi giriniz"
                                    value="{{$firstAdres ==null ? '':$firstAdres->city}}">
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <label>Sipariş notu</label>
                            <textarea class="form-control" style="height:150px" placeholder="Sipariş notu ekleyiniz."
                                name="notes" id="notes"></textarea>
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