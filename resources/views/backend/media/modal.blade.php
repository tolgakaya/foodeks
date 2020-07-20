@extends('backend/layouts/main')
@section('extracss')
{{-- <link href="{{asset('backend/plugins/fileuploads/css/dropify.css')}}" rel="stylesheet" type="text/css" /> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<link href="{{asset('backend/css/image-checkbox.css')}}" rel="stylesheet" />
<meta name="_token" content="{{csrf_token()}}" />
@endsection
@section('content')
<div class="row">
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-block btn-primary mb-3 mb-md-0" data-toggle="modal"
                data-target="#modal-default">Default</button>
            <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="modal-title-default">Select or Upload Media</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12">

                                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active show" id="home-tab2" data-toggle="tab" href="#home2"
                                            role="tab" aria-selected="true">Upload Media</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#profile2"
                                            role="tab" aria-selected="false">Media Library</a>
                                    </li>

                                </ul>
                                <div class="tab-content tab-bordered" id="myTab2Content">
                                    <div class="tab-pane fade active show text-sm" id="home2" role="tabpanel"
                                        aria-labelledby="home-tab2">
                                        <form method="post" action="{{route('admin.media.store')}}"
                                            enctype="multipart/form-data" class="dropzone" id="dropzone">
                                            @csrf
                                        </form>
                                    </div>
                                    <div class="tab-pane fade text-sm" id="profile2" role="tabpanel"
                                        aria-labelledby="profile-tab2">
                                        <form>
                                            <div class="form-group" id="custom-search-input">
                                                <div class="input-group">
                                                    @csrf
                                                    <input type="text" class="form-control"
                                                        placeholder="Media arayın..." id="term" name="term">
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="submit"
                                                            id="btn-search">Ara</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </form>
                                        <form action="{{route('admin.media.delete.mass')}}" method="post"
                                            id="modalForm">
                                            @csrf
                                            <div class="gallery row">
                                            </div>
                                            <input type="submit" class="btn btn-primary" form="modalForm"
                                                value="Save" />
                                        </form>
                                        <p class="text-center mt-4 mb-5"><button class="load-more btn btn-dark"
                                                data-totalResult="{{ App\Media::count() }}">Load
                                                More</button></p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnForm" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
                            {{-- <input type="submit" class="btn btn-primary" form="modalForm" value="Save" /> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('extrascript')
{{-- <script src="{{asset('backend/plugins/fileuploads/js/dropify.min.js')}}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
{{-- Ajax Script Start --}}
<script>
    $(document).ready(function() {
$('#btnForm').click(function() {
var formData = $('#modalForm').serialize();
console.log('Posting the following: ', formData);

$.ajax({
headers: {
    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    },
    url: '/admin/library/delete/mass',
data: formData,
type: 'post',
dataType: 'json',
success: function(data) {
console.log(data);
}
});
});
});
        
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#modal-default").on('shown.bs.modal', function(){
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
$.each(response,function(index,value){
_html+='<div class="col-lg-3 satir">';
                _html+='<div class="card shadow overflow-hidden custom-control custom-checkbox image-checkbox">';
                    _html+= '<input type="checkbox" class="custom-control-input" name="selecteds[]" id="' + value.filename+'" value="'+ value.id+'">';
                    _html+= '<label class="custom-control-label" for="' + value.filename+'">';
                        _html+= '<img src="'+image+ value.filename+'" class="big" alt="" title="Beautiful Image" name="selecteds[]" />';
                        _html+= '</label>';
                    _html+= '</div>';
                _html+= '</div>';
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
             
                    $.each(response,function(index,value){
               
                                                _html+='<div class="col-lg-3 satir">';
                                                    _html+='<div class="card shadow overflow-hidden custom-control custom-checkbox image-checkbox">';
                                              _html+= '<input type="checkbox" class="custom-control-input" name="selecteds[]" id="' + value.filename+'" value="'+ value.id+'">';
                                                        _html+= '<label class="custom-control-label" for="' + value.filename+'">';
                                                            _html+= '<img src="'+image+ value.filename+'" class="big" alt="" title="Beautiful Image"  />';
                                                            _html+= '</label>';
                                                        _html+= '</div>';
                                                    _html+= '</div>';
                                              
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
                
                    $.each(response,function(index,value){
                    
                        _html+='<div class="col-lg-3 satir">';
                            _html+='<div class="card shadow overflow-hidden custom-control custom-checkbox image-checkbox">';
                         _html+= '<input type="checkbox" class="custom-control-input" name="selecteds[]" id="' + value.filename+'" value="'+ value.id+'">';
                                _html+= '<label class="custom-control-label" for="' + value.filename+'">';
                                    _html+= '<img src="'+image+ value.filename+'" class="big" alt="" title="Beautiful Image"  />';
                                    _html+= '</label>';
                                _html+= '</div>';
                            _html+= '</div>';
                        

                    });
                    $(".gallery").append(_html);
                
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
   

        $.each(response,function(index,value){
      
                _html+='<div class="col-lg-3 satir">';
                    _html+='<div class="card shadow overflow-hidden custom-control custom-checkbox image-checkbox">';
                        _html+= '<input type="checkbox" class="custom-control-input" id="' + value+'">';
                        _html+= '<label class="custom-control-label" for="' + value+'">';
                            _html+= '<img src="'+image+ value+'" class="big" alt="" title="Beautiful Image" name="selecteds[]" />';
                            _html+= '</label>';
                        _html+= '</div>';
                    _html+= '</div>';
             
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