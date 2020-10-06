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
            <h1>{{$settings->company ?? 'Hakkımızda'}}</h1>
            <p>{{$page->title ?? 'Eşsiz Adana Lezzetleri'}}</p>
            <p></p>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->
@endsection

@section('main')

<!-- Content ================================================== -->
<div class="container margin_60">
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
                <h1>Rezervasyonlarım</h1>
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
                                        <th>İşlem</th>
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
                                        <td>
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

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section><!-- End section 1 -->

            <section id="section-1">
                <h1>Siparişlerim</h1>
                <div class="grid-margin">
                    <div class="">
                        <div class="table-responsive">
                            <table id="stafftable"
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
                                <tbody id="staffbody">
                                    @foreach($orders as $order)
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
                            <h3>Change your password</h3>
                            <p>
                                Mussum ipsum cacilds, vidis litro abertis.
                            </p>
                        </div>
                        <div class="wrapper_indent">
                            <div class="form-group">
                                <label>Old password</label>
                                <input class="form-control" name="old_password" id="old_password" type="password">
                            </div>
                            <div class="form-group">
                                <label>New password</label>
                                <input class="form-control" name="new_password" id="new_password" type="password">
                            </div>
                            <div class="form-group">
                                <label>Confirm new password</label>
                                <input class="form-control" name="confirm_new_password" id="confirm_new_password"
                                    type="password">
                            </div>
                            <button type="submit" class="btn_1 green">Update Password</button>
                        </div><!-- End wrapper_indent -->
                    </div>

                    <div class="col-md-6 col-sm-6 add_bottom_15">
                        <div class="indent_title_in">
                            <i class="icon_mail_alt"></i>
                            <h3>Change your email</h3>
                            <p>
                                Mussum ipsum cacilds, vidis litro abertis.
                            </p>
                        </div>
                        <div class="wrapper_indent">
                            <div class="form-group">
                                <label>Old email</label>
                                <input class="form-control" name="old_email" id="old_email" type="email">
                            </div>
                            <div class="form-group">
                                <label>New email</label>
                                <input class="form-control" name="new_email" id="new_email" type="email">
                            </div>
                            <div class="form-group">
                                <label>Confirm new email</label>
                                <input class="form-control" name="confirm_new_email" id="confirm_new_email"
                                    type="email">
                            </div>
                            <button type="submit" class="btn_1 green">Update Email</button>
                        </div><!-- End wrapper_indent -->
                    </div>

                </div><!-- End row -->

                <hr class="styled_2">

                <div class="indent_title_in">
                    <i class="icon_shield"></i>
                    <h3>Notification settings</h3>
                    <p>
                        Mussum ipsum cacilds, vidis litro abertis.
                    </p>
                </div>
                <div class="row">

                    <div class="col-md-6 col-sm-6">
                        <div class="wrapper_indent">
                            <table class="table table-striped notifications">
                                <tbody>
                                    <tr>
                                        <td style="width:5%">
                                            <i class="icon_pencil-edit_alt"></i>
                                        </td>
                                        <td style="width:65%">
                                            New orders
                                        </td>
                                        <td style="width:35%">
                                            <label>
                                                <input type="checkbox" name="option_1_settings" checked class="icheck"
                                                    value="yes">Yes</label>
                                            <label class="margin_left">
                                                <input type="checkbox" name="option_1_settings" class="icheck"
                                                    value="no">No</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="icon_pencil-edit_alt"></i>
                                        </td>
                                        <td>
                                            Modified orders
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="option_2_settings" checked class="icheck"
                                                    value="yes">Yes</label>
                                            <label class="margin_left">
                                                <input type="checkbox" name="option_2_settings" class="icheck"
                                                    value="no">No</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="icon_pencil-edit_alt"></i>
                                        </td>
                                        <td>
                                            New user registration
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="option_3_settings" checked class="icheck"
                                                    value="yes">Yes</label>
                                            <label class="margin_left">
                                                <input type="checkbox" name="option_3_settings" class="icheck"
                                                    value="no">No</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="icon_pencil-edit_alt"></i>
                                        </td>
                                        <td>
                                            New comments
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="option_4_settings" checked class="icheck"
                                                    value="yes">Yes</label>
                                            <label class="margin_left">
                                                <input type="checkbox" name="option_4_settings" class="icheck"
                                                    value="no">No</label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn_1 green">Update notifications settings</button>
                        </div>

                    </div><!-- End row -->
                </div><!-- End wrapper_indent -->

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
var table= $('#stafftable').DataTable();
});
</script>

@endsection