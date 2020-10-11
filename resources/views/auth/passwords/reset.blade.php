@extends('frontend.layouts.layout')
@section('extracss')
<meta name="_token" content="{{csrf_token()}}" />
<!-- Radio and check inputs -->
<link href="{{asset('css/skins/square/grey.css')}}" rel="stylesheet">
{{-- <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="{{asset('backend/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" /> --}}
<link href='https://fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic,300,300italic' rel='stylesheet'
    type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Gochi+Hand' rel='stylesheet' type='text/css'>

@endsection
@section('subheader')
<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll"
    data-image-src="{{asset('frontend/img/adana_web.jpg')}}" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
            {{-- <h1></h1> --}}

            <div class="bs-wizard">
                <div class="col-xs-4 bs-wizard-step active">
                    <div class="text-center bs-wizard-stepnum"><strong>1.</strong> Emailinizi yazın</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="#0" class="bs-wizard-dot"></a>
                </div>

                <div class="col-xs-4 bs-wizard-step disabled">
                    <div class="text-center bs-wizard-stepnum"><strong>2.</strong>Gelen bağlantıya tıklayın</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="cart_2.html" class="bs-wizard-dot"></a>
                </div>

                <div class="col-xs-4 bs-wizard-step disabled">
                    <div class="text-center bs-wizard-stepnum"><strong>3.</strong> Yeni şifrenizi belirleyin</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="cart_3.html" class="bs-wizard-dot"></a>
                </div>
            </div><!-- End bs-wizard -->
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->
@endsection

@section('main')
<!-- Content ================================================== -->
<div class="container bg-faded">
    <h1 class="text-center">Şifre Sıfırlama</h1>
    <div class="row text-center">
        <div class="col-xs-6 col-xs-offset-3">Kayıtlı <code>emailinizi</code>aşağıdaki kutucuğa girip butona tıklayınız.
            Size şifrenizi değiştirebileceğiniz bir bağlantı göndereceğiz.</div>
    </div>
    <hr>

    <div class="row">
        <div class="col-xs-6  col-xs-offset-3 ">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group ">
                    <label for="email" class="col-form-label">Email</label>


                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                <div class="form-group  ">
                    <label for="password" class="col-form-label text-md-right">Yeni Şifreniz</label>

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>

                <div class="form-group ">
                    <label for="password-confirm" class="col-form-label text-md-right">Şifreyi Tekrar Girin</label>


                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password">

                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-block">
                            Kaydet
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<hr>
</div>
<!-- End Content =============================================== -->



@endsection

@section('specialscript')
<!-- SPECIFIC SCRIPTS -->
<script src="js/theia-sticky-sidebar.js"></script>
<script>
    jQuery('#sidebar').theiaStickySidebar({
        			additionalMarginTop: 80
        		});
 
@endsection