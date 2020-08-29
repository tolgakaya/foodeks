@extends('backend/layouts/main')
@section('extracss')
<meta name="_token" content="{{csrf_token()}}" />

@endsection
@section('content')
<div class="page-header mt-0 shadow p-3">
    <input type="hidden" id="orderid" value="{{$order->id}}">
    <div class="btn-group mb-0">
        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Actions</button>
        <input type="hidden" id="restaurantid" value="">
    </div>
</div>
<div class="row">
    <div class=" col-md-12 ">
        <div class="card shadow">
            <div class="card-header">
                <h2 class="mb-0">Müşteri Adresi</h2>
            </div>
            <div class="card-body">
                <div id="myMap" class="mapheight"></div>
            </div>

            <button id="btnGeri" class="btn btn-block btn-primary" href="cart.html">Geri</button>

        </div>
    </div>

    @endsection

    @section('extrascript')
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyDudjGDbcq3lKGFqFsHdGWZNgWOsNX4gjs"></script>
    <script src="{{asset('backend/js/carrier.js')}}"></script>
    <script>
        $( document ).ready(function() {
                    // console.log( "document loaded" );
                    initialize();
                    $('#btnGeri').on('click',function () {
                        window.history.back();
                    });
                });
             
                $( window ).on( "load", function() {
                    console.log( "window loaded" );
                });
    </script>
    @endsection