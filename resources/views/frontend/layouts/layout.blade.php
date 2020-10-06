<!DOCTYPE html>
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html>

@include('frontend.layouts.head')

<body>
    @include('sweet::alert')
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
    @include('frontend.Cart.index');
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
    @include('frontend.layouts.modal')
    <!-- COMMON SCRIPTS -->
    <script src="{{asset('frontend/js/jquery-2.2.4.min.js')}}"></script>
    <script src="{{asset('frontend/js/common_scripts_min.js')}}"></script>
    <script src="{{asset('frontend/js/functions.js')}}"></script>
    <script src="{{asset('frontend/assets/validate.js')}}"></script>
    <script src="{{asset('frontend/cart/js/util.js')}}"></script>
    <script src="{{asset('frontend/cart/js/main.js')}}"></script>
    <script src="{{asset('frontend/cart/js/cart.js')}}"></script>
    <script src="{{asset('frontend/js/cat_nav_mobile.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#btnLogin").click(function(e){
                e.preventDefault();
                var password = $("#password").val();
                        var email = $("#login_email").val();
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
    {{-- <script>
        $(function() {
         var logolrg = $(".lrglogo");
         var logosml = $(".smllogo");
         $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        
        if (scroll >= 200) {
            logolrg.hide().fadeIn( "slow");
            logosml.show().fadeIn( "slow");
        // if(!logo.hasClass("sml-logo")) {
        // logo.hide();
        // logo.removeClass('lrg-logo').addClass("sml-logo").fadeIn( "slow");
        // }
        } else {
            logolrg.show().fadeIn( "slow");
                        logosml.hide().fadeIn( "slow");
        // if(!logo.hasClass("lrg-logo")) {
        // logo.hide();
        // logo.removeClass("sml-logo").addClass('lrg-logo').fadeIn( "slow");
        // }
        }
        
        });
        });
    </script> --}}
    <script>
        $(function() {
             var logolrg = $(".lrglogo");
             var logosml = $(".smllogo");
             $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            
            if (scroll >= 200) {
                logolrg.css("display","none")
                logosml.css("display","block")
 
            // }
            } else {
                logolrg.css("display","block")
                logosml.css("display","none")
 
            // }
            }
            
            });
            });
    </script>
    @yield('specialscript')

</body>

</html>