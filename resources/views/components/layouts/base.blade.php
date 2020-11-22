@props(['title' => config('laravel-foundation.menu_name')])

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$title}} - {{ config('laravel-foundation.company') }}</title>

    @yield('meta')

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('images/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon-16x16.png')}}">

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
