<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/navbar.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
</head>
<body>

    <div class="jumbotron" style="margin-bottom: 0px; padding: 0px 10px;">
        <div class="container">

            <div class="row" style="padding-top: 4px; padding-bottom: 4px">
                <div class="col-lg-2 col-md-2" style="border-right: 1px solid pink; padding: 0px">
                    <span class="fa fa-envelope" style="color: black"></span>
                    <small>Achawaten@yahoo.com</small>
                </div>

                <div class="col-lg-7 col-md-7 pt-1">
                    <small>Free Shipping for all Order Above $656</small>
                </div>


                <div class="col-lg-3" style="padding: 5px; border-left: 1px solid pink">
                    <ul style="list-style-type: none; margin-bottom: 0px">
                        <li style="display: inline-block"><a class="p-2" style="text-decoration: none; color: black" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        <li style="display: inline-block"><a class="p-2" style="text-decoration: none; color: black" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>


    <div class="container">

        <!----- First row------>
        <div class="row pb-3">

            <div class="col-lg-2">
                <h2 style="font-weight: bold"><a class="navbar-brand" href="{{ url('/post') }}">
                   Fruit
                </a></h2>
            </div>

            <div class="col-lg-8 pt-2 text-center">
                <ul class="main-link-container">
                    <li class="main-links-list"><a class="main-links" href="">Home</a></li>
                    <li class="main-links-list"><a class="main-links" href="">Shop</a></li>
                    <li class="main-links-list"><a class="main-links" href="">Page</a></li>
                    <li class="main-links-list"><a class="main-links" href="">Contact Us</a></li>
                </ul>
            </div>

            <div class="col-lg-2">

            </div>
        </div>

         <!----- end of First row------>


        <div class="row">

            <div id="side-navbar-switch" class="col-lg-3 p-3" style="cursor: pointer; background-color: #7fad39;; color: white">
                <span class="fa fa-navicon"></span>
                <span class="glyphicon glyphicon-menu-hamburger"></span>
                <span style="font-weight: bold">All Categories</span>
            </div>


            <div id="side-navbar-target" class="col-lg-3" style="position: absolute; z-index: 1; top: 165px; padding-right: 40px; margin-left: -12px; padding-left: 12px">
               <div class="col-lg-12" style="border: 1px solid #b2b2b2; background-color: white; padding: 10px;">
                    <ul style="list-style-type: none; padding: 0px; margin: 0px">
                        <li class="side-bar-nav">Vegetable</li>
                        <li class="side-bar-nav">Banana</li>
                        <li class="side-bar-nav">Plaintain</li>
                        <li class="side-bar-nav">Orange</li>
                    </ul>
                </div>
            </div>


            <div class="col-lg-7" style="padding-left: 50px">
                <input id="search-field" type="text" placeholder="What do you need?">
                <input id="search-btn" type="submit" value="Submit">
            </div>

            <div class="col-lg-2 p-2">
                <span class="fa fa-phone" style="padding: 15px; color: green; background-color: cyan; border-radius: 50px"></span>
                <span style="font-weight: bold">+234 456 6789 </span>
            </div>



        </div>

    </div>

        <main class="py-4">

            <div class="container">
                @include('layouts.msg')
                @yield('content')
            </div>

        </main>

        @include('layouts.footer')

</body>
</html>
