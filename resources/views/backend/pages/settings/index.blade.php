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
    <div class="card shadow">
        <div class="card-header">
            <h2 class="mb-0">Genel Site Ayarları</h2>
        </div>
        <div class="card-body">
            <form action="{{route('admin.pages.settings.store')}}" method="post" id='haberForm'>
                <div class="row" id="haberDiv">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Şirket İsmi</label>
                            <input type="text" class="form-control" name="company"
                                value="{{$page!=null ? $page->company : ''}}" placeholder="Şirket ismi giriniz"
                                required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Genel tema rengi</label>
                            @if ($page!=null)
                            <select name="style" class="form-control select2 w-100">
                                <option value="style_brand" {{$page->style !=null ?'selected': ''}}>Gri/Altın</option>
                                <option value="style_red" {{$page->style !=null ?'selected': ''}}>Kırmızı</option>
                            </select>
                            @else
                            <select name="style" class="form-control select2 w-100">
                                <option value="style_brand">Gri/Altın</option>
                                <option value="style_red">Kırmızı</option>
                            </select>
                            @endif


                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="form-group">
                            <label class="custom-switch">
                                @isset($page)
                                <input type="checkbox" name="payment_card" value="1" class="custom-switch-input"
                                    {{$page->payment_card==true ? 'checked' : ' ' }}>
                                @endisset
                                <input type="checkbox" name="payment_card" value="1" class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Kredi kartı ile ödeme kabul et</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="form-group">
                            <label class="custom-switch">
                                @isset($page)
                                <input type="checkbox" name="payment_setcard" value="1" class="custom-switch-input"
                                    {{$page->payment_setcard==true ? 'checked' : ' ' }}>
                                @endisset
                                <input type="checkbox" name="payment_setcard" value="1" class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Setcard ile ödeme kabul et</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="form-group">
                            <label class="custom-switch">
                                @isset($page)
                                <input type="checkbox" name="payment_ticket" value="1" class="custom-switch-input"
                                    {{$page->payment_ticket==true ? 'checked' : ' ' }}>
                                @endisset
                                <input type="checkbox" name="payment_ticket" value="1" class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">TicketToTicket ile ödeme kabul et</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="form-group">
                            <label class="custom-switch">
                                @isset($page)
                                <input type="checkbox" name="payment_multinet" value="1" class="custom-switch-input"
                                    {{$page->payment_multinet==true ? 'checked' : ' ' }}>
                                @endisset
                                <input type="checkbox" name="payment_multinet" value="1" class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Multinet ile ödeme kabul et</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="form-group">
                            <label class="custom-switch">
                                @isset($page)
                                <input type="checkbox" name="payment_cash" value="1" class="custom-switch-input"
                                    {{$page->payment_cash==true ? 'checked' : ' ' }}>
                                @endisset
                                <input type="checkbox" name="payment_cash" value="1" class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Nakit ile ödeme kabul et</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="form-group">
                            <label class="custom-switch">
                                @isset($page)
                                <input type="checkbox" name="multi_branch" value="1" class="custom-switch-input"
                                    {{$page->multi_branch==true ? 'checked' : ' ' }}>
                                @endisset
                                <input type="checkbox" name="multi_branch" value="1" class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Çok şubeli restaurant sitemini kullan</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Paket servisi maksimum menzili (km)</label>
                            <input type="number" class="form-control" name="radius_service"
                                value="{{$page != null ? $page->radius_service : 5}}" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Facebook bağlantısı</label>
                            <input type="text" class="form-control" name="facebook"
                                value="{{$page != null ? $page->facebook : ''}}"
                                placeholder="Facebook adresini giriniz">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Instagram bağlantısı</label>
                            <input type="text" class="form-control" name="instagram"
                                value="{{$page != null ? $page->instagram : ''}}"
                                placeholder="Instagram adresini giriniz">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Youtube bağlantısı</label>
                            <input type="text" class="form-control" name="youtube"
                                value="{{$page != null ? $page->youtube : ''}}" placeholder="Youtube adresini giriniz">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Twitter bağlantısı</label>
                            <input type="text" class="form-control" name="twitter"
                                value="{{$page != null ? $page->twitter : ''}}" placeholder="Twitter adresini giriniz">
                        </div>
                    </div>
                    <input type="hidden" id="logo_image" name="logo" value="{{$page!=null ? $page->logo  : ''}}">

                </div>
            </form>
            <div class="col-md-12">
                <div class="form-group mb-0">
                    <label class="form-label">Firma Logosu</label>
                    <form method="post" action="{{route('admin.meals.media.store')}}" enctype="multipart/form-data"
                        class="dropzone" id="dropzone">
                        @csrf
                    </form>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-block  btn-success" id="btnKaydet">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extrascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<script type="text/javascript">
    // Dropzone.autoDiscover = false;
    Dropzone.options.dropzone =
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
                            
                            var image="/images'/";
                            var i=$("#logo_image").val();
                            var defaultValue=image+i;
                           
                            var mockFile = {
                            name: i,
                            size: 123456
                            };
                            
                            // Call the default addedfile event handler
                            thisDropzone.emit("addedfile", mockFile);
                        
                            thisDropzone.emit("thumbnail", mockFile,defaultValue);
            },
          removedfile: function(file)
        {
        // var name = file.upload.filename;
        var name=$("#logo_image").val();
        $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        type: 'POST',
        url: '{{ url("admin/meals/media/delete") }}',
        data: {filename: name},
        success: function (data){
 
        // $('#'+name).remove();
        $('#logo_image').val('');
  
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
                var image="/mages'/";
       
        $('#logo_image').val(response.success);
     
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