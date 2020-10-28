@if (!$model->isAdmin())
    <x-laravel-foundation::utils.edit-button :href="route('backend.system.role.edit', $model)" />
    <x-laravel-foundation::utils.delete-button :href="route('backend.system.role.destroy', $model)" />
@endif
