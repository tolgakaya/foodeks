@extends('backend/layouts/main')
@section('extracss')
{{-- <link href="{{asset('backend/plugins/fileuploads/css/dropify.css')}}" rel="stylesheet" type="text/css" /> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<link href="{{asset('backend/css/image-checkbox.css')}}" rel="stylesheet" />
<style>
    .dz-message {
        text-align: center;
        font-size: 28px;
    }

    .dz-preview .dz-image img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover;
    }
</style>

<meta name="_token" content="{{csrf_token()}}" />
@endsection
@section('content')
<div class="page-header mt-0 shadow p-3">
</div>

<div class="container">
    <div class="card shadow">
        <div class="card-header">
            <h2 class="mb-0">F&B Bilgileri</h2>
        </div>
        <div class="card-body">
            <form action="{{route('admin.meals.update',['meal'=>$meal->id])}}" method="post" id='haberForm'>
                <div class="row" id="haberDiv">
                    <div id="imagediv">
                        <input type="hidden" id="imagehdn" name="image" value="{{$meal->image}}" />
                    </div>
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Kategori</label>
                            <select class="selectpicker form-control" name="category_id">
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}"
                                    {{$category->id==$meal->category_id ? 'selected' : ''}}>{{$category->category}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="form-group mb-0">
                            <label class="form-label">F&B İsmi</label>
                            <input class="form-control" name="name" value="{{$meal->name}}"
                                placeholder="Bir isim giriniz" \>
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="form-group mb-0">
                            <label class="form-label">F&B Açıklaması</label>
                            <input class="form-control" name="description" value="{{$meal->description}}"
                                placeholder="Bir açıklama giriniz" \>
                        </div>
                    </div>
                </div>
            </form>
            <div id="accordion">
                <div class="accordion">
                    <div class="accordion-body collapse show border border-top-0 text-sm" id="panel-body-1"
                        data-parent="#accordion">
                        <form method="post" action="{{route('admin.meals.media.store')}}" enctype="multipart/form-data"
                            class="dropzone" id="dropzone">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">


            <p class="text-center mt-4 mb-5">

                </button><button class="btn btn-dark" id="btnKaydet">Kaydet
                </button> </p>
        </div>
    </div>
</div>
@endsection

@section('extrascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>

<script>
    $(document).ready(function(){
    $("#btnDelete").click(function(){
    $("#deleteForm").submit(); // Submit the form
    });
    });

 

</script>

{{-- Ajax Script End --}}
<script type="text/javascript">
    Dropzone.options.dropzone =
         {
            maxFiles: 4,
            init: function () {
              this.on("addedfile", function (file) {
            // this.removeFile(file);
          if (this.files.length > this.options.maxFiles) {
            this.removeFile(this.files[0]);
            }
            });
            var thisDropzone = this;
            
            var image="{{ asset('/images') }}/";
            var i=$("#imagehdn").val();
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
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 5000,
removedfile: function(file)
{
 var fileRef;
return (fileRef = file.previewElement) != null ?
fileRef.parentNode.removeChild(file.previewElement) : void 0;
},
        success: function(file,response){
            // $('.dz-preview').remove();
        var _html='';
        var image="{{ asset('images') }}/";
        var _hidden="";

        $.each(response,function(index,value){
            console.log(value);
          
                    _hidden+='<input type="hidden" name="image"   value="' + value+'">';


       
        });
        // $(".gallery").prepend(_html);
        $('#imagediv').empty();
        $("#imagediv").append(_hidden);

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