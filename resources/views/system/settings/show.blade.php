<x-laravel-foundation::layouts.app :title="'General Settings'">
    <x-laravel-foundation::utils.card>
        <x-slot name="header">
            <x-laravel-foundation::utils.link
                icon="fas fa-pencil-alt"
                class="btn btn-sm btn-primary"
                :href="route('backend.system.settings.general.edit')"
                :text="__('Edit')"
            />
        </x-slot>

        <x-slot name="body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>@lang('Count Down')</th>
                    <td>{{ $settings->countdown }}</td>
                </tr>
            </table>
        </x-slot>
    </x-laravel-foundation::utils.card>
</x-laravel-foundation::layouts.app>
