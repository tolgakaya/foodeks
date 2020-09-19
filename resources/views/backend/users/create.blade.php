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
            <h2 class="mb-0">Yeni Kullanıcı Ekleyin</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.store') }}">
                <div class="row" id="haberDiv">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Kullanıcı Görevi</label>
                            <select class="selectpicker form-control" name="role">
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
                                name="adi" value="{{ old('adi') }}" required autocomplete="adi" autofocus
                                placeholder="Ad Soyad giriniz">
                            @error('adi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 ">

                        <div class="form-group mb-0">
                            <label>Cep Telefonu</label>
                            <input id="mobile" type="number" class="form-control @error('mobile') is-invalid @enderror"
                                name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile" autofocus
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
                                name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="form-group mb-0">
                            <label>Şifre</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="form-group mb-0">
                            <label>Şifreyi tekrar girin</label>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <div class="text-center"><button type="submit" class="btn btn-primary">Kaydet</button></div>
                        </div>
                    </div>
            </form>

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