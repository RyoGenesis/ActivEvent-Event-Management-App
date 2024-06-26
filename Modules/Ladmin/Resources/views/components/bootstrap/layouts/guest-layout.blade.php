<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Administrator {{ $metaTitle }} | ActivEvent</title>

    @stack('before-styles')
    <link rel="stylesheet" href="{{ asset('/css/bs-ladmin.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/custom-css-admin.css') }}">
    {{ $styles ?? null }}
    @stack('after-styles')

</head>

<body class="bg-auth ladmin-auth">

    {{ $slot }}

    @stack('before-scripts')
    <script src="{{ asset('/js/bs-ladmin.js') }}"></script>
    @stack('after-scripts')
</body>

</html>
