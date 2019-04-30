<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Like;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->take(5)->get();
        $id = \Auth::user()->id;
        $recents = Post::where('user_id', '=', $id)->latest()->take(5)->get();
        $posts_count = Post::where('user_id', '=', $id)->count();
        $comment_count = Comment:: where('user_id', '=', $id)->count();

// Count all likes that an user received over time
        $cmtbyid = Comment:: where('user_id', '=', $id)->get();
        $like_all = 0;
        foreach ($cmtbyid as $cmt) {
           $like_all += Like::where('comment_id', '=', $cmt->id)->count();
        }

//Count only likes that an user received last 7 days
        $date = \Carbon\Carbon::today()->subDays(7);
        $cmtweek = Comment::where('user_id', '=', $id)->where('created_at', '>=', $date)->get();
        $like_week = 0;
        foreach ($cmtweek as $cmt) {
            $like_week += Like::where('comment_id', '=', $cmt->id)->count();
        }


        return view('posts.index', compact('posts', 'recents', 'posts_count', 'comment_count', 'like_week', 'like_all'));
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
