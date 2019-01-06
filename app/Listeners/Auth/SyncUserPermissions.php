<?php

namespace App\Listeners\Auth;

use App\Events\Auth\RolePermissionsChanged;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class SyncUserPermissions implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RolePermissionsChanged  $event
     * @return void
     */
    public function handle(RolePermissionsChanged $event)
    {
        $role_permissions=$event->role->permissions->pluck('id')->toArray();
        $event->role->users->whereNot('slug', 'super-admin')->each(function (User $user) use ($role_permissions) {
            $user->permissions->sync($permission_ids);
        });
    }
}
