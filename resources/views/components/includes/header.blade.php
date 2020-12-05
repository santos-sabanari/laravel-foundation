<header class="c-header c-header-light c-header-fixed">
    <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
        <i class="c-icon c-icon-lg cil-menu"></i>
    </button>

    <a class="c-header-brand d-lg-none text-dark text-decoration-none text-uppercase font-weight-bold pr-4 pr-sm-4" href="route('backend.dashboard')">
        {{config('laravel-foundation.company')}}
    </a>

    <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
        <i class="c-icon c-icon-lg cil-menu"></i>
    </button>

    <ul class="c-header-nav d-md-down-none">
        <li class="c-header-nav-item px-3 text-dark text-decoration-none text-uppercase font-weight-bold">{{config('laravel-foundation.company')}}</li>
    </ul>

    <ul class="c-header-nav ml-auto mr-4">
        <li class="c-header-nav-item dropdown">
            <x-laravel-foundation::utils.link class="c-header-nav-link align-items-baseline" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <x-slot name="text">
                    Hi, {{auth()->user()->name}} <i class="fas fa-chevron-circle-down ml-1"></i>
                </x-slot>
            </x-laravel-foundation::utils.link>

            <div class="dropdown-menu dropdown-menu-right pt-0">
                <x-laravel-foundation::utils.link
                    href="{{route('backend.profile')}}"
                    class="dropdown-item"
                    icon="c-icon mr-2 cil-user">
                    <x-slot name="text">
                        Profile
                    </x-slot>
                </x-laravel-foundation::utils.link>

                {{--                <x-laravel-foundation::utils.link--}}
                {{--                    href="#"--}}
                {{--                    class="dropdown-item"--}}
                {{--                    icon="mr-2 fa fa-arrows-alt"--}}
                {{--                    onclick="toggleFullScreen();return false;">--}}
                {{--                    <x-slot name="text">--}}
                {{--                        Toggle Fullscreen--}}
                {{--                    </x-slot>--}}
                {{--                </x-laravel-foundation::utils.link>--}}

                <x-laravel-foundation::utils.link
                    class="dropdown-item"
                    icon="c-icon mr-2 cil-account-logout"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <x-slot name="text">
                        Logout
                        <x-laravel-foundation::forms.post id="logout-form" class="d-none" action="{{route('logout')}}"/>
                    </x-slot>
                </x-laravel-foundation::utils.link>
            </div>
        </li>
    </ul>

    @if($subheader)
        <div class="c-subheader justify-content-between px-3">
            <div class="font-weight-bold text-uppercase my-auto">
                @isset($title) {{$title}} @endisset
            </div>

            <div class="c-subheader-nav mfe-2">
                <x-laravel-foundation::includes.partials.breadcrumbs />
            </div>
        </div><!--c-subheader-->
    @endif
</header>
