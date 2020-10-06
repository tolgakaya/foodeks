@extends('backend/layouts/main')
@section('extracss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<link href="{{asset('backend/css/image-checkbox.css')}}" rel="stylesheet" />
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
    <div class="row">

    </div>
    <div class="card shadow">
        <div class="card-header">
            <h2 class="mb-0">Restaurant Sayfası İçeriği</h2>
        </div>
        <div class="card-body">
            <form action="{{route('admin.pages.restaurant.store')}}" method="post" id='haberForm'>
                <div class="row" id="haberDiv">
                    @csrf

                    <input type="hidden" name="paralax_image" id='paralax_image'
                        value="{{$page !=null ?  $page->paralax_image : ''}}">
                </div>

            </form>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-md-12 pull-left">
                    <div class="form-group mb-0">
                        <label class="form-label">Arkaplan Birinci Görseli</label>
                        <form method="post" action="{{route('admin.meals.media.store')}}" enctype="multipart/form-data"
                            class="dropzone" id="imagezone">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>

            <p class="text-center mt-4 mb-5">

                </button><button class="btn btn-dark" id="btnKaydet">Kaydet
                </button> </p>
        </div>
    </div>
</div>
@endsection

@section('extrascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>

<script type="text/javascript">
    // Dropzone.autoDiscover = false;
    Dropzone.options.imagezone =
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
                            var i=$("#paralax_image").val();
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
        var name=$("#paralax_image").val();
        $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        type: 'POST',
        url: '{{ url("admin/meals/media/delete") }}',
        data: {filename: name},
        success: function (data){
 
        // $('#'+name).remove();
        $('#paralax_image').val('');
  
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
       
        $('#paralax_image').val(response.success);
     
        },
        error: function(file, response)
        {
        return false;
        }
};
</script>

<script>
    $(document).ready(function(){
    $("#btnKaydet").click(function(){        
        $("#haberForm").submit(); // Submit the form
    });
});
 
</script>
@endsection