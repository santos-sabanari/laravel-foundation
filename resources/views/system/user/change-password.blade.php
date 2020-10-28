<x-laravel-foundation::layouts.app :title="'Change Password'">
    <x-laravel-foundation::forms.patch :action="route('backend.system.user.change-password.update', $user)">
        <x-laravel-foundation::utils.card>
            <x-slot name="header">
                @lang('Change Password for :name', ['name' => $user->name])
            </x-slot>

            <x-slot name="headerActions">
{{--                <x-laravel-foundation::utils.link class="card-header-action" :href="route('backend.system.user.index')" :text="__('Cancel')"/>--}}
                <x-laravel-foundation::utils.link
                    icon="fas cil-arrow-circle-left"
                    class="btn btn-sm btn-secondary"
                    :href="route('backend.system.user.index')"
                    :text="__('Cancel')"
                />
            </x-slot>

            <x-slot name="body">
                <div class="form-group row">
                    <label for="password" class="col-md-2 col-form-label">@lang('Password')</label>

                    <div class="col-md-10">
                        <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="new-password"/>
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="password_confirmation" class="col-md-2 col-form-label">@lang('Password Confirmation')</label>

                    <div class="col-md-10">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="{{ __('Password Confirmation') }}" maxlength="100" required autocomplete="new-password"/>
                    </div>
                </div><!--form-group-->
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update')</button>
            </x-slot>
        </x-laravel-foundation::utils.card>
    </x-laravel-foundation::forms.patch>
</x-laravel-foundation::layouts.app>
