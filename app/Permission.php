<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'model', 'permission'
    ];

    public $timestamps = 0;

    protected $dispatchesEvents=[
        'saved' => \App\Events\Auth\NewPermissionAdded::class,
        'deleted' => \App\Events\Auth\NewPermissionAdded::class
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public static function savePermissionSlugs($model)
    {
        $permissions = [
            'view', 'create', 'update', 'delete', 'restore', 'force-delete'
        ];

        array_map(function ($permission) use ($model) {
            Permission::create([
                'model' => $model,
                'permission' => $permission."-".strtolower($model)
            ]);
        }, $permissions);
    }
}
