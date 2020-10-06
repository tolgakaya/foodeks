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

        <div class="card" id="catt">
            <div class="card-header">
                <div class="row">
                    <div class="col md-3 text-left ">
                        <div class="btn-group mb-0">
                            <a class="btn btn-primary btn-sm dropdown-toggle"
                                href="{{route('admin.bookings.create')}}"><i class="fas fa-plus mr-2"></i>Rezervasyon
                                ekle</a>
                        </div>
                    </div>
                    <div class="col md-9 text-right">
                        <h4 id='groupid+meal'>Rezervasyon listesi</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="mealcategory">
                    {{-- meal başlıyor --}}
                    <div id="tekil">
                        <div id="accordion">
                            <div class="accordion">
                                <div class="accordion-header" data-toggle="collapse" data-target="#panel">
                                    {{-- #urun-mealid --}}

                                </div>
                                <div class="accordion-body collapse show border border-top-0 text-sm" id="panel"
                                    data-parent="#accordion">

                                    <h2 class=" mb-0">Rezervasyon Bilgileri</h2>

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
                                                        <tr
                                                            class="{{$booking->status==1 ? 'text-danger': 'text-bold'}}">
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
var table= $('#stafftable').DataTable();
});
</script>
@endsection