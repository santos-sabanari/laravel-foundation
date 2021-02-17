@isset($showFieldErrors)
    @if($showFieldErrors === true && isset($errors) && $errors->any())
        @php
            $messages = [];
        @endphp
        @foreach($errors->keys() as $key)
            @if(!str_starts_with($key,'flash_'))
                @php
                    $messages[] = $errors->get($key)[0];
                @endphp
            @endif
        @endforeach

        @if(count($messages) > 0)
            <x-laravel-foundation::utils.alert type="danger" class="header-message">
                @foreach($messages as $message)
                    {{ $message }} <br>
                @endforeach
            </x-laravel-foundation::utils.alert>
        @endif
    @endif
@endisset

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
