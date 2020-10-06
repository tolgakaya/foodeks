@extends('backend/layouts/main')
@section('extracss')
<meta name="_token" content="{{csrf_token()}}" />
<link rel="stylesheet" href="{{asset('backend//plugins/select2/select2.css')}}">
<!-- Data table css -->
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="{{asset('backend/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{asset('frontend/css/loader.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="page-header mt-0 shadow p-3">

</div>

<div class="d-flex justify-content-center">
    {!! $orders->links() !!}
</div>
<div class="email-app card shadow">
    <nav class="p-0">
        <div class="card-body">
            <a href='#' id="yeniSiparis" class="btn btn-primary btn-block  btn-sm mt-1 mb-1">Yeni Sipariş
                Oluştur</a>
        </div>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link mr-0 border-top" href="{{route('admin.orders.index',['status'=>1])}}"><i
                        class="fa fa-inbox"></i> Yeni Siparişler
                    {{-- <span class="badge badge-primary">14</span> --}}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link mr-0" href="{{route('admin.orders.index',['status'=>3])}}"><i
                        class="fas fa-rocket"></i> Yoldakiler</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mr-0" href="{{route('admin.orders.index',['status'=>4])}}"><i
                        class="fas fa-trash"></i> Teslim Edilenler</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mr-0" href="{{route('admin.orders.index',['status'=>5])}}"><i
                        class="fas fa-bookmark"></i> İptaller</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mr-0" href="{{route('admin.orders.index')}}"><i class="fas fa-inbox"></i> Bütün
                    Siparişler
                    {{-- <span class="badge badge-danger">14</span> --}}
                </a>
            </li>
        </ul>
    </nav>
    <div class="inbox p-0">
        <div class="card-body d-none d-lg-block">

            <div class="toolbar ">
                <div class="btn-group mt-1 mb-1">
                    {{-- created --}}
                    <button type="button" class="btn btn-sm btn-light status" title="Yeni Sipariş" data-status="1">
                        <span class="fas fa-envelope"></span>
                    </button>
                    {{-- mutfaktan çıktı --}}
                    <button type="button" class="btn btn-sm btn-light status" title="Mutfaktan Çıktı" data-status="2">
                        <span class="fas fa-star"></span>
                    </button>
                    {{-- yolda --}}
                    <button type="button" class="btn btn-sm btn-light status" title="Yola Çıktı" data-status="3">
                        <span class="fas fa-bookmark"></span>
                    </button>
                    {{-- Teslim edildi --}}
                    <button type="button" class="btn btn-sm btn-light status" title="Teslim Edildi" data-status="4">
                        <span class="fas fa-bookmark"></span>
                    </button>
                    <button type="button" class="btn btn-sm btn-light status" title="İptal Edildi" data-status="5">
                        <span class="fas fa-trash"></span>
                    </button>
                    @if ($restaurants!=null)
                    <select class="form-control" id="selectRestaurant" name="restaurant_id">
                        @foreach ($restaurants as $restaurant)
                        <option value="{{$restaurant->id}}">{{$restaurant->name}}</option>
                        @endforeach
                    </select>
                    @endif

                </div>
                <div class="btn-group float-right ">
                    <a class="btn btn-primary btn-sm dropdown-toggle" href="#" data-toggle="modal"
                        data-target="#userModal"><i class="fas fa-plus mr-2"></i>Paketçi
                        Gönder</a>
                </div>
            </div>
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
        <ul class="mail_list list-group list-unstyled">
            @foreach ($orders as $order)
            @if ($loop->odd)
            <li class="list-group-item" id="row{{$order->id}}">
                @else
            <li class="list-group-item unread" id="row{{$order->id}}">
                @endif
                <h3>{{$order->address->contact_name}} - {{$order->address->phone}}</h3>
                <small class="text-muted"><time class="hidden-sm-down" datetime="2017">{{$order->created_at}}</time><i
                        class="zmdi zmdi-attachment-alt ml-2"></i> </small>
                <div class="media">
                    <div class="pull-left">

                        <div class="controls">
                            <div class="checkbox">
                                <input type="checkbox" id="{{$order->id}}" name="orderCheck" value="{{$order->id}}">
                                <label for="{{$order->id}}"></label>
                            </div>

                        </div>
                    </div>
                    <div class="media-body">
                        <div class="media-heading">
                            <a href="{{route('admin.orders.edit',['order'=>$order->id])}}"
                                class="mr-2">{{$order->address->address}}</a>
                            @if ($order->status==3 && $order->task!==null )
                            <span class="{{$order->statusStyle()}}">{{$order->task->user->adi}} <i
                                    class="fas fa-motorcycle fa-2x"></i></span>
                            @else
                            <span class="{{$order->statusStyle()}}">{{$order->orderStatus()}}</span>

                            @endif

                            {{-- <small class="text-muted"><time class="hidden-sm-down"
                                    datetime="2017">{{$order->created_at}}</time><i
                                class="zmdi zmdi-attachment-alt ml-2"></i> </small> --}}
                            <div class="float-right">
                                {!! QrCode::size(150)->generate(route('carrier.orders.qr',['order'=>$order->id])); !!}
                            </div>
                        </div>
                        <p class="msg">{{$order->notes}}</p>
                        @foreach ($order->orderdetails as $detail)

                        <div class="media-heading">
                            <a href="mail-single.html" class="mr-2">{{$detail->quantity}} X {{$detail->option_name}}
                                {{$detail->meal_name}}</a>

                        </div>

                        <div class="media-heading">
                            <p class="msg">
                                @foreach (json_decode($detail->extras) as $extra)
                                {{$extra->extra}}
                                @if (!$loop->last)
                                ,
                                @endif
                                @endforeach
                            </p>
                        </div>

                        @endforeach
                        <button class="btn  btn-sm btn-success yazdir pull-left"
                            data-yazdir="row{{$order->id}}">Yazdır</button>
                    </div>
                </div>
            </li>
            @endforeach

        </ul>

    </div>

</div>
<div class="d-flex justify-content-center">
    {!! $orders->links() !!}
</div>
{{-- {{$orders->links()}} --}}


<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userlModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="userModalLabel">Kullanıcı Bilgisi</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered w-100 text-nowrap" id="example2">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Resim</th>
                                <th>isim</th>
                                <th>role</th>

                            </tr>
                        </thead>
                        <tbody id="userbody">
                            @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>
                                    <div class="avatar-group">
                                        <a class="avatar avatar-md" data-toggle="tooltip" href="#">
                                            <img src=" {{$user->image}}" class="rounded-circle" alt=""
                                                title="BeautifulImage" /> </a></div>
                                </td>
                                <td>{{$user->adi}}</td>
                                <td>{{$user->mobile}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                    <input type="hidden" id="mealcat">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                <button type="button" id="btnsave" class="btn btn-primary">Kaydet</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('extrascript')

<script src="{{asset('backend/plugins/select2/select2.full.js')}}"></script>
<script src="{{asset('backend/js/select2.js')}}"></script>
<!-- Data tables -->
<script src="{{asset('backend/plugins/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>

{{-- <script src="{{asset('backend/js/menu.js')}}"></script> --}}
<script>
    $(document).ready(function () {
$('.yazdir').on('click',function () {
    var yazdirilacak=$(this).data('yazdir');
    console.log(yazdirilacak);
   
   var prtContent = document.getElementById(yazdirilacak);
    var WinPrint = window.open();
    WinPrint.document.write('<link rel="stylesheet" href="http://foodeks/backend/plugins/bootstrap/css/bootstrap.min.css">');
    WinPrint.document.write('<link href="http://foodeks/backend/css/dashboard.css" rel="stylesheet" type="text/css">');
    WinPrint.document.write('<link href="http://foodeks/backend/plugins/select2/select2.css" rel="stylesheet" type="text/css">');
    WinPrint.document.write('<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800" rel="stylesheet" type="text/css">');
    WinPrint.document.write('<link href="http://foodeks/backend/css/icons.css" rel="stylesheet" type="text/css">');
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
  });

var table= $('#example2').DataTable();
$('#example2 #userbody').on('click', 'tr', function () {

  //#region datatable satır seçimi
        console.log('clickledim');
        if ($(this).hasClass('selected')) {
        $(this).removeClass('selected');
        } else {
        table.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
        }
//#endregion

//#region  paketçi ekleme
$('#btnsave').click(function () {
var dataArr = [];
var rows = $('tr.selected');
var rowData = table.rows(rows).data();
$.each($(rowData), function (key, value) {
dataArr.push(value[0]); //"name" being the value of your first column.
});
var id = dataArr[0];

var orderids = $('input:checked').map(function(){
    return $(this).val();
    });

if (id) {
// console.log(id + ' ve ' + restaurantid);
var userModel = {
orderids: orderids.get(),
userid:id
};
console.log(userModel);
$.ajax({
headers: {
'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
},
url: "/admin/orders/tasks",
data: JSON.stringify(userModel),
type: "POST",
contentType: "application/json;charset=utf-8",
dataType: "json",
success: function (result) {
if(result.error){
    alert(result.error);
    // Swal.fire(
    // 'Good job!',
    // 'Paketçoktan yola çıkmış görünüyor',
    // 'error'
    // )
}
location.reload();
$('#userModal').modal('hide');

},
error: function (errormessage) {
// alert(errormessage.responseText);
// console.log(errormessage);
alert(errormessage.error);
}
});
} else {
console.log('Lütfen bir servis elemanı seçiniz.');
}
});
//#endregion

});
});
</script>
<script>
    $(document).ready(function () {
        $('#yeniSiparis').click(function(e){
            e.preventDefault();
           var siparisId= $('#selectRestaurant').val();
           var url='/admin/orders/create/'+siparisId;
            location.href=url;
        });
      $(".status").click(function(e) {
        e.preventDefault();
       var status= $(this).data("status");
        var ids = $('input:checked').map(function(){
        return $(this).val();
        });
        // var ans = confirm("Seçli siparişin durumunu değiştirmek istiyor musunuz?");
                         
                           var felan = { 
                               orders:ids.get(),
                              status:status
                              };
                            //   console.log('felanimiz' + felan);
                            $.ajax({
                            headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                            url: "/admin/orders/status/update",
                            data: JSON.stringify(felan),
                            type: "POST",
                            contentType: "application/json;charset=UTF-8",
                            dataType: "json",
                            beforeSend: function(){
                                    // Show image container
                                    console.log('gönderiliyor');
                                    $("#loadergif").show();
                                    },
                            success: function (result) {
                           location.reload();
                            },
                            complete:function(data){
                                console.log('tamamlandı');
                                    // Hide image container
                                    $("#loadergif").hide();
                                    },
                            error: function (errormessage) {
                            console.log(errormessage.responseText);
                            }
                            });
                        

      });
                
 });
</script>
@endsection