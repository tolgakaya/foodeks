@extends('backend/layouts/main')
@section('extracss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<link href="{{asset('backend/css/image-checkbox.css')}}" rel="stylesheet" />

<meta name="_token" content="{{csrf_token()}}" />
@endsection
@section('content')

<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mx-auto ">
                <div class="card-header">
                    <h2 class="mb-0">Sidebar Reklam Listesi</h2>
                </div>
                <div class="card-body">
                    {{-- <form action="{{route('admin.pages.ad.store')}}" method="post" id='haberForm'> --}}
                    <div class="row" id="haberDiv">
                        @csrf

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Birinci Reklam</label>
                                    <input class="form-control" name="paralax_sub_text" id="link"
                                        value="{{$ads->link ?? ''}}"
                                        placeholder="Birinci reklam linkini yazın.(http://.....)" \>
                                </div>
                                <div class="form-group">
                                    {{-- <label class="form-label">Arkaplan Birinci Görseli</label> --}}

                                    <form method="post" action="{{route('admin.meals.media.store')}}"
                                        enctype="multipart/form-data" class="dropzone" id="reklam1">
                                        @csrf
                                    </form>
                                    <input type="hidden" id="filename" value="{{$ads->filename ??  ""}}">
                                </div>
                            </div>
                            <div class="col-md-6 pull-right ">
                                <div class="form-group">
                                    <label class="form-label">İkinci Reklam</label>
                                    <input class="form-control" name="paralax_sub_text"
                                        placeholder="İkinci reklam linkini yazın.(http://.....)" id="link2"
                                        value="{{$ads->link2 ?? ''}}" \>
                                </div>
                                <div class="form-group">
                                    {{-- <label class="form-label">Arkaplan İkinci Görseli</label> --}}
                                    <form method="post" action="{{route('admin.meals.media.store')}}"
                                        enctype="multipart/form-data" class="dropzone" id="reklam2">
                                        @csrf
                                    </form>
                                    <input type="hidden" id="filename2" value="{{$ads->filename2 ??  ""}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Üçüncü Reklam</label>
                                    <input class="form-control" name="paralax_sub_text"
                                        placeholder="Üçüncü reklam linkini yazın.(http://.....)" id="link3"
                                        value="{{$ads->link3 ?? ''}}" \>
                                </div>
                                <div class="form-group">
                                    {{-- <label class="form-label">Arkaplan Birinci Görseli</label> --}}

                                    <form method="post" action="{{route('admin.meals.media.store')}}"
                                        enctype="multipart/form-data" class="dropzone" id="reklam3">
                                        @csrf
                                    </form>
                                    <input type="hidden" id="filename3" value="{{$ads->filename3 ??  ""}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Dördüncü Reklam</label>
                                    <input class="form-control" name="paralax_sub_text"
                                        placeholder="Dördüncü reklam linkini yazın.(http://.....)" id="link4"
                                        value="{{$ads->link4 ?? ''}}" \>
                                </div>
                                <div class="form-group">
                                    {{-- <label class="form-label">Arkaplan İkinci Görseli</label> --}}
                                    <form method="post" action="{{route('admin.meals.media.store')}}"
                                        enctype="multipart/form-data" class="dropzone" id="reklam4">
                                        @csrf
                                    </form>
                                    <input type="hidden" id="filename4" value="{{$ads->filename4 ??  ""}}">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <button class="btn btn-primary btn-block" id="btnKaydet">Kaydet</button>
            </div>

        </div>



    </div>
    {{-- burası --}}
</div>


@endsection

@section('extrascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>

<script type="text/javascript">
    // Dropzone.autoDiscover = false;
    Dropzone.options.reklam1 =
         {
            maxFilesize: 12,
            maxFiles:1,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 5000,
            init: function() {
                    this.on("maxfilesexceeded", function(file){
                    alert("Yalnızca tek dosya yükleyebilirsiniz!");
                    this.removeFile(file);
                    });
                    var thisDropzone = this;
                            
                            var image="{{ asset('images') }}/";
                            var i=$("#filename").val();
                            var defaultValue=image+i;
                            //Call the action method to load the images from the server
                            //// Create the mock file:
                            var mockFile = {
                            name: i,
                            size: 123456
                            };
                            
                            // Call the default addedfile event handler
                            thisDropzone.emit("addedfile", mockFile);
                            
                            // And optionally show the thumbnail of the file:
                            thisDropzone.emit("thumbnail", mockFile,defaultValue);
            },
          removedfile: function(file)
        {
        // var name = file.upload.filename;
        var name=$("#filename").val();
        $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        type: 'POST',
        url: '{{ url("admin/meals/media/delete") }}',
        data: {filename: name},
        success: function (data){
 
        // $('#'+name).remove();
        $('#filename').val('');
  
        },
        error: function(e) {
        console.log(e.message);
        }});
        var fileRef;
        return (fileRef = file.previewElement) != null ?
        fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },

        success: function(file,response){
                var _html='';
                var image="{{ asset('images') }}/";
       
        $('#filename').val(response.success);
     
        },
        error: function(file, response)
        {
        return false;
        }
};
</script>

<script type="text/javascript">
    // Dropzone.autoDiscover = false;
    Dropzone.options.reklam2 =
         {
            maxFilesize: 12,
            maxFiles:1,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 5000,
            init: function() {
                    this.on("maxfilesexceeded", function(file){
                    alert("Yalnızca tek dosya yükleyebilirsiniz!");
                    this.removeFile(file);
                    });
                    var thisDropzone = this;
                            
                            var image="{{ asset('images') }}/";
                            var i=$("#filename2").val();
                            var defaultValue=image+i;
                            //Call the action method to load the images from the server
                            //// Create the mock file:
                            var mockFile = {
                            name: i,
                            size: 123456
                            };
                            
                            // Call the default addedfile event handler
                            thisDropzone.emit("addedfile", mockFile);
                            
                            // And optionally show the thumbnail of the file:
                            thisDropzone.emit("thumbnail", mockFile,defaultValue);
            },
          removedfile: function(file)
        {
        // var name = file.upload.filename;
        var name=$("#filename2").val();
        $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        type: 'POST',
        url: '{{ url("admin/meals/media/delete") }}',
        data: {filename: name},
        success: function (data){
 
        // $('#'+name).remove();
        $('#filename2').val('');
  
        },
        error: function(e) {
        console.log(e.message);
        }});
        var fileRef;
        return (fileRef = file.previewElement) != null ?
        fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },

        success: function(file,response){
                var _html='';
                var image="{{ asset('images') }}/";
       
        $('#filename2').val(response.success);
     
        },
        error: function(file, response)
        {
        return false;
        }
};
</script>

<script type="text/javascript">
    // Dropzone.autoDiscover = false;
    Dropzone.options.reklam3 =
         {
            maxFilesize: 12,
            maxFiles:1,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 5000,
            init: function() {
                    this.on("maxfilesexceeded", function(file){
                    alert("Yalnızca tek dosya yükleyebilirsiniz!");
                    this.removeFile(file);
                    });
                    var thisDropzone = this;
                            
                            var image="{{ asset('images') }}/";
                            var i=$("#filename3").val();
                            var defaultValue=image+i;
                            //Call the action method to load the images from the server
                            //// Create the mock file:
                            var mockFile = {
                            name: i,
                            size: 123456
                            };
                            
                            // Call the default addedfile event handler
                            thisDropzone.emit("addedfile", mockFile);
                            
                            // And optionally show the thumbnail of the file:
                            thisDropzone.emit("thumbnail", mockFile,defaultValue);
            },
          removedfile: function(file)
        {
        // var name = file.upload.filename;
        var name=$("#filename3").val();
        $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        type: 'POST',
        url: '{{ url("admin/meals/media/delete") }}',
        data: {filename: name},
        success: function (data){
 
        // $('#'+name).remove();
        $('#filename3').val('');
  
        },
        error: function(e) {
        console.log(e.message);
        }});
        var fileRef;
        return (fileRef = file.previewElement) != null ?
        fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },

        success: function(file,response){
                var _html='';
                var image="{{ asset('images') }}/";
       
        $('#filename3').val(response.success);
     
        },
        error: function(file, response)
        {
        return false;
        }
};
</script>
<script type="text/javascript">
    // Dropzone.autoDiscover = false;
    Dropzone.options.reklam4 =
         {
            maxFilesize: 12,
            maxFiles:1,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 5000,
            init: function() {
                    this.on("maxfilesexceeded", function(file){
                    alert("Yalnızca tek dosya yükleyebilirsiniz!");
                    this.removeFile(file);
                    });
                    var thisDropzone = this;
                            
                            var image="{{ asset('images') }}/";
                            var i=$("#filename4").val();
                            var defaultValue=image+i;
                            //Call the action method to load the images from the server
                            //// Create the mock file:
                            var mockFile = {
                            name: i,
                            size: 123456
                            };
                            
                            // Call the default addedfile event handler
                            thisDropzone.emit("addedfile", mockFile);
                            
                            // And optionally show the thumbnail of the file:
                            thisDropzone.emit("thumbnail", mockFile,defaultValue);
            },
          removedfile: function(file)
        {
        // var name = file.upload.filename;
        var name=$("#filename4").val();
        $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        type: 'POST',
        url: '{{ url("admin/meals/media/delete") }}',
        data: {filename: name},
        success: function (data){
 
        // $('#'+name).remove();
        $('#filename4').val('');
  
        },
        error: function(e) {
        console.log(e.message);
        }});
        var fileRef;
        return (fileRef = file.previewElement) != null ?
        fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },

        success: function(file,response){
                var _html='';
                var image="{{ asset('images') }}/";
       
        $('#filename4').val(response.success);
     
        },
        error: function(file, response)
        {
        return false;
        }
};
</script>
<script>
    $(document).ready(function(){
$('#btnKaydet').on('click', function (e) {
    e.preventDefault();
 var link = $('#link').val();
 var filename = $('#filename').val();
 var link2 = $('#link2').val();
var filename2 = $('#filename2').val();
var link3 = $('#link3').val();
var filename3 = $('#filename3').val();
var link4 = $('#link4').val();
var filename4 = $('#filename4').val();
 
var reklamModel = {
link: link,
filename:filename,
link2: link2,
filename2:filename2,
link3: link3,
filename3:filename3,
link4: link4,
filename4:filename4,
};
$.ajax({
headers: {
'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
},
url: "/admin/pages/ad",
data:JSON.stringify( reklamModel),
type: "POST",
contentType: "application/json;charset=UTF-8",
dataType: "json",
success: function (result) {
//burada ilgili alanı renklendirelim
console.log(result);
location.reload();
},
error: function (errormessage) {
alert(errormessage.responseText);
}
});
 
});


});
 
</script>
@endsection