@inject('model', 'App\Models\User')

<x-laravel-foundation::layouts.app :title="'Create User'">
    <x-laravel-foundation::forms.post :action="route('backend.system.user.store')">
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
                            <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') }}" maxlength="100" required/>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="username" class="col-md-2 col-form-label">@lang('Username')</label>

                        <div class="col-md-10">
                            <input type="text" name="username" class="form-control" placeholder="{{ __('Username') }}" value="{{ old('username') }}" maxlength="100" required/>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="email" class="col-md-2 col-form-label">@lang('E-mail Address')</label>

                        <div class="col-md-10">
                            <input type="email" name="email" class="form-control" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255" required/>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="password" class="col-md-2 col-form-label">@lang('Password')</label>

                        <div class="col-md-10">
                            <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="new-password"/>
                        </div>
                    </div><!--form-group-->

{{--                    <div x-data="{ emailVerified : false }">--}}
{{--                        <div class="form-group row">--}}
{{--                            <label for="email_verified" class="col-md-2 col-form-label">@lang('E-mail Verified')</label>--}}

{{--                            <div class="col-md-10">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input--}}
{{--                                        type="checkbox"--}}
{{--                                        name="email_verified"--}}
{{--                                        id="email_verified"--}}
{{--                                        value="1"--}}
{{--                                        class="form-check-input"--}}
{{--                                        x-on:click="emailVerified = !emailVerified"--}}
{{--                                        {{ old('email_verified') ? 'checked' : '' }} />--}}
{{--                                </div><!--form-check-->--}}
{{--                            </div>--}}
{{--                        </div><!--form-group-->--}}

{{--                        <div x-show="!emailVerified">--}}
{{--                            <div class="form-group row">--}}
{{--                                <label for="send_confirmation_email" class="col-md-2 col-form-label">@lang('Send Confirmation E-mail')</label>--}}

{{--                                <div class="col-md-10">--}}
{{--                                    <div class="form-check">--}}
{{--                                        <input--}}
{{--                                            type="checkbox"--}}
{{--                                            name="send_confirmation_email"--}}
{{--                                            id="send_confirmation_email"--}}
{{--                                            value="1"--}}
{{--                                            class="form-check-input"--}}
{{--                                            {{ old('send_confirmation_email') ? 'checked' : '' }} />--}}
{{--                                    </div><!--form-check-->--}}
{{--                                </div>--}}
{{--                            </div><!--form-group-->--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    @include('laravel-foundation::system.includes.roles')
                    @include('laravel-foundation::system.includes.permissions')
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Create User')</button>
            </x-slot>
        </x-laravel-foundation::utils.card>
    </x-laravel-foundation::forms.post>
</x-laravel-foundation::layouts.app>
