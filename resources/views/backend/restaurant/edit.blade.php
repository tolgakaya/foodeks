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
            <a class="dropdown-item" href="#"><i class="fas fa-plus mr-2"></i>Add new
                Page</a>
            <a class="dropdown-item" href="#"><i class="fas fa-eye mr-2"></i>View the page
                Details</a>
            <a class="dropdown-item" href="#"><i class="fas fa-edit mr-2"></i>Edit Page</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i> Settings</a>
        </div>
    </div>
</div>
<div class="container">
    <div class="card shadow">
        <div class="card-header">
            <h2 class="mb-0">Restaurant Bilgilerini Düzenleyin</h2>
        </div>
        <div class="card-body">
            <form action="{{route('admin.restaurant.update',['restaurant'=>$restaurant->id])}}" method="post">
                <div class="row">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Name Of Branch</label>
                            <input type="text" class="form-control" name="name" value="{{$restaurant->name}}"
                                placeholder="Name of restaurant" required>
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="form-group mb-0">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="4"
                                placeholder="text here..">{{$restaurant->description}}</textarea>
                            <input type="hidden" id="txtLatitude" name="coordinate">
                            <input type="hidden" id="ltd" name="latitude">
                            <input type="hidden" id="lng" name="longitude">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Telefon</label>
                            <input type="text" class="form-control" name="phone"
                                placeholder="Rezervasyon ve Sipariş Telefonu" value="{{$restaurant->phone}}" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Adres</label>
                            <input type="text" class="form-control" name="address"
                                placeholder="Restaurant adresini giriniz" value="{{$restaurant->address}}" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email"
                                placeholder="Sipariş/Rezervasyon email giriniz" value="{{$restaurant->email}}" required>
                        </div>
                    </div>
                    <div class=" col-md-12 ">
                        <div class="card shadow">
                            <div class="card-header">
                                <h2 class="mb-0">Restaurant Lokasyonu</h2>
                            </div>
                            <div class="card-body">
                                <div id="myMap" class="mapheight"></div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <input type="text" id='txtLatitude2' /> --}}
                <div class="row">
                    <div class="col-md-6 ">
                        <button class="btn btn-primary btn-block">Geri</button>
                    </div>
                    <div class="col-md-6 ">
                        <button class="btn btn-primary btn-block">Kaydet</button>
                    </div>
                </div>
            </form>
            <input type="hidden" id="id" value="{{$restaurant->id}}" />
        </div>
    </div>
    @endsection
    @section('extrascript')
    <!--GMap Plugin -->
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyDudjGDbcq3lKGFqFsHdGWZNgWOsNX4gjs"></script>
    <script src="{{asset('backend/js/harita-musteri-kaydet.js')}}"></script>

    <script>
        $( document ).ready(function() {
                // console.log( "document loaded" );
                initialize();
            });
         
            $( window ).on( "load", function() {
                console.log( "window loaded" );
            });
    </script>
    @endsection