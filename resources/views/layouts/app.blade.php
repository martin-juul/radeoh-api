<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>
        @if(View::hasSection('title'))
            @yield('title') - {{ config('app.name') }}
        @else
            {{ config('app.name') }}
        @endif
    </title>
    @yield('meta_tags')
    <script src="{{ mix('js/app.js') }}" defer></script>

    @stack('scripts')

    @if(app()->environment('local'))
        <script src="{{ config('vue.dev.remote_host') }}:{{ config('vue.dev.remote_port') }}"></script>
    @endif

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open:700|Roboto:400,500">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <router-view></router-view>
</div>
</body>
</html>
