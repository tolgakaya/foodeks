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
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>QuickFood - Quality delivery or take away food</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
        href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
        href="img/apple-touch-icon-144x144-precomposed.png">

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

    <link href="{{asset('css/base.css')}}" rel="stylesheet">


    {{-- <link href="css/skins/square/grey.css" rel="stylesheet">
    <link href="css/ion.rangeSlider.css" rel="stylesheet">
    <link href="css/ion.rangeSlider.skinFlat.css" rel="stylesheet"> --}}
    <!-- Modernizr -->
    <script src="{{asset('js/modernizr.js')}}"></script>
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

    <div class="layer"></div><!-- Mobile menu overlay mask -->

    <!-- Login modal -->
    <div class="modal fade" id="login_2" tabindex="-1" role="dialog" aria-labelledby="myLogin" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-popup">
                <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
                <form action="{{route('login')}}" method="POST" class="popup-form" id="myLogin">
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

    <!-- COMMON SCRIPTS -->
    <script src="{{asset('js/jquery-2.2.4.min.js')}}"></script>
    <script src="{{asset('js/common_scripts_min.js')}}"></script>
    <script src="{{asset('js/functions.js')}}"></script>
    <script src="{{asset('assets/validate.js')}}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
               
                $("#btnLogin").click(function(e){
              e.preventDefault();
                
                var password = $("input[name=password]").val();
                var email = $("input[name=email]").val();
                $.ajax({
                    type:'POST',
                    url:"{{ route('login') }}",
                    data:{email:email, password:password},
                    success:function(data){
                        console.log(data.message);
                        // location.reload(true);
                        },
                    error:function(data){
               if(data.responseJSON.errors.email) {
                $( '#email-error' ).html(data.responseJSON.errors.email[0]);
                }
                    }
                });
              	});
    </script>
    @yield('specialscript')

</body>

</html>