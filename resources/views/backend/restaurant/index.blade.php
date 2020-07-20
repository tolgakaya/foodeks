@extends('backend/layouts/main')

@section('content')
<div class="page-header mt-0 shadow p-3">
    <ol class="breadcrumb mb-sm-0">
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active" aria-current="page">Empty Page</li>
    </ol>
    <div class="btn-group mb-0">
        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Actions</button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{route('admin.restaurant.create')}}"><i class="fas fa-plus mr-2"></i>Add new
                restaurant</a>
            <a class="dropdown-item" href="#"><i class="fas fa-eye mr-2"></i>View the page
                Details</a>
            <a class="dropdown-item" href="#"><i class="fas fa-edit mr-2"></i>Edit Page</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i> Settings</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <h2 class="mb-0">Data Table</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered w-100 text-nowrap">
                        <thead>
                            <tr>
                                <th class="wd-15p">ID</th>
                                <th class="wd-15p">Name</th>
                                <th class="wd-20p">Description</th>
                                <th class="wd-20p">Distance</th>
                                <th class="wd-25p">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($restaurants as $restaurant)
                            <tr>
                                <td>{{$restaurant->id}}</td>
                                <td>{{$restaurant->name}}</td>
                                <td>{{$restaurant->description}}</td>
                                <td>{{$restaurant->distance}}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-danger"><i class=" fa fa-trash"></i></a>
                                    <a href="{{route('admin.restaurant.edit',['restaurant'=>$restaurant->id])}}"
                                        class="btn btn-sm btn-primary"><i class=" fa fa-pen"></i></a>
                                    <a href="{{route('admin.restaurant.staffs',['restaurant'=>$restaurant->id])}}"
                                        class="btn btn-sm btn-primary"><i class=" fa fa-user"></i></a>
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
    
    			var table = $('#example1').DataTable();
    			$('button').click( function() {
    				var data = table.$('input, select').serialize();
    				alert(
    					"The following data would have been submitted to the server: \n\n"+
    					data.substr( 0, 120 )+'...'
    				);
    				return false;
    			});
    			$('#example2').DataTable( {
    				"scrollY":        "200px",
    				"scrollCollapse": true,
    				"paging":         false
    			});
    		} );
    
</script>
@endsection