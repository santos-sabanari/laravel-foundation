<?php

namespace SantosSabanari\LaravelFoundation\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;
use SantosSabanari\LaravelDatatables\Views\Column;
use SantosSabanari\LaravelDatatables\LaravelDatatables;

class UsersDatatable extends LaravelDatatables
{
    public $sortField = 'name';

    public $status;

    /**
     * @param  string  $status
     */
    public function mount($status = 'active'): void
    {
        $this->status = $status;
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return User::with('roles');
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Type'))
                ->view('laravel-foundation::system.user.includes.type', 'user')
                ->sortable(),
            Column::make(__('Name'))
                ->searchable()
                ->sortable(),
            Column::make(__('Username'))
                ->searchable()
                ->sortable(),
            Column::make(__('E-mail'), 'email')
                ->searchable()
                ->sortable(),
            Column::make(__('Roles'), 'roles_label')
                ->customAttribute()
                ->html()
                ->searchable(function ($builder, $term) {
                    return $builder->orWhereHas('roles', function ($query) use ($term) {
                        return $query->where('name', 'like', '%'.$term.'%');
                    });
                }),
            Column::make(__('Additional Permissions'), 'permissions_label')
                ->customAttribute()
                ->html()
                ->searchable(function ($builder, $term) {
                    return $builder->orWhereHas('permissions', function ($query) use ($term) {
                        return $query->where('name', 'like', '%'.$term.'%');
                    });
                }),
            Column::make(__('Actions'))
                ->view('laravel-foundation::system.user.includes.actions', 'user'),
        ];
    }
}
