@props(['href' => '#', 'permission' => false])

<x-laravel-foundation::utils.link :href="$href" class="btn btn-primary btn-sm" icon="fas fa-pencil-alt" permission="{{ $permission }}" />
