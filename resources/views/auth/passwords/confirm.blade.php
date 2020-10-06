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
            <h1>Siparişi Tamamlayın</h1>
            <div class="bs-wizard">
                <div class="col-xs-4 bs-wizard-step active">
                    <div class="text-center bs-wizard-stepnum"><strong>1.</strong> Bilgileriniz</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="#0" class="bs-wizard-dot"></a>
                </div>

                <div class="col-xs-4 bs-wizard-step disabled">
                    <div class="text-center bs-wizard-stepnum"><strong>2.</strong>Kapıda Ödeme</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="cart_2.html" class="bs-wizard-dot"></a>
                </div>

                <div class="col-xs-4 bs-wizard-step disabled">
                    <div class="text-center bs-wizard-stepnum"><strong>3.</strong> Afiyet Olsun</div>
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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Confirm Password') }}</div>

                <div class="card-body">
                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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