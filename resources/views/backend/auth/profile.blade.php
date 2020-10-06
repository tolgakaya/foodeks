@extends('backend/layouts/main')
@section('extracss')
{{-- <link href="{{asset('backend/plugins/fileuploads/css/dropify.css')}}" rel="stylesheet" type="text/css" /> --}}
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
    <div class="card shadow">
        <div class="card-header">
            <h2 class="mb-0">Profil Bilgileriniz</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.profile.store') }}">
                <div class="row" id="haberDiv">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Kullanıcı Görevi</label>
                            <select class="selectpicker form-control" name="role" disabled>
                                @foreach ($roles as $key => $role)
                                <option value="{{$key}}">{{$role}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 ">

                        <div class="form-group mb-0">
                            <label>Ad-Soyad</label>
                            <input id="adi" type="text" class="form-control @error('adi') is-invalid @enderror"
                                name="adi" required autocomplete="adi" autofocus placeholder="Ad Soyad giriniz"
                                value="{{$user->adi}}">
                            @error('adi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class=" col-md-12 ">

                        <div class=" form-group mb-0">
                            <label>Cep Telefonu</label>
                            <input id="mobile" type="number" class="form-control @error('mobile') is-invalid @enderror"
                                name="mobile" value="{{ $user->mobile}}" required autocomplete="mobile" autofocus
                                placeholder="Telefon giriniz">
                            @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="form-group mb-0">
                            <label>Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ $user->email }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <input type="hidden" id='avatar' name="avatar" value="{{$user->avatar}}">
                    </div>

            </form>
            <div class="col-md-12 ">
                <div class="form-group mb-0">
                    <label class="form-label">Arkaplan Resim</label>
                    <form method="post" action="{{route('admin.meals.media.store')}}" enctype="multipart/form-data"
                        class="dropzone" id="imagezone">
                        @csrf
                    </form>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <button type="submit" class="btn btn block btn-primary">Kaydet</button>
                </div>

            </div>

        </div>

    </div>
    @endsection

    @section('extrascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    <script type="text/javascript">
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
init: function () {
                this.on("addedfile", function (file) {
                // this.removeFile(file);
                if (this.files.length > this.options.maxFiles) {
                this.removeFile(this.files[0]);
                }
                });
                var thisDropzone = this;
                
                var image="{{ asset('/images') }}/";
                var i=$("#avatar").val();
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
        var name=$("#avatar").val();
        $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        type: 'POST',
        url: '{{ url("admin/meals/media/delete") }}',
        data: {filename: name},
        success: function (data){
 
        // $('#'+name).remove();
        $('#avatar').val('');
  
        },
        error: function(e) {
        console.log(e.message);
        }});
        var fileRef;
        return (fileRef = file.previewElement) != null ?
        fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },

        success: function(file,response){
            console.log(response.success);
             var image="{{ asset('/images') }}/";
       
        $('#avatar').val(response.success);
     
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