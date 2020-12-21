

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

                            <!-- Authentication Links -->
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

                       <!---
                        <li style="display: inline-block"><a class="p-2" style="text-decoration: none; color: black" href="{{ route('login') }}">{{ __('Logingh') }}</a></li>
                        <li style="display: inline-block"><a class="p-2" style="text-decoration: none; color: black" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        --->
                    </ul>
                </div>
            </div>

        </div>
    </div>


    <div class="container">

        <!----- First row------>
        <div class="row pb-3" style="">

            <div class="col-lg-2">
                <h2 style="font-weight: bold"><a class="navbar-brand" href="{{ url('/') }}">
                   Logo
                </a></h2>
            </div>

            <div class="col-lg-8 pt-2 text-center">
                <ul class="main-link-container">
                    <li class="main-links-list"><a class="main-links" href="/">Home</a></li>
                    <li class="main-links-list"><a class="main-links" href="">Shop</a></li>
                    <li class="main-links-list"><a class="main-links" href="">Page</a></li>
                    <li class="main-links-list"><a class="main-links" href="">Contact Us</a></li>
                </ul>
            </div>

            <div class="col-lg-2 mt-3">
                <a href="/cart">
                    <span class="fa fa-shopping-bag" style="font-size: 25px"></span>
                    <span class="badge badge-danger" style="position: absolute; top: -5px; left: 35px">@php echo $total_cart; @endphp</span>
                </a>
            </div>
        </div>













