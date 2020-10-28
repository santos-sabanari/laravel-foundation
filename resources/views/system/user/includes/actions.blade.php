@if (auth()->user()->hasAllAccess())
    <x-laravel-foundation::utils.view-button :href="route('backend.system.user.show', $user)"/>
    <x-laravel-foundation::utils.edit-button :href="route('backend.system.user.edit', $user)"/>
@endif

@if ($user->id !== auth()->user()->id && !$user->isMasterAdmin() && auth()->user()->hasAllAccess())
    <x-laravel-foundation::utils.delete-button :href="route('backend.system.user.destroy', $user)"/>
@endif

{{-- The logged in user is the master admin, and the row is the master admin. Only the master admin can do anything to themselves--}}
@if ($user->isMasterAdmin() && auth()->user()->isMasterAdmin())
    <div class="dropdown d-inline-block">
        <a class="btn btn-sm btn-secondary dropdown-toggle" id="moreMenuLink" href="#" role="button" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"></a>

        <div class="dropdown-menu" aria-labelledby="moreMenuLink">
            <x-laravel-foundation::utils.link
                :href="route('backend.system.user.change-password', $user)"
                class="dropdown-item"
                :text="__('Change Password')"
                permission="backend.system.user.change-password"/>
        </div>
    </div>
@elseif (
    !$user->isMasterAdmin() && // This is not the master admin
    $user->id !== auth()->user()->id && // It's not the person logged in
    // Any they have at lease one of the abilities in this dropdown
    (
        auth()->user()->can('backend.system.user.change-password') ||
        auth()->user()->can('backend.system.user.clear-session')
    )
)
    <div class="dropdown d-inline-block">
        <a class="btn btn-sm btn-secondary dropdown-toggle" id="moreMenuLink" href="#" role="button" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"></a>
        <div class="dropdown-menu" aria-labelledby="moreMenuLink">
            @if(auth()->user()->can('backend.system.user.change-password'))
                <x-laravel-foundation::utils.link
                    :href="route('backend.system.user.change-password', $user)"
                    class="dropdown-item"
                    :text="__('Change Password')"
                    permission="backend.system.user.change-password"/>
            @endif

            @if(auth()->user()->can('backend.system.user.clear-session'))
                <x-laravel-foundation::utils.form-button
                    :action="route('backend.system.user.clear-session', $user)"
                    name="confirm-item"
                    button-class="dropdown-item"
                    permission="backend.system.user.clear-session"
                >
                    @lang('Clear Session')
                </x-laravel-foundation::utils.form-button>
            @endif
        </div>
    </div>
@endif
