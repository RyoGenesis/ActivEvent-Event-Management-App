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
    @yield('style')

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
</head>
<body>
    <div id="app" class="d-flex flex-column min-vh-100">
        <header>
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                                    
                    <form class="d-flex ms-5" role="search" method="GET" action="/search/nama">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle">
                                Filter
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href=""></a></li>
                            </ul>
                        </div>
                        <input type="search" class="form-control-lg me-2" placeholder="Search Event" name="nama">
                        <button type="submit" class="btn btn-dark ms-3">Search</button>
                    </form>
                    
                    <div class="collapse navbar-collapse" id=navbarApp>
                        <ul class="navbar-nav me-auto ms-3 my-2">
                            <li class="nav-item">
                                <a class="nav-link active" href="">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a  class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Event </a>
                                <ul class="dropdown-menu">
                                    <li>Popular</li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>Featured</li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">Contact us</a>
                            </li>
                        </ul>
                    </div>
    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">
    
                        </ul>
    
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Sign In') }}</a>
                                    </li>
                                @endif
    
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
    
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
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

        <footer class="footer bg-info">
            <div class="container p-3">
                <div class="row">
                    <div class="col"> ActivEvent </div>
                    <div class="col font-italic"> ActivEvent - &copy 2023</div>
                </div>
            </div>
        </footer>
    </div>
    @yield('scripts')
</body>
</html>
