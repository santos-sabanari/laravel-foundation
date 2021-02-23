@props(['title' => config('laravel-foundation.menu_name')])

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$title}} - {{ config('laravel-foundation.company') }}</title>

    @yield('meta')

    @stack('before-styles')
    <link href="{{ mix('/css/app.css', 'vendor/laravel-foundation') }}" rel="stylesheet">
    <link href="{{ mix('/css/coreui.css', 'vendor/laravel-foundation') }}" rel="stylesheet">
    <livewire:styles />
    @stack('after-styles')
</head>

<body {{ $attributes->merge(['class' => 'c-app']) }}>
{{ $slot }}

@stack('before-scripts')
<livewire:scripts />
<script src="{{ mix('/js/app.js', 'vendor/laravel-foundation') }}"></script>
<script src="{{ mix('/js/coreui.js', 'vendor/laravel-foundation') }}"></script>
@stack('after-scripts')
</body>
</html>
