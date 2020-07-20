@extends('backend/layouts/main')
@section('extracss')

<meta name="_token" content="{{csrf_token()}}" />
@endsection
@section('content')
<div class="page-header mt-0 shadow p-3">
    <ol class="breadcrumb mb-sm-0">
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active" aria-current="page">Empty Page</li>
    </ol>
    {{-- <div class="btn-group mb-0">
        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Actions</button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#"><i class="fas fa-plus mr-2"></i>Add new
                Page</a>
            <a class="dropdown-item" href="#"><i class="fas fa-eye mr-2"></i>View the page
                Details</a>
            <a class="dropdown-item" href="#"><i class="fas fa-edit mr-2"></i>Edit Page</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i> Settings</a>
        </div>
    </div> --}}
</div>
<div class="container">
    <div class="card shadow">
        <div class="card-header">
            <h2 class="mb-0">Yeni Kategoi Ekleyin</h2>
        </div>
        <div class="card-body">
            <form action="{{route('admin.categories.store')}}" method="post" id='haberForm'>
                <div class="row" id="haberDiv">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Kategori Adı</label>
                            <input type="text" class="form-control" name="category" placeholder="Kategori ismi girin"
                                required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Kategori Açıklaması</label>
                            <input type="text" class="form-control" name="description"
                                placeholder="Kategori açıklaması girin">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="submit" value="Kaydet">
                        </div>
                    </div>
                </div>
        </div>
        </form>

    </div>
</div>

</div>
@endsection