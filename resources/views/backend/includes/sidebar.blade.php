{{-- Master --}}
@if ( auth()->user()->hasAllAccess() || (
    auth()->user()->can('backend.provinsi') ||
    auth()->user()->can('backend.provinsi.list') ||
    auth()->user()->can('backend.provinsi.create') ||
    auth()->user()->can('backend.provinsi.show') ||
    auth()->user()->can('backend.provinsi.edit') ||
    auth()->user()->can('backend.provinsi.delete')
))
    <li class="c-sidebar-nav-dropdown {{
                    activeClass(
                        Route::is('backend.provinsi.*')
                        ,'c-open c-show') }}">
        <x-laravel-foundation::utils.link
            href="#"
            icon="c-sidebar-nav-icon fa fa-database"
            class="c-sidebar-nav-dropdown-toggle"
            :text="__('Master')"/>

        <ul class="c-sidebar-nav-dropdown-items">
            @if ( auth()->user()->hasAllAccess() || (
                auth()->user()->can('backend.provinsi') ||
                auth()->user()->can('backend.provinsi.list') ||
                auth()->user()->can('backend.provinsi.create') ||
                auth()->user()->can('backend.provinsi.show') ||
                auth()->user()->can('backend.provinsi.edit') ||
                auth()->user()->can('backend.provinsi.delete')
            ))
                <li class="c-sidebar-nav-item">
                    <x-laravel-foundation::utils.link
                        :href="route('backend.provinsi.index')"
                        class="c-sidebar-nav-link"
                        :text="__('Provinsi')"
                        :active="activeClass(Route::is('backend.provinsi.*'), 'c-active')"/>
                </li>
            @endif

        </ul>
    </li>
@endif

{{-- TRANSAKSI --}}
@if ( auth()->user()->hasAllAccess())
    <li class="c-sidebar-nav-dropdown {{
                    activeClass(
                        Route::is('backend.transaksi.*')
                        ,'c-open c-show') }}">
        <x-laravel-foundation::utils.link
            href="#"
            icon="c-sidebar-nav-icon fa fa-archive"
            class="c-sidebar-nav-dropdown-toggle"
            :text="__('Transaksi')"/>

        <ul class="c-sidebar-nav-dropdown-items">

        </ul>
    </li>
@endif

{{-- LAPORAN --}}
@if ( auth()->user()->hasAllAccess()  || (
    auth()->user()->can('backend.laporan') ||
    auth()->user()->can('backend.laporan.list') ||
    auth()->user()->can('backend.laporan.create') ||
    auth()->user()->can('backend.laporan.show') ||
    auth()->user()->can('backend.laporan.edit') ||
    auth()->user()->can('backend.laporan.delete')
))
    <li class="c-sidebar-nav-dropdown {{
                    activeClass(
                        Route::is('backend.laporan.*')
                        ,'c-open c-show') }}">
        <x-laravel-foundation::utils.link
            href="#"
            icon="c-sidebar-nav-icon fa fa-file"
            class="c-sidebar-nav-dropdown-toggle"
            :text="__('Laporan')"/>

        <ul class="c-sidebar-nav-dropdown-items">

        </ul>
    </li>
@endif
