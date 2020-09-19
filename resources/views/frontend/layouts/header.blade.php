<!-- Header ================================================== -->
<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col--md-3 col-sm-3 col-xs-3">
                <a href="{{route('home')}}" id="logo">
                    <img src="{{asset('frontend/img/logo.png')}}" width="190" height="23" alt="" data-retina="true"
                        class="hidden-xs">
                    <img src="{{asset('frontend/img/logo_mobile.png')}}" width="59" height="23" alt=""
                        data-retina="true" class="hidden-lg hidden-md hidden-sm">
                </a>
            </div>
            <nav class="col--md-9 col-sm-9 col-xs-9">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu
                        mobile</span></a>
                <div class="main-menu">
                    <div id="header_menu">
                        <img src="{{asset('frontend/img/logo.png')}}" width="190" height="23" alt="" data-retina="true">
                    </div>
                    <a href="#" class="open_close" id="close_in"><i class="icon_close"></i></a>
                    <ul>
                        <li>
                            <a href="{{route('home')}}">Ana Sayfa</a>
                        </li>
                        <li>
                            <a href="{{route('restaurants.index')}}">Restaurantlar</a>
                        </li>
                        <li><a href="{{route('about')}}">Hakkımızda</a></li>
                        @guest
                        <li><a href="#0" data-toggle="modal" data-target="#login_2">Giriş</a></li>
                        <li><a href="#0" data-toggle="modal" data-target="#register">Üyelik</a></li>
                        @endguest
                        @auth
                        <li class="dropdown" style=" margin-right: 60px;">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-expanded="false"> <span class="glyphicon glyphicon-user"></span>
                                {{Auth::user()->name}}<span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-cart" role="menu">
                                @if(Auth::user()->role==1)
                                <li><a href="{{route('admin.dashboard')}}" id="user"><i
                                            class="glyphicon glyphicon-user"></i>
                                        Dashboard <span class="badge">1</span></a></li>
                                @elseif(Auth::user()->role==2)
                                <li><a href="{{route('customer.dashboard')}}" id="user"><i
                                            class="glyphicon glyphicon-user"></i>
                                        Dashboard <span class="badge">1</span></a></li>
                                @endif
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                                     document.getElementById('logout-form').submit();">
                                        <i class="icon-logout">Logout</i>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                                <li class="divider"></li>
                                <li><a class="text-center" href="">View Cart</a></li>
                            </ul>
                        </li>
                        @endauth

                    </ul>

                </div><!-- End main-menu -->
            </nav>

        </div><!-- End row -->
    </div><!-- End container -->

</header>


<!--end container -->
<!-- End Header =============================================== -->