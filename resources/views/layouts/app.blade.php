<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    <!-------Owl CSS---
    <link rel="stylesheet" href="{{ asset('js/js/owl/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('js/owl/owl.theme.css') }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    ---->

    <!---------JS-----
    <script src="{{ asset('js/bootstrap.js')}}"></script>
    <script src="{{ asset('js/navbar.js') }}" defer></script>
    --->


    <script src="{{ asset('css/boot/jquery.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <script src="{{ asset('js/bootstrap.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('css/jquery.bxslider.css')}}">
    <script src="{{ asset('js/jquery.bxslider.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('css/boot/owl/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/boot/owl/owl.theme.css') }}">
    <script src="{{ asset('css/boot/owl/owl.carousel.js') }}"></script>
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <script src="{{ asset('js/navbar.js') }}" defer></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>

</head>
<body onload="callToGetState()">

    @php
        $total_cart = 0;
    @endphp

    @if(session('cart'))
        @foreach (session('cart') as $item => $value)
            @php
                $total_cart += $value['quantity'];
            @endphp
        @endforeach
    @endif

    <div class="jumbotron jumbo-header">
        <div class="container d-none d-md-block">
            <div class="row jumbo-row">
                <div class="col-lg-3 col-xl-3 col-md-3" id="email-body-con">
                    <span class="fa fa-envelope" ></span>
                    <small>cosmeticstore@support.com</small>
                </div>

                <div class="col-lg-6 col-md-6 col-xl-6 pt-1">
                    <small>Free Shipping for all Order Above $656</small>
                </div>

                <div class="col-lg-3 col-md-3 col-xl-3 user-login-body">
                    <ul class="user-list-links">

                            <!-- Authentication Links -->
                            @guest
                                <li class="auth-list-links">
                                    <a class="p-2 auth-links" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @if (Route::has('register'))
                                <li class="auth-list-links">
                                    <a class="p-2 auth-links" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                            <li>
                                <a id="navbarDropdown" class="" href="#" role="button" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul id="showAuthLink">
                                    <!-----<li><a class="auth-user-link" href="/user-dashboard">Dashboard</a></li>----->
                                    <li><a class="auth-user-link" href="/user-orders">My Orders</a></li>
                                    <li><a class="auth-user-link" href="/user-profile">Profile</a></li>
                                    <li><a class="auth-user-link" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </li>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </ul>
                            </li>



                        @endguest

                    </ul>
                </div>
            </div>

        </div>
    </div>


    <div class="container d-none d-md-block">
        <!----- First row------>
        <div class="row pb-3" style="">
            <div class="col-lg-2 col-md-2 col-xl-2">
                <h2 id="website-name"><a class="navbar-brand" href="{{ url('/') }}">
                  Cosmeticstore
                </a></h2>
            </div>

            <div class="col-lg-8 col-md-8 col-xl-8 pt-2 text-center">
            <!---
                <ul class="main-link-container">
                    <li class="main-links-list"><a class="main-links" href="/">Home</a></li>
                    <li class="main-links-list"><a class="main-links" href="/shop">Shop</a></li>
                    <li class="main-links-list"><a class="main-links" href="/contact">Contact Us</a></li>
                </ul>
                --->
            </div>

            <div class="col-lg-2 col-md-2 col-xl-2 mt-3">
                <a href="/cart">
                    <span class="fa fa-shopping-bag icon-bag"></span>
                    <span class="badge badge-danger icon-badge">@php echo $total_cart; @endphp</span>
                </a>
            </div>
        </div>

         <!----- end of First row------>


        <div class="row">
            <div id="side-navbar-switch" class="col-lg-3 col-xl-3 col-md-3 p-3">
                <span class="fa fa-navicon"></span>
                <span class="glyphicon glyphicon-menu-hamburger"></span>
                <span class="text-bold">All Categories</span>
            </div>

            <div id="side-navbar-target" class="col-lg-3 col-md-3 col-xl-3">
               <div id="side-navbar-inner-body">
                    <ul id="navbar-list">
                        <a href="/category/skin-care" class="black-color"><li class="side-bar-nav">Skin Care</li></a>
                        <a href="/category/face-care" class="black-color"><li class="side-bar-nav">Face Care</li></a>
                        <a href="/category/bath-body" class="black-color"><li class="side-bar-nav">Bath & Body</li></a>
                        <a href="/category/fragrance" class="black-color"><li class="side-bar-nav">Fragrance</li></a>
                        <a href="/category/make-up" class="black-color"><li class="side-bar-nav">Make Up</li></a>
                        <a href="/category/hair-care" class="black-color"><li class="side-bar-nav">Hair Care</li></a>
                        <a href="/category/foot-care" class="black-color"><li class="side-bar-nav">Foot Care</li></a>
                    </ul>
                </div>
            </div>


            <div class="col-lg-7 col-md-7 col-xl-7" id="search-con">
                <form action="/search" method="GET" onsubmit="return validate()">
                    <div class="d-flex">
                        <div style="width: 100%">
                            <input id="search-field" class="" type="text" name="search" placeholder="What do you need?">
                        </div>
                        <div>   
                            <input id="search-btn" type="submit" value="Submit">
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-2 col-md-2 col-xl-2 contact-phone-con">
                <span class="fa fa-phone icon-phone"></span>
                <span class="contact-phone">+234 456 6789 </span>
            </div>

        </div>
    </div>

    <!--------------------- End of large screen --------------------->

    <!--==================== Smaller Screen ========================---------->
     <div class="container-fluid d-none d-sm-block d-block d-md-none d-lg-none d-xl-none">
        <!------------ First row ------------>
        <div class="row pb-2" id="first-row-small-screen-header">
            <div class="col-sm-6 col-6">
                <li class="small-screen-header-text">
                 <span class="fa fa-envelope d-none" id="small-screen-icon-msg"></span>cosmeticstore@support.com
                </li>
            </div>
            <div class="col-sm-6 col-6 pt-2">
                <div class="d-flex justify-content-center">
                    @guest
                        <div class="p-1 pr-3">
                            <li class="small-screen-header-link"><a class="small-screen-auth-links" href="{{ route('login') }}">Login</a></li>
                        </div>
                     @if (Route::has('register'))
                        <div class="p-1 pl-3">
                            <li class="small-screen-header-link"><a class="small-screen-auth-links" href="{{ route('register') }}">Register</a></li>
                        </div>
                    @endif
                    
                    @else
                        <div>
                             <li id="auth-user-list">
                                <h6 id="auth-user-link" class="p-1" onclick="callSmallScreenDropDown()">{{ Auth::user()->name }}<span class="caret"></span></h6>
                               
                                <ul id="showSmallScreenAuthLink">
                                   <!----- <li class="small-screen-auth-list-link"><a class="auth-user-link" href="/user-dashboard">Dashboard</a></li> ---->
                                    <li class="small-screen-auth-list-link"><a class="auth-user-link" href="/user-orders">My Orders</a></li>
                                    <li class="small-screen-auth-list-link"><a class="auth-user-link" href="/user-profile">Profile</a></li>
                                    <li class="small-screen-auth-list-link"><a class="auth-user-link" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </li>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </ul>
                            </li>

                        </div>

                    @endguest
                </div>
            </div>
        </div>
        <!---========== End of first row ============--------->

        </div>


        <div class="container-fluid small-screen-con-body pt-2 d-none d-sm-block d-block d-md-none d-lg-none d-xl-none">
        <!--===================== Second row ==================------->
        <div class="row mt-2 small-screen-second-row-body">
            <div class="col-sm-6 col-6">
                <div class="d-flex">
                    <div class="pr-4 pl-2">
                        <span class="fa fa-navicon small-screen-navbar" onclick="callSmallScreenSideNavbar()"></span>
                    </div>
                    <div class="pl-4">
                        <a href="/" class="small-screen-website-name">Cosmeticstore</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-6 text-center">
                <a href="/cart" class="fa fa-shopping-bag small-screen-icon-bag"></a>
                <span class="badge badge-danger small-screen-icon-badge">@php echo $total_cart; @endphp</span>
            </div>
        </div>

        <!-------======= Side NavBar ======----->
        <div class="row" id="side-nav-row">
            <div class="col-sm-10 col-10 sidenavbar">
                <span class="fa fa-close close-small-screen-sidenav pl-3 pr-3 pt-3" onclick="closeSmallScreenSideNavbar()"></span>
                <a href="/" class="small-screen-sidenav-title">Cosmeticstore</a>
                <hr>
                <ul id="small-screen-side-nav">
                    <a href="/category/skin-care" class="black-color"><li class="side-bar-nav">Skin Care</li></a>
                    <a href="/category/face-care" class="black-color"><li class="side-bar-nav">Face Care</li></a>
                    <a href="/category/bath-body" class="black-color"><li class="side-bar-nav">Bath & Body</li></a>
                    <a href="/category/fragrance" class="black-color"><li class="side-bar-nav">Fragrance</li></a>
                    <a href="/category/make-up" class="black-color"><li class="side-bar-nav">Make Up</li></a>
                    <a href="/category/hair-care" class="black-color"><li class="side-bar-nav">Hair Care</li></a>
                    <a href="/category/foot-care" class="black-color"><li class="side-bar-nav">Foot Care</li></a>
                </ul>
            </div>
        </div>

        <!----=============== End of second row ===================--------->


        <!----=============== thrid row ===================--------->
        <div class="row mt-2">
            <div class="col-sm-12 col-12">
                 <form action="/search" method="GET" onsubmit="return smallScreenValidate()">
                    <span class="fa fa-search small-screen-search-icon"></span>
                    <input id="small-screen-search-field" class="" type="text" name="search" placeholder="What do you need?">     
                    <input id="small-screen-search-btn" class="d-none" type="submit" value="Submit">

                </form>
            </div>


        </div>
        <!----=============== End of third row ===================--------->

     </div>



        <main class="py-4">
            <div class="container">
                @include('layouts.msg')
            </div>
            @yield('content')
              

        </main>

        @include('layouts.footer')









</body>
</html>



