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


    <!-- Sidemenu Css -->
    <link href="{{asset('backend/plugins/toggle-sidebar/css/sidemenu.css')}}" rel="stylesheet">
    @yield('extracss')

</head>

<body class="app sidebar-mini rtl">
    <div id="global-loader"></div>
    <div class="page">
        <div class="page-main">
            <!-- Sidebar menu-->
            <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
            <aside class="app-sidebar ">
                <div class="sidebar-img">
                    <a class="navbar-brand" href="index-2.html"><img alt="..." class="navbar-brand-img main-logo"
                            src="{{asset('backend/img/brand/logo-dark.png')}}"> <img alt="..."
                            class="navbar-brand-img logo" src="{{asset('backend/img/brand/logo.png')}}"></a>
                    <ul class="side-menu">
                        <li class="slide">
                            <a class="side-menu__item active" data-toggle="slide" href="#"><i
                                    class="side-menu__icon fe fe-home"></i><span
                                    class="side-menu__label">Restaurant</span><i
                                    class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu">
                                <li>
                                    <a class="slide-item" href="{{route('admin.restaurant.index')}}">Restaurants</a>
                                </li>
                                <li>
                                    <a class="slide-item" href="{{route('admin.restaurant.create')}}">New Restaurant</a>
                                </li>
                                <li>
                                    <a class="slide-item" href="dashboard-marketing.html">Marketing Dashboard</a>
                                </li>
                                <li>
                                    <a class="slide-item" href="dashboard-it.html">IT Dashboard</a>
                                </li>
                                <li>
                                    <a class="slide-item" href="dashboard-cryptocurrency.html">Cryptocurrency
                                        Dashboard</a>
                                </li>

                            </ul>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="#"><i
                                    class="side-menu__icon fe fe-grid"></i><span class="side-menu__label">Media</span><i
                                    class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu">
                                <li>
                                    <a href="{{route('admin.media.index')}}" class="slide-item">Media Library</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.media.create')}}" class="slide-item">Add Media</a>
                                </li>
                                <li>
                                    <a href="widgets.html" class="slide-item">Widgets</a>
                                </li>
                                <li>
                                    <a href="full-calendar.html" class="slide-item">Full Calendar</a>
                                </li>
                                <li>
                                    <a href="range-slider.html" class="slide-item">Range Slider</a>
                                </li>
                                <li>
                                    <a href="scroll-bar.html" class="slide-item">Scroll Bar</a>
                                </li>
                                <li>
                                    <a href="sweet-alerts.html" class="slide-item">Sweet Alerts</a>
                                </li>
                                <li>
                                    <a href="timeline.html" class="slide-item">Timeline</a>
                                </li>
                                <li>
                                    <a href="users.html" class="slide-item">Users</a>
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
                                    class="side-menu__label">Tables</span><i class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu">
                                <li>
                                    <a href="tables.html" class="slide-item">Tables</a>
                                </li>
                                <li>
                                    <a href="datatable.html" class="slide-item">Data Tables</a>
                                </li>
                            </ul>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="#"><i
                                    class="side-menu__icon fe fe-bar-chart-2"></i><span class="side-menu__label">Chart
                                    Types</span><i class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu">
                                <li>
                                    <a href="chart-flot.html" class="slide-item">Flot Charts</a>
                                </li>
                                <li>
                                    <a href="chart-high.html" class="slide-item">High Charts </a>
                                </li>
                                <li>
                                    <a href="charts-chartjs.html" class="slide-item">Chartjs Charts</a>
                                </li>
                                <li>
                                    <a href="charts-echarts.html" class="slide-item">Echart Charts</a>
                                </li>
                                <li>
                                    <a href="charts-morris.html" class="slide-item">Morris Charts</a>
                                </li>
                            </ul>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="#"><i
                                    class="side-menu__icon fe fe-folder"></i><span
                                    class="side-menu__label">Pages</span><i class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu">
                                <li>
                                    <a href="user-profile.html" class="slide-item">User Profile</a>
                                </li>
                                <li>
                                    <a href="email-inbox.html" class="slide-item">Email Inbox</a>
                                </li>
                                <li>
                                    <a href="email-compose.html" class="slide-item">Email</a>
                                </li>
                                <li>
                                    <a href="gallery.html" class="slide-item">Gallery</a>
                                </li>
                                <li>
                                    <a href="invoice.html" class="slide-item">Invoice</a>
                                </li>
                                <li>
                                    <a href="pricing.html" class="slide-item">Pricing Tables</a>
                                </li>
                                <li>
                                    <a href="empty.html" class="slide-item">Empty</a>
                                </li>
                                <li>
                                    <a href="under-construction.html" class="slide-item">Under Construction</a>
                                </li>
                                <li>
                                    <a href="400.html" class="slide-item">Page 400</a>
                                </li>
                                <li>
                                    <a href="404.html" class="slide-item">Page 404</a>
                                </li>
                                <li>
                                    <a href="500.html" class="slide-item">Page 500</a>
                                </li>
                                <li>
                                    <a href="505.html" class="slide-item">Page 505</a>
                                </li>
                            </ul>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="#"><i
                                    class="side-menu__icon fe fe-italic"></i><span
                                    class="side-menu__label">Icons</span><i class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu">
                                <li>
                                    <a href="icons-feather.html" class="slide-item">Feather Icons</a>
                                </li>
                                <li>
                                    <a href="icons-fontawesome.html" class="slide-item">Font Awesome Icons</a>
                                </li>
                                <li>
                                    <a href="icons-ion.html" class="slide-item">Ion Icons</a>
                                </li>
                                <li>
                                    <a href="icons-materialdesign.html" class="slide-item">Materialdesign Icons</a>
                                </li>
                                <li>
                                    <a href="icons-nucleo.html" class="slide-item">Nucleo Icons</a>
                                </li>
                                <li>
                                    <a href="icons-pe7.html" class="slide-item">pe7 Icons</a>
                                </li>
                                <li>
                                    <a href="icons-simpleline.html" class="slide-item">Simpleline Icons</a>
                                </li>
                                <li>
                                    <a href="icons-themify.html" class="slide-item">Themify Icons</a>
                                </li>
                            </ul>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="#"><i
                                    class="side-menu__icon fe fe-underline"></i><span class="side-menu__label">Ui
                                    Elements</span><i class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu">
                                <li>
                                    <a href="accordion.html" class="slide-item">Accordion</a>
                                </li>
                                <li>
                                    <a href="alerts.html" class="slide-item">Alerts</a>
                                </li>
                                <li>
                                    <a href="badges.html" class="slide-item">Badges</a>
                                </li>
                                <li>
                                    <a href="buttons.html" class="slide-item">Buttons</a>
                                </li>
                                <li>
                                    <a href="carousel.html" class="slide-item">Carousels</a>
                                </li>
                                <li>
                                    <a href="colors.html" class="slide-item">Colors</a>
                                </li>
                                <li>
                                    <a href="dropdowns.html" class="slide-item">Drop downs</a>
                                </li>
                                <li>
                                    <a href="grids.html" class="slide-item">Grids</a>
                                </li>
                                <li>
                                    <a href="modal.html" class="slide-item">Modal</a>
                                </li>
                                <li>
                                    <a href="navigation.html" class="slide-item">Navigation</a>
                                </li>
                                <li>
                                    <a href="pagination.html" class="slide-item">Pagination</a>
                                </li>
                                <li>
                                    <a href="popovers.html" class="slide-item">Popovers</a>
                                </li>
                                <li>
                                    <a href="progress.html" class="slide-item">Progress</a>
                                </li>
                                <li>
                                    <a href="tabs.html" class="slide-item">Tabs</a>
                                </li>
                                <li>
                                    <a href="tooltip.html" class="slide-item">Tooltip</a>
                                </li>
                                <li>
                                    <a href="typography.html" class="slide-item">Typography</a>
                                </li>
                            </ul>
                        </li>

                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="#"><i
                                    class="side-menu__icon fe fe-user"></i><span
                                    class="side-menu__label">Account</span><i class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu">
                                <li>
                                    <a href="login.html" class="slide-item">Login</a>
                                </li>
                                <li>
                                    <a href="register.html" class="slide-item">Register</a>
                                </li>
                                <li>
                                    <a href="forgot.html" class="slide-item">Forgot password</a>
                                </li>
                                <li>
                                    <a href="lockscreen.html" class="slide-item">Lock screen</a>
                                </li>
                            </ul>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="#"><i
                                    class="side-menu__icon fe fe-shopping-cart"></i><span
                                    class="side-menu__label">E-commerce</span><i
                                    class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu">
                                <li>
                                    <a href="shop.html" class="slide-item">Products</a>
                                </li>
                                <li>
                                    <a href="cart.html" class="slide-item">Shopping Cart</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a class="side-menu__item" href="https://themeforest.net/user/sprukosoft/portfolio"><i
                                    class="side-menu__icon fa fa-question-circle"></i><span
                                    class="side-menu__label">Help & Support</span></a>
                        </li>
                    </ul>
                </div>
            </aside>
            <!-- Sidebar menu-->

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
                                            class="nav-link pr-md-0 d-none d-lg-block" data-toggle="dropdown" href="#"
                                            role="button">
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
                                            class="nav-link pr-md-0 d-none d-lg-block" data-toggle="dropdown" href="#"
                                            role="button">
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
                                </ul>

                                <!-- Brand -->
                                <a class="navbar-brand pt-0 d-md-none" href="index-2.html">
                                    <img src="backend/img/brand/logo-light.png" class="navbar-brand-img" alt="...">
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
                                                <i class="fe fe-user "></i>
                                            </div>
                                        </a>
                                        <div
                                            class="dropdown-menu dropdown-menu-lg dropdown-menu-arrow dropdown-menu-right">
                                            <a class="dropdown-item d-flex" href="#">
                                                <span class="avatar brround mr-3 align-self-center"> <img
                                                        src="backend/img/faces/male/4.jpg" alt="imag"></span>
                                                <div>
                                                    <strong>Madeleine Scott</strong> sent you friend request
                                                    <div class=" mt-2 small text-muted">
                                                        <span class="btn btn-sm btn-primary">Conform</span>
                                                        <span class="btn btn-sm btn-outline-primary">Delete</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item d-flex" href="#">
                                                <span class="avatar brround mr-3 align-self-center"><img
                                                        src="{{asset('backend/img/faces/female/14.jpg')}}"
                                                        alt="imag"></span>
                                                <div>
                                                    <strong>rebica</strong> sent you friend request
                                                    <div class=" mt-2 small text-muted">
                                                        <span class="btn btn-sm btn-primary">Conform</span>
                                                        <span class="btn btn-sm btn-outline-primary">Delete</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item d-flex" href="#">
                                                <span class="avatar brround mr-3 align-self-center"><img
                                                        src="{{asset('backend/img/faces/male/1.jpg')}}"
                                                        alt="imag"></span>
                                                <div>
                                                    <strong>Devid robott</strong> sent you friend request
                                                    <div class=" mt-2 small text-muted">
                                                        <span class="btn btn-sm btn-primary">Conform</span>
                                                        <span class="btn btn-sm btn-outline-primary">Delete</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="dropdown-divider"></div><a
                                                class="dropdown-item text-center text-muted-dark" href="#">View all
                                                Requestes</a>
                                        </div>
                                    </li>

                                    <li class="nav-item dropdown d-none d-md-flex">
                                        <a aria-expanded="false" aria-haspopup="true" class="nav-link pr-0"
                                            data-toggle="dropdown" href="#" role="button">
                                            <div class="media align-items-center">
                                                <i class="fe fe-mail "></i>
                                            </div>
                                        </a>
                                        <div
                                            class="dropdown-menu  dropdown-menu-lg dropdown-menu-arrow dropdown-menu-right">
                                            <a href="#" class="dropdown-item text-center">12 New Messages</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item d-flex">
                                                <span class="avatar brround mr-3 align-self-center"><img
                                                        src="backend/img/faces/male/41.jpg" alt="img"></span>
                                                <div>
                                                    <strong>Madeleine</strong> Hey! there I' am available....
                                                    <div class="small text-muted">3 hours ago</div>
                                                </div>
                                            </a>
                                            <a href="#" class="dropdown-item d-flex">
                                                <span class="avatar brround mr-3 align-self-center"><img
                                                        src="{{asset('backend/img/faces/female/1.jpg')}}"
                                                        alt="img"></span>
                                                <div>
                                                    <strong>Anthony</strong> New product Launching...
                                                    <div class="small text-muted">5 hour ago</div>
                                                </div>
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item text-center">See all Messages</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown d-none d-md-flex">
                                        <a aria-expanded="false" aria-haspopup="true" class="nav-link pr-0"
                                            data-toggle="dropdown" href="#" role="button">
                                            <div class="media align-items-center">
                                                <i class="fe fe-bell f-30 "></i>
                                            </div>
                                        </a>
                                        <div
                                            class="dropdown-menu dropdown-menu-lg dropdown-menu-arrow dropdown-menu-right">
                                            <a href="#" class="dropdown-item d-flex">
                                                <div>
                                                    <strong>Someone likes our posts.</strong>
                                                    <div class="small text-muted">3 hours ago</div>
                                                </div>
                                            </a>
                                            <a href="#" class="dropdown-item d-flex">
                                                <div>
                                                    <strong> 3 New Comments</strong>
                                                    <div class="small text-muted">5 hour ago</div>
                                                </div>
                                            </a>
                                            <a href="#" class="dropdown-item d-flex">
                                                <div>
                                                    <strong> Server Rebooted.</strong>
                                                    <div class="small text-muted">45 mintues ago</div>
                                                </div>
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item text-center">View all Notification</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a aria-expanded="false" aria-haspopup="true" class="nav-link pr-md-0"
                                            data-toggle="dropdown" href="#" role="button">
                                            <div class="media align-items-center">
                                                <span class="avatar avatar-sm rounded-circle"><img
                                                        alt="Image placeholder"
                                                        src="{{asset('backend/img/faces/female/32.jpg')}}"></span>
                                                <div class="media-body ml-2 d-none d-lg-block">
                                                    <span class="mb-0 ">{{Auth::user()->name}}</span>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                                            <div class=" dropdown-header noti-title">
                                                <h6 class="text-overflow m-0">Welcome!</h6>
                                            </div>
                                            <a class="dropdown-item" href="user-profile.html"><i
                                                    class="ni ni-single-02"></i> <span>My profile</span></a>
                                            <a class="dropdown-item" href="#"><i class="ni ni-settings-gear-65"></i>
                                                <span>Settings</span></a>
                                            <a class="dropdown-item" href="#"><i class="ni ni-calendar-grid-58"></i>
                                                <span>Activity</span></a>
                                            <a class="dropdown-item" href="#"><i class="ni ni-support-16"></i>
                                                <span>Support</span></a>
                                            <div class="dropdown-divider"></div><a class="dropdown-item"
                                                href="login.html"><i class="ni ni-user-run"></i> <span>Logout</span></a>
                                        </div>
                                    </li>
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


    @yield('extrascript')
</body>

</html>