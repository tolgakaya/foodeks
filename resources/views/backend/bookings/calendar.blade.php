@extends('backend/layouts/main')
@section('extracss')
<meta name="_token" content="{{csrf_token()}}" />
<link rel="stylesheet" href="{{asset('backend//plugins/select2/select2.css')}}">
<!-- Data table css -->
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="{{asset('backend/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<!--Fullcalendar css-->
<link href='{{asset('backend/plugins/fullcalendar/fullcalendar.css')}}' rel='stylesheet' />
<link href='{{asset('backend/plugins/fullcalendar/fullcalendar.print.min.css')}}' rel='stylesheet' media='print' />
@endsection
@section('content')
<div class="page-header mt-0 shadow p-3">

</div>

<div class="row">
    <div class="col-md-12">

        <div class="card" id="catt">
            <div class="card-header">
                <div class="row">
                    <div class="col md-3 text-left ">
                        <div class="btn-group mb-0">
                            <a class="btn btn-primary btn-sm dropdown-toggle"
                                href="{{route('admin.bookings.create')}}"><i class="fas fa-plus mr-2"></i>Rezervasyon
                                ekle</a>
                        </div>
                    </div>
                    <div class="col md-9 text-right">
                        <h4 id='groupid+meal'>Rezervasyon listesi</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="response"></div>
                <div id='calendar'></div>
            </div>
        </div>

    </div>

</div>
<div class="row">
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
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
                    {{-- modal body başlıyor --}}
                    <form method="POST" action="{{ route('admin.bookings.store') }}">
                        <div class="row" id="haberDiv">
                            @csrf
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Restaurant/Şube</label>
                                    <select class="selectpicker form-control" name="restaurant_id" id="restaurant_id">
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
                                        <input id="name" type="text"
                                            class="form-control @error('adi') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus
                                            placeholder="Ad Soyad giriniz">
                                        <input type="hidden" id="rezid">
                                        <input type="hidden" id="eventStart">
                                        <input type="hidden" id="eventEnd">
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
                                    <input id="phone" type="text"
                                        class="form-control @error('phone') is-invalid @enderror" name="phone"
                                        value="{{ old('phone') }}" required autocomplete="mobile" autofocus
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
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">
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
                                                    <span class="input-group-text"><i
                                                            class="ni ni-calendar-grid-58"></i></span>
                                                </div>
                                                <input class="form-control datepicker" placeholder="Select date"
                                                    type="text" name="date" id="tarih" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label>Saat</label>
                                            <div class="input-group date" id="datetimepicker1"
                                                data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#datetimepicker1" name="time" id="saat" disabled />
                                                <div class="input-group-append" data-target="#datetimepicker1"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <input class="form-control datepicker" id="baslangic" placeholder="Select date"
                                            type="hidden" name="date">
                                        <input type="hidden" class="form-control datetimepicker-input" id="son"
                                            data-target="#datetimepicker1" name="time" />
                                        <div class="form-group ">
                                            <label>Kişi sayısı</label>
                                            <input type="number" id="quantity" name="quantity" id="quantity"
                                                class="form-control" placeholder="Kişi sayısı giriniz">
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
                                    <div class="text-center"><button type="submit" class="btn btn-primary btn-block"
                                            id="btnKaydet">Kaydet</button></div>
                                </div>
                            </div>
                    </form>

                    {{-- modal body bitiyor --}}
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSil" class="btn btn-danger">Sil</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>

                </div>
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
<!--Fullcalendar js-->
<script src='{{asset('backend/plugins/fullcalendar/moment.min.js')}}'></script>
<script src='{{asset('backend/plugins/fullcalendar/jquery-ui.min.js')}}'></script>
<script src='{{asset('backend/plugins/fullcalendar/fullcalendar.min.js')}}'></script>
<script src="{{asset('backend/js/fullcalendar.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.6.1/locale-all.js"></script>

<script>
    $(document).ready(function () {
var SITEURL = "{{url('/')}}";
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
var calendar = $('#calendar').fullCalendar({
    header: {
    left: 'prev,next today',
    center: 'title',
    right: 'month,agendaWeek,agendaDay'
    },
    defaultView: 'agendaDay',
    eventBorderColor: "#de1f1f",
editable: true,
locale:'tr',
events: "/admin/bookings/calendar",
displayEventTime: true,
// editable: true,
eventRender: function (event, element) {
    console.log(event);
        $(element).tooltip({ title: event.title });
        element.css('background-color', '#'+event.color);
        },
selectable: true,
selectHelper: true,
select: function (start, end, allDay) {

    //burası
// var title = prompt('Event Title:');

var baslangic = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
var son = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
let copyOf = new Date(start.valueOf())

var tarih=$.fullCalendar.formatDate(start, "DD/MM/Y");
var saat=$.fullCalendar.formatDate(end, "HH:mm:ss");
$('#rezid').val('');
$('#tarih').val(tarih);
$('#saat').val(saat);
 $('#baslangic').val(baslangic);
$('#son').val(son);
$('#userModal').modal('show');

//burası
calendar.fullCalendar('unselect');
},
eventDrop: function (event, delta) {
var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
var update = {
title:title,
start:start,
end:end,
id:event.id
};

$.ajax({
headers: {
'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
},
url: '/admin/fullcalendar/update',
data:JSON.stringify(update) ,
type: "POST",
contentType: "application/json;charset=utf-8",
dataType: "json",
success: function (response) {
displayMessage("Updated Successfully");
}
});
},
eventClick: function (event) {
// var deleteMsg = confirm("Do you really want to delete?");
// if (deleteMsg) {
//     var willDelete={
//         id:event.id
//     };
console.log(event);
var editUrl='/admin/bookings/edit/'+event.id;

$.ajax({
headers: {
'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
},
type: "GET",
url:  editUrl,
// data: JSON.stringify(willDelete),
contentType: "application/json;charset=utf-8",
dataType: "json",
success: function (response) {

    console.log(response);

           $('#tarih').val(response.date);
           $('#saat').val(response.time);
            $('#quantity').val(response.quantity);
           $('#notes').val(response.notes);
            $('#name').val(response.name);
           $('#phone').val(response.phone);
           $('#email').val(response.email);
           $('#eventStart').val(event.start);
           $('#eventEnd').val(event.end);
           $('#rezid').val(response.id);
            $('#userModal').modal('show');
            // if(parseInt(response) > 0) {
            // $('#calendar').fullCalendar('removeEvents', event.id);
            // displayMessage("Deleted Successfully");
            // }
}
});
// }
}
});
$('#btnKaydet').on('click', function (e) {
    // We don't want this to act as a link so cancel the link action
    e.preventDefault();
   var rezz= $('#rezid').val();
   if(rezz){
        doUpdate();
   }else{
       doSubmit();
   }
   
    });
    $('#btnSil').on('click', function (e) {
    // We don't want this to act as a link so cancel the link action
    e.preventDefault();
    var rezz= $('#rezid').val();
    if(rezz){
    doDelete();
    }
    
    });
    function doSubmit() {
       
        var restaurant_id=$('#restaurant_id').val();
        var date=$('#tarih').val();
        var time=$('#saat').val();
        var quantity=$('#quantity').val();
        var notes=$('#notes').val();
        var name=$('#name').val();
        var phone=$('#phone').val();
        var email=$('#email').val();

        var send = {
                    restaurant_id: restaurant_id,
                    date: date,
                    time: time,
                    quantity:quantity,
                    notes:notes,
                    name:name,
                    phone:phone,
                    email:email
        };
        var donenId=0;
        $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        url: "/admin/bookings",
        data: JSON.stringify(send),
        type: "POST",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        success: function (data) {
            console.log('donen deger=>'+data.id);
            // donenId=data.id;
            $('#rezid').val(data.id);
        // displayMessage("Added Successfully");
        $("#userModal").modal('hide');
        window.location.reload();
        }
        });
 
    // $("#calendar").fullCalendar('renderEvent',
    // {
    //             id:$('#rezid').val(),
    //             title: $('#name').val(),
    //             start: new Date($('#baslangic').val()),
    //             end: new Date($('#son').val()),
    // },
    // true);
    }
    //update
function doUpdate() {
    
    var rezid=$('#rezid').val();
    var date=$('#tarih').val();
    var time=$('#saat').val();
    var quantity=$('#quantity').val();
    var notes=$('#notes').val();
    var name=$('#name').val();
    var phone=$('#phone').val();
    var email=$('#email').val();
    
var send = {
    rezid: rezid,
    quantity: quantity,
    notes: notes,
    name: name,
    phone: phone,
    email: email
    };
    var updateUrl="/admin/bookings/update/"+rezid;
$.ajax({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    },
    url: updateUrl,
    data: JSON.stringify(send),
    type: "POST",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    success: function (data) {
    displayMessage("Added Successfully");
    $("#userModal").modal('hide');
    window.location.reload();
    }
    });
//     var bas=$.fullCalendar.parseISO8601($('#eventStart').val());
//    var en=$.fullCalendar.parseISO8601($('#eventEnd').val());
 
//     var start = $.fullCalendar.formatDate(bas, "Y-MM-DD HH:mm:ss");
//     var end = $.fullCalendar.formatDate(en, "Y-MM-DD HH:mm:ss");
    // $("#calendar").fullCalendar('updateEvent',
    // {
    //   //  burada güncelleme gösterilecek
    // title: $('#name').val(),
    // start: start,
    // end: end,
    // },
    // true);
    }
    //update

    //delete
    function doDelete() {
    
    var rezid=$('#rezid').val();
      
    var send = {
    rezid: rezid,

    };
    var deleteUrl="/admin/bookings/delete/"+rezid;
    $.ajax({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    },
    url: deleteUrl,
    // data: JSON.stringify(send),
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    success: function (data) {
    displayMessage("Added Successfully");
    $("#userModal").modal('hide');
    window.location.reload();
    }
    });
    // var bas=$.fullCalendar.parseISO8601($('#eventStart').val());
    // var en=$.fullCalendar.parseISO8601($('#eventEnd').val());
    
    // var start = $.fullCalendar.formatDate(bas, "Y-MM-DD HH:mm:ss");
    // var end = $.fullCalendar.formatDate(en, "Y-MM-DD HH:mm:ss");
    // $("#calendar").fullCalendar('updateEvent',
    // {
    // // burada güncelleme gösterilecek
    // title: $('#name').val(),
    // start: start,
    // end: end,
    // },
    // true);
    }
    //delete
});
function displayMessage(message) {
$(".response").html("<div class='success'>"+message+"</div>");
setInterval(function() { $(".success").fadeOut(); }, 1000);
}
</script>
<script>
    $(document).ready(function () {
var table= $('#stafftable').DataTable();
});
</script>
@endsection