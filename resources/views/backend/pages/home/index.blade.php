@extends('backend/layouts/main')
@section('extracss')
{{-- <link href="{{asset('backend/plugins/fileuploads/css/dropify.css')}}" rel="stylesheet" type="text/css" /> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<link href="{{asset('backend/css/image-checkbox.css')}}" rel="stylesheet" />
{{-- <style>
    .dz-message {
        text-align: center;
        font-size: 28px;
    }

    .dz-preview .dz-image img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover;
    }
</style> --}}

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
            <h2 class="mb-0">Ana Sayfa İçeriği</h2>
        </div>
        <div class="card-body">
            <form action="{{route('admin.pages.home.store')}}" method="post" id='haberForm'>
                <div class="row" id="haberDiv">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <label class="form-label">Slogan (Video üstünde gözükecek)</label>
                            <input class="form-control" name="slogan" value="{{$page != null ?  $page->slogan : ''}}"
                                placeholder="Lütfen bir cümle giriniz" \>
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="form-group mb-0">
                            <label class="form-label">Alt Başlık(Sloganın altında gözükecek)</label>
                            <input class="form-control" name="sub_slogan"
                                value="{{$page !=null ? $page->sub_slogan : ''}}"
                                placeholder="Lütfen bir başlık giriniz" \>
                        </div>
                    </div>
                    <div class="col-md-12 mb-1 mt-2">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="custom-switch">
                                        @if ($page !=null)
                                        <input type="checkbox" name="show_how" value="1" class="custom-switch-input"
                                            {{$page->show_how==true ? 'checked' :'' }}>
                                        @else
                                        <input type="checkbox" name="show_how" value="1" class="custom-switch-input">
                                        @endif

                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Çalışma sistemini göster</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="custom-switch">
                                        @if ($page !=null)
                                        <input type="checkbox" name="menu_show" value="1" class="custom-switch-input"
                                            {{$page->menu_show==true ? 'checked' : '' }}>
                                        @else
                                        <input type="checkbox" name="menu_show" value="1" class="custom-switch-input">
                                        @endif

                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Menüyü göster</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="custom-switch">
                                        @if ($page !=null)
                                        <input type="checkbox" name="paralax_show" value="1" class="custom-switch-input"
                                            {{$page->paralax_show==true ? 'checked'  :''}}>
                                        @else
                                        <input type="checkbox" name="paralax_show" value="1"
                                            class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Arkaplan resmini göster</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <label class="form-label">Arkaplan başlık (Resim üstünde gözükecek)</label>
                            <input class="form-control" name="paralax_text"
                                value="{{$page !=null ?  $page->paralax_text : ''}}"
                                placeholder="Lütfen bir cümle giriniz" \>
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="form-group mb-0">
                            <label class="form-label">Alt Başlık(Başlığın altında gözükecek)</label>
                            <input class="form-control" name="paralax_sub_text"
                                value="{{$page !=null ?  $page->paralax_sub_text : ''}}"
                                placeholder="Lütfen bir başlık giriniz" \>
                        </div>
                    </div>
                    <input type="hidden" name="video" value="{{$page !=null ?  $page->video : ''}}" id='video'>
                    <input type="hidden" name="paralax_image" id='paralax_image'
                        value="{{$page !=null ?  $page->paralax_image : ''}}">
                </div>
            </form>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 pull-left">
                    <div class="form-group mb-0">
                        <label class="form-label">Slider Video</label>
                        <form method="post" action="{{route('admin.meals.media.store')}}" enctype="multipart/form-data"
                            class="dropzone" id="videozone">
                            @csrf
                        </form>
                    </div>
                </div>
                <div class="col-md-6 pull-right ">
                    <div class="form-group mb-0">
                        <label class="form-label">Arkaplan Resim</label>
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


{{-- Ajax Script End --}}
<script type="text/javascript">
    Dropzone.options.videozone =
         {
            maxFilesize: 12,
            maxFiles:1,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: ".mp4,.avi,.mov",
            init: function() {
                    this.on("maxfilesexceeded", function(file){
                    alert("Yalnızca tek dosya yükleyebilirsiniz!");
                    this.removeFile(file);
                    });

                     var thisDropzone = this;
                    
                    var image="{{ asset('images') }}/";
                    var i=$("#video").val();
                    var defaultValue=image+i;
                    //Call the action method to load the images from the server
                    //// Create the mock file:
                    var mockFile = {
                    name: i,
                    size: 123456
                    };
                    

                    //
                    // Call the default addedfile event handler
                    thisDropzone.emit("addedfile", mockFile);
                    
                    // And optionally show the thumbnail of the file:
                     thisDropzone.emit("thumbnail", mockFile,defaultValue);

                    },
            addRemoveLinks: true,
            timeout: 5000,
          removedfile: function(file)
        {
        // var name = file.upload.filename;
        var name=$("#video").val();
        $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        type: 'POST',
        url: '{{ url("admin/meals/media/delete") }}',
        data: {filename: name},
        success: function (data){
 
        $('#video').val('');
        // $('#'+name).remove();
  
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
                $('#video').val(response.success);

   
        },
        error: function(file, response)
        {
        return false;
        }
};
</script>
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