<x-laravel-foundation::layouts.base>
    <x-laravel-foundation::includes.sidebar/>

    <div class="c-wrapper c-fixed-components">
        <x-laravel-foundation::includes.header/>
        <x-laravel-foundation::includes.partials.announcements/>

        <div class="c-body">
            <main class="c-main">
                <div class="container-fluid">
                    <div class="fade-in">
                        <x-laravel-foundation::includes.partials.messages/>
                        {{$slot}}
                    </div><!--fade-in-->
                </div><!--container-fluid-->
            </main>
        </div><!--c-body-->
    </div><!--c-wrapper-->
</x-laravel-foundation::layouts.base>
