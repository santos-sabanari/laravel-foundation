<div class="form-group row">
    <label for="permissions" class="col-md-2 col-form-label">@lang('Additional Permissions')</label>

    <div class="col-md-10">
        @include('laravel-foundation::system.includes.no-permissions-message')

        <div x-show="userType === '{{ $model::TYPE_ADMIN }}'">
            @include('laravel-foundation::system.partials.permission-type', ['type' => $model::TYPE_ADMIN])
        </div>

        <div x-show="userType === '{{ $model::TYPE_USER}}'">
            @include('laravel-foundation::system.partials.permission-type', ['type' => $model::TYPE_USER])
        </div>
    </div>
</div><!--form-group-->
