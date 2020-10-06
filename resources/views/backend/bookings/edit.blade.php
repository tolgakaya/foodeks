@extends('backend/layouts/main')
@section('extracss')
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
<meta name="_token" content="{{csrf_token()}}" />
@endsection
@section('content')
<div class="page-header mt-0 shadow p-3">
</div>
<div class="container">
    <div class="card shadow">
        <div class="card-header">
            <h2 class="mb-0">Rezervasyon Bilgileri</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.bookings.update',['booking'=>$booking->id]) }}">
                <div class="row" id="haberDiv">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Restaurant/Şube</label>
                            <select class="selectpicker form-control" name="restaurant_id">
                                @foreach ($restaurants as $restaurant)
                                <option value="{{$restaurant->id}}"
                                    {{$booking->restaurant_id == $restaurant->id ? 'selected' :''}}>
                                    {{$restaurant->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 ">

                        <div class="form-group">
                            <label>Ad-Soyad</label>
                            <input id="name" type="text" class="form-control @error('adi') is-invalid @enderror"
                                name="name" value="{{$booking->name}}" required autocomplete="name" autofocus
                                placeholder="Ad Soyad giriniz">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 ">

                        <div class="form-group">
                            <label>Cep Telefonu</label>
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                name="phone" value="{{$booking->phone}}" required autocomplete="mobile" autofocus
                                placeholder="Telefon giriniz">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label>Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{$booking->email}}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tarih</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input class="form-control datepicker" placeholder="Select date" type="text"
                                            name="date" value="{{$booking->formatDate()}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label>Saat</label>
                                    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#datetimepicker1" name="time" value="{{$booking->time}}" />
                                        <div class="input-group-append" data-target="#datetimepicker1"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">

                                <div class="form-group ">
                                    <label>Kişi sayısı</label>
                                    <input type="number" id="quantity" name="quantity" class="form-control"
                                        placeholder="Kişi sayısı giriniz" value="{{$booking->quantity}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <label>Müşteri notu</label>
                            <textarea class="form-control" style="height:150px"
                                placeholder="Rezervasyona özel bir notunuz varsa bu alana yazabilirsiniz..."
                                name="notes" id="notes">{{$booking->notes}}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <div class="text-center"><button type="submit"
                                    class="btn btn-primary btn-block">Kaydet</button></div>
                        </div>
                    </div>
            </form>

        </div>

    </div>
    @endsection

    @section('extrascript')


    <script>
        $(document).ready(function(){
    $("#btnKaydet").click(function(){        
        $("#haberForm").submit(); // Submit the form
    });
});
    </script>


    <script src="{{asset('backend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('frontend/js/bootstrap-datepicker.tr.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js">
    </script>

    <script>
        $('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    language: 'tr',
    'setDate':'today',
    });
    </script>
    <script type="text/javascript">
        $('#datetimepicker3').datetimepicker();
           
    </script>
    <script type="text/javascript">
        $('#datetimepicker1').datetimepicker({
    format: 'HH:mm:ss',
    locale:'tr'
    });
                        
    </script>
    @endsection