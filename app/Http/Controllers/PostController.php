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
        return view('posts/index',[
            'posts' => Post::with('user')->latest()->get(),
        ]);
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

        $dataValidates = $request -> validate([
            'message' => ['required', 'min:8', 'max:250'],
        ]);

        // Post::create([
        //     //'message' => $message,
        //     'message' => $request->all(),
        //     'user_id' => auth()->id()
        // ]);

        // return to_route('post.index')->with ('status',_('Post created succesfully!'));


        // Generar un registro a tráves de una relación HasMany
        // Primero accediendo al User desde el Request, luego a
        // Post desde User y finalmente a create desde Post, ahora solo pasan los datos
        $request->user()->posts()->create($dataValidates);

        return to_route('posts.index') ->with ('status', __('Post created succesfully!'));
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
        // if(auth()->user()->id != $post->user_id){
        //     abort(403);
        // }
        // return view('posts/edit',[
        //     'post' => $post,
        // ]);
        $this->authorize('update', $post);
        // return view ('posts/edit', compact('post'))
        
        return view('posts/edit',[
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $dataValidates = $request->validate([
            'message' => ['required', 'min:8', 'max:255'] 
        ]);

        $post->update($dataValidates);

        return to_route('posts.index') -> with ('status', __('Post updated succesfully!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);
        $post->delete();
        return to_route('posts.index') -> with ('status', __('Post deleted succesfully!'));
    }
}
