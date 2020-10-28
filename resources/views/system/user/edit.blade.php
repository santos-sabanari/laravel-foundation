@inject('model', 'App\Models\User')

<x-laravel-foundation::layouts.app :title="'Update User'">
    <x-laravel-foundation::forms.patch :action="route('backend.system.user.update', $user)">
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
                <div x-data="{userType : '{{ $user->type }}'}">
                    @if (!$user->isMasterAdmin())
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label">@lang('Type')</label>
                            <div class="col-md-10">
                                <select name="type" class="form-control" required x-on:change="userType = $event.target.value">
                                    <option value="{{ $model::TYPE_USER }}" {{ $user->type === $model::TYPE_USER ? 'selected' : '' }}>@lang('User')</option>
                                    <option value="{{ $model::TYPE_ADMIN }}" {{ $user->type === $model::TYPE_ADMIN ? 'selected' : '' }}>@lang('Administrator')</option>
                                </select>
                            </div>
                        </div><!--form-group-->
                    @endif

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') ?? $user->name }}" maxlength="100" required/>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="username" class="col-md-2 col-form-label">@lang('Username')</label>

                        <div class="col-md-10">
                            <input type="text" name="username" class="form-control" placeholder="{{ __('Username') }}" value="{{ old('username') ?? $user->username }}" maxlength="100" required/>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="email" class="col-md-2 col-form-label">@lang('E-mail Address')</label>

                        <div class="col-md-10">
                            <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') ?? $user->email }}" maxlength="255" required/>
                        </div>
                    </div><!--form-group-->

                    @if (!$user->isMasterAdmin())
                        @include('laravel-foundation::system.includes.roles')
                        @include('laravel-foundation::system.includes.permissions')
                    @endif
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update User')</button>
            </x-slot>
        </x-laravel-foundation::utils.card>
    </x-laravel-foundation::forms.patch>
</x-laravel-foundation::layouts.app>
