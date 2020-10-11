@extends('backend/layouts/main')
@section('extracss')
<meta name="_token" content="{{csrf_token()}}" />
<link rel="stylesheet" href="{{asset('backend//plugins/select2/select2.css')}}">
<!-- Data table css -->
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="{{asset('backend/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{asset('frontend/css/loader.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="page-header mt-0 shadow p-3">

    {{-- <div class="btn-group mb-0">
        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Actions</button>

    </div> --}}
</div>
<div class="row">
    <input type="hidden" id="restaurantid" value="">
    @foreach ($orders as $order)
    <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="snip1492 card shadow">
            {{-- <img src="{{asset('assets/img/products/1.jpg')}}" alt="sample85" /> --}}
            <div class="figcaption">
                <h3>{{$order->address->contact_name}} - {{$order->orderno}}</h3>
                <p>{{$order->address->address}}</p>
                @foreach ($order->orderdetails as $detail)
                <p>
                    {{$detail->quantity}} X {{$detail->option_name}} {{$detail->meal_name}}
                </p>
                @endforeach
                <div class="price">
                    {{-- <s>$80.00</s> --}}
                    {{$order->total}} TL
                </div>
            </div>
            {{-- <a href="tel:{{$order->address->phone}}">Ara {{$order->address->phone}}</a> --}}
            {{-- <i class="ion-ios-cart"></i> --}}
            <div class="text-center">
                <div class="btn-group">
                    <button id="btnTeslim" data-status="teslim" data-order="{{$order->id}}"
                        class="btn btn-sm btn-primary status" href="cart.html">Teslim Edildi</button>
                    <button id="btnIptal" data-status="iptal" data-order="{{$order->id}}"
                        class="btn btn-sm btn-danger status">İptal
                        Edildi</button>
                    <form method="GET" action="{{route('carriers.orders.addshow',['order'=>$order->id])}}">
                        <button type="submit" class="btn btn-sm btn-success">Harita</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    @endforeach
</div>

@endsection

@section('extrascript')

<script>
    $(document).ready(function () {
    $('.status').click(function () {
     var status=   $(this).data('status');
     var orderid= $(this).data('order');
    var orderModel = {
            orderid: orderid,
            status:status
    };
    $.ajax({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    },
    url: "/carriers/orders/status/"+orderid,
    data: JSON.stringify(orderModel),
    type: "POST",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    success: function (result) {
    if(result.error){
    alert(result.error);
    }
    location.reload();
   },
    error: function (errormessage) {
    alert(errormessage.error);
    }
    });
    });
    });
</script>

@endsection