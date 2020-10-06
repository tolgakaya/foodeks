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

</div>
<div class="container">
    <div class="card shadow">
        <div class="card-header">
            <h2 class="mb-0">Yeni Rezervasyon Ekleyin</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.bookings.store') }}">
                <div class="row" id="haberDiv">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Restaurant/Şube</label>
                            <select class="selectpicker form-control" name="restaurant_id">
                                @foreach ($restaurants as $restaurant)
                                <option value="{{$restaurant->id}}">{{$restaurant->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 ">

                        <div class="form-group">
                            <label class="form-label">Ad-Soyad</label>
                            <div class="input-group">
                                <input id="name" type="text" class="form-control @error('adi') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                    placeholder="Ad Soyad giriniz">
                                <span class="input-group-append">
                                    <button class="btn btn-primary" type="button"><a
                                            class="btn btn-primary btn-sm dropdown-toggle" href="#" data-toggle="modal"
                                            data-target="#userModal" data-val={{$restaurant->id}}><i
                                                class="fas fa-plus mr-2"></i>Bak</a></button>
                                </span>
                            </div>
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
                                name="phone" value="{{ old('phone') }}" required autocomplete="mobile" autofocus
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
                                name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <input type="hidden" id="userid" name="user_id">
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
                                            name="date" value="20/08/2020">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label>Saat</label>
                                    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#datetimepicker1" name="time" />
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
                                        placeholder="Kişi sayısı giriniz">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <label>Müşteri notu</label>
                            <textarea class="form-control" style="height:150px"
                                placeholder="Rezervasyona özel bir notunuz varsa bu alana yazabilirsiniz..."
                                name="notes" id="notes"></textarea>
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
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userlModalLabel"
        aria-hidden="true">
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
                                    <th>İsim</th>
                                    <th>Telefon</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody id="userbody">
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->adi}}</td>
                                    <td>{{$user->mobile}}</td>
                                    <td>{{$user->email}}</td>
                                </tr>
                                @endforeach
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
    <script src="{{asset('backend/plugins/select2/select2.full.js')}}"></script>
    <script src="{{asset('backend/js/select2.js')}}"></script>
    <!-- Data tables -->
    <script src="{{asset('backend/plugins/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>
    {{-- <script src="{{asset('backend/js/menu.js')}}"></script> --}}
    <script>
        $(document).ready(function () {
        var table = $('#example2').DataTable();
     
        $('#example2 #userbody').on('click', 'tr', function () {
        console.log('clickledim');

        if ($(this).hasClass('selected')) {
        $(this).removeClass('selected');
        } else {
        table.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
        }
        });

    $('#btnsave').click(function () {
    var dataArr = [];
    var rows = $('tr.selected');
    var rowData = table.rows(rows).data();
    $.each($(rowData), function (key, value) {
    dataArr.push(value[0]);
    dataArr.push(value[1]);
    dataArr.push(value[2]);
    dataArr.push(value[3]);

    });
     $('#userid').val(dataArr[0]);
    $('#name').val(dataArr[1]);
    $('#phone').val(dataArr[2]);
    $('#email').val(dataArr[3]);
    $('#userModal').modal('hide');
    });
        });
 
 
    </script>
    @endsection