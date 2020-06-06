<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Benedu</title>

    <!-- Scripts -->
    <script src="{{ asset('js/vendor/modernizr-3.5.0.min.js')}}"></script>
    <script src="{{ asset('js/vendor/jquery-1.12.4.min.js')}}"></script>
    <script src="{{ asset('js/popper.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{ asset('js/main.js')}}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vote.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css')}}">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css')}}">
    <link rel="stylesheet" href="{{ asset('css/gijgo.css')}}">
    <link rel="stylesheet" href="{{ asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{ asset('css/slicknav.css')}}">
</head>
<body>
    <div id="app">
        <header>
            <div class="header-area ">
                <div id="sticky-header" class="main-header-area">
                    <div class="container-fluid p-0">
                        <div class="row align-items-center no-gutters">
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo-img">
                                    <a href="{{ url('/') }}">
                                        <img src="{{asset('img/logo.png')}}" width="150" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-7">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li>
                                                <form action="/search" method="POST" role="search">
                                                    {{ csrf_field() }}
                                                    <div class="input-group">
                                                        <input type="text" class="form-control mr-1" name="q" placeholder="Search courses">
                                                        <button type="submit" class="btn btn-primary">Search</button> 
                                                    </div>
                                                </form>
                                            </li>
                                            <li><a href="{{ url('/all-courses') }}">Courses</a></li>
                                            <li><a href="{{ url('/all-subjects') }}">Categories</a></li>
                                            <li><a href="{{ url('/community') }}">Community</a></li>
                                            <li><a href="{{ url('/about') }}">About</a></li>
                                            <li><a href="{{ url('/contact') }}">Contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 d-none d-lg-block">

                                @if (Route::has('login'))
                                    <div class="log_chat_area d-flex align-items-center">
                                        @auth
                                            <li class="nav-item dropdown">
                                                <a id="navbarDropdown" class="nav-link dropdown-toggle login popup-with-form" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                <span>
                                                    @if( Auth::user()->avatar == NULL)
                                                        <img class="mr-2" style="border-radius: 50%" src="{{asset('img/blog/default-avatar.png')}}" alt="" width=30 height=30>
                                                    @else
                                                    <img class="mr-2" style="border-radius: 50%" src="{{ asset('storage/'.Auth::user()->avatar) }}" alt="" width=30 height=30>
                                                    @endif
                                                    {{ Auth::user()->name }}
                                                </span>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item" href="{{ url('/home') }}" class="login popup-with-form">
                                                        <span>My page</span>
                                                    </a>
                                                    <!-- My profile Shin -->
                                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                                                        {{ __('Logout') }}
                                                    </a>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                </div>
                                            </li>
                                        @else
                                            <a href="{{ route('login') }}" class="login popup-with-form">
                                                <i class="flaticon-user"></i>
                                                <span>Log in</span>
                                            </a>
                                            @if (Route::has('register'))
                                                <div class="live_chat_btn">
                                                    <a class="boxed_btn_orange" href="{{ route('register') }}">
                                                        <span>Register</span>
                                                    </a>
                                                </div>
                                            @endif
                                        @endauth
                                    </div>
                                @endif

                            </div>
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        <!-- footer -->
        <footer class="footer footer_bg_1">
            <div class="footer_top">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-md-6 col-lg-4">
                            <div class="footer_widget">
                                <div class="footer_logo">
                                    <a href="#">
                                        <img src="{{asset('img/logo.png')}}" width="200" alt="">
                                    </a>
                                </div>
                                <p>
                                    Firmament morning sixth subdue darkness creeping gathered divide our let god moving.
                                    Moving in fourth air night bring upon it beast let you dominion likeness open place day
                                    great.
                                </p>
                                <div class="socail_links">
                                    <ul>
                                        <li>
                                            <a href="javascript:;">
                                                <i class="ti-facebook"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <i class="ti-twitter-alt"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <i class="fa fa-instagram"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <i class="fa fa-youtube-play"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-2 offset-xl-1 col-md-6 col-lg-3">
                            <div class="footer_widget">
                                <h3 class="footer_title">
                                    Subjects
                                </h3>
                                <ul>
                                    <li><a href="javascript:;">Mathematics</a></li>
                                    <li><a href="javascript:;"> Robotics</a></li>
                                    <li><a href="javascript:;">Psychology</a></li>
                                    <li><a href="javascript:;">Graphic Design</a></li>
                                    <li><a href="javascript:;">Business Law</a></li>
                                </ul>

                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 col-lg-2">
                            <div class="footer_widget">
                                <h3 class="footer_title">
                                Resources
                                </h3>
                                <ul>
                                    <li><a href="{{ url('/all-courses') }}">Courses</a></li>
                                    <li><a href="{{ url('/all-subjects') }}">Categories</a></li>
                                    <li><a href="{{ url('/community') }}">Community</a></li>
                                    <li><a href="{{ url('/about') }}">About</a></li>
                                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-3">
                            <div class="footer_widget">
                                <h3 class="footer_title">
                                    Address
                                </h3>
                                <p>
                                    1 Đại Cồ Việt, Bách Khoa<br> Hai Bà Trưng, Hà Nội <br>
                                    +10 367 467 8934 <br>
                                    benedu@contact.com
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copy-right_text">
                <div class="container">
                    <div class="footer_border"></div>
                    <div class="row">
                        <div class="col-xl-12">
                            <p class="copy_right text-center">
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer -->

    </div>

    @yield('scripts')
</body>
</html>
