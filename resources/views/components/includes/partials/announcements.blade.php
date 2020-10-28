@if(isset($announcements) && $announcements->any())
    @foreach($announcements as $announcement)
        <x-laravel-foundation::utils.alert :type="$announcement->type" :dismissable="false" class="pt-1 pb-1 mb-0">
            {{ (new \Illuminate\Support\HtmlString($announcement->message)) }}
        </x-laravel-foundation::utils.alert>
    @endforeach
@endif
