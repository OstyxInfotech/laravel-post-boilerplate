<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function isAdmin()
    {
        return $this->hasRoleById(1);
    }

    public function isNotAdmin()
    {
        return ! $this->isAdmin();
    }

    public function hasRoleById($role_id)
    {
        return $this->roles()->where('role_id', $role_id)->count();
    }

    public function hasRole($slug)
    {
        return $this->roles()->where('slug', $slug)->count();
    }

    public function syncPermissions()
    {
        if ($this->isNotAdmin()) {
            foreach ($this->roles as $role) {
                $this->permissions()->sync($role->permissions);
            }
        } else {
            $this->permissions()->sync(Role::where('slug', 'super-admin')->first()->permissions);
        }
    }

    public function hasAccess($slug)
    {
        // return $this->permi
    }
}
