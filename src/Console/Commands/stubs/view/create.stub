@inject('model', 'App\Models\User')

<x-laravel-foundation::layouts.app :title="'Create Role'">
    <x-laravel-foundation::forms.post :action="route('backend.system.role.store')">
        <x-laravel-foundation::utils.card>
            <x-slot name="header">
                <x-laravel-foundation::utils.link
                    icon="fas cil-arrow-circle-left"
                    class="btn btn-sm btn-secondary"
                    :href="route('backend.system.user.index')"
                    :text="__('Cancel')"
                />
            </x-slot>

            <x-slot name="body">
                <div x-data="{userType : '{{ $model::TYPE_USER }}'}">
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Type')</label>

                        <div class="col-md-10">
                            <select name="type" class="form-control" required x-on:change="userType = $event.target.value">
                                <option value="{{ $model::TYPE_USER }}">@lang('User')</option>
                                <option value="{{ $model::TYPE_ADMIN }}">@lang('Administrator')</option>
                            </select>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') }}" maxlength="100" required />
                        </div>
                    </div>

                    @include('laravel-foundation::system.includes.permissions')
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Create Role')</button>
            </x-slot>
        </x-laravel-foundation::utils.card>
    </x-laravel-foundation::forms.post>
</x-laravel-foundation::layouts.app>
