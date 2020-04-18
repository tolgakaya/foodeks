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
                        <li class="dropdown" style=" margin-right: 60px;">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-expanded="false"> <span class="glyphicon glyphicon-user"></span> User Name<span
                                    class="caret"></span></a>
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
                        {{-- <li><a href="#" id="cart"><i class="glyphicon glyphicon-shopping-cart"></i> Cart <span
                                    class="badge">3</span></a></li> --}}

                        {{-- <li><a href="#" id="user"><i class="glyphicon glyphicon-user"></i> User <span
                                    class="badge">1</span></a></li> --}}
                        {{-- <li><a href="#0" data-toggle="modal" data-target="#login_2">Login</a></li>
                        <li><a href="#0" data-toggle="modal" data-target="#register">Register</a></li> --}}
                    </ul>

                </div><!-- End main-menu -->
            </nav>

        </div><!-- End row -->
    </div><!-- End container -->
    <div class="container">
        <div class="shopping-cartx">
            <div class="shopping-cart-header">
                <i class="glyphicon glyphicon-user"></i><span class="badge">3</span>
                <div class="shopping-cart-total">
                    <span class="lighter-text">UserName</span>
                </div>
            </div>
            <!--end shopping-cart-header -->

            <ul class="shopping-cart-items">
                <li class="clearfix">
                    <span class="item-quantity">My Account</span>
                </li>

                <li class="clearfix">
                    <span class="item-quantity">Any Noificatiton...</span>
                </li>
            </ul>

            <a href="#" class="button">Logout</a>
        </div>
        <!--end shopping-cart -->
    </div>
    <div class="container">
        <div class="shopping-cart">
            <div class="shopping-cart-header">
                <i class="glyphicon glyphicon-shopping-cart"></i><span class="badge">3</span>
                <div class="shopping-cart-total">
                    <span class="lighter-text">Total:</span>
                    <span class="main-color-text">$2,229.97</span>
                </div>
            </div>
            <!--end shopping-cart-header -->

            <ul class="shopping-cart-items">
                <li class="clearfix">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/cart-item1.jpg" alt="item1" />
                    <span class="item-name">Sony DSC-RX100M III</span>
                    <span class="item-price">$849.99</span>
                    <span class="item-quantity">Quantity: 01</span>
                </li>

                <li class="clearfix">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/cart-item2.jpg" alt="item1" />
                    <span class="item-name">KS Automatic Mechanic...</span>
                    <span class="item-price">$1,249.99</span>
                    <span class="item-quantity">Quantity: 01</span>
                </li>

                <li class="clearfix">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/cart-item3.jpg" alt="item1" />
                    <span class="item-name">Kindle, 6" Glare-Free To...</span>
                    <span class="item-price">$129.99</span>
                    <span class="item-quantity">Quantity: 01</span>
                </li>
            </ul>

            <a href="#" class="button">Checkout</a>
        </div>
        <!--end shopping-cart -->
    </div>

</header>


<!--end container -->
<!-- End Header =============================================== -->