
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
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
    <body>





        <div class="container-fluid">
            <div class="row" style="">
                <div class="col-lg-2 col-md-2" id="side-menu-body">
                    <ul class="admin-link-con">
                        <a href="/admin/dashboard" class="admin-link-items"><li id="dashboard-admin-links"><span class="fa fa-dashboard side-menu-icons"></span>Dashboard <span class="fa fa-reorder" id="dashbord-icon"></span></li></a>
                        <a href="/" class="admin-link-items"><li class="admin-links"><span class="fa fa-home side-menu-icons"></span> Homepage</li></a>
                        <li class="admin-links" id="pro-manage-text" onclick="callProManageBody()"><span class="fa fa-sliders side-menu-icons"></span>Product Management <span id="management-dropdown-icon" class="fa fa-angle-right"></span></li>
                        <ul id="pro-management-dropdown-body">
                            <a href="/admin/create" class="admin-link-items"><li class="pro-manage-admin-links"><span class="fa fa-plus-square sub-menu-icons"></span>Add new item</li></a>
                            <a href="/admin/items" class="admin-link-items"><li class="pro-manage-admin-links"><span class="fa fa-edit sub-menu-icons"></span>Manage item</li></a>
                        </ul>
                        
                        <a href="/admin/orders" class="admin-link-items"><li class="admin-links"><span class="fa fa-shopping-basket side-menu-icons"></span>Orders</li></a>
                        <a href="/admin/sales-detail" class="admin-link-items"><li class="admin-links"><span class="fa fa-area-chart side-menu-icons"></span>Sales Details</li></a>
                        
                        <li class="admin-links" id="stock-dropdown-trigger" onclick="callStockDropdown()">Stock Management <span id="stock-management-dropdown-icon" class="fa fa-angle-right"></span></li>
                        <ul id="stock-management-dropdown">
                            <a href="/admin/out-of-stock" class="admin-link-items"><li class="stock-management-links"><span class="fa fa-shopping-basket side-menu-icons"></span>Out Of Stock Items</li></a>
                            <a href="" class="admin-link-items"><li class="stock-management-links"><span class="fa fa-shopping-basket side-menu-icons"></span>Avaiable Stocks</li></a>
                        </ul>
                        <a href="/admin/fund" class="admin-link-items"><li class="admin-links"><span class="fa fa-users side-menu-icons"></span>Fund Users</li></a>
                        <a href="/admin/reg-users" class="admin-link-items"><li class="admin-links"><span class="fa fa-users side-menu-icons"></span>Registered Users</li></a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();"
                                            {{ __('Logout') }} class="admin-link-items"><li class="admin-links"><span class="fa fa-sign-out side-menu-icons"></span>Logout</li></a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </div>

                <div class="col-lg-10 col-md-10 offset-md-2 offset-lg-2 offset-xl-2" id="template-body">
                    <div class="row">
                        <div class="col-lg-2 pt-3">
                            <span class="fa fa-bell" id="update-icon"></span>
                            <span class="badge badge-pill badge-primary" id="update-count">0</span>
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



