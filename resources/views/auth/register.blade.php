@extends('frontend.layouts.layout')
@section('extracss')
<!-- Radio and check inputs -->
<link href="{{asset('css/skins/square/grey.css')}}" rel="stylesheet">
@endsection
@section('subheader')
<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="img/sub_header_cart.jpg"
    data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
            <h1>Work with us</h1>
            <p>Qui debitis meliore ex, tollit debitis conclusionemque te eos.</p>
            <p></p>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->
@endsection

@section('main')
<div id="position">
    <div class="container">
        <ul>
            <li><a href="#0">Home</a></li>
            <li><a href="#0">Category</a></li>
            <li>Page active</li>
        </ul>
        <a href="#0" class="search-overlay-menu-btn"><i class="icon-search-6"></i> Search</a>
    </div>
</div><!-- Position -->
<div class="container margin_60">
    <div class="main_title margin_mobile">
        <h2 class="nomargin_top">Please submit the form below</h2>
        <p>
            Cum doctus civibus efficiantur in imperdiet deterruisset.
        </p>
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="form-group">
                    <label>Name</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="form-group">
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
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="form-group">
                    <label>Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="form-group">
                    <label>Retype your password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <h5>Do you have a motorbike or scooter?</h5>
                    <label><input name="motor" type="radio" value="" class="icheck" checked>Yes</label>
                    <label class="margin_left"><input name="motor" type="radio" value="" class="icheck">No</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <h5>Are you a student?</h5>
                    <label><input name="student" type="radio" value="" class="icheck" checked>Yes</label>
                    <label class="margin_left"><input name="student" type="radio" value="" class="icheck">No</label>
                </div>
            </div>
        </div><!-- End row  -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <h5>Do you have a driving license?</h5>
                    <label><input name="license" type="radio" value="" class="icheck" checked>Yes</label>
                    <label class="margin_left"><input name="license" type="radio" value="" class="icheck">No</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <h5>Do you have an iPhone or Android mobile?</h5>
                    <label><input name="mobile" type="radio" value="" class="icheck" checked>Yes</label>
                    <label class="margin_left"><input name="mobile" type="radio" value="" class="icheck">No</label>
                </div>
            </div>
        </div><!-- End row  -->
        <hr style="border-color:#ddd;">
        <div class="text-center"><button type="submit" class="btn_full_outline">Submit</button></div>
    </form>
</div><!-- End container  -->
<!-- Search Menu -->
<div class="search-overlay-menu">
    <span class="search-overlay-close"><i class="icon_close"></i></span>
    <form role="search" id="searchform" method="get">
        <input value="" name="q" type="search" placeholder="Search..." />
        <button type="submit"><i class="icon-search-6"></i>
        </button>
    </form>
</div>
<!-- End Search Menu -->
@endsection