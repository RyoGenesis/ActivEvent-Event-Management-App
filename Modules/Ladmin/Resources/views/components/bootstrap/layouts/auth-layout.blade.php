<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="url-home" content="{{ route('ladmin.index') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $metaTitle }}</title>

    @stack('before-styles')
    <link rel="stylesheet" href="{{ asset('/css/bs-ladmin.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="{{ asset('/css/custom-css-admin.css') }}">
    {{ $styles ?? null }}
    @stack('after-styles')

</head>

<body class="ladmin">
    <aside class="aside">
        <div class="bg-aside bg-white">

            <header class="aside-logo text-center p-3">
                <img src="{{asset('images/ActivEvent-logo.png')}}" alt="Logo" width="100">
                <a href="javascript:Ladmin.toggleMenu();" class="text-decoration-none">
                    <i class="fa fa-2x text-danger btn-close-sidebar fa-regular fa-circle-xmark"></i>
                </a>
            </header>
            <aside class="menu-sidebar">

                <div class="px-4 my-3">
                    <strong>Main Menu</strong>
                </div>

                <x-ladmin-menu-sidebar />

            </aside>
        </div>
    </aside>

    <div class="content">
        <header class="content-header bg-white p-3 d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <a href="javascript:Ladmin.toggleMenu();" class="me-3">
                    <svg id="i-menu" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="32" height="32"
                        fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2">
                        <path d="M4 8 L28 8 M4 16 L28 16 M4 24 L28 24" />
                    </svg>
                </a>
            </div>
            <div class="d-flex align-items-center me-3">

                {{-- <x-ladmin-notification :user="$user" /> --}}

                <img src="{{ $user->gravatar }}" alt="Avatar" class="img-thumbnail me-3 img-fluid rounded-circle"
                    width="50">
                <a href="" class="lh-1 text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                    <div>
                        <strong class="text-primary"
                            title="{{ $user->username }}">{{ Str::limit($user->username, 10) }}</strong>
                        <i class="fa fa-solid text-muted fa-caret-down"></i>
                    </div>
                    <small class="text-muted" title="{{ $role }}">{{ Str::limit($role, 10) }}</small>
                    <ul class="dropdown-menu mt-3">
                        <li><a class="dropdown-item" href="{{ route('ladmin.profile.index') }}">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="javascript:document.getElementById('logout').submit();">Sign
                                Out</a></li>
                    </ul>
                </a>
            </div>
        </header>
        <div class="content-body">
            <x-ladmin-error />
            <x-ladmin-alert />
            <div class="content-inner">
                <div class="d-flex mb-4 align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        @if (request()->has('back'))
                            <a href="{{ request()->get('back') }}"
                                class="btn btn-sm btn-primary rounded-circle text-white me-3">
                                &larr;
                            </a>
                        @endif
                        <h3 class="me-3 my-0">{{ $title ?? 'Page Title' }}</h3>
                        <div>{{ $button ?? null }}</div>
                    </div>
                    <div>{{ $button_end ?? null }}</div>
                    <ol class="breadcrumb m-0 d-none"></ol>
                </div>

                {{ $slot }}
            </div>
        </div>
        <div class="content-footer bg-white p-3">
            <x-ladmin-footer />
        </div>
    </div>


    <form action="{{ route('ladmin.logout') }}" method="POST" id="logout">
        @csrf
    </form>
    <form action="{{ route('ladmin.notification.store') }}" method="POST" id="notification-all-read">
        @csrf
    </form>

    @stack('before-scripts')
    <script src="{{ asset('/js/bs-ladmin.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{ $scripts ?? null }}
    @stack('after-scripts')
</body>

</html>
