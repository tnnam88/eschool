<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Like;
use Illuminate\Support\Facades\Session;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->content = $request->get('content');
        $comment->user_id = Auth::user()->id;
        $post = Post::find($request->get('post_id'));
        $post->comment()->save($comment);

        return back()->with('success', 'Comment has been added'); //Session
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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


    /**
     * Add like in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function like(Request $request)
    {
        $like = new Like;
        $like->comment_id = $request->comment_id;
        $like->user_id = Auth::user()->id;
        $liked = Like::where('comment_id', '=', $like->comment_id)->where('user_id', '=', $like->user_id)->count();

        if ($liked == 0)
        {
            $like->save();
            Session::flash('msg_cmt_added', 'You have liked a comment');
            return back(); //Session
        } else {
            Session::flash('msg_cmt_not_added', 'You already liked this comment');
            return back(); //Session
        }

    }

}
