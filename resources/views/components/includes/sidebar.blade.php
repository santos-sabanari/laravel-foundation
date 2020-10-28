<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <div class="c-sidebar-brand-full text-center" width="118" height="46" alt="Logo">
            <x-laravel-foundation::utils.link
                :href="route('backend.dashboard')"
                class="text-white text-decoration-none text-uppercase font-weight-bold"
                :text="config('laravel-foundation.menu_name')"/>
        </div>
        <div class="c-sidebar-brand-minimized" width="46" height="46" alt="Logo">
            <x-laravel-foundation::utils.link
                :href="route('backend.dashboard')"
                class="text-white text-decoration-none text-uppercase font-weight-bold"
                :text="config('laravel-foundation.menu_name_short')"/>
        </div>
    </div><!--c-sidebar-brand-->

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <x-laravel-foundation::utils.link
                class="c-sidebar-nav-link"
                :href="route('backend.dashboard')"
                icon="c-sidebar-nav-icon cil-speedometer"
                :text="'Dashboard'"/>
        </li>

        @if ( auth()->user()->hasAllAccess() || (
                auth()->user()->can('backend.system.user.list') ||
                auth()->user()->can('backend.system.user.deactivate') ||
                auth()->user()->can('backend.system.user.reactivate') ||
                auth()->user()->can('backend.system.user.clear-session') ||
                auth()->user()->can('backend.system.user.impersonate') ||
                auth()->user()->can('backend.system.user.change-password')
            ))
            <li class="c-sidebar-nav-title">@lang('System')</li>

            <li class="c-sidebar-nav-dropdown {{ activeClass(Route::is('backend.system.user.*') || Route::is('backend.system.role.*'), 'c-open c-show') }}">
                <x-laravel-foundation::utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-user"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Access')"/>

                <ul class="c-sidebar-nav-dropdown-items">
                    @if ( auth()->user()->hasAllAccess() || (
                            auth()->user()->can('backend.system.user.list') ||
                            auth()->user()->can('backend.system.user.deactivate') ||
                            auth()->user()->can('backend.system.user.reactivate') ||
                            auth()->user()->can('backend.system.user.clear-session') ||
                            auth()->user()->can('backend.system.user.impersonate') ||
                            auth()->user()->can('backend.system.user.change-password')
                        ))
                        <li class="c-sidebar-nav-item">
                            <x-laravel-foundation::utils.link
                                :href="route('backend.system.user.index')"
                                class="c-sidebar-nav-link"
                                :text="__('User Management')"
                                :active="activeClass(Route::is('backend.system.user.*'), 'c-active')"/>
                        </li>
                    @endif

                    @if (auth()->user()->hasAllAccess() || (
                            auth()->user()->can('backend.system.role.list') ||
                            auth()->user()->can('backend.system.role.edit') ||
                            auth()->user()->can('backend.system.role.delete')
                        ))
                        <li class="c-sidebar-nav-item">
                            <x-laravel-foundation::utils.link
                                :href="route('backend.system.role.index')"
                                class="c-sidebar-nav-link"
                                :text="__('Role Management')"
                                :active="activeClass(Route::is('backend.system.role.*'), 'c-active')"/>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (auth()->user()->hasAllAccess())
            <li class="c-sidebar-nav-dropdown">
                <x-laravel-foundation::utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-list"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Logs')"/>

                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <x-laravel-foundation::utils.link
                            :href="route('log-viewer::dashboard')"
                            class="c-sidebar-nav-link"
                            :text="__('Dashboard')"/>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-laravel-foundation::utils.link
                            :href="route('log-viewer::logs.list')"
                            class="c-sidebar-nav-link"
                            :text="__('Logs')"/>
                    </li>
                </ul>
            </li>
        @endif
    </ul>

    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div><!--sidebar-->
