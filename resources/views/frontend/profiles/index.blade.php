@extends('frontend.layouts.layout')
@section('extracss')
<!-- Radio and check inputs -->
<link href="{{asset('frontend/css/skins/square/grey.css')}}" rel="stylesheet">
<link href="{{asset('frontend/css/admin.css')}}" rel="stylesheet">
<link href="{{asset('frontend/css/bootstrap3-wysihtml5.min.css')}}" rel="stylesheet">
{{-- <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="{{asset('backend/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" /> --}}
@endsection
@section('subheader')
<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll"
    data-image-src="{{$paralax !=null ? $paralax->paralax() : asset('frontend/img/adana_web.jpg')}}"
    data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
            <h1>{{Auth::user()->adi}}</h1>
            <p>Profil Bilgileri</p>
            <p></p>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->
@endsection

@section('main')

<!-- Content ================================================== -->
<div class="container">
    <div id="tabs" class="tabs">
        <nav>
            <ul>
                <li><a href="#section-1" class="icon-profile"><span>Rezervasyonlar</span></a>
                </li>
                <li><a href="#section-2" class="icon-menut-items"><span>Siparişler</span></a>
                </li>
                <li><a href="#section-3" class="icon-settings"><span>Ayarlar</span></a>
                </li>
            </ul>
        </nav>
        <div class="content">

            <section id="section-1">
                <div class="indent_title_in">
                    <i class="icon_clock_alt"></i>
                    <h3>Rezervasyonlarım</h3>

                </div>
                <div class="grid-margin">
                    <div class="">
                        <div class="table-responsive">
                            <table id="stafftable"
                                class="table card-table table-vcenter text-nowrap  align-items-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Restaurant</th>
                                        <th>İsim</th>
                                        <th>Telefon</th>
                                        <th>Tarih</th>
                                        <th>Saat</th>
                                        <th>Durum</th>
                                        {{-- <th>İşlem</th> --}}
                                    </tr>
                                </thead>
                                <tbody id="staffbody">
                                    @foreach($bookings as $booking)
                                    <tr class="{{$booking->status==1 ? 'text-danger': 'text-bold'}}">
                                        <td>
                                            {{$booking->id}}</td>
                                        <td>
                                            {{$booking->restaurant->name}}
                                        </td>
                                        <td>
                                            {{$booking->name}}
                                        </td>
                                        <td class="text-sm font-weight-600">
                                            {{$booking->phone}}
                                        <td>{{$booking->formatDate()}} </td>
                                        <td class="text-nowrap">
                                            {{$booking->time}}
                                        </td>
                                        <td class="text-nowrap">
                                            {{$booking->bookStatus()}}
                                        </td>
                                        {{-- <td>
                                            @if ($booking->status == 0)
                                            <a class="btn btn-primary btn-sm"
                                                href="{{route('admin.bookings.edit',['booking'=>$booking->id])}}"><i
                                            class="fas fa-pen mr-2"></i>Düzenle</a>
                                        <a class="btn btn-success btn-sm"
                                            href="{{route('admin.bookings.close',['booking'=>$booking->id])}}"><i
                                                class="fas fa-check mr-2"></i>Kapat</a>
                                        <a class="btn btn-danger btn-sm"
                                            href="{{route('admin.bookings.delete',['booking'=>$booking->id])}}"><i
                                                class="fas fa-minus mr-2"></i>İptal</a>
                                        @endif

                                        </td> --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section><!-- End section 1 -->

            <section id="section-1">
                <div class="indent_title_in">
                    <i class="icon_check_alt2"></i>
                    <h3>Paket Siparişlerim</h3>
                </div>
                <div class="grid-margin">
                    <div class="">
                        <div class="table-responsive">
                            <table id="ordertable"
                                class="table card-table table-vcenter text-nowrap  align-items-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Restaurant</th>
                                        <th>Sipariş</th>
                                        <th>Tutar</th>
                                        <th>Tarih</th>
                                        <th>Durum</th>
                                    </tr>
                                </thead>
                                <tbody id="orderbody">
                                    @foreach($userOrders as $order)
                                    <tr>
                                        <td>
                                            {{$order->id}}</td>
                                        <td>
                                            {{$order->restaurant->name}}
                                        </td>
                                        <td>
                                            <div class="table-responsive">
                                                <table
                                                    class="table card-table table-vcenter text-nowrap  align-items-center">
                                                    @foreach ($order->orderdetails as $detail)
                                                    <tr>
                                                        <td>
                                                            {{$detail->quantity}} X {{$detail->option_name}}
                                                            {{$detail->meal_name}}
                                                        </td>
                                                        <td>
                                                            @foreach (json_decode($detail->extras) as $extra)
                                                            {{$extra->extra}}
                                                            @if (!$loop->last)
                                                            ,
                                                            @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </td>
                                        <td class="text-sm font-weight-600">
                                            {{$order->total}} TL
                                        <td>{{$order->tarih()}} </td>
                                        <td class="text-nowrap">
                                            <span class="{{$order->statusStyle()}}">{{$order->orderStatus()}}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section><!-- End section 1 -->

            <section id="section-3">

                <div class="row">

                    <div class="col-md-6 col-sm-6 add_bottom_15">
                        <div class="indent_title_in">
                            <i class="icon_lock_alt"></i>
                            <h3>Şifreyi değiştirin</h3>

                        </div>
                        <form method="POST" action="{{ route('profile.changepassword') }}">
                            @csrf
                            <div class="wrapper_indent">
                                @foreach ($errors->all() as $error)
                                <p class="text-danger">{{ $error }}</p>
                                @endforeach
                                <div class="form-group">
                                    <label>Şimdiki şifreniz</label>
                                    <input class="form-control" name="current_password" id="password" type="password">
                                </div>
                                <div class="form-group">
                                    <label>Yeni şifre girin</label>
                                    <input class="form-control" name="new_password" id="new_password" type="password">
                                </div>
                                <div class="form-group">
                                    <label>Yeni şifreyi tekrar girin</label>
                                    <input class="form-control" name="new_confirm_password" id="new_confirm_password"
                                        type="password">
                                </div>
                                <button type="submit" class="btn_1 green">Şifreyi Güncelle</button>
                            </div><!-- End wrapper_indent -->
                        </form>
                    </div>

                    <div class="col-md-6 col-sm-6 add_bottom_15">
                        <div class="indent_title_in">
                            <i class="icon_mail_alt"></i>
                            <h3>Bilgilerinizi Güncelleyin</h3>

                        </div>
                        <form method="POST" action="{{ route('profile.changeemail') }}">
                            @csrf
                            <div class="wrapper_indent">
                                @foreach ($errors->all() as $error)
                                <p class="text-danger">{{ $error }}</p>
                                @endforeach
                                <div class="form-group">
                                    <label>Email adresiniz</label>
                                    <input class="form-control" name="old_email" id="old_email" type="email">
                                </div>
                                <div class="form-group">
                                    <label>Yeni email adresiniz</label>
                                    <input class="form-control" name="new_email" id="new_email" type="email">
                                </div>
                                <div class="form-group">
                                    <label>Yeni email adresinizi tekrar girin</label>
                                    <input class="form-control" name="confirm_new_email" id="confirm_new_email"
                                        type="email">
                                </div>
                                <button type="submit" class="btn_1 green">Kaydet</button>
                            </div><!-- End wrapper_indent -->
                        </form>
                    </div>

                </div><!-- End row -->
            </section><!-- End section 3 -->

        </div><!-- End content -->
    </div>
</div><!-- End container  -->
<!-- End Content =============================================== -->


@endsection
@section('specialscript')
<!-- Specific scripts -->
<script src="{{asset('frontend/js/tabs.js')}}"></script>
<script>
    new CBPFWTabs(document.getElementById('tabs'));
</script>

<script src="{{asset('frontend/js/bootstrap3-wysihtml5.min.js')}}"></script>
<script type="text/javascript">
    $('.wysihtml5').wysihtml5({});
</script>

<script src="{{asset('backend/plugins/select2/select2.full.js')}}"></script>
<script src="{{asset('backend/js/select2.js')}}"></script>
<!-- Data tables -->
<script src="{{asset('backend/plugins/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>
{{-- <script src="{{asset('backend/js/menu.js')}}"></script> --}}
<script>
    $(document).ready(function () {
                var table= $('#stafftable').DataTable({
                "order": [[ 1, "desc" ]],
                "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Turkish.json"
                }
                });
                var table= $('#ordertable').DataTable({
               "order": [[ 1, "desc" ]],
                "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Turkish.json"
                }
                });
});
</script>

@endsection