@props(['title' => config('laravel-foundation.menu_name')])

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$title}} - {{ config('laravel-foundation.company') }}</title>

@yield('meta')

<!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('vendor/laravel-foundation/favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('vendor/laravel-foundation/favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('vendor/laravel-foundation/favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('vendor/laravel-foundation/favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('vendor/laravel-foundation/favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('vendor/laravel-foundation/favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('vendor/laravel-foundation/favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('vendor/laravel-foundation/favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('vendor/laravel-foundation/favicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('vendor/laravel-foundation/favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('vendor/laravel-foundation/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('vendor/laravel-foundation/favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('vendor/laravel-foundation/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('vendor/laravel-foundation/favicon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('vendor/laravel-foundation/favicon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">

    @stack('before-styles')
    <link href="{{ mix('css/app.css', 'vendor/laravel-foundation') }}" rel="stylesheet">
    <livewire:styles />
    @stack('after-styles')
</head>

<body {{ $attributes->merge(['class' => 'c-app']) }}>
{{ $slot }}

@stack('before-scripts')
<script src="{{ mix('js/manifest.js', 'vendor/laravel-foundation') }}"></script>
<script src="{{ mix('js/vendor.js', 'vendor/laravel-foundation') }}"></script>
<script src="{{ mix('js/app.js', 'vendor/laravel-foundation') }}"></script>
<livewire:scripts />
@stack('after-scripts')
</body>
</html>
