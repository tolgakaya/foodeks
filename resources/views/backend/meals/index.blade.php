@extends('backend/layouts/main')

@section('content')
<div class="page-header mt-0 shadow p-3">


</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <div class="btn-group mb-0  float-right">
                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">İşlemler</button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('admin.meals.create')}}"><i
                                class="fas fa-plus mr-2"></i>Yeni Ürün Ekle</a>

                    </div>
                </div>
                <h2 class="mb-0">F&B Listesi</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered w-100 text-nowrap">
                        <thead>
                            <tr>
                                <th class="wd-15p">ID</th>
                                <th class="wd-15p">Kategori</th>
                                <th class="wd-15p">F&B İsmi</th>
                                <th class="wd-25p">İşlem</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($meals as $meal)
                            <tr>
                                <td>{{$meal->id}}</td>
                                <td>{{$meal->category->category}}</td>
                                <td>{{$meal->name}}</td>

                                <td>
                                    <a href="{{route('admin.meals.sil',['meal'=>$meal->id])}}"
                                        class="btn btn-sm btn-danger"><i class=" fa fa-trash"></i></a>

                                    <a href="{{route('admin.meals.edit',['meal'=>$meal->id])}}"
                                        class="btn btn-sm btn-primary"><i class=" fa fa-pen"></i></a>

                                    <a href="{{route('admin.meals.details',['meal'=>$meal->id])}}"
                                        class="btn btn-sm btn-primary"><i class=" fa fa-plus"></i></a>
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
@endsection

@section('extrascript')
<script>
    $(function(e) {
    			$('#example').DataTable();
          	 
    		} );
    
</script>


@endsection