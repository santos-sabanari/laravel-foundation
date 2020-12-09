<x-laravel-foundation::layouts.app :title="'Edit General Setting'">
    <x-laravel-foundation::forms.patch :action="route('backend.system.settings.general.update')">
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
                <div class="form-group row">
                    <label for="countdown" class="col-md-2 col-form-label">@lang('Countdown')</label>

                    <div class="col-md-10">
                        <input type="text" name="countdown" class="form-control" placeholder="{{ __('Countdown') }}" value="{{ old('countdown') ?? $settings->countdown }}" maxlength="100" required/>
                    </div>
                </div><!--form-group-->
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Settings')</button>
            </x-slot>
        </x-laravel-foundation::utils.card>
    </x-laravel-foundation::forms.patch>
</x-laravel-foundation::layouts.app>
