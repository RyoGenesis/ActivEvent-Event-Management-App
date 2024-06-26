<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'ActivEvent')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom-css-main.css') }}">
    @yield('style')
    <style>
        @media (max-width: 767px) {
            .footer{
                font-size: 14px;
                
            }
        }
    </style>
    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <div id="app" class="d-flex flex-column min-vh-100">
        <header>
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow">
                <div class="container">
                    <a class="navbar-brand img-logo" href="{{ url('/') }}">
                        <img class="img-fluid" src="{{asset('images/ActivEvent-logo.png')}}" alt="ActivEvent Logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <form class="input-xl col-12 col-md-4 border rounded-pill bg-light" role="search" method="GET" action="{{route('search')}}">
                        <div class="input-group">
                            <input type="search" name="search" value="{{$search ?? ''}}" class="form-control" placeholder="Search keywords">
                            <div class="input-group-append">
                                <span class="input-group-text mt-1 bg-light border-0">
                                    <button type="submit" class="fa-solid fa-magnifying-glass border-0" style="color: #000000;"></button>
                                </span>
                              </div>
                        </div>
                    </form>
    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto ">
                             <li class="nav-item">
                                <a class="nav-link main-menu {{Route::is('home') ? 'active' : ''}}" href="{{route('home')}}">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle main-menu" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Event </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item main-menu" href="{{route('popularevent')}}">Popular</a>

                                    <a class="dropdown-item main-menu" href="{{route ('featuredevent')}}">Featured</a>

                                    <a class="dropdown-item main-menu" href="{{route('latestevent')}}">Latest</a>
                                </div>
                            </li>
                            @auth
                            <li class="nav-item">
                                <a class="nav-link main-menu {{Route::is('recommendedevent') ? 'active' : ''}}" href="{{route('recommendedevent')}}">For You</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link main-menu {{Route::is('eventhistory') ? 'active' : ''}}" href="{{route('eventhistory')}}">Event History</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link main-menu" href="{{route('profile')}}#upcoming">Upcoming</a>
                            </li>
                            @endauth
                            <li class="nav-item">
                                <a class="nav-link main-menu {{Route::is('contactus') ? 'active' : ''}}" href="{{route('contactus')}}">Contact us</a>
                            </li>
                        </ul>
    
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link main-menu" href="{{ route('login') }}">Login</a>
                                    </li>
                                @endif
    
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link main-menu" href="{{ route('register') }}">Register</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown main-menu">
                                    <a id="navbarDropdown main-menu" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Hello, {{ Auth::user()->name }}
                                    </a>
    
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item main-menu" href="{{route('profile')}}">Profile</a>

                                        <a href="{{route('changepassword')}}" class="dropdown-item main-menu">Change Password</a>

                                        <a class="dropdown-item main-menu" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main class="py-4 flex-fill">
            @yield('content')
        </main>

        <footer class="footer" style="background-color: #05559e; color:white">
            <div class="container p-3">
                <div class="row mb-3">
                    <div class="col-12 col-md-3 mb-2">
                        <img class="img-fluid app-logo" src="{{asset('images/ActivEvent-logo.png')}}" alt="ActivEvent Logo"> 
                    </div>
                    <div class="col-4 col-md-3">
                        <div class="fs-4">Event</div>
                        <div class="mt-2">
                            <a href="{{route('featuredevent')}}" style="text-decoration:none; color:white">Featured</a>
                        </div>
                        <div class="mt-2">
                            <a href="{{route('popularevent')}}" style="text-decoration:none; color:white">Popular</a>
                        </div>
                        <div class="mt-2">
                            <a href="{{route('latestevent')}}" style="text-decoration:none; color:white">Latest</a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3">
                        <div class="fs-4">Need help?</div>
                        <div class="mt-2">
                            <div>Admission:</div>
                            <small>
                                +62852 08 696969
                            </small>
                        </div>
                        <div class="mt-2">
                            <div>Student Service:</div>
                            <small>+62878 0172 4687
                            </small>
                        </div>
                    </div>
                    <div class="text-end col-4 col-md-3">
                        <div class="fw-bold fs-4 mb-3">Connect With Us</div>
                        <div>
                            <i class="fa-brands fa-facebook fa-2xl mx-1 my-3" style="color: #ffffff;"></i>
                            <i class="fa-brands fa-instagram fa-2xl mx-1 my-3" style="color: #ffffff;"></i>
                            <i class="fa-brands fa-twitter fa-2xl mx-1 my-3" style="color: #ffffff;"></i>
                            <i class="fa-brands fa-youtube fa-2xl mx-1 my-3" style="color: #ffffff;"></i>
                        </div>
                    </div>
                </div>
                <div class="my-2">
                    ActivEvent - &copy 2023
                </div>
            </div>
        </footer>

        <button type="button" class="btn btn-info btn-lg" id="btn-back-top">
            <i class="fa-solid fa-arrow-up"></i>
        </button>
    </div>
    <script>
        $(document).ready(function() {
            var btnTop = $("#btn-back-top");
            
            function backToTop() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }

            // show button when not on top
            $(window).on('scroll', function() {
                if ($(window).scrollTop() > 20) {
                    btnTop.show();
                } else {
                    btnTop.hide();
                }
            });
    
            // event listener for scroll to top
            btnTop.on("click", backToTop);
        });
    </script>
    @yield('scripts')
</body>
</html>
