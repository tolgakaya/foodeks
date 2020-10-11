@extends('frontend.layouts.layout')
@section('extracss')
<!-- Radio and check inputs -->
<link href="{{asset('css/skins/square/grey.css')}}" rel="stylesheet">
@endsection
@section('subheader')
<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll"
    data-image-src="{{$paralax !=null ? $paralax->paralax() : asset('frontend/img/adana_web.jpg')}}"
    data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
            <h1>Giriş</h1>
            <p>Gerçek adana lezeetleri için giriş yapın</p>
            <p></p>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->
@endsection

@section('main')

<div class="container bg-faded">
    <h1 class="text-center">Lezzet Dünyasına Girin</h1>
    <div class="row">
        <div class="col-xs-12 text-center">Email ve <code>şifrenizle</code>giriş yapabilirsiniz.</div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-6  col-xs-offset-3 ">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group row">
                    <label for="email" class=" col-form-label text-md-right">Email</label>

                    <div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class=col-form-label text-md-right">Şifre</label>

                    <div>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-xs-12 ">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                Beni hatırla
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row pull-right">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary">
                            Giriş
                        </button>
                        <button type="button" id="btnGirisUyelik" class="btn btn-primary">
                            Üye Ol
                        </button>
                        @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            Şifremi unuttum?
                        </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
    <hr>
</div>

@endsection
@section('specialscript')
<script>
    $('#btnGirisUyelik').on('click', function (e) {
                e.preventDefault();
                $('#register').modal('show');
            });
        
</script>
@endsection