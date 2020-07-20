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
        <input type="hidden" id="restaurantid" value="">
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
                            <a class="btn btn-primary btn-sm dropdown-toggle" href="{{route('admin.users.create')}}"><i
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
                        <h4 id='groupid+meal'>Sistem kullanıcıları</h4>
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

                                    <h2 class=" mb-0">Kullanıcı Bilgileri</h2>

                                    <div class="grid-margin">
                                        <div class="">
                                            <div class="table-responsive">
                                                <table id="stafftable"
                                                    class="table card-table table-vcenter text-nowrap  align-items-center">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Restaurant</th>
                                                            <th>Resim</th>
                                                            <th>Kullanıcı</th>
                                                            <th>Kullanıcı Adı</th>
                                                            <th>Görev</th>
                                                            <th>İşlem</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="staffbody">
                                                        @foreach($users as $user)
                                                        <tr>
                                                            <td>
                                                                {{$user->id}}</td>
                                                            <td>
                                                                @if(isset($user->restaurant))
                                                                {{$user->restaurant->name}}
                                                                @endif
                                                            </td>
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
                                                            <td>
                                                                <a class="btn btn-primary btn-sm"
                                                                    href="{{route('admin.users.delete',['user'=>$user->id])}}"><i
                                                                        class="fas fa-plus mr-2"></i>Sil</a>
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