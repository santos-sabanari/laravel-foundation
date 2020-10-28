<x-laravel-foundation::layouts.app :title="'User Management'">
    <x-laravel-foundation::utils.card>
        <x-slot name="header">
            <x-laravel-foundation::utils.link
                icon="fas fa-plus-circle"
                class="btn btn-sm btn-primary"
                :href="route('backend.system.user.create')"
                :text="__('Create User')"
            />
        </x-slot>

        <x-slot name="body">
            <livewire:users-datatable />
        </x-slot>
    </x-laravel-foundation::utils.card>
</x-laravel-foundation::layouts.app>
