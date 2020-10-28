@if(isset($errors) && $errors->any())
    <x-laravel-foundation::utils.alert type="danger" class="header-message">
        @foreach($errors->all() as $error)
            {{ $error }}<br/>
        @endforeach
    </x-laravel-foundation::utils.alert>
@endif

@if(session()->get('flash_success'))
    <x-laravel-foundation::utils.alert type="success" class="header-message">
        {{ session()->get('flash_success') }}
    </x-laravel-foundation::utils.alert>
@endif

@if(session()->get('flash_warning'))
    <x-laravel-foundation::utils.alert type="warning" class="header-message">
        {{ session()->get('flash_warning') }}
    </x-laravel-foundation::utils.alert>
@endif

@if(session()->get('flash_info') || session()->get('flash_message'))
    <x-laravel-foundation::utils.alert type="info" class="header-message">
        {{ session()->get('flash_info') }}
    </x-laravel-foundation::utils.alert>
@endif

@if(session()->get('flash_danger'))
    <x-laravel-foundation::utils.alert type="danger" class="header-message">
        {{ session()->get('flash_danger') }}
    </x-laravel-foundation::utils.alert>
@endif

@if(session()->get('status'))
    <x-laravel-foundation::utils.alert type="success" class="header-message">
        {{ session()->get('status') }}
    </x-laravel-foundation::utils.alert>
@endif

@if(session()->get('resent'))
    <x-laravel-foundation::utils.alert type="success" class="header-message">
        A fresh verification link has been sent to your email address.
    </x-laravel-foundation::utils.alert>
@endif

@if(session()->get('verified'))
    <x-laravel-foundation::utils.alert type="success" class="header-message">
        Thank you for verifying your e-mail address.
    </x-laravel-foundation::utils.alert>
@endif
