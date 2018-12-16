<?php

namespace App\Http\Controllers;

use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        return view('posts.index')->withPosts(Post::latest()->paginate(15));
    }

    public function show(Post $post)
    {
        return view('posts.show')->withPost($post);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $form=request()->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        auth()->user()->posts()->save(new Post($form));

        return redirect('/posts')->withStatus('Successfully created post');
    }

    public function edit(Post $post)
    {
        return view("posts.edit")->withPost($post);
    }

    public function update(Post $post)
    {
        $form=request()->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $post->update($form);

        return redirect('/posts/'.$post->id)->withStatus('Successfully updated post');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/posts')->withStatus('Successfully deleted post');
    }
}
