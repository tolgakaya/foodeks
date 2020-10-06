@extends('backend/layouts/main')
@section('extracss')
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="{{asset('backend/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<meta name="_token" content="{{csrf_token()}}" />
@endsection
@section('content')
<div class="page-header mt-0 shadow p-3">
    <ol class="breadcrumb mb-sm-0">
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active" aria-current="page">Empty Page</li>
    </ol>

</div>
<div class="container">
    <div class="card shadow">
        <div class="card-header">
            <h2 class="mb-0">{{$restaurant->name}} Çalışma Zamanları</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.restaurants.times.store',['restaurant'=>$restaurant->id]) }}">
                <div class="row" id="haberDiv">
                    @csrf
                    <div class="col-md-12">
                        @if (!empty($gunler))
                        @foreach ($gunler as $gun => $time)
                        <div class="row">
                            <div class="col-md-2 my-auto">
                                {{-- <div class="form-group"> --}}
                                <label>{{$gun}}</label>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group ">
                                    <label>Açılış</label>
                                    <div class="input-group date" id="datetimepicker{{$time->day}}"
                                        data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#datetimepicker{{$time->day}}"
                                            name="openning_time[{{$time->day}}]" value={{$time->openning_time}} />
                                        <div class="input-group-append" data-target="#datetimepicker{{$time->day}}"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group ">
                                    <label>Kapanış</label>
                                    <div class="input-group date" id="kdatetimepicker{{$time->day}}"
                                        data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#kdatetimepicker{{$time->day}}"
                                            name="closing_time[{{$time->day}}]" value={{$time->closing_time}} />
                                        <div class="input-group-append" data-target="#kdatetimepicker{{$time->day}}"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endforeach
                        @endif
                        {{-- burada eksik gün varsa ekliyoruz --}}
                        @if (!empty($eksik))
                        @foreach ($eksik as $gun => $sayi)
                        <div class="row">
                            <div class="col-md-2 my-auto">
                                {{-- <div class="form-group"> --}}
                                <label>{{$gun}}</label>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group ">
                                    <label>Açılış</label>
                                    <div class="input-group date" id="datetimepicker{{$sayi}}"
                                        data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#datetimepicker{{$sayi}}" name="openning_time[{{$sayi}}]" />
                                        <div class="input-group-append" data-target="#datetimepicker{{$sayi}}"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group ">
                                    <label>Kapanış</label>
                                    <div class="input-group date" id="kdatetimepicker{{$sayi}}"
                                        data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#kdatetimepicker{{$sayi}}" name="closing_time[{{$sayi}}]" />
                                        <div class="input-group-append" data-target="#kdatetimepicker{{$sayi}}"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endforeach
                        @endif
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


    <script type="text/javascript">
        for (i = 1; i < 8; i++) { 
        $('#datetimepicker'+i).datetimepicker({
            format: 'HH:mm:ss',
            locale:'tr'
            });
            $('#kdatetimepicker'+i).datetimepicker({
                            format: 'HH:mm:ss',
                            locale:'tr'
                            });
}


    
        
    </script>
    <script src="{{asset('backend/plugins/select2/select2.full.js')}}"></script>
    <script src="{{asset('backend/js/select2.js')}}"></script>
    <!-- Data tables -->
    <script src="{{asset('backend/plugins/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>
    {{-- <script src="{{asset('backend/js/menu.js')}}"></script> --}}

    @endsection