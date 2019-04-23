<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->take(2)->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required',
            'content' => 'required'
        ]);
        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = \Auth::user()->id;

// Store photo of a post
        if ($request->file('photo') != NULL) {
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension();
            Storage::disk('public')->put($photo->getFilename() . '.' . $extension, File::get($photo));


            $post->mime = $photo->getClientMimeType();
            $post->original_filename = $photo->getClientOriginalName();
            $post->filename = $photo->getFilename() . '.' . $extension;
        }
        $post->save();

        return back()->with('success', 'Post has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $comments = $post->comment;


        return view('posts.show', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
