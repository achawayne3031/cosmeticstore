
<html>

    <head>
    <title>Admin</title>

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/navbar.js') }}" defer></script>


    <script src="{{ asset('css/boot/jquery.js') }}"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

</head>
    <body>

<!--- margin-bottom: 0px; padding: 0px 10px; --->
<div class="" style="">
    <div class="container">

        <div class="row offset-md-4" style="padding-top: 4px; padding-bottom: 4px">
            <div class="col-lg-2 col-md-2" style="border-right: 1px solid pink; padding: 0px">
                <span class="fa fa-envelope" style="color: black"></span>
                <small>Admin@gmail.com</small>
            </div>

            <div class="col-lg-7 col-md-7 pt-1">
                <small>Admin path................</small>
            </div>


            <div class="col-lg-3" style="padding: 5px; border-left: 1px solid pink">
                <ul style="list-style-type: none; margin-bottom: 0px">

                        <!--- Authentication Links --->
                        @guest
                        <li style="display: inline-block">
                            <a class="p-2" style="text-decoration: none; color: black" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li style="display: inline-block">
                                <a class="p-2" style="text-decoration: none; color: black" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();" style="position: absolute; z-index: 9999">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>

    </div>
</div>



        <div class="container-fluid">
            <div class="row" style="">
                <div class="col-lg-2 col-md-2" style="background-color: lightgray; padding: 0px">

                    <ul class="admin-link-con">
                        <a href="/" class="admin-link-items"><li class="admin-links">Homepage</li></a>
                        <a href="/admin/dashboard" class="admin-link-items"><li class="admin-links">Dashboard</li></a>
                        <a href="/admin/items" class="admin-link-items"><li class="admin-links">Added Items</li></a>
                        <a href="/admin/create" class="admin-link-items"><li class="admin-links">Add New Item</li></a>
                        <a href="" class="admin-link-items"><li class="admin-links">Edit Item</li></a>
                        <a href="" class="admin-link-items"><li class="admin-links">Orders</li></a>
                        <a href="" class="admin-link-items"><li class="admin-links">Sales Details</li></a>
                        <a href="" class="admin-link-items"><li class="admin-links">Avaiable Stocks</li></a>
                        <a href="" class="admin-link-items"><li class="admin-links">Registered Users</li></a>
                        <a href="" class="admin-link-items"><li class="admin-links">Logout</li></a>
                    </ul>
                </div>

                <div class="col-lg-10 col-md-10" style="padding-top: 10px">
                    <div class="row">
                        <div class="col-lg-2 pt-3">
                            <span class="fa fa-bell"></span>
                            <span class="badge badge-pill badge-primary">0</span>
                        </div>

                        <div class="col-lg-8 text-center">
                            <h5>Admin Dashboard</h5>
                        </div>
                    </div>
                    <hr>

                    @include('admin.layouts.alert')

                    @yield('content')

                </div>


            </div>
        </div>




    </body>
</html>



