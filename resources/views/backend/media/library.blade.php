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
    <div class="btn-group mb-0">
        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Actions</button>
        <div class="dropdown-menu">
            <a class="dropdown-item"
                href="{{$chcbox==null ?  route('admin.media.index', ['chcbox'=>'1']) : route('admin.media.index') }}"><i
                    class="fas fa-plus mr-2"></i>{{$chcbox==null ? 'Delete Medias' : 'Media Exporer'}}</a>
            <a class="dropdown-item" href="#"><i class="fas fa-eye mr-2"></i>Explore Medias</a>
            <a class="dropdown-item" href="#"><i class="fas fa-edit mr-2"></i>Edit Page</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i> Settings</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body ">
                <div id="accordion">
                    <div class="accordion">
                        <div class="accordion-header" data-toggle="collapse" data-target="#panel-body-1">
                            <h4 class="mb-0">Click or drag your file</h4>
                        </div>
                        <div class="accordion-body collapse show border border-top-0 text-sm" id="panel-body-1"
                            data-parent="#accordion">
                            <form method="post" action="{{route('admin.media.store')}}" enctype="multipart/form-data"
                                class="dropzone" id="dropzone">
                                @csrf
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-6  mx-auto align-items-center">
                    <form>
                        <div class="form-group" id="custom-search-input">
                            <div class="input-group">
                                @csrf
                                <input type="text" class="form-control" placeholder="Media arayın..." id="term"
                                    name="term">
                                <span class="input-group-append">
                                    <button class="btn btn-primary" type="button" id="btn-search">Ara</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="{{route('admin.media.delete.mass')}}" method="post" id="deleteForm">
    <div class="gallery row">
        @csrf
        <input type="hidden" id='chchidden' value="{{$chcbox ?? '' }}">
        @foreach ($medias as $m)
        @if ($chcbox=='1' )
        <div class="col-lg-3 satir">
            <div class="card shadow overflow-hidden custom-control custom-checkbox image-checkbox">
                <input type="checkbox" class="custom-control-input" id="{{$m->filename}}" name='selecteds[]'
                    value="{{$m->id}}">
                <label class="custom-control-label" for="{{$m->filename}}">
                    <img src="{{$m->path()}}" class="big" alt="" title="Beautiful Image" />
                </label>
            </div>
        </div>
        @else
        <div class="col-lg-3 hover15 satir">
            <div class="card shadow overflow-hidden">
                <a href="{{route('admin.media.show',['filename'=>$m->filename])}}" class="big"><img src="{{$m->path()}}"
                        alt="" title="Beautiful Image" /></a>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</form>

@if(count($medias)>0)
<p class="text-center mt-4 mb-5"><button class="load-more btn btn-dark" data-totalResult="{{ App\Media::count() }}">Load
        More</button></p>
@endif
<p class="text-center mt-4 mb-5">
    <button class="btn btn-success" id="btnDelete">Delete Selected Medias
    </button>
</p>


@endsection
@section('extrascript')
{{-- <script src="{{asset('backend/plugins/fileuploads/js/dropify.min.js')}}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<!-- gallery Js-->
{{-- <script src="{{asset('backend/plugins/gallery/dist/simple-lightbox.js')}}"></script> --}}
{{-- <script src="{{asset('backend/js/gallery.js')}}"></script> --}}

{{-- Ajax Script Start --}}
{{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}
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

//   console.log(countCheckedCheckboxes);
    });
    
    });

</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#btn-search").on('click',function(e){
            e.preventDefault();
            var _totalCurrentResult=$(".satir").length;
            // Ajax Reuqest
            var param=$("#term").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                url:'/admin/library/search',
                type:'post',
                dataType:'json',
                data:{
                            term:param
                },
                // beforeSend:function(){
                //     $(".load-more").html('Loading...');
                // },
                success:function(response){
                    var _html='';
                    var image="{{ asset('images') }}/";
                    var chcval=$('#chchidden').val();
                    $.each(response,function(index,value){
                        if (chcval=='1') {
                                                _html+='<div class="col-lg-3 satir">';
                                                    _html+='<div class="card shadow overflow-hidden custom-control custom-checkbox image-checkbox">';
                                                        _html+= '<input type="checkbox" class="custom-control-input" id="' + value.filename+'">';
                                                        _html+= '<label class="custom-control-label" for="' + value.filename+'">';
                                                            _html+= '<img src="'+image+ value.filename+'" class="big" alt="" title="Beautiful Image"  name="selecteds[]"/>';
                                                            _html+= '</label>';
                                                        _html+= '</div>';
                                                    _html+= '</div>';
                                                } else {
                                                
                                                _html+= '<div class="col-lg-3 hover15 satir">';
                                                    _html+='<div class="card shadow overflow-hidden">';
                                         _html+= '<a href="/admin/library/detail/'+value.filename+' " class="big"><img src="'+image+value.filename+'" alt="sample85" /></a>';
                                                        _html+= '</div>';
                                                    _html+= '</div>';
                                                }
                    });
                    $(".gallery").empty();
                    $(".gallery").append(_html);
                    // Change Load More When No Further result
                    var _totalCurrentResult=$(".satir").length;
                    var _totalResult=parseInt($(".load-more").attr('data-totalResult'));
                    console.log(_totalCurrentResult);
                    console.log(_totalResult);
                    if(_totalCurrentResult==_totalResult){
                        $(".load-more").remove();
                    }else{
                        $(".load-more").html('Load More');
                    }
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".load-more").on('click',function(){
            var _totalCurrentResult=$(".satir").length;
            // Ajax Reuqest
            $.ajax({
                url:'/admin/more',
                type:'get',
                dataType:'json',
                data:{
                    skip:_totalCurrentResult
                },
                beforeSend:function(){
                    $(".load-more").html('Loading...');
                },
                success:function(response){
                    var _html='';
                    var image="{{ asset('images') }}/";
                    var chcval=$('#chchidden').val();
                    $.each(response,function(index,value){
                        if (chcval=='1') {
                        _html+='<div class="col-lg-3 satir">';
                            _html+='<div class="card shadow overflow-hidden custom-control custom-checkbox image-checkbox">';
                                _html+= '<input type="checkbox" class="custom-control-input" name="selecteds[]" id="' + value.filename+'" value="'+ value.id+'">';
                                _html+= '<label class="custom-control-label" for="' + value.filename+'">';
                                    _html+= '<img src="'+image+ value.filename+'" class="big" alt="" title="Beautiful Image" name="selecteds[]" />';
                                    _html+= '</label>';
                                _html+= '</div>';
                            _html+= '</div>';
                        } else {

                          _html+= '<div class="col-lg-3 hover15 satir">';
                                    _html+='<div class="card shadow overflow-hidden">';
                                        _html+= '<a href="/admin/library/detail/'+value.filename+' " class="big"><img src="'+image+value.filename+'" alt="sample85" /></a>';
                                        _html+= '</div>';
                                    _html+= '</div>';
                        }

                    });
                    $(".gallery").append(_html);
                    // Change Load More When No Further result
                    // var sayi=$(".satir").length;
                    var _totalCurrentResult=$(".satir").length;
                    var _totalResult=parseInt($(".load-more").attr('data-totalResult'));
                    console.log('current result' +_totalCurrentResult);
                    // console.log('satir sayisi' +sayi);
                    console.log('total result' +_totalResult);
                    if(_totalCurrentResult==_totalResult){
                        $(".load-more").remove();
                    }else{
                        $(".load-more").html('Load More');
                    }
                }
            });
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
        url: '{{ url("admin/library/delete") }}',
        data: {filename: name},
        success: function (data){
        alert("File has been successfully removed!!");
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
        var chcval=$('#chchidden').val();

        $.each(response,function(index,value){
            if (chcval=='1') {
                _html+='<div class="col-lg-3 satir">';
                    _html+='<div class="card shadow overflow-hidden custom-control custom-checkbox image-checkbox">';
                        _html+= '<input type="checkbox" class="custom-control-input" id="' + value+'">';
                        _html+= '<label class="custom-control-label" for="' + value+'">';
                            _html+= '<img src="'+image+ value+'" class="big" alt="" title="Beautiful Image" name="selecteds[]" />';
                            _html+= '</label>';
                        _html+= '</div>';
                    _html+= '</div>';
                } else {
                
                _html+= '<div class="col-lg-3 hover15 satir">';
                    _html+='<div class="card shadow overflow-hidden">';
                        _html+= '<a href="/admin/library/detail/'+value+' " class="big"><img src="'+image+value+'" alt="sample85" /></a>';
                        _html+= '</div>';
                    _html+= '</div>';
                }
        });
        $(".gallery").prepend(_html);

        },
        error: function(file, response)
        {
        return false;
        }
};
</script>
@endsection
@show