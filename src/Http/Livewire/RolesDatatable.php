<?php

namespace SantosSabanari\LaravelFoundation\Http\Livewire;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;
use SantosSabanari\LaravelDatatables\Views\Column;
use SantosSabanari\LaravelDatatables\LaravelDatatables;

class RolesDatatable extends LaravelDatatables
{
    public $sortField = 'name';

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Role::with('permissions:id,name,description')
            ->withCount('users');
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Type'))
                ->view('backend.auth.role.includes.type', 'role')
                ->sortable(),
            Column::make(__('Name'))
                ->searchable()
                ->sortable(),
            Column::make(__('Permissions'), 'permissions_label')
                ->customAttribute()
                ->html()
                ->searchable(function ($builder, $term) {
                    return $builder->orWhereHas('permissions', function ($query) use ($term) {
                        return $query->where('name', 'like', '%'.$term.'%');
                    });
                }),
            Column::make(__('Number of Users'), 'users_count')
                ->sortable(),
            Column::make(__('Actions'))
                ->view('laravel-foundation::system.role.includes.actions'),
        ];
    }
}
