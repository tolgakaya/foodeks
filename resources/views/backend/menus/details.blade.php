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
    <ol class="breadcrumb mb-sm-0">
        <li class="breadcrumb-item active">
            <select name="restaurant_id" id="restaurant" class="form-control select2 "
                data-placeholder="Restaurant seçiniz...." style="min-width: 250px;">
                @foreach ($restaurants as $restaurant)
                <option value="{{$restaurant->id}}">{{$restaurant->name}}</option>
                @endforeach
            </select>
        </li>
    </ol>
    <div class="btn-group mb-0">
        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Actions</button>
        <input type="hidden" id="menuid" value="{{$menu->id}}">

    </div>
</div>

<div class="row">
    <div class="col-md-12">
        @foreach ($categories as $category)
        <div class="card" id="cat{{$category->id}}">
            <div class="card-header">
                <div class="row">
                    <div class="col md-3 text-left ">
                        <div class="btn-group mb-0">

                            <a class="btn btn-primary btn-sm dropdown-toggle" href="#" data-toggle="modal"
                                data-target="#mealModal" data-val={{$category->id}}><i class="fas fa-plus mr-2"></i>Ürün
                                ekle</a>

                        </div>
                    </div>
                    <div class="col md-9 text-right">
                        <h4 id='groupid+meal'>{{$category->category}}</h4>
                    </div>
                </div>

            </div>
            <script>
                function Delete(menid, mealid) {
        var ans = confirm("Kaydı silmek istiyor musunuz?");
        if (ans) {
        var silinecek = {
        'meal': mealid
        };
        $.ajax({
        url: "/admin/menus/details/delete/" + ID,
        data: silinecek,
        type: "POST",
        contentType: "application/json;charset=UTF-8",
        dataType: "json",
        success: function (result) {
        console.log(result);
        },
        error: function (errormessage) {
        alert(errormessage.responseText);
        }
        });
        }
        }
            </script>
            <div class="card-body">
                <div id="meal{{$category->id}}">
                    @foreach($meals as $meal)
                    @if ($meal->category_id==$category->id)
                    {{-- meal başlıyor --}}
                    <div id="tekil{{$meal->id}}">
                        <div id="accordion">
                            <div class="accordion">
                                <div class="accordion-header" data-toggle="collapse"
                                    data-target="#panel{{$category->id}}{{$meal->id}}">
                                    {{-- #urun-mealid --}}
                                    <div class="row">
                                        <div class="col md-3 text-left ">
                                            <div class="btn-group mb-0">
                                                <button type="button"
                                                    class="{{$meal->pivot->pasif ==1 ? 'btn btn-warning' : 'btn btn-primary'}} btn-sm dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">İşlemler</button>
                                                <div class="dropdown-menu">
                                                    <div class="dropdown-divider"></div>

                                                    <a class="dropdown-item deletebutton" href="#" id="{{$meal->id}}"><i
                                                            class="fas fa-cog mr-2"></i>
                                                        Sil</a>
                                                    <a class="dropdown-item statusbutton" href="#"
                                                        data-id="{{$meal->id}}"
                                                        data-status="{{$meal->pivot->pasif ==1 ? 0 : 1}}"><i
                                                            class="fas fa-cog mr-2"></i>
                                                        {{$meal->pivot->pasif ==1 ? 'Aktif' :'Pasif'}}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col md-9 text-right">
                                            <h4> {{$meal->name}}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-body collapse show border border-top-0 text-sm"
                                    id="panel{{$category->id}}{{$meal->id}}" data-parent="#accordion">

                                    <h2 class=" mb-0">Ürün Bilgileri</h2>

                                    <div class="grid-margin">
                                        <div class="">
                                            <div class="table-responsive">
                                                <table id="group_id+"
                                                    class="table card-table table-vcenter text-nowrap  align-items-center">
                                                    <thead class="thead-light">
                                                        <tr>

                                                            <th>Resim</th>
                                                            <th>Ürün İsmi</th>
                                                            <th>Açıklama</th>
                                                            <th>Fiyat</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>

                                                            <td>
                                                                <div class="avatar-group">
                                                                    <a class="avatar avatar-md" data-toggle="tooltip"
                                                                        href="#"><img alt="Image placeholder"
                                                                            class="rounded-circle"
                                                                            src="assets/img/faces/female/8.jpg"></a>
                                                                </div>
                                                            </td>
                                                            <td class="text-sm font-weight-600">
                                                                {{$meal->name}}</td>

                                                            <td>{{$meal->description}} </td>
                                                            <td class="text-nowrap">{{$meal->pivot->fee}} TL
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <h2 class=" mb-0">Seçenekler</h2>

                                    <div class="grid-margin">
                                        <div class="">
                                            <div class="table-responsive">
                                                <table
                                                    class="table card-table table-vcenter text-nowrap  align-items-center">
                                                    <thead class="thead-light">
                                                        <tr>

                                                            <th>Seçenek</th>
                                                            <th>Eklenecek Fiyat</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($meal->options as $option)
                                                        <tr>

                                                            <td class="text-sm font-weight-600">
                                                                {{$option->option}}</td>
                                                            <td class="text-nowrap">+ {{$option->fee}} TL
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <h2 class=" mb-0">Extralar</h2>

                                    <div class="grid-margin">
                                        <div class="">
                                            <div class="table-responsive">
                                                <table
                                                    class="table card-table table-vcenter text-nowrap  align-items-center">
                                                    <thead class="thead-light">
                                                        <tr>

                                                            <th>Ekstra İsmi</th>
                                                            <th>Eklenecek Fiyat</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($meal->extras as $extra)
                                                        <tr>

                                                            <td class="text-sm font-weight-600">
                                                                {{$extra->extra}}</td>
                                                            <td class="text-nowrap">+ 0 TL
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
                    {{-- meal bitiyor --}}
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
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
                                <th>isim</th>
                                <th>Açıklama</th>

                            </tr>
                        </thead>
                        <tbody id="mealbody">

                        </tbody>
                    </table>
                    <div class="form-group">
                        <input type="number" class="form-control" name="fee" id="mealfee" placeholder="Fiyat giriniz">
                        <input type="hidden" id="mealcat">
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

 
        $('body').on('click', '.deletebutton', function () {
        var silinecekMeal=$(this).attr('id');
        var menuid = $('#menuid').val();
        var ans = confirm("Kaydı silmek istiyor musunuz?");
        if (ans) {
        var mealModel = {
        mealid: silinecekMeal
        };
        $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        url: "/admin/menus/details/delete/" + menuid,
        data:JSON.stringify( mealModel),
        type: "POST",
        contentType: "application/json;charset=UTF-8",
        dataType: "json",
        success: function (result) {
        var bosalt=$('#tekil'+silinecekMeal);
        bosalt.empty();
        },
        error: function (errormessage) {
        alert(errormessage.responseText);
        }
        });
        }
        });
  
 //status update

 $('body').on('click', '.statusbutton', function () {
    var mealimiz=$(this).data('id');
    var menuid = $('#menuid').val();
    var status=$(this).data('status');
  
    var ans = confirm("Kaydı silmek istiyor musunuz?");
    if (ans) {
    var mealModel = {
    mealid: mealimiz,
    status:status
    };
    $.ajax({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    },
    url: "/admin/menus/details/status/" + menuid,
    data:JSON.stringify( mealModel),
    type: "POST",
    contentType: "application/json;charset=UTF-8",
    dataType: "json",
    success: function (result) {
        //burada ilgili alanı renklendirelim
        console.log(result);
location.reload();
    },
    error: function (errormessage) {
    alert(errormessage.responseText);
    }
    });
    }
    });

    //mealModal baslangıc
    $('#mealModal').on('show.bs.modal', function (event) {

        var categoryid = $(event.relatedTarget).data('val');
        console.log('categoridmizzzzzz' + categoryid);
        $.ajax({
            url: "/admin/meals/category/" + categoryid,
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            success: function (result) {
                $('#mealcat').val(categoryid);
                $('#mealbody').empty();
                var html = '';
                $.each(result, function (key, item) {

                    html += '<tr>';
                    html += '<td>' + item.id + '</td>';
                    html += '<td>';
                    html += '<div class="avatar-group">';
                    html += '<a class="avatar avatar-md" data-toggle="tooltip" href="#">';
                    html += '<img src="' + item.image + '" class="rounded-circle" alt="" title="Beautiful Image" />';
                    html += '</a></div></td>';
                    html += '<td class="text-sm font-weight-600">' + item.name + '</td>';
                    html += '<td>' + item.description + '</td>';


                    // html += '<td><a href="#" onclick="return getbyID(' + item.id + ')">Düzenle</a> | <a href="#"
                    //         onclick="Delele(' + item.id + ')">Sil</a></td>';
                    html += '</tr>';

                });

                $('#mealbody').append(html);
                var table = $('#example2').DataTable();

                $('#example2 #mealbody').off('click');
                $('#example2 #mealbody').on('click', 'tr', function () {
                    console.log('clickledim');
                    if ($(this).hasClass('selected')) {
                        $(this).removeClass('selected');
                    } else {
                        table.$('tr.selected').removeClass('selected');
                        $(this).addClass('selected');
                    }
                });

                //btnsave
                $('#btnsave').click(function () {
                    var dataArr = [];
                    var rows = $('tr.selected');
                    var rowData = table.rows(rows).data();
                    $.each($(rowData), function (key, value) {
                        dataArr.push(value[0]); //"name" being the value of your first column.
                    });
                    var id = dataArr[0];
                    var fiyat = $('#mealfee').val();
                    var menuid = $('#menuid').val();
                    if (id && fiyat) {
                        console.log(id + ' ve ' + fiyat);
                        categorimiz = $('#mealcat').val();
                        console.log('categorimiz' + categorimiz)
                        var menuModel = {
                            meal_id: id,
                            fee: fiyat,
                            category: categorimiz
                        };
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                            url: "/admin/menus/details/" + menuid,
                            data: JSON.stringify(menuModel),
                            type: "POST",
                            contentType: "application/json;charset=utf-8",
                            dataType: "json",
                            success: function (result) {
                                // console.log(result);
                                var catelement = $('#meal' + categorimiz);
                                var html = '';
                                var opHtml = "";
                                $.each(result.last, function (index, value) {
                                    console.log('idmiiizzzzzzzzzzzz' + result.myId);
                                    console.log(value);
                                    html += '<div id="tekil'+value.id+'">';
                                    html += '<div id="accordion">';
                                    html += ' <div class="accordion">';
                                    html += ' <div class="accordion-header" data-toggle="collapse" data-val="' + value.id + '" data-target="#panel' + categorimiz + value.id + '">';
                                    html += ' <div class="row">';
                                    html += '<div class="col md-3 text-left "> ';
                                    html += '<div class="btn-group mb-0"> ';
                                    html += '<button type="button" class="btn btn-primary btn-sm dropdown-toggle"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">İşlemler</button> ';
                                    html += '<div class="dropdown-menu"> ';
                                    html += '<div class="dropdown-divider"></div> ';
                                    html += '<a class="dropdown-item deletebutton" id="'+value.id+'" href="#"><i class="fas fa-cog mr-2"></i> Sil</a> </div> </div></div>';
                                    html += ' <div class="col md-9 text-right"><h4 >' + value.name + '</h4> </div> </div> </div>';
                                    html += ' <div class="accordion-body collapse show border border-top-0 text-sm" id="panel' + categorimiz + value.id + '" data-parent="#accordion">';
                                    html += ' <h2 class=" mb-0">Ürün Bilgileri</h2>';
                                    html += '<div class="grid-margin"> <div class=""> <div class="table-responsive"> ';
                                    html += '<table class="table card-table table-vcenter text-nowrap  align-items-center"> ';
                                    html += '<thead class="thead-light"><tr><th>Resim</th><th>Ürün İsmi</th><th>Açıklama</th><th>Fiyat</th> </tr></thead>';
                                    html += ' <tbody>  <tr>';

                                    html += ' <td>';
                                    html += ' <div class="avatar-group">';
                                    html += ' <a class="avatar avatar-md" data-toggle="tooltip" href="#"><img alt="Image placeholder" class="rounded-circle" src="assets/img/faces/female/8.jpg"></a>';
                                    html += ' </div> </td>';
                                    html += ' <td class="text-sm font-weight-600">' + value.name + '</td>';
                                    html += ' <td>' + value.description + ' </td>';
                                    html += ' <td class="text-nowrap">' + value.pivot.fee + '</td>';
                                    html += '</tr></tbody></table>';
                                    html += ' </div> </div> </div>';
                                    html += '<h2 class=" mb-0">Seçenekler</h2>';
                                    html += '<div class="grid-margin"> ';
                                    html += '<div class=""><div class="table-responsive">';
                                    html += '<table class="table card-table table-vcenter text-nowrap  align-items-center"> ';
                                    html += '<thead class="thead-light"> ';
                                    html += '<tr> ><th>Seçenek</th><th>Eklenecek Fiyat</th></tr></thead>';
                                    html += '<tbody id="option' + result.myId + '">';
                                    html += '</tbody></table> </div></div></div>';
                                    html += '<div id="extra' + result.myId + '"></div>';
                                    html += ' </div> </div>  </div>';
                                    html+= '</div>';

                                    $.each(value.options, function (index, val) {
                                        opHtml += '<tr>';
                                        opHtml += '<td class="text-sm font-weight-600"> ' + val.option + '</td>';
                                        opHtml += '<td class="text-nowrap"> ' + val.fee + '</td> </tr> '
                                    });
                                });
                                catelement.empty();
                                catelement.append(html);
                                var extraAlani = $('#option' + result.myId);
                                extraAlani.append(opHtml);
                                $('#mealModal').modal('hide');
                                //ürün ekleyeceğiz
                                urunalani = $('#meal' + categoryid);
                                // alert(urunalani.html);
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
    $("#mealModal").on('hidden.bs.modal', function () {
        $(this).removeData('bs.modal');
        $('#example2').DataTable().clear().destroy();
    });


});
</script>
@endsection