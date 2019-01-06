<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

// use App\Scopes\PostUserScope;

class Post extends Model
{
    protected $fillable=['title', 'body', 'user_id'];

    public static function boot()
    {
        parent::boot();

        // static::addGlobalScope(new PostUserScope); //using App\Scope\PostUserScope

        //Using Anonymous Global Scope
        // if (auth()->user()->isNotAdmin()) {
        //     static::addGlobalScope('owner', function (Builder $builder) {
        //         $builder->where('user_id', auth()->user()->id);
        //     });
        // }
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // public function scopeSearch($query, $s)
    // {
    //     return $query->where('title', 'like', '%'.$s.'%');
    // }
}
