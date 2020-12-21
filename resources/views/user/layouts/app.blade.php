
<html>
    <head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/navbar.js') }}" defer></script>
    <script src="{{ asset('css/boot/jquery.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <script src="https://js.paystack.co/v1/inline.js"></script>

</head>
    <body>


    <div class="container-fluid d-none d-sm-block d-block d-md-none d-lg-none d-xl-none">
        <div class="row">
            <div class="col-sm-3 col-2">
                <span class="fa fa-reorder user-small-screen-side-menu-icons" onclick="callAdminUserSideNav()"></span>
            </div>
             <div class="col-sm-9 col-10">
                <h6 class="text-center user-dashboard-text">Dashboard</h6>
               
            </div>
        </div>


        <div class="row" id="small-screen-side-nav-row">
            <div class="col-sm-10 col-10" id="small-screen-side-nav-body">
                <span class="fa fa-close user-admin-close-small-screen-sidenav pb-4 pl-3 pr-3 pt-3" onclick="closeAdminUserSmallScreenSideNavbar()"></span>
                 <ul class="small-screen-ul-body">
                    <!----<a href="/user-dashboard" class="admin-link-items"><li id="dashboard-admin-links"><span class="fa fa-dashboard side-menu-icons"></span>Dashboard <span class="fa fa-reorder" id="dashbord-icon"></span></li></a> ---->
                    <a href="/" class="admin-link-items"><li class="admin-links"><span class="fa fa-home side-menu-icons"></span> Go to Store</li></a>                       
                    <a href="/user-orders" class="admin-link-items"><li class="admin-links"><span class="fa fa-shopping-bag side-menu-icons"></span>Orders</li></a>
                    <a href="/fund-account" target="_top" class="admin-link-items"><li class="admin-links"><span class="fa fa-bank side-menu-icons"></span>Fund My Account</li></a>
                    <a href="/user-profile" class="admin-link-items"><li class="admin-links"><span class="fa fa-id-card-o side-menu-icons"></span>Profile</li></a>
                    
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();"
                                        {{ __('Logout') }} class="admin-link-items"><li class="admin-links"><span class="fa fa-sign-out side-menu-icons"></span>Logout</li></a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </div>
        </div>

    </div>




    <!-------============= Larger Screenn ==========------------>

        <div class="container-fluid d-none d-md-block">
            <div class="row" style="">
                <div class="col-lg-2 col-md-2" id="side-menu-body">
                    <ul class="admin-link-con">
                        <!-----<a href="/user-dashboard" class="admin-link-items"><li id="dashboard-admin-links"><span class="fa fa-dashboard side-menu-icons"></span>Dashboard <span class="fa fa-reorder" id="dashbord-icon"></span></li></a>--->
                        <a href="/" class="admin-link-items"><li class="admin-links"><span class="fa fa-home side-menu-icons"></span> Go to Store</li></a>                       
                        <a href="/user-orders" class="admin-link-items"><li class="admin-links"><span class="fa fa-shopping-bag side-menu-icons"></span>Orders</li></a>
                        <a href="/fund-account" target="_top" class="admin-link-items"><li class="admin-links"><span class="fa fa-bank side-menu-icons"></span>Fund My Account</li></a>
                        <a href="/user-profile" class="admin-link-items"><li class="admin-links"><span class="fa fa-id-card-o side-menu-icons"></span>Profile</li></a>
                      
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();"
                                            {{ __('Logout') }} class="admin-link-items"><li class="admin-links"><span class="fa fa-sign-out side-menu-icons"></span>Logout</li></a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </div>

              


            </div>
        </div>


        <div class="container-fluid">
          <div class="col-lg-10 col-md-10 offset-md-2 offset-lg-2 offset-xl-2" id="template-body">
                    <div class="row">
                        <div class="col-lg-8 text-center">
                        </div>
                    </div>

                @yield('content')

            </div>
        </div>


    </body>
</html>



