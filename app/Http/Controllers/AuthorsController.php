<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AuthorsController extends Controller
{
    public function show($user)
    {
        $user = User::find($user);
        $posts=$user->posts()->paginate(15);

        return view('authors.show')->with(compact('user', 'posts'));
    }
}
