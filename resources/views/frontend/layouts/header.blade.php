<!-- Header ================================================== -->
<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col--md-3 col-sm-3 col-xs-3">
                <a href="{{route('home')}}" id="logo">
                    <img src="{{asset('img/logo.png')}}" width="190" height="23" alt="" data-retina="true"
                        class="hidden-xs">
                    <img src="{{asset('img/logo_mobile.png')}}" width="59" height="23" alt="" data-retina="true"
                        class="hidden-lg hidden-md hidden-sm">
                </a>
            </div>
            <nav class="col--md-9 col-sm-9 col-xs-9">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu
                        mobile</span></a>
                <div class="main-menu">
                    <div id="header_menu">
                        <img src="{{asset('img/logo.png')}}" width="190" height="23" alt="" data-retina="true">
                    </div>
                    <a href="#" class="open_close" id="close_in"><i class="icon_close"></i></a>
                    <ul>
                        <li>
                            <a href="{{route('home')}}">Home</a>
                        </li>
                        <li>
                            <a href="{{route('restaurants.index')}}">Restaurants</a>
                        </li>
                        <li><a href="{{route('about')}}">About us</a></li>
                        <li><a href="{{route('faq')}}">Faq</a></li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-expanded="false"> <span class="glyphicon glyphicon-shopping-cart"></span> 7 -
                                Items<span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-cart" role="menu">
                                <li>
                                    <span class="item">
                                        <span class="item-left">
                                            <img src="http://lorempixel.com/50/50/" alt="" />
                                            <span class="item-info">
                                                <span>Item name</span>
                                                <span>23$</span>
                                            </span>
                                        </span>
                                        <span class="item-right">
                                            <button class="btn btn-xs btn-danger pull-right">x</button>
                                        </span>
                                    </span>
                                </li>
                                <li>
                                    <span class="item">
                                        <span class="item-left">
                                            <img src="http://lorempixel.com/50/50/" alt="" />
                                            <span class="item-info">
                                                <span>Item name</span>
                                                <span>23$</span>
                                            </span>
                                        </span>
                                        <span class="item-right">
                                            <button class="btn btn-xs btn-danger pull-right">x</button>
                                        </span>
                                    </span>
                                </li>
                                <li>
                                    <span class="item">
                                        <span class="item-left">
                                            <img src="http://lorempixel.com/50/50/" alt="" />
                                            <span class="item-info">
                                                <span>Item name</span>
                                                <span>23$</span>
                                            </span>
                                        </span>
                                        <span class="item-right">
                                            <button class="btn btn-xs btn-danger pull-right">x</button>
                                        </span>
                                    </span>
                                </li>
                                <li>
                                    <span class="item">
                                        <span class="item-left">
                                            <img src="http://lorempixel.com/50/50/" alt="" />
                                            <span class="item-info">
                                                <span>Item name</span>
                                                <span>23$</span>
                                            </span>
                                        </span>
                                        <span class="item-right">
                                            <button class="btn btn-xs btn-danger pull-right">x</button>
                                        </span>
                                    </span>
                                </li>
                                <li class="divider"></li>
                                <li><a class="text-center" href="">View Cart</a></li>
                            </ul>
                        </li>

                        @guest
                        <li><a href="#0" data-toggle="modal" data-target="#login_2">Login</a></li>
                        <li><a href="#0" data-toggle="modal" data-target="#register">Register</a></li>
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