<?php

namespace SantosSabanari\LaravelFoundation\Listeners;

use SantosSabanari\LaravelFoundation\Events\RoleCreated;
use SantosSabanari\LaravelFoundation\Events\RoleDeleted;
use SantosSabanari\LaravelFoundation\Events\RoleUpdated;

/**
 * Class RoleEventListener.
 */
class RoleEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        activity('role')
            ->performedOn($event->role)
            ->withProperties([
                'role' => [
                    'type' => $event->role->type,
                    'name' => $event->role->name,
                ],
                'permissions' => $event->role->permissions->count() ? $event->role->permissions->pluck('description')->implode(', ') : 'None',
            ])
            ->log(':causer.name created role :subject.name with permissions: :properties.permissions');
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        activity('role')
            ->performedOn($event->role)
            ->withProperties([
                'role' => [
                    'type' => $event->role->type,
                    'name' => $event->role->name,
                ],
                'permissions' =>$event->role->permissions->count() ? $event->role->permissions->pluck('description')->implode(', ') : 'None',
            ])
            ->log(':causer.name updated role :subject.name with permissions: :properties.permissions');
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        activity('role')
            ->performedOn($event->role)
            ->log(':causer.name deleted role :subject.name');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            RoleCreated::class,
            'SantosSabanari\LaravelFoundation\Listeners\RoleEventListener@onCreated'
        );

        $events->listen(
            RoleUpdated::class,
            'SantosSabanari\LaravelFoundation\Listeners\RoleEventListener@onUpdated'
        );

        $events->listen(
            RoleDeleted::class,
            'SantosSabanari\LaravelFoundation\Listeners\RoleEventListener@onDeleted'
        );
    }
}
