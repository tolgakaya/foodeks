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
    {{-- <div class="btn-group mb-0">
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
            <h2 class="mb-0">Yeni F&B Ekleyin</h2>
        </div>
        <div class="card-body">
            <form action="{{route('admin.meals.store')}}" method="post" id='haberForm'>
                <div class="row" id="haberDiv">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Category</label>
                            <select class="selectpicker form-control" name="category_id">
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->category}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="form-group mb-0">
                            <label class="form-label">F&B İsmi</label>
                            <input class="form-control" name="name" placeholder="Bir isim giriniz" \>
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="form-group mb-0">
                            <label class="form-label">F&B Açıklaması</label>
                            <input class="form-control" name="description" placeholder="Bir açıklama giriniz" \>
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

    $(document).ready(function(){
    
    var $checkboxes = $('#deleteForm input[type="checkbox"]');
    
    $checkboxes.change(function(){
    var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
    if ( countCheckedCheckboxes > 0 )
    $('#btnDelete').css('visibility','visible');
    else
    $('#btnDelete').css('visibility','hidden');

    });
    
    });

</script>

{{-- Ajax Script End --}}
<script type="text/javascript">
    Dropzone.options.dropzone =
         {
            maxFilesize: 12,
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
        var name = file.upload.filename;
        $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        type: 'POST',
        url: '{{ url("admin/meals/media/delete") }}',
        data: {filename: name},
        success: function (data){
 
        $('#'+name).remove();
  
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
  var _hidden="";

        $.each(response,function(index,value){
       
        _hidden+='<input type="hidden" name="image"   value="' + value+'" id="' + value+'">';
       
        });
        // $(".gallery").prepend(_html);
        $("#haberDiv").prepend(_hidden);

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