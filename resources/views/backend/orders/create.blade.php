@extends('backend/layouts/main')
@section('extracss')
<meta name="_token" content="{{csrf_token()}}" />
<link rel="stylesheet" href="{{asset('backend//plugins/select2/select2.css')}}">
<!-- Data table css -->
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="{{asset('backend/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />

@endsection
@section('content')
<div class="page-header mt-0 shadow p-3">
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col md-3 text-left ">
                        <div class="btn-group mb-0">
                            <a class="btn btn-primary btn-sm dropdown-toggle" href="#" data-toggle="modal"
                                data-target="#mealModal" data-val={{$restaurant->id}}><i
                                    class="fas fa-plus mr-2"></i>Ürün ekle</a>
                        </div>
                    </div>
                    <div class="col md-9 text-right">
                        <h2>Sipariş Sepeti</h2>
                        {{-- <h4 id='groupid+meal'>{{$category->category}}</h4> --}}
                    </div>
                </div>
            </div>
            <input type="hidden" id="menuid" value="{{$menu->id}}">
            <div class="card-body">
                <table class="table table-bordered align-items-center" id="sepet">
                    <thead>
                        <tr>
                            <th>Adet</th>
                            <th>Seçenek</th>
                            <th>Ürün</th>
                            <th>Fiyat</th>
                            <th>Ekstralar</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="sepetBody">
                        @foreach ($cartItems as $rowid => $row)
                        <tr id="row{{$row->id}}">
                            <td>{{$row->quantity}} X</td>
                            @if ($row->attributes['option']!=null)
                            <td> {{$row->attributes['option']->option}}</td>
                            @else
                            <td></td>
                            @endif

                            <td>{{$row->name}} </td>
                            <td>
                                @if ($row->attributes['option']!=null)
                                {{ $row->quantity * ($row->price + $row->attributes['option']->fee)}}
                                @else
                                {{ $row->quantity * ($row->price)}}
                                @endif


                            </td>
                            <td>
                                @foreach($row->attributes['extras'] as $key => $extra)

                                {{$extra->extra}},


                                @endforeach
                            </td>
                            <td><a class="btn btn-danger btn-sm text-white delete" data-toggle="tooltip"
                                    data-id="{{$row->id}}" data-original-title="Sil"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col md-3 text-left ">

                    </div>
                    <div class="col md-9 text-right">
                        <h2>Sipariş Detayları</h2>
                        {{-- <h4 id='groupid+meal'>{{$category->category}}</h4> --}}
                    </div>
                </div>

            </div>
            <div class="card-body">
                <form action="{{route('admin.orders.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>İsminiz</label>
                        <input type="hidden" value="anonim adres" name="address_name">
                        <input type="text" class="form-control" id="contact_name" name="contact_name"
                            placeholder="İsminizi giriniz">
                    </div>

                    <div class="form-group">
                        <label>Telephone/mobile</label>
                        <input type="text" id="phone" name="phone" class="form-control" placeholder="Telephone/mobile">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Your email">
                    </div>
                    <div class="form-group">
                        <label>Teslimat adresi</label>

                        <textarea class="form-control" style="height:150px" id="address"
                            placeholder="Ex. Allergies, cash change..." name="address" id="address"></textarea>
                        <input type="hidden" name="address_id" id="address_id" value="">
                        <input type="hidden" name="userid" id="userid" value="">
                        <a href="#" data-toggle="modal" data-target="#userModal" class="btn btn-primary">Müşteri Seçiniz
                        </a>


                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" id="city_order" name="city" class="form-control"
                                    placeholder="Semtinizi giriniz" value="">
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
            </div>
        </div>

    </div>

</div>
<div class="modal fade" id="mealModal" tabindex="-1" role="dialog" aria-labelledby="mealModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="mealModalLabel">Ürün Bilgisi</h2>
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
                                <th>İsim</th>
                                <th>Fiyat</th>
                            </tr>
                        </thead>
                        <tbody id="mealbody">
                            @foreach ($menu->meals as $meal)
                            <tr>
                                <td> {{$meal->id}}</td>
                                <td>
                                    <div class="avatar-group">
                                        <a class="avatar avatar-md" data-toggle="tooltip" href="#"><img
                                                alt="Image placeholder" class="rounded-circle"
                                                src="{{$meal->path()}}"></a>
                                    </div>
                                </td>
                                <td> {{$meal->name}}</td>
                                <td> {{$meal->pivot->fee}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="form-group">
                        {{-- <input type="number" class="form-control" name="fee" id="mealfee" placeholder="Fiyat giriniz"> --}}
                        <input type="hidden" id="mealcat">
                    </div>
                    <form>
                        <div class="options form">

                        </div>
                    </form>

                    <div class="extras">

                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                <button type="button" id="btnsave" class="btn btn-primary">Kaydet</button>
            </div>
        </div>
    </div>
</div>
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
                    <table class="table table-striped table-bordered w-100 text-nowrap" id="example3">
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
                <div class="adressecim">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                <button type="button" id="btnAdresEkle" class="btn btn-primary">Kaydet</button>
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
var table = $('#example2').DataTable();
$('#example2 #mealbody').on('click', 'tr', function () {

//#region satır seçme olayı
if ($(this).hasClass('selected')) {

$(this).removeClass('selected');
console.log('seçimi kaldırdım.');
} else {
table.$('tr.selected').removeClass('selected');
$(this).addClass('selected');

var dataArr = [];
var rows = $('tr.selected');
var rowData = table.rows(rows).data();
$.each($(rowData), function (key, value) {
dataArr.push(value); //"name" being the value of your first column.
});
var mealid = dataArr[0][0];
var fiyat=dataArr[0][3];
// if($('#mealfee').val()){
//     fiyat=$('#mealfee').val();
// }
console.log('fiyatimiz '+fiyat);
var menuid= $('#menuid').val();
// var optionid=$("input[name = " + idd+ "]:checked").val();

secim(mealid);

$('#btnsave').click(function () {
    var secilen="optionsecim";
    var optionid=$("input[name ="+secilen+"]:checked").val();
    var extras = $('.extraBox:input:checked').map(function(){
    return $(this).val();
    });

    sepetEkle(mealid,menuid,fiyat,optionid,extras.get());
});
 
}
 
});

function secim(secilen) {
console.log('secimi yaptım' + secilen);

$.ajax({
headers: {
'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
},
url: "/admin/orders/meal/details/"+secilen,
// data: JSON.stringify(mealModel),
type: "POST",
contentType: "application/json;charset=utf-8",
dataType: "json",
success: function (result) {
console.log(result);
html ='';
htmlExt='';
$.each(result.options, function (key, item) {

                html +='<div class="custom-control custom-radio custom-control-inline">';
                html+='<input type="radio" class="custom-control-input optionBox" id="op'+item.id+'" name="optionsecim"  value="'+item.id+'">';
                html+='<label class="custom-control-label" for="op'+item.id+'">';
                html+= item.option;
                html+='</label> ';
                html+='</div>';
 });

$.each(result.extras, function (key, exItem) {

htmlExt +='<div class="custom-control custom-checkbox custom-control-inline">';
  
         htmlExt+='<input type="checkbox" class="custom-control-input extraBox" name="extrasecim" id="ex'+exItem.id+'" value="'+exItem.id+'">';
         htmlExt+='<label class="custom-control-label" for="ex'+exItem.id+'">';
         htmlExt+= exItem.extra;
         htmlExt+='</label> ';
         htmlExt+='</div>';
});

 $('.options').empty();
$('.options').html(html);
$('.extras').empty();
$('.extras').html(htmlExt);
},
error: function (errormessage) {
alert(errormessage.error);
}
});
}
//documentReady

//#region sepete ekleme metodu
// $('#btnsave').click(function () {
//  var secenekler = $('.extraBox:input:checked').map(function(){
//     return $(this).val();
//     });
// //verileri alıp karta kaydedilecek(ajax)
// //successte sepet güncellenecek

//     console.log(secenekler.get());
// });

//#endregion
function sepetEkle(mealid,menuid,fiyat,optionid,extras) {
    var mealModel = {
    mealid: mealid,
    fiyat:fiyat,
    miktar:1,
    optionid:optionid,
    menuid:menuid,
    extras:extras
    };
    console.log(mealModel);
    $.ajax({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    },
    url: "/cart/add",
    data:JSON.stringify(mealModel),
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
    $('#sepetBody').empty();
    $('.total').empty();
    
    // addToCart();
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
    //////sepeeti güncellemede kaldım
    html+='<tr id="row'+item.id+'">';
    html+='<td>'+item.quantity+'X</td>';
        if(item.attributes.option){
        html+= '<td>'+item.attributes.option.option+'</td>';
        }
        else{
         html+=   '<td></td>';
        }

   html+='<td>'+item.name+'</td>';
 html+='<td>'+rowPrice+'TL</td>';
    html+='<td>';
    if(item.attributes.extras){
    $.each(item.attributes.extras, function (k, ex) {
 
            html+= ex.extra;
            html+=',';
         
    });
    }
    html+='</td>';
  
    html+='<td><a class="btn btn-danger btn-sm text-white delete" data-toggle="tooltip" data-id="'+item.id+'"><i class="fas fa-trash"></i></a> </td>';
    html+='</tr>';
    });
    
    // htmlTotal +='<span class="pull-right">'+result.total+'TL</span>';
    // $('.total').append(htmlTotal);
    // htmlQuantity +=result.quantity;
    // $('#quantity').empty();
    // $('#quantity').append(htmlQuantity);
    $('#mealModal').modal('hide');
    $('#sepetBody').html(html);

    
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
$('tbody').on('click', '.delete', function () {
var deletedRowId=  $(this).data("id");
        var mealModel = {
        rowid: deletedRowId
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
            success: function (result) {
            console.log(result);
            $("#row"+deletedRowId).hide();
            // htmlTotal +=' <span class="pull-right">'+result.total+'TL</span>';
            
            // $('.total').append(htmlTotal);
            
            },
            error: function (errormessage) {
            alert(errormessage.responseText);
            }

        });
});

</script>
<script>
    $(document).ready(function () {
var table = $('#example3').DataTable();
$('#example3 #userbody').on('click', 'tr', function () {

//#region satır seçme olayı
if ($(this).hasClass('selected')) {

$(this).removeClass('selected');
console.log('seçimi kaldırdım.');
} else {
table.$('tr.selected').removeClass('selected');
$(this).addClass('selected');

var dataArr = [];
var rows = $('tr.selected');
var rowData = table.rows(rows).data();
$.each($(rowData), function (key, value) {
dataArr.push(value); //"name" being the value of your first column.
});
var userid = dataArr[0][0];
console.log(userid);
adresSecim(userid);

$('#btnAdresEkle').click(function () {
var secilen = "adsecim";
var ad_id = $("input[name =" + secilen + "]:checked").val();
var secilenElement=$("input[name =" + secilen + "]:checked").attr('id');
// console.log('ad_id=' + ad_id);
var city = $('#' + secilenElement).data('city');
var address=$('#' + secilenElement).data('address');
var email=$('#' + secilenElement).data('email');
var phone=$('#' + secilenElement).data('phone');
var contact_name=$('#' + secilenElement).data('contact');
$('#city').val(city);
$('#address').val(address);
$('#email').val(email);
$('#phone').val(phone);
$('#contact_name').val(contact_name);
$('#userid').val(userid);
$('#address_id').val(ad_id);
$('#userModal').modal('hide');
console.log('userid ' + userid + ' city ' + city);
// sepetEkle(mealid, menuid, fiyat, optionid, extras.get());
});

}

});

function adresSecim(secilen) {
console.log('secimi yaptım' + secilen);

$.ajax({
headers: {
'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
},
url: "/admin/orders/addresses/" + secilen,
// data: JSON.stringify(mealModel),
type: "POST",
contentType: "application/json;charset=utf-8",
dataType: "json",
success: function (result) {
console.log(result);
html = '';
htmlExt = '';
$.each(result.addresses, function (key, item) {
console.log(item);
html += '<div class="custom-control custom-radio custom-control-inline">';
    html += '<input type="radio" class="custom-control-input optionBox" id="ad' + item.id + '" name="adsecim" value="';
   html += item.id + '" data-city="' + item.city + '" data-phone="'+item.phone+'" data-email="'+item.email;
   html+='" data-address="'+item.address+'" data-contact="'+item.contact_name+'">';
    html += '<label class="custom-control-label" for="ad' + item.id + '">';
        html += item.address;
        html += '</label> ';

    html += '</div>';
});

$('.adressecim').empty();
$('.adressecim').html(html);

},
error: function (errormessage) {
alert(errormessage.error);
}
});
}
//documentReady



});

// $('#extraModal').on('show.bs.modal', function(event) {
//     $('#mealfee').val('');
// });
</script>
@endsection