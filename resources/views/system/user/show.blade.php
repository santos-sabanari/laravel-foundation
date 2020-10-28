<x-laravel-foundation::layouts.app :title="'View User'">
    <x-laravel-foundation::utils.card>
        <x-slot name="header">
            <x-laravel-foundation::utils.link
                icon="fas cil-arrow-circle-left"
                class="btn btn-sm btn-secondary"
                :href="route('backend.system.user.index')"
                :text="__('Back')"
            />
        </x-slot>

        <x-slot name="body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>@lang('Type')</th>
                    <td>@include('laravel-foundation::system.user.includes.type')</td>
                </tr>

                <tr>
                    <th>@lang('Name')</th>
                    <td>{{ $user->name }}</td>
                </tr>

                <tr>
                    <th>@lang('Username')</th>
                    <td>{{ $user->username }}</td>
                </tr>

                <tr>
                    <th>@lang('E-mail Address')</th>
                    <td>{{ $user->email }}</td>
                </tr>

                <tr>
                    <th>@lang('Verified')</th>
                    <td>@include('laravel-foundation::system.user.includes.verified', ['user' => $user])</td>
                </tr>

                <tr>
                    <th>@lang('Last Login At')</th>
                    <td>
                        @if($user->last_login_at)
                            {{$user->last_login_at}}
                        @else
                            @lang('N/A')
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>@lang('Last Known IP Address')</th>
                    <td>{{ $user->last_login_ip ?? __('N/A') }}</td>
                </tr>

                <tr>
                    <th>@lang('Roles')</th>
                    <td>{!! $user->roles_label !!}</td>
                </tr>

                <tr>
                    <th>@lang('Additional Permissions')</th>
                    <td>{!! $user->permissions_label !!}</td>
                </tr>
            </table>
        </x-slot>
    </x-laravel-foundation::utils.card>
</x-laravel-foundation::layouts.app>
