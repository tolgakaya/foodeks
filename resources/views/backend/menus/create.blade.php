@extends('backend/layouts/main')
@section('extracss')
{{-- <link href="{{asset('backend/plugins/fileuploads/css/dropify.css')}}" rel="stylesheet" type="text/css" /> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<link href="{{asset('backend/css/image-checkbox.css')}}" rel="stylesheet" />

<meta name="_token" content="{{csrf_token()}}" />
@endsection
@section('content')
<div class="page-header mt-0 shadow p-3">

</div>
<div class="container">
    <div class="card shadow">
        <div class="card-header">
            <h2 class="mb-0">Yeni Menü Ekleyin</h2>
        </div>
        <div class="card-body">
            <form action="{{route('admin.menus.store')}}" method="post" id='haberForm'>
                <div class="row" id="haberDiv">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Restaurant</label>
                            <select class="selectpicker form-control" name="restaurant_id">
                                @foreach ($restaurants as $restaurant)
                                <option value="{{$restaurant->id}}">{{$restaurant->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="form-group mb-0">
                            <label class="form-label">Menü İsmi</label>
                            <input class="form-control" name="name" placeholder="Bir menü ismi giriniz" \>
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="form-group mb-0">
                            <label class="form-label">Menü Açıklaması</label>
                            <input class="form-control" name="description" placeholder="Bir açıklama giriniz" \>
                        </div>
                    </div>
                </div>
            </form>

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


<script>
    $(document).ready(function(){
    $("#btnKaydet").click(function(){        
        $("#haberForm").submit(); // Submit the form
    });
});
 
</script>
@endsection