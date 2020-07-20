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
    {{-- <ol class="breadcrumb mb-sm-0">
        <li class="breadcrumb-item active">
            <select name="restaurant_id" id="restaurant" class="form-control select2 "
                data-placeholder="Restaurant seçiniz...." style="min-width: 250px;">
                @foreach ($restaurants as $restaurant)
                <option value="{{$restaurant->id}}">{{$restaurant->name}}</option>
    @endforeach
    </select>
    </li>
    </ol> --}}
    <div class="btn-group mb-0">
        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Actions</button>
        <input type="hidden" id="restaurantid" value="{{$restaurant->id}}">
        {{-- <div class="dropdown-menu">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#mealModal"><i
                    class="fas fa-plus mr-2"></i>Ürün Ekle</a>
            <a class="dropdown-item" href="#"><i class="fas fa-eye mr-2"></i>View the page
                Details</a>
            <a class="dropdown-item" href="#"><i class="fas fa-edit mr-2"></i>Edit Page</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i> Settings</a>
        </div> --}}
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="card" id="catt">
            <div class="card-header">
                <div class="row">
                    <div class="col md-3 text-left ">
                        <div class="btn-group mb-0">
                            {{-- <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">İşlemler</button> --}}
                            {{-- <div class="dropdown-menu"> --}}
                            <a class="btn btn-primary btn-sm dropdown-toggle" href="#" data-toggle="modal"
                                data-target="#userModal" data-val={{$restaurant->id}}><i
                                    class="fas fa-plus mr-2"></i>Kullanıcı ekle</a>
                            {{-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#optionModal"><i
                                        class="fas fa-plus mr-2"></i>Ürün
                                    seçeneği ekle</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#extraModal"><i
                                        class="fas fa-plus mr-2"></i>Ürün
                                    ekstrası ekle</a> --}}
                            {{-- <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>
                                    Sil</a> --}}
                            {{-- </div> --}}
                        </div>
                    </div>
                    <div class="col md-9 text-right">
                        <h4 id='groupid+meal'>{{$restaurant->name}}</h4>
                    </div>
                </div>

            </div>

            <div class="card-body">
                <div id="mealcategory">


                    {{-- meal başlıyor --}}
                    <div id="tekil{{$restaurant->id}}">
                        <div id="accordion">
                            <div class="accordion">
                                <div class="accordion-header" data-toggle="collapse"
                                    data-target="#panel{{$restaurant->id}}">
                                    {{-- #urun-mealid --}}

                                </div>
                                <div class="accordion-body collapse show border border-top-0 text-sm"
                                    id="panel{{$restaurant->id}}" data-parent="#accordion">

                                    <h2 class=" mb-0">Kullanıcı Bilgileri</h2>

                                    <div class="grid-margin">
                                        <div class="">
                                            <div class="table-responsive">
                                                <table id="stafftable"
                                                    class="table card-table table-vcenter text-nowrap  align-items-center">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Resim</th>
                                                            <th>Kullanıcı</th>
                                                            <th>Kullanıcı Adı</th>
                                                            <th>Görev</th>
                                                            <th>İşlem</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="staffbody">
                                                        @foreach($restaurant->users as $user)
                                                        <tr>
                                                            <td>
                                                                {{$user->id}}</td>
                                                            <td>
                                                                <div class="avatar-group">
                                                                    <a class="avatar avatar-md" data-toggle="tooltip"
                                                                        href="#"><img alt="Image placeholder"
                                                                            class="rounded-circle"
                                                                            src="assets/img/faces/female/8.jpg"></a>
                                                                </div>
                                                            </td>
                                                            <td class="text-sm font-weight-600">
                                                                {{$user->adi}}</td>

                                                            <td>{{$user->email}} </td>
                                                            <td class="text-nowrap">{{$user->UserRole()}}
                                                            </td>
                                                            <td><button class="btn btn-primary btn-sm">Sil</button></td>
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
                    {{-- meal bitiyor --}}

                </div>
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
       function unsign(userid) {
        //    alert(id);
           var userModel = {
        userid: userid,
        };
     var restaurantid = $('#restaurantid').val();
$.ajax({
headers: {
'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
},
url: "/admin/restaurants/users/unsign/" + restaurantid,
data: JSON.stringify(userModel),
type: "POST",
contentType: "application/json;charset=utf-8",
dataType: "json",
success: function (result) {
    $('#stafftable').DataTable().clear().destroy();

console.log(result);
var catelement = $('#staffbody');
var html = '';
   $.each(result, function (key, item) {                      
 html += '<tr>';
    html += '<td>'+item.id+' </td>' ;
 html += '<td><div class="avatar-group">' ;
 html+='<a class="avatar avatar-md" data-toggle="tooltip" href="#"><img alt="Image placeholder" class="rounded-circle" src="assets/img/faces/female/8.jpg"></a>';
 html += '</div></td>';
 html += '<td class="text-sm font-weight-600">'+item.adi+'</td>';
 html += '<td>'+item.email+'</td>';
 html += '<td class="text-nowrap">'+item.user_role+'</td>';
 html += '<td><button class="btn btn-primary btn-sm">Sil</button></td>';
 html+='</tr>';
 });
                    // html += '<td><a href="#" onclick="return getbyID(' + item.id + ')">Düzenle</a> | <a href="#"
                    //         onclick="Delele(' + item.id + ')">Sil</a></td>';
catelement.empty();
 catelement.append(html);
 var table= $('#stafftable').DataTable();
 $('#stafftable tbody').off('click');
 $('#stafftable tbody').on( 'click', 'button', function () {
    var data = table.row( $(this).parents('tr') ).data();
    // alert( data[2] +"' Idsi: "+ data[ 0 ] );
    unsign(data[0]);
    } );
$('#userModal').modal('hide');

},
error: function (errormessage) {
alert(errormessage.responseText);
}
});
       }
    //mealModal baslangıc
    $('#userModal').on('show.bs.modal', function (event) {

        var restaurantid = $(event.relatedTarget).data('val');
        console.log('categoridmizzzzzz' + restaurantid);
        $.ajax({
            url: "/admin/restaurants/users/" + restaurantid,
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            success: function (result) {
                $('#mealcat').val(restaurantid);
                $('#userbody').empty();
                var html = '';
                $.each(result, function (key, item) {

                    html += '<tr>';
                    html += '<td>' + item.id + '</td>';
                    html += '<td>';
                    html += '<div class="avatar-group">';
                    html += '<a class="avatar avatar-md" data-toggle="tooltip" href="#">';
                    html += '<img src="' + "item.image" + '" class="rounded-circle" alt="" title="Beautiful Image" />';
                    html += '</a></div></td>';
                    html += '<td class="text-sm font-weight-600">' + item.email + '</td>';
                    html += '<td>' + item.user_role+ '</td>';


                    // html += '<td><a href="#" onclick="return getbyID(' + item.id + ')">Düzenle</a> | <a href="#"
                    //         onclick="Delele(' + item.id + ')">Sil</a></td>';
                    html += '</tr>';

                });

                $('#userbody').append(html);
                var table = $('#example2').DataTable();

                $('#example2 #userbody').off('click');
                $('#example2 #userbody').on('click', 'tr', function () {
                    console.log('clickledim');
                    if ($(this).hasClass('selected')) {
                        $(this).removeClass('selected');
                    } else {
                        table.$('tr.selected').removeClass('selected');
                        $(this).addClass('selected');
                    }
                });
$('#btnsave').click(function () {
var dataArr = [];
var rows = $('tr.selected');
var rowData = table.rows(rows).data();
$.each($(rowData), function (key, value) {
dataArr.push(value[0]); //"name" being the value of your first column.
});
var id = dataArr[0];
var restaurantid = $('#restaurantid').val();
if (id) {
console.log(id + ' ve ' + restaurantid);
var userModel = {
userid: id,
};
$.ajax({
headers: {
'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
},
url: "/admin/restaurants/users/" + restaurantid,
data: JSON.stringify(userModel),
type: "POST",
contentType: "application/json;charset=utf-8",
dataType: "json",
success: function (result) {
    $('#stafftable').DataTable().clear().destroy();

console.log(result);
var catelement = $('#staffbody');
var html = '';
   $.each(result, function (key, item) {                      
 html += '<tr>';
    html += '<td>'+item.id+' </td>' ;
 html += '<td><div class="avatar-group">' ;
 html+='<a class="avatar avatar-md" data-toggle="tooltip" href="#"><img alt="Image placeholder" class="rounded-circle" src="assets/img/faces/female/8.jpg"></a>';
 html += '</div></td>';
 html += '<td class="text-sm font-weight-600">'+item.adi+'</td>';
 html += '<td>'+item.email+'</td>';
 html += '<td class="text-nowrap">'+item.user_role+'</td>';
 html += '<td><button class="btn btn-primary btn-sm">Sil</button></td>';
 html+='</tr>';
 });
                    // html += '<td><a href="#" onclick="return getbyID(' + item.id + ')">Düzenle</a> | <a href="#"
                    //         onclick="Delele(' + item.id + ')">Sil</a></td>';
catelement.empty();
 catelement.append(html);
 var table= $('#stafftable').DataTable();
 $('#stafftable tbody').off('click');
 $('#stafftable tbody').on( 'click', 'button', function () {
    var data = table.row( $(this).parents('tr') ).data();
    // alert( data[2] +"' Idsi: "+ data[ 0 ] );
    unsign(data[0]);
    } );
$('#userModal').modal('hide');

},
error: function (errormessage) {
alert(errormessage.responseText);
}
});
} else {
console.log('lütfen bir ürün seçin ve fiyat girin');
}
});
                },
            error: function (errormessage) {
                alert(errormessage.responseText);
            }
        });
    });

    // mealModal bitti
    $("#userModal").on('hidden.bs.modal', function () {
        $(this).removeData('bs.modal');
        $('#example2').DataTable().clear().destroy();
    });
 
    var table= $('#stafftable').DataTable();

    $('#stafftable tbody').on( 'click', 'button', function () {
    var data = table.row( $(this).parents('tr') ).data();
    // alert( data[2] +"' Idsi: "+ data[ 0 ] );
    unsign(data[0]);
    } );


});
</script>
@endsection