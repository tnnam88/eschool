<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AvatarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index($posts_length =3 )
//    {
//
//        $posts = Post::latest()->take($posts_length )->get();
//        return view('welcome', compact('posts'));
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//    public function store(Request $request)
//    {
//        $this->validate(request(), [
//            'title' => 'required',
//            'content' => 'required'
//        ]);
//        $post = new Post;
//        $post->title = $request->title;
//        $post->content = $request->content;
//        $post->user_id = \Auth::user()->id;
//
//// Store photo of a post
////        if ($request->file('photo') != NULL) {
//        $photo = $request->file('photo');
//        $extension = $photo->getClientOriginalExtension();
//        Storage::disk('public')->put($photo->getFilename() . '.' . $extension, File::get($photo));
//
//
//        $post->mime = $photo->getClientMimeType();
//        $post->original_filename = $photo->getClientOriginalName();
//        $post->filename = $photo->getFilename() . '.' . $extension;
////        }
//        $post->save();
//
//        return back()->with('success', 'Post has been added');
//    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$comment_length)
    {
        $post = Post::find($id);
        $comments =  Comment::where('post_id', $id)->orderBy('id','desc')->take($comment_length)->get();


        return view('posts.show', compact('post','comments','id','comment_length'));
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
    public function avatar($id )
    {
        $posts_length =6;
        //get user id
        $click = new User();
        $user = User::all();
        foreach ($user as $u) {
            if ($u->id == $id) {
                $click = $u;

            }
        }

        $posts = Post::latest()->take($posts_length )->get()->where('user_id',$click->id);
        return view('posts/show_user_post', compact('posts','click'));
    }


}

