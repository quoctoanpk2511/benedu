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
    <script src="{{ asset('js/app.js') }}" ></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css')}}">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css')}}">
    <link rel="stylesheet" href="{{ asset('css/gijgo.css')}}">
    <link rel="stylesheet" href="{{ asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{ asset('css/slicknav.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
    <div id="app">
        <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area sticky">
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
                                        <li><a href="{{ url('/all-subjects') }}">Subjects</a></li>
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
                                                <a class="dropdown-item" href="{{  route('users.edit',  Auth::user()->id)  }}" class="login popup-with-form">
                                                    <span>My profile</span>
                                                </a>
                                                @if(auth()->user()->isAdmin())  
                                                <a class="dropdown-item" href="{{ route('users.index') }}">
                                                    <span>Users</span>
                                                </a>
                                                @endif
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

        <main class="py-4" style="margin-top: 100px; min-height: 100vh;">
            @auth
                <div class="container">
                    <div class="row">
                        
                        <div class="col-md-3">
                            <div class="wrapper slider_bg_1">
                                <!-- Sidebar -->
                                <nav id="sidebar">
                                    <ul class="list-unstyled components">
                                        <li>
                                            <a href="{{ route('subjects.index') }}"><i class="ti-layout-grid2 mr-3"></i>Subjects</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('courses.index') }}"><i class="ti-book mr-3"></i>Courses</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('lessons.index') }}"><i class="ti-book mr-3"></i>Lessons</a>
                                        </li>

                                        <!-- Wallet Shin -->


                                    </ul>
                                </nav>

                            </div>
                        </div>

                        <div class="col-md-9">
                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            @yield('content')
                        </div>
                    </div>
                </div>
            @else
                @yield('content')
            @endauth
        </main>

    </div>

    @yield('scripts')
</body>
</html>
