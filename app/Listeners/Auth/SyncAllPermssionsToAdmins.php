<?php

namespace App\Listeners\Auth;

use App\Events\Auth\NewPermissionAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Permission;
use App\Role;

class SyncAllPermssionsToAdmins implements ShouldQueue
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
     * @param  NewPermissionAdded  $event
     * @return void
     */
    public function handle(NewPermissionAdded $event)
    {
        $permissions=Permission::pluck('id')->toArray();
        Role::where('slug', 'super-admin')->each(function ($role) use ($permissions) {
            $role->permissions()->sync($permissions);
            if ($role->users) {
                $role->users->each(function ($user) use ($permissions) {
                    $user->permssions()->sync($permissions);
                });
            }
        });
    }
}
