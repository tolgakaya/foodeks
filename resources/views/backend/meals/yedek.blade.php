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
        <div class="card" id="cat{{$details->id}}">
            <div class="card-header">
                <div class="row">
                    <div class="col md-3 text-left ">
                        <div class="btn-group mb-0">
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">İşlemler</button>
                            <div class="dropdown-menu">

                                <a class="dropdown-item" href="#" data-toggle="modal" data-val={{$details->id}}
                                    data-target="#optionModal"><i class="fas fa-plus mr-2"></i>Ürün
                                    seçeneği ekle</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-val={{$details->id}}
                                    data-target="#extraModal"><i class="fas fa-plus mr-2"></i>Ürün
                                    ekstrası ekle</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>
                                    Sil</a>
                            </div>
                        </div>
                    </div>
                    <div class="col md-9 text-right">
                        <h4 id='groupid+meal'>{{$details->name}}</h4>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div id="meal{{$details->id}}">
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
                                            @foreach($details->options as $option)
                                            <tr>
                                                <td><a href="#" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-trash">Sil</i></a>
                                                    <a href="#" class="btn btn-primary btn-sm"><i
                                                            class="fa fa-pen ">Düzenle</i></a>
                                                </td>
                                                <td class="text-sm font-weight-600">
                                                    {{$option->option}}</td>
                                                <td class="text-nowrap">+ {{$option->fee}}
                                                </td>
                                            </tr>
                                            @endforeach
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
                                            <tr>
                                                <td><a href="#" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-trash">Sil</i></a>
                                                    <a href="#" class="btn btn-primary btn-sm"><i
                                                            class="fa fa-pen ">Düzenle</i></a>
                                                </td>
                                                <td class="text-sm font-weight-600">
                                                    {{$option->extra}}</td>
                                                <td class="text-nowrap">+ {{$option->extra}}
                                                </td>
                                            </tr>
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

<div class="modal fade" id="optionModal" tabindex="-1" role="dialog" aria-labelledby="optionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="optionModalLabel">Ürün Seçenek Bilgisi</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <div class="form-group">
                        <label for="option">Seçenek</label>
                        <input type="text" class="form-control" id="option" aria-describedby="optionHelp"
                            placeholder="Seçenek giriniz">
                        <small id="optioHelp" class="form-text text-muted">Seçenek
                            giriniz</small>
                    </div>
                    <div class="form-group">
                        <label for="optionFee">Fiyat</label>
                        <input type="number" class="form-control" id="optionFee" aria-describedby=" optionFeeHelp"
                            placeholder="Seçenek ekstra fiyat giriniz">
                        <small id="optionFeeHelp" class="form-text text-muted">Seçenek
                            ekstra fiyat
                            giriniz</small>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                <button type="button" id="btnOptionSave" class="btn btn-primary">Kaydet</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="extraModal" tabindex="-1" role="dialog" aria-labelledby="extraModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="extraModalLabel">Ürün Ekstra Bilgisi</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <div class="form-group">
                        <label for="extra">Eksta</label>
                        <input type="text" class="form-control" id="extra" aria-describedby="
                                                        extraHelp" placeholder="Ekstra giriniz">
                        <small id="extraHelp" class="form-text text-muted">Ürün yanında
                            verilebilecek extra ürün bilgisi giriniz.Örnek, salata
                            vb</small>
                    </div>
                    <div class="form-group">
                        <label for="extraFee">Fiyat</label>
                        <input type="number" class="form-control" id="extraFee" aria-describedby="extraFeeHelp"
                            placeholder="Ekstra fiyat giriniz">
                        <small id="extraFeeHelp" class="form-text text-muted">Burada
                            girdiğiniz fiyat extra ürün seçilmesi halinde ürün fiyatına
                            eklenecektir.</small>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                <button type="button" id="btnExtraSave" class="btn btn-primary">Kaydet</button>
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
<script>
    $(document).ready(function() {

//option modal işlemleri
$('#optionModal').on('show.bs.modal', function(event) {
     var meal = $(event.relatedTarget).data('val');
    console.log('iliskiid' + meal);
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
        url: "/admin/menus/details/option/" + meal,
        data: JSON.stringify(optionModel),
        type: "POST",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        success: function(result) {
        console.log(result);
       var secenekAlani=$('.options');
       var html ='';
       $.each(result,function(index,value){
  html+='<tr>';
           html+= '<td><a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash">Sil</i></a>';
                html+='<a href="#" class="btn btn-primary btn-sm"><i class="fa fa-pen ">Düzenle</i></a>';
           html+= '</td>';
            html+='<td class="text-sm font-weight-600">';
              html+=  value.option;
               html+= '</td>';
            html+= '<td class="text-nowrap">+ '+ value.fee + 'TL </td> </tr>';
                    });
        secenekAlani.html(html);
         },
        error: function(errormessage) {
        alert(errormessage.responseText);
        }
        });
        
        
        });
});

    });
</script>

@endsection