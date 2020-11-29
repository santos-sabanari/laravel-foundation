@error('flash_danger')
<x-laravel-foundation::utils.alert type="danger" class="header-message">
    {{$message}}
</x-laravel-foundation::utils.alert>
@enderror

@error('flash_success')
<x-laravel-foundation::utils.alert type="success" class="header-message">
    {{$message}}
</x-laravel-foundation::utils.alert>
@enderror

@error('flash_warning')
<x-laravel-foundation::utils.alert type="warning" class="header-message">
    {{$message}}
</x-laravel-foundation::utils.alert>
@enderror

@error('flash_info')
<x-laravel-foundation::utils.alert type="info" class="header-message">
    {{$message}}
</x-laravel-foundation::utils.alert>
@enderror