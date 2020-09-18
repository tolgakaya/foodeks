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
            <h2 class="mb-0">Hakkımızda Sayfası Bilgileri</h2>
        </div>
        <div class="card-body">
            <form action="{{route('admin.about.store')}}" method="post" id='haberForm'>
                <div class="row" id="haberDiv">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Başlık</label>
                            <input type="text" class="form-control" name="title"
                                value="{{$page!=null ? $page->title : ''}}" placeholder="Hakkımızda başlığı girin"
                                required>
                        </div>
                    </div>

                    <div class="col-md-12 ">
                        <div class="form-group mb-0">
                            <label class="form-label">Hakkımızda Sayfası İçeriği</label>
                            <textarea class="form-control" class="form-control" id="summary-ckeditor" name="text"
                                rows="10"
                                placeholder="İçerik bilgisini girin, yukarıdaki buttonlarla içeriğinize sitili verebilirsiniz.">{!! $page!= null ? $page->text : '' !!}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="form-group">
                            <label class="custom-switch">
                                @isset($page)
                                <input type="checkbox" name="show_opening" value="1" class="custom-switch-input"
                                    {{$page->show_opening==true ? 'checked' : ' ' }}>
                                @endisset
                                <input type="checkbox" name="show_opening" value="1" class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Açılış kapanış zamanlarını göster</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="text-right">
                                <div class="btn-group">
                                    <button type="button" class="btn  btn-primary " data-toggle="modal"
                                        data-target="#modal-default">Resim
                                        Galerisi</button>
                                    <button type="submit" class="btn  btn-success">Kaydet</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @include('backend.pages.about.modal')
        </div>
    </div>
</div>
@endsection

@section('extrascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<script src=" https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"> </script>
<script src="{{asset('backend/js/about.js')}}"></script>

<script>
    CKEDITOR.replace( 'summary-ckeditor', {
        filebrowserUploadUrl: "{{route('gonder', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>

@endsection