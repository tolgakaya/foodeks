@extends('backend/layouts/main')
@section('extracss')
<meta name="_token" content="{{csrf_token()}}" />
<link rel="stylesheet" href="{{asset('backend//plugins/select2/select2.css')}}">
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="{{asset('backend/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection
@section('content')
<div class="page-header mt-0 shadow p-3">
</div>

<div class="row">
    <div class="col-md-12">
        <input type="hidden" id="mealid" value="{{$meal->id}}">
        <div class="card" id="cat{{$meal->id}}">
            <div class="card-header">
                <div class="row">
                    <div class="col md-3 text-left ">
                        <div class="btn-group mb-0">
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">İşlemler</button>
                            <div class="dropdown-menu">

                                <a class="dropdown-item" href="#" data-toggle="modal" data-val={{$meal->id}}
                                    data-target="#optionModal"><i class="fas fa-plus mr-2"></i>Ürün
                                    seçeneği ekle</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-val={{$meal->id}}
                                    data-target="#extraModal"><i class="fas fa-plus mr-2"></i>Ürün
                                    ekstrası ekle</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>
                                    Sil</a>
                            </div>
                        </div>
                    </div>
                    <div class="col md-9 text-right">
                        <h4 id='groupid+meal'>{{$meal->name}}</h4>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div id="meal{{$meal->id}}">
                    <div>
                        <h2 class=" mb-0">Seçenekler</h2>

                        <div class="grid-margin">
                            <div class="">
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap  align-items-center">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>İşlem</th>
                                                <th>Seçenek</th>
                                                <th>Eklenecek Fiyat</th>
                                            </tr>
                                        </thead>
                                        <tbody class="options">
                                            @forelse($options as $option)
                                            <tr id="op{{$option->id}}">
                                                <td><a href="#" class="btn btn-danger btn-sm delete"
                                                        data-optionid="{{$option->id}}"><i
                                                            class="fa fa-trash">Sil</i></a>
                                                </td>
                                                <td class="text-sm font-weight-600">
                                                    {{$option->option}}</td>
                                                <td class="text-nowrap">+ {{$option->fee}} TL
                                                </td>
                                            </tr>
                                            @empty

                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h2 class=" mb-0">Extralar</h2>

                        <div class="grid-margin">
                            <div class="">
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap  align-items-center">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>İşlem</th>
                                                <th>Ekstra İsmi</th>
                                                <th>Eklenecek Fiyat</th>

                                            </tr>
                                        </thead>
                                        <tbody class="extras">
                                            @foreach($details->extras as $extra)
                                            <tr id="ex{{$extra->id}}">
                                                <td><a href="#" class="btn btn-danger btn-sm deletex"
                                                        data-extraid="{{$extra->id}}"><i class="fa fa-trash">Sil</i></a>
                                                </td>
                                                <td class="text-sm font-weight-600">
                                                    {{$extra->extra}}</td>
                                                <td class="text-nowrap">+ {{$option->fee}} TL
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.meals.modal')
@endsection

@section('extrascript')

<script src="{{asset('backend/plugins/select2/select2.full.js')}}"></script>
<script src="{{asset('backend/js/select2.js')}}"></script>
<!-- Data tables -->
<script src="{{asset('backend/plugins/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script>
    $(document).ready(function() {
$('body').on('click', '.delete', function () {

    var silinecekOption=$(this).data('optionid');
    var mealid = $('#mealid').val();
    var ans = confirm("Kaydı silmek istiyor musunuz?");
    if (ans) {
    var optionModel = {
    optionid: silinecekOption
    };
    $.ajax({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    },
    url: "/admin/meals/option/delete/" + mealid,
    data:JSON.stringify( optionModel),
    type: "POST",
    contentType: "application/json;charset=UTF-8",
    dataType: "json",
    success: function (result) {
    var bosalt=$('#op'+silinecekOption);
    bosalt.empty();
    },
    error: function (errormessage) {
    alert(errormessage.responseText);
    }
    });
    }
    });

$('body').on('click', '.deletex', function () {

var silinecekEx=$(this).data('extraid');
var mealid = $('#mealid').val();
var ans = confirm("Kaydı silmek istiyor musunuz?");
if (ans) {
var extraModel = {
extraid: silinecekEx
};
$.ajax({
headers: {
'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
},
url: "/admin/meals/extra/delete/" + mealid,
data:JSON.stringify( extraModel),
type: "POST",
contentType: "application/json;charset=UTF-8",
dataType: "json",
success: function (result) {
var bosalt=$('#ex'+silinecekEx);
bosalt.empty();
},
error: function (errormessage) {
alert(errormessage.responseText);
}
});
}
});

//option modal işlemleri
$('#optionModal').on('show.bs.modal', function(event) {
     var meal = $(event.relatedTarget).data('val');
    console.log('iliskiid' + meal);
    $('#btnOptionSave').off('click');
    $('#btnOptionSave').click(function() {
        var fiyat = $('#optionFee').val();
        var secenek = $('#option').val();
        var optionModel={
        option: secenek,
        fee: fiyat,
        }
        $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        url: "/admin/meals/details/option/" + meal,
        data: JSON.stringify(optionModel),
        type: "POST",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        success: function(result) {
        console.log(result);
       var secenekAlani=$('.options');
       var html ='';
       $.each(result,function(index,value){
  html+='<tr  id="op'+value.id+'">';
           html+= '<td><a href="#" class="btn btn-danger btn-sm delete" data-optionid="'+value.id+'"><i class="fa fa-trash">Sil</i></a>';
                  html+= '</td>';
            html+='<td class="text-sm font-weight-600">';
              html+=  value.option;
               html+= '</td>';
            html+= '<td class="text-nowrap">+ '+ value.fee + 'TL </td> </tr>';
                    });
        secenekAlani.html(html);
        $('#optionModal').modal('hide');
         },
        error: function(errormessage) {
        alert(errormessage.responseText);
        }
        });
        
        
        });
});
//option modal bittti
//extra modal başlıyor
$('#extraModal').on('show.bs.modal', function(event) {
var meal = $(event.relatedTarget).data('val');
console.log('iliskiid' + meal);
$('#btnExtraSave').off('click');
$('#btnExtraSave').click(function() {
    console.log('tıkladım');
var fiyat = $('#extraFee').val();
var extra = $('#extra').val();
var extraModel={
extra: extra,
fee: fiyat,
}
$.ajax({
headers: {
'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
},
url: "/admin/meals/details/extra/" + meal,
data: JSON.stringify(extraModel),
type: "POST",
contentType: "application/json;charset=utf-8",
dataType: "json",
success: function(result) {
console.log(result);
var extraAlani=$('.extras');
var html ='';
$.each(result,function(index,value){
html+='<tr id="ex'+value.id+'">';
html+= '<td><a href="#" class="btn btn-danger btn-sm deletex" data-extraid="'+value.id+'"><i class="fa fa-trash">Sil</i></a>';
 
        html+= '</td>';
    html+='<td class="text-sm font-weight-600">';
        html+= value.extra;
        html+= '</td>';
    html+= '<td class="text-nowrap">+ '+ value.fee + 'TL </td></tr>';
});
extraAlani.html(html);
$('#extraModal').modal('hide');
},
error: function(errormessage) {
alert(errormessage.responseText);
}
});

});
});
//extra modal bitti
    });
</script>
@endsection