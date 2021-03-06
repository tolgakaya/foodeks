@extends('backend/layouts/main')
@section('extracss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
@endsection
@section('content')
<div class="page-header mt-0 shadow p-3">
    {{-- <ol class="breadcrumb mb-sm-0">
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active" aria-current="page">Empty Page</li>
    </ol>
    <div class="btn-group mb-0">
        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Actions</button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#"><i class="fas fa-plus mr-2"></i>Add new
                Page</a>
            <a class="dropdown-item" href="#"><i class="fas fa-eye mr-2"></i>View the page
                Details</a>
            <a class="dropdown-item" href="#"><i class="fas fa-edit mr-2"></i>Edit Page</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i> Settings</a>
        </div>
    </div> --}}
</div>
<div class="container">
    <div class="card shadow">
        <div class="card-header">
            <h2 class="mb-0">Yeni Restaurant Ekle</h2>
        </div>
        <div class="card-body">
            <form action="{{route('admin.restaurant.store')}}" method="post" id="haberForm">
                <div class="row">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Restaurant ismi</label>
                            <input type="text" class="form-control" name="name" placeholder="bir isim girin" required>
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="form-group mb-0">
                            <label class="form-label">Açıklama</label>
                            <textarea class="form-control" name="description" rows="4"
                                placeholder="Açıklama yazın"></textarea>
                            <input type="hidden" id="txtLatitude" name="coordinate">
                            <input type="hidden" id="ltd" name="latitude">
                            <input type="hidden" id="lng" name="longitude">
                            <input type="hidden" id='avatar' name="avatar">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Telefon</label>
                            <input type="text" class="form-control" name="phone"
                                placeholder="Rezervasyon ve Sipariş Telefonu" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Adres</label>
                            <input type="text" class="form-control" name="address"
                                placeholder="Restaurant adresini giriniz" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email"
                                placeholder="Sipariş/Rezervasyon email giriniz" required>
                        </div>
                    </div>
                    <div class=" col-md-12 ">
                        <div class="card shadow">
                            <div class="card-header">
                                <h2 class="mb-0">Restaurant Koordinatları</h2>
                            </div>
                            <div class="card-body">
                                <div id="myMap" class="mapheight"></div>
                            </div>
                        </div>
                    </div>
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
                    <button type="submit" class="btn btn block btn-primary" id="btnKaydet">Kaydet</button>
                </div>

            </div>
        </div>
    </div>
    @endsection
    @section('extrascript')
    <!--GMap Plugin -->
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyDudjGDbcq3lKGFqFsHdGWZNgWOsNX4gjs"></script>
    <script src="{{asset('backend/js/harita-musteri-kaydet.js')}}"></script>
    <script>
        $( document ).ready(function() {
                // console.log( "document loaded" );
                initialize();
            });
         
            $( window ).on( "load", function() {
                console.log( "window loaded" );
            });
    </script>
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