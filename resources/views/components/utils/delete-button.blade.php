@props(['href' => '#', 'text' => __('Delete'), 'permission' => false])

<x-laravel-foundation::utils.form-button
    :action="$href"
    method="delete"
    name="delete-item"
    button-class="btn btn-danger btn-sm"
    permission="{{ $permission }}"
>
    <i class="fas fa-trash"></i>
</x-utils.form-button>
