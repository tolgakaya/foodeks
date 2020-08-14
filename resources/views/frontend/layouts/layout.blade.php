<!DOCTYPE html>
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="pizza, delivery food, fast food, sushi, take away, chinese, italian food">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <meta name="_token" content="{{csrf_token()}}" />
    <title>QuickFood - Quality delivery or take away food</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
        href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
        href="img/apple-touch-icon-144x144-precomposed.png">
    <link href="{{asset('frontend/css/loader.css')}}" rel="stylesheet">

    <!-- GOOGLE WEB FONT -->
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic,300,300italic'
        rel='stylesheet' type='text/css'>

    <!-- BASE CSS -->
    {{-- <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/menu.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/elegant_font/elegant_font.css" rel="stylesheet">
    <link href="css/fontello/css/fontello.min.css" rel="stylesheet">
    <link href="css/magnific-popup.css" rel="stylesheet">
    <link href="css/pop_up.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet"> --}}

    <link href="{{asset('frontend/css/base.css')}}" rel="stylesheet">


    {{-- <link href="css/skins/square/grey.css" rel="stylesheet">
    <link href="css/ion.rangeSlider.css" rel="stylesheet">
    <link href="css/ion.rangeSlider.skinFlat.css" rel="stylesheet"> --}}
    <!-- Modernizr -->
    <script src="{{asset('frontend/js/modernizr.js')}}"></script>
    @yield('extracss')

    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!--[if lte IE 8]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
    <![endif]-->

    <div id="preloader">
        <div class="sk-spinner sk-spinner-wave" id="status">
            <div class="sk-rect1"></div>
            <div class="sk-rect2"></div>
            <div class="sk-rect3"></div>
            <div class="sk-rect4"></div>
            <div class="sk-rect5"></div>
        </div>
    </div><!-- End Preload -->

    @include('frontend.layouts.header')

    @yield('subheader')

    @yield('main')

    @include('frontend.layouts.footer')

    <div class="row">
        <div id='loadergif' class='app_loader' style='display: none; z-index:9999'>
            <div id="cooking">
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div id="area">
                    <div id="sides">
                        <div id="pan"></div>
                        <div id="handle"></div>
                    </div>
                    <div id="pancake">
                        <div id="pastry"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="layer"></div><!-- Mobile menu overlay mask -->

    <!-- Login modal -->
    <div class="modal fade" id="login_2" tabindex="-1" role="dialog" aria-labelledby="myLogin" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-popup">
                <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
                <form class="popup-form" id="myLogin">
                    {{-- {{ csrf_field() }} --}}
                    @csrf
                    <div class="login_icon"><i class="icon_lock_alt"></i></div>
                    <input id="email" name="email" type="text"
                        class="form-control form-white @error('email') is-invalid @enderror" placeholder="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <span class="invalid-feedback" role="alert">
                        <strong id="email-error"></strong>
                    </span>
                    <input type="password"
                        class="form-control form-white form-control @error('password') is-invalid @enderror"
                        placeholder="Password" id="password" name="password" required autocomplete="current-password">
                    <span class="invalid-feedback" role="alert">
                        <strong id="password-error"></strong>
                    </span>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="text-left">
                        <a href="#">Forgot Password?</a>
                    </div>
                    <button type="submit" id="btnLogin" class="btn btn-submit">Submit</button>
                </form>
            </div>
        </div>
    </div><!-- End modal -->

    <!-- Login modal -->
    <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myRegister" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-popup">
                <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
                <form class="popup-form" id="myRegister">
                    {{ csrf_field() }}
                    @csrf
                    <div class="login_icon"><i class="icon_lock_alt"></i></div>
                    <input id="register_name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" required autocomplete="name"
                        placeholder="İsminizi giriniz" autofocus>
                    <span class="invalid-feedback" role="alert">
                        <strong id="name-error"></strong>
                    </span>
                    <input id="register_email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email"
                        placeholder="Eposta adresinizi giriniz">
                    <span class="invalid-feedback" role="alert">
                        <strong id="email-error"></strong>
                    </span>
                    <input id="register_password" type="password"
                        class="form-control @error('password') is-invalid @enderror" name="password" required
                        autocomplete="new-password" placeholder="Bir şifre giriniz">
                    <span class="invalid-feedback" role="alert">
                        <strong id="password-error"></strong>
                    </span>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password" placeholder="Şifrenizi tekrar giriniz">
                    <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror"
                        name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile"
                        placeholder="Telefon giriniz" autofocus>
                    <input id="register_city" type="text"
                        class="form-control @error('register_city') is-invalid @enderror" name="mobile"
                        value="{{ old('register_city') }}" required autocomplete="register_city"
                        placeholder="Semtinizi giriniz" autofocus>
                    <textarea class="form-control" style="height:150px" placeholder="Adresinzi giriniz" name="notes"
                        id="register_address"></textarea>
                    <div class="text-left">
                        <a href="#">Forgot Password?</a>
                    </div>
                    <button type="submit" id="btnRegister" class="btn btn-submit">Submit</button>
                </form>
            </div>
        </div>
    </div><!-- End modal -->
    <!-- COMMON SCRIPTS -->
    <script src="{{asset('frontend/js/jquery-2.2.4.min.js')}}"></script>
    <script src="{{asset('frontend/js/common_scripts_min.js')}}"></script>
    <script src="{{asset('frontend/js/functions.js')}}"></script>
    <script src="{{asset('frontend/assets/validate.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#btnLogin").click(function(e){
                e.preventDefault();
                var password = $("#password").val();
                        var email = $("#email").val();
                        var authModel={
                        email:email,
                        password:password
                        };
            $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            url: "/login",
            data:JSON.stringify(authModel),
            type: "POST",
            contentType: "application/json;charset=UTF-8",
            dataType: "json",
            beforeSend: function(){
            // Show image container
            $("#loadergif").show();
            },
            success: function (result) {
            console.log(result);
            $('#login_2').modal('hide');
            location.reload(true);
           },
            complete:function(data){
            // Hide image container
            $("#loadergif").hide();
            },
            error: function (errormessage) {
            alert(errormessage.responseText);
            }
            });
           });


           ///REGISTER ACTION

           $("#btnRegister").click(function(e){
                    e.preventDefault();
                    var adi2 = $("#register_name").val();
                    var password2 = $("#register_password").val();
                    var email2 = $("#register_email").val();
                   var  password_confirm=$("#password-confirm").val();
                    var role=2;
                    var mobile=$('#mobile').val();
                    var address=$('#register_address').val();
                    var city=$('#register_city').val();
                    var registerModel={
                        adi:adi2,
                         email:email2,
                         password:password2,
                         password_confirmation:password_confirm,
                         role:role,
                         mobile:mobile,
                         city:city,
                         address:address
                    };
                    $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    url: "/register",
                    data:JSON.stringify(registerModel),
                    type: "POST",
                    contentType: "application/json;charset=UTF-8",
                    dataType: "json",
                    beforeSend: function(){
                    // Show image container
                    $("#loadergif").show();
                    },
                    success: function (result) {
                    // console.log(result);
                  
                    $('#register').modal('hide');
                    location.reload(true);
                    },
                    complete:function(data){
                    // Hide image container
                    $("#loadergif").hide();
                    },
                    error: function (errormessage) {
                    alert(errormessage.responseText);
                    }
                    });
                    });
        });

    </script>
    @yield('specialscript')

</body>

</html>