<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts');
    }

    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return 'Posting Now ...';
        //return requeste('message');
        //$message = request('message');
        //validations
        $request -> validate([
            'message' => ['required', 'min:8'],
        ]);
        Post::create([
            //'message' => $message,
            'message' => $request->all(),
            'user_id' => auth()->id()
        ]);

        return to_route('post.index')->with ('status',_('Post created succesfully!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
