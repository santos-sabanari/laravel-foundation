<x-laravel-foundation::layouts.app :title="'Role Management'">
    <x-laravel-foundation::utils.card>
        <x-slot name="header">
            <x-laravel-foundation::utils.link
                icon="fas fa-plus-circle"
                class="btn btn-primary"
                :href="route('backend.system.role.create')"
                :text="__('Create Role')"
            />
        </x-slot>

        <x-slot name="body">
{{--            <livewire:users-table />--}}
            <livewire:roles-datatable />

        </x-slot>
    </x-laravel-foundation::utils.card>
</x-laravel-foundation::layouts.app>
