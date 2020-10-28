@inject('model', 'App\Models\User')

<x-laravel-foundation::layouts.app :title="'Update Role'">
    <x-laravel-foundation::forms.patch :action="route('backend.system.role.update', $role)">
        <x-laravel-foundation::utils.card>
            <x-slot name="header">
                <x-laravel-foundation::utils.link
                    icon="fas cil-arrow-circle-left"
                    class="btn btn-sm btn-secondary"
                    :href="route('backend.system.role.index')"
                    :text="__('Cancel')"
                />
            </x-slot>

            <x-slot name="body">
                <div x-data="{userType : '{{ $role->type }}'}">
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Type')</label>

                        <div class="col-md-10">
                            <select name="type" class="form-control" required x-on:change="userType = $event.target.value">
                                <option value="{{ $model::TYPE_USER }}" {{ $role->type === $model::TYPE_USER ? 'selected' : '' }}>@lang('User')</option>
                                <option value="{{ $model::TYPE_ADMIN }}" {{ $role->type === $model::TYPE_ADMIN ? 'selected' : '' }}>@lang('Administrator')</option>
                            </select>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                        <div class="col-md-10">
                            <input type="text"  name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') ?? $role->name }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->

                    @include('laravel-foundation::system.includes.permissions')
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Role')</button>
            </x-slot>
        </x-laravel-foundation::utils.card>
    </x-laravel-foundation::forms.patch>
</x-laravel-foundation::layouts.app>
