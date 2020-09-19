<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta content="Start your development with a Dashboard for Bootstrap 4." name="description">
    <meta content="Spruko" name="author">

    <!-- Title -->
    <title>Ansta - Responsive Multipurpose Admin Dashboard Template</title>

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
    {{-- <style>
        .felan {
            width: 100%;
            height: 15vw;
            object-fit: cover;
        }
    </style> --}}


    @yield('extracss')

</head>

<body class="app">
    @include('sweet::alert')
    <div id="global-loader"></div>
    <div class="page">
        <div class="page-main">
            <!-- Sidebar menu-->
            {{-- <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
            <aside class="app-sidebar ">
                <div class="sidebar-img">
                    <a class="navbar-brand" href="index-2.html"><img alt="..." class="navbar-brand-img main-logo"
                            src="{{asset('backend/img/brand/logo-dark.png')}}"> <img alt="..."
                class="navbar-brand-img logo" src="{{asset('backend/img/brand/logo.png')}}"></a>
            <ul class="side-menu">
                @for ($i = 0; $i < count($categories); $i++) <li>
                    <a class="side-menu__item"
                        href="{{route('touchless.index',['restaurant'=>1,'category'=>$categories[$i]])}}"><i
                            class="side-menu__icon fe fe-grid"></i><span
                            class="side-menu__label">{{$kategoriler[$i]->category}}</span><i
                            class="angle fa fa-angle-right"></i></a>
                    </li>
                    @endfor
                    {{-- @foreach ($categories as $i=> $category)
                            <li>
                                <a class="side-menu__item"
                                    href="{{route('touchless.paging',['restaurant'=>1,'category'=>$category])}}"><i
                        class="side-menu__icon fe fe-grid"></i><span class="side-menu__label">{{$category}}</span><i
                        class="angle fa fa-angle-right"></i></a>
                    </li>
                    @endforeach --}}
                    {{-- 
            </ul>
        </div>
        </aside>  --}}
                    <!-- Sidebar menu-->

                    <!-- app-content-->
                    <div class="app-content ">
                        <div class="side-app">
                            <div class="main-content">
                                {{-- <div class="p-2 d-block d-sm-none navbar-sm-search">
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
                                </div> --}}
                                <!-- Top navbar -->
                                <nav class="navbar navbar-top  navbar-expand-md navbar-dark" id="navbar-main">
                                    <div class="container-fluid">
                                        <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar"
                                            href="#"></a>

                                        <!-- Horizontal Navbar -->
                                        {{-- <ul class="navbar-nav align-items-center d-none d-xl-block">
                                            <li class="nav-item dropdown">
                                                <a aria-expanded="false" aria-haspopup="true"
                                                    class="nav-link pr-md-0 d-none d-lg-block" data-toggle="dropdown"
                                                    href="#" role="button">
                                                    Default Settings <span class="fas fa-caret-down"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                                                    <a class="dropdown-item" href="#"><span>Manage Profile</span></a>
                                                    <a class="dropdown-item" href="#"><span>Themes</span></a>
                                                    <a class="dropdown-item" href="#"><span>Passwords</span></a>
                                                    <a class="dropdown-item" href="#"><span>Payment methods</span></a>
                                                    <a class="dropdown-item" href="#"><span>Other Settings</span></a>
                                                </div>
                                            </li>
                                            <li class="nav-item dropdown">
                                                <a aria-expanded="false" aria-haspopup="true"
                                                    class="nav-link pr-md-0 d-none d-lg-block" data-toggle="dropdown"
                                                    href="#" role="button">
                                                    Projects <span class="fas fa-caret-down"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                                                    <a class="dropdown-item" href="#"><span>Active</span></a>
                                                    <a class="dropdown-item" href="#"><span>Marketing</span></a>
                                                    <a class="dropdown-item" href="#"><span>Users</span></a>
                                                    <a class="dropdown-item" href="#"><span>Development</span></a>
                                                    <a class="dropdown-item" href="#"><span>Settings</span></a>
                                                </div>
                                            </li>
                                        </ul> --}}

                                        <!-- Brand -->
                                        <a class="navbar-brand pt-0 d-md-none" href="index-2.html">
                                            <img src="{{asset('backend/img/brand/logo-light.png')}}"
                                                class="navbar-brand-img" alt="...">
                                        </a>
                                        <!-- Form -->
                                        {{-- <form class="navbar-search navbar-search-dark form-inline mr-3  ml-lg-auto">
                                            <div class="form-group mb-0">
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-search"></i></span>
                                                    </div><input class="form-control" placeholder="Search" type="text">
                                                </div>
                                            </div>
                                        </form> --}}
                                        <!-- User -->
                                        <ul class="navbar-nav align-items-center ">
                                            <li class="nav-item d-none d-md-flex">
                                                <div class="dropdown d-none d-md-flex mt-2 ">
                                                    <a class="nav-link full-screen-link pl-0 pr-0"><i
                                                            class="fe fe-maximize-2 floating "
                                                            id="fullscreen-button"></i></a>
                                                </div>
                                            </li>
                                            <li class="nav-item ">
                                                <a aria-expanded="false" aria-haspopup="true" class="nav-link pr-md-0"
                                                    data-toggle="modal" data-target="#exampleModal" role="button">
                                                    <div class="media align-items-center">
                                                        <i class="fe fe-bell "></i>
                                                    </div>
                                                </a>

                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                                <!-- Top navbar-->

                                <!-- Page content -->
                                <div class="container-fluid pt-8">
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                {{-- <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Adisyon</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div> --}}
                                                <div class="modal-body">
                                                    @if ($order !=null)
                                                    <div class="card shadow felan">
                                                        <div class="card-header bg-gradient-primary">
                                                            <h2 class="mb-0 text-white ">Masa No: {{$order->masaid}}
                                                            </h2>
                                                        </div>
                                                        <div class="card-body text-center">

                                                            <h4 class="h4 mb-0 mt-3 font-600">Adisyon Tutarı :
                                                                {{$order->total}} TL</h4>
                                                            <div class="">
                                                                <div class="grid-margin">
                                                                    <div class="">
                                                                        <div class="table-responsive">
                                                                            <table class="table">
                                                                                <thead class="thead-light">
                                                                                    <tr>
                                                                                        <th>Adet/Seçenek</th>
                                                                                        <th>Ürün</th>
                                                                                        <th>Tutar</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach ($order->orderdetails as
                                                                                    $detail)
                                                                                    <tr
                                                                                        class="{{$detail->goruldu !=1 ? 'bg-info' :''}}">
                                                                                        <td>{{$detail->quantity}} X
                                                                                            {{$detail->option_name}}
                                                                                        </td>
                                                                                        <td
                                                                                            class="text-sm font-weight-600">
                                                                                            {{$detail->meal_name}}</td>
                                                                                        <td class="text-nowrap">
                                                                                            {{$detail->total}} TL</td>
                                                                                    </tr>
                                                                                    @endforeach

                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="card-footer">
                                                            <button type="button" class="btn btn-secondary btn-block"
                                                                data-dismiss="modal">Kapat</button>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                                {{-- <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    @yield('content')
                                    <!-- Footer -->
                                    <footer class="footer">
                                        <div class="row align-items-center justify-content-xl-between">
                                            <div class="col-xl-6">
                                                <div class="copyright text-center text-xl-left text-muted">
                                                    <p class="text-sm font-weight-500">Copyright 2018 © All Rights
                                                        Reserved.Dashboard Template</p>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <p class="float-right text-sm font-weight-500"><a
                                                        href="www.templatespoint.net">Templates Point</a></p>
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


    @yield('specialscript')
</body>

</html>