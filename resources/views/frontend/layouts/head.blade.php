<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="pizza, delivery food, fast food, sushi, take away, chinese, italian food">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <meta name="_token" content="{{csrf_token()}}" />
    <title>Adanadayım Kebap Izgara</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
        href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
        href="img/apple-touch-icon-144x144-precomposed.png">
    <link href="{{asset('frontend/css/loader.css')}}" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
    <!-- GOOGLE WEB FONT -->
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic,300,300italic'
        rel='stylesheet' type='text/css'>
    <link href="{{asset('frontend/cart/css/style.css')}}" rel="stylesheet">
    @if ($settings !=null)
    <link
        href="{{$settings->style !=null ? asset('frontend/css/'+$settings->style): asset('frontend/css/style_brand.css')}}"
        rel="stylesheet">
    @else
    <link href="{{asset('frontend/css/style_brand.css')}}" rel="stylesheet">
    @endif

    <link href="{{asset('frontend/css/base.css')}}" rel="stylesheet">
    <script src="{{asset('frontend/js/modernizr.js')}}"></script>
    @yield('extracss')

    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    <style>
        .gizle {
            display: none;
        }

        .goster {
            display: block;
        }

        .mycart-footer {
            padding: 0px !important;
        }
    </style>
</head>