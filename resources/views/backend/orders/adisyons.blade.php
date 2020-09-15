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

    <div class="btn-group mb-0">
        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Actions</button>
        <input type="hidden" id="restaurantid" value="">
    </div>
</div>
<div class="row">
    @foreach ($orders as $order)
    <div class="col-md-6 col-lg-6">
        <div class="card shadow">
            <div class="card-header bg-gradient-primary">
                <h2 class="mb-0 text-white ">Masa No: {{$order->masaid}}</h2>
            </div>
            <div class="card-body text-center">

                <h4 class="h4 mb-0 mt-3 font-600">Adisyon Tutarı : {{$order->total}} TL</h4>
                <div class="">
                    <div class="grid-margin">
                        <div class="">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Adet/Seçenek</th>
                                            <th>Ürün</th>
                                            <th>Tutar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderdetails as $detail)
                                        <tr class="{{$detail->goruldu !=1 ? 'bg-info' :''}}">
                                            <td>{{$detail->quantity}} X {{$detail->option_name}}</td>
                                            <td class="text-sm font-weight-600">{{$detail->meal_name}}</td>
                                            <td class="text-nowrap">{{$detail->total}} TL</td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-right">
                    <div class="btn-group">
                        <form method="GET" action="{{route('admin.orders.kapat',['order'=>$order->id])}}">
                            <button type="submit" class="btn btn-outline-default">Kapat</button>
                        </form>

                        {{-- <button class="btn btn-outline-warning">Sil</button> --}}
                        <form method="GET" action="{{route('admin.orders.edit',['order'=>$order->id])}}">
                            <button type="submit" class="btn btn-outline-danger">Düzenle</button>
                        </form>
                        <form method="GET" action="{{route('admin.orders.goruldu',['order'=>$order->id])}}">
                            <button type="submit" class="btn btn-outline-info">Görüldü</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
    @endforeach

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
                               orders:ids,
                              status:status
                              };
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