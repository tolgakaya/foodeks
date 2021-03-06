<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta content="Start your development with a Dashboard for Bootstrap 4." name="description">
    <meta content="Spruko" name="author">

    <!-- Title -->
    <title>{{$settings !=null ?  $settings->company : 'Adanadayım Sipariş Yönetim Paneli'}}</title>

    <!-- Favicon -->
    <link href="{{asset('backend/img/brand/favicon.png')}}" rel="icon" type="image/png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800" rel="stylesheet">

    <!-- Icons -->
    <link href="{{asset('backend/css/icons.css')}}" rel="stylesheet">

    <!--Bootstrap.min css-->
    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap/css/bootstrap.min.css')}}">

    <!-- Ansta CSS -->
    <link href="{{asset('backend/css/dashboard.css')}}" rel="stylesheet" type="text/css">

    <!-- Custom scroll bar css-->
    <link href="{{asset('backend/plugins/customscroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Sidemenu Css -->
    <link href="{{asset('backend/plugins/toggle-sidebar/css/sidemenu.css')}}" rel="stylesheet">
    <style>
        .badge {
            position: absolute;
            font-size: xx-small;
            margin-left: -5px;
            margin-top: -15px;
            background-color: var(--orange);
            color: white;
        }
    </style>
    <style>
        .dz-message {
            text-align: center;
            font-size: 28px;
        }

        .dz-preview .dz-image img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover;
        }
    </style>
    @yield('extracss')

</head>


<body class="app sidebar-mini rtl">
    @include('sweet::alert')
    <audio id="notification" src="{{asset('backend/sounds/alert.wav')}}" muted></audio>
    <div id="global-loader"></div>
    <div class="page">
        <div class="page-main">
            <!-- Sidebar menu-->
            <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
            @if (Auth::user()->role !=4)
            <aside class="app-sidebar ">
                <div class="sidebar-img">
                    <a class="navbar-brand"
                        href="{{Auth::user()->role == 4 ? route('carrier.dashboard') : route('admin.orders.index')}}"><img
                            alt="..." class="navbar-brand-img main-logo"
                            src="{{$settings !=null ? $settings->companyLogo() :  asset('backend/img/brand/logo-light.png')}}">
                        <img alt="..." class="navbar-brand-img logo"
                            src="{{$settings !=null ? $settings->companyLogo() :  asset('backend/img/brand/logo-light.png')}}"></a>
                    <ul class="side-menu">
                        <li class="slide">
                            <a class="side-menu__item active" data-toggle="slide" href="#"><i
                                    class="side-menu__icon fe fe-home"></i><span
                                    class="side-menu__label">Restaurant</span><i
                                    class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu">
                                <li>
                                    <a class="slide-item" href="{{route('admin.restaurant.index')}}">Restaurantlar</a>
                                </li>
                                <li>
                                    <a class="slide-item" href="{{route('admin.restaurant.create')}}">Yeni Restaurant
                                        Ekle</a>
                                </li>

                            </ul>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="#"><i
                                    class="side-menu__icon fe fe-edit"></i><span class="side-menu__label">Menü
                                    İşlemleri</span><i class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu">
                                <li>
                                    <a href="{{route('admin.categories.create')}}" class="slide-item">Yeni Kategori</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.categories.index')}}" class="slide-item">Kategori
                                        Listesi</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.meals.create')}}" class="slide-item">Yeni F&B</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.meals.index')}}" class="slide-item">F&B Listesi</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.menus.create')}}" class="slide-item">Yeni Menü</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.menus.index')}}" class="slide-item">Menü Listesi</a>
                                </li>
                            </ul>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="#"><i
                                    class="side-menu__icon fe fe-map"></i><span
                                    class="side-menu__label">Personel</span><i class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu">
                                <li>
                                    <a href="{{route('admin.users.index')}}" class="slide-item">Personel Listesi</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.users.create')}}" class="slide-item">Personel Ekle</a>
                                </li>
                            </ul>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="#"><i
                                    class="side-menu__icon fe fe-file-text"></i><span
                                    class="side-menu__label">Siparişler</span><i
                                    class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu">
                                <li>
                                    <a href="{{route('admin.orders.index')}}" class="slide-item">Sipariş Listesi</a>
                                </li>

                            </ul>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="#"><i
                                    class="side-menu__icon fe fe-bar-chart-2"></i><span
                                    class="side-menu__label">Rezervasyonlar</span><i
                                    class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu">
                                <li>
                                    <a href="{{route('admin.bookings.create')}}" class="slide-item">Yeni rezervasyon</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.bookings.calendar')}}" class="slide-item">Rezervasyon
                                        Takvimi
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('admin.bookings.index')}}" class="slide-item">Rezervasyon
                                        listesi</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.bookings.gunluk')}}" class="slide-item">Bugünkü
                                        ezervasyonlar</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.bookings.yarin')}}" class="slide-item">Yarınki
                                        rezervasyonlar</a>
                                </li>
                            </ul>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="#"><i
                                    class="side-menu__icon fe fe-folder"></i><span
                                    class="side-menu__label">Adisyonlar</span><i
                                    class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu">
                                <li>
                                    <a href="{{route('admin.orders.indexMasa')}}" class="slide-item">Açık Adisyonlar</a>
                                </li>
                            </ul>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="#"><i
                                    class="side-menu__icon fe fe-italic"></i><span
                                    class="side-menu__label">Sayfa/Ayar</span><i
                                    class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu">
                                <li>
                                    <a href="{{route('admin.pages.home.index')}}" class="slide-item">Ana Sayfa<a>
                                </li>
                                <li>
                                    <a href="{{route('admin.pages.about.index')}}" class="slide-item">Hakkımızda</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.pages.settings.index')}}" class="slide-item">Site
                                        Ayarları</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.pages.restaurant.index')}}" class="slide-item">Restaurant
                                        Listesi Sayfası</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.pages.ad.index')}}" class="slide-item">Sidebar Reklam<a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </aside>
            <!-- Sidebar menu-->
            @endif


            <!-- app-content-->
            <div class="app-content ">
                <div class="side-app">
                    <div class="main-content">
                        <div class="p-2 d-block d-sm-none navbar-sm-search">
                            <!-- Form -->
                            <form class="navbar-search navbar-search-dark form-inline ml-lg-auto">
                                <div class="form-group mb-0">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                                        </div><input class="form-control" placeholder="Search" type="text">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Top navbar -->
                        <nav class="navbar navbar-top  navbar-expand-md navbar-dark" id="navbar-main">
                            <div class="container-fluid">
                                <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar"
                                    href="#"></a>

                                <!-- Horizontal Navbar -->
                                <ul class="navbar-nav align-items-center d-none d-xl-block">
                                    <li class="nav-item dropdown">
                                        <a aria-expanded="false" aria-haspopup="true"
                                            class="nav-link  d-none d-lg-block" data-toggle="dropdown" href="#"
                                            role="button">
                                            Hızlı Erişim<span class="fas fa-caret-down"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                                            <a class="dropdown-item"
                                                href="{{route('admin.orders.index')}}"><span>Sipariş Listesi</span></a>
                                            <a class="dropdown-item"
                                                href="{{route('admin.bookings.calendar')}}"><span>Rezervasyonlar</span></a>
                                            <a class="dropdown-item"
                                                href="{{route('admin.orders.indexMasa')}}"><span>Açık
                                                    Adisyonlar</span></a>
                                        </div>
                                    </li>
                                </ul>

                                <!-- Brand -->
                                <a class="navbar-brand pt-0 d-md-none"
                                    href="{{Auth::user()->role == 4 ? route('carrier.dashboard') : route('admin.orders.index')}}">
                                    <img src="{{$settings !=null ? $settings->companyLogo() :  asset('backend/img/brand/logo-light.png')}}"
                                        class="navbar-brand-img" alt="">
                                </a>
                                <!-- Form -->
                                <form class="navbar-search navbar-search-dark form-inline mr-3  ml-lg-auto">
                                    <div class="form-group mb-0">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            </div><input class="form-control" placeholder="Search" type="text">
                                        </div>
                                    </div>
                                </form>
                                <!-- User -->
                                <ul class="navbar-nav align-items-center ">
                                    <li class="nav-item d-none d-md-flex">
                                        <div class="dropdown d-none d-md-flex mt-2 ">
                                            <a class="nav-link full-screen-link pl-0 pr-0"><i
                                                    class="fe fe-maximize-2 floating " id="fullscreen-button"></i></a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown d-none d-md-flex">
                                        <a aria-expanded="false" aria-haspopup="true" class="nav-link pr-0"
                                            data-toggle="dropdown" href="#" role="button">

                                            <div class="media align-items-center">
                                                <i class="fe fe-user " id="paketcount"></i>
                                            </div>

                                        </a>
                                        <input type="hidden" id="currentPaket">
                                        <div id='alarmpaket'
                                            class="dropdown-menu dropdown-menu-lg dropdown-menu-arrow dropdown-menu-right">

                                            <div class="dropdown-divider"></div>
                                        </div>
                                    </li>

                                    <li class="nav-item dropdown d-none d-md-flex">
                                        <a aria-expanded="false" aria-haspopup="true" class="nav-link pr-0"
                                            data-toggle="dropdown" href="#" role="button">
                                            <div class="media align-items-center">
                                                <i class="fe fe-mail " id="adisyoncount"></i>
                                            </div>
                                        </a>
                                        <input type="hidden" id="currentAdisyon">
                                        <div id="alarmadisyon"
                                            class="dropdown-menu  dropdown-menu-lg dropdown-menu-arrow dropdown-menu-right">

                                            <div class="dropdown-divider"></div>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown d-none d-md-flex">
                                        <a aria-expanded="false" aria-haspopup="true" class="nav-link pr-0"
                                            data-toggle="dropdown" href="#" role="button">
                                            <div class="media align-items-center">
                                                <i class="fe fe-bell fe-30 " id="bookingcount"></i>
                                            </div>
                                        </a>
                                        <div id="alarmbooking"
                                            class="dropdown-menu  dropdown-menu-lg dropdown-menu-arrow dropdown-menu-right">
                                            {{-- <a href="#" class="dropdown-item text-center">12 New Messages</a> --}}
                                            <div class="dropdown-divider"></div>
                                        </div>
                                    </li>
                                    @auth
                                    <li class="nav-item dropdown">
                                        <a aria-expanded="false" aria-haspopup="true" class="nav-link pr-md-0"
                                            data-toggle="dropdown" href="#" role="button">
                                            <div class="media align-items-center">
                                                <span class="avatar avatar-sm rounded-circle"><img
                                                        alt="Image placeholder"
                                                        src="{{Auth::user()->userAvatar() ?? asset('backend/img/faces/female/32.jpg')}}"></span>
                                                <div class="media-body ml-2 d-none d-lg-block">
                                                    <span class="mb-0 ">{{Auth::user()->adi}}</span>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                                            <div class=" dropdown-header noti-title">
                                                <h6 class="text-overflow m-0">Selam! {{Auth::user()->adi}}</h6>
                                            </div>
                                            <a class="dropdown-item" href="{{route('admin.profile.index')}}"><i
                                                    class="ni ni-single-02"></i> <span>Profilim</span></a>
                                            <a class="dropdown-item" href="{{route('admin.change.password')}}"><i
                                                    class="ni ni-settings-gear-65"></i>
                                                <span>Şifre değiştir</span></a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                                                                                         document.getElementById('logout-form').submit();">
                                                <i class="icon-logout">Logout</i>
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                    @endauth

                                </ul>
                            </div>
                        </nav>
                        <!-- Top navbar-->

                        <!-- Page content -->
                        <div class="container-fluid pt-8">

                            @yield('content')
                            <!-- Footer -->
                            <footer class="footer">
                                <div class="row align-items-center justify-content-xl-between">
                                    <div class="col-xl-6">
                                        <div class="copyright text-center text-xl-left text-muted">
                                            <p class="text-sm font-weight-500">© {{$settings->company ?? 'ADANADAYIM'}}
                                                - {{ now()->year }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <p class="float-right text-sm font-weight-500"><a
                                                href="http://www.10loop.com">10Loop</a></p>
                                    </div>
                                </div>
                            </footer>
                            <!-- Footer -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- app-content -->
        </div>
    </div>
    <!-- Back to top -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    <!-- Ansta Scripts -->
    <!-- Core -->
    <script src="{{asset('backend/plugins/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('backend/js/popper.js')}}"></script>
    <script src="{{asset('backend/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- Optional JS -->
    <script src="{{asset('backend/plugins/chart.js/dist/Chart.min.js')}}"></script>
    <script src="{{asset('backend/plugins/chart.js/dist/Chart.extension.js')}}"></script>

    <!-- Data tables -->
    <script src="{{asset('backend/plugins/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Fullside-menu Js-->
    <script src="{{asset('backend/plugins/toggle-sidebar/js/sidemenu.js')}}"></script>

    <!-- Custom scroll bar Js-->
    <script src="{{asset('backend/plugins/customscroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{asset('backend//plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <!-- Ansta JS -->
    <script src="{{asset('backend/js/custom.js')}}"></script>
    <script src="{{asset('backend/js/alert.js')}}"></script>
    {{-- <script src="{{asset('backend/js/sweet-alert.js')}}"></script> --}}

    <script>
        $(document).ready(function () {
                            function Delete(menid, mealid) {
                                console.log("menuid "+menid );
                                var ans = confirm("Kaydı silmek istiyor musunuz?");
                                if (ans) {
            
                                var silinecek = { meal:mealid};
                                                   $.ajax({
                                    headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                    },
                                url: "/admin/menus/details/delete/" + menid+"/"+mealid,
                                data: JSON.stringify(silinecek),
                                type: "GET",
                                contentType: "application/json;charset=UTF-8",
                                dataType: "json",
                                success: function (result) {
                                console.log(result);
                                },
                                error: function (errormessage) {
                                alert(errormessage.responseText);
                                }
                                });
                                }
                                }});
    </script>


    @yield('extrascript')
</body>

</html>