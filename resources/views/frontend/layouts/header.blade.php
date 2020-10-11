<!-- Header ================================================== -->
<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col--md-3 col-sm-3 col-xs-3">
                {{-- <div class="lrg-logo"> --}}
                <a href="{{route('home')}}" id="logo">
                    <div class="lrglogo">
                        <img src="{{$settings->logo ?? asset('frontend/img/logo.png')}}" alt="" data-retina="true"
                            class="hidden-xs">
                    </div>
                    <div class="smllogo" style="display: none">
                        <img src="{{$settings->logo ?? asset('frontend/img/logo-sml.png')}}" alt="" data-retina="true"
                            class="hidden-xs">
                    </div>


                    <img src="{{$settings->logo ?? asset('frontend/img/logo.png')}}" width="59" height="23" alt=""
                        data-retina="true" class="hidden-lg hidden-md hidden-sm">
                </a>
                {{-- </div> --}}
            </div>
            <nav class="col--md-9 col-sm-9 col-xs-9">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu
                        mobile</span></a>
                <div class="main-menu">
                    <div id="header_menu">
                        <img src="{{$settings->logo ?? asset('frontend/img/logo.png')}}" width="190" height="23" alt=""
                            data-retina="true">
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
                        <li><a href="#0" data-toggle="modal" data-target="#login_2" id="btnLoginHead">Giriş</a></li>
                        <li><a href="#0" data-toggle="modal" data-target="#register" id="btnRegisterHead">Üyelik</a>
                        </li>
                        @endguest
                        @auth
                        <li class="dropdown" style=" margin-right: 60px;">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-expanded="false"> <span class="glyphicon glyphicon-user"></span>
                                {{Auth::user()->adi}}<span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-cart" role="menu">
                                @if(Auth::user()->role==1 || Auth::user()->role==3)
                                <li><a href="{{route('admin.dashboard')}}" id="user"><i
                                            class="glyphicon glyphicon-user"></i>
                                        Panel <span class="badge">1</span></a></li>
                                @elseif(Auth::user()->role==2)
                                <li><a href="{{route('customer.profile.index')}}" id="user"><i
                                            class="glyphicon glyphicon-user"></i>
                                        Profil <span class="badge">1</span></a>
                                </li>

                                @elseif(Auth::user()->role==4)
                                <li><a href="{{route('carrier.dashboard')}}" id="user"><i
                                            class="glyphicon glyphicon-user"></i>
                                        Panel <span class="badge">1</span></a>
                                </li>
                                @endif
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                                     document.getElementById('logout-form').submit();">
                                        <i class="icon-logout">Çıkış</i>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                                <li class="divider"></li>

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