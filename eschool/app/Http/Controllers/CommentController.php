<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Like;
use Illuminate\Support\Facades\DB;
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
        $comment->content = $request->input('content');
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request->input('post_id');
        $comment->like_count = 0;
//        $post = Post::find($request->get('post_id'));
        $comment->save();
        $frs= User::all();

        return redirect()->route('posts.show', ['id' => $comment->post_id,'comment_length'=>5]); //Session
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
//    public function like(Request $request)
//    {
//        $like = new Like;
//        $like->comment_id = $request->comment_id;
//        $like->user_id = Auth::user()->id;
//        $liked = Like::where('comment_id', '=', $like->comment_id)->where('user_id', '=', $like->user_id)->count();
//        $frs= User::all();
//        if ($liked == 0)
//        {
//            $like->save();
//            Session::flash('msg_cmt_added', 'You have liked a comment');
//            return back()->with([$frs]); //Session
//        } else {
//            Session::flash('msg_cmt_not_added', 'You already liked this comment');
//            return back()->with([$frs]); //Session
//        }
//
//    }

    public function changelike(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $like_count ="";
            $check_like=DB::table('likes')
                ->where('user_id','=',$request->user_id)
                ->where('comment_id','=',$request->cmt_id)
                ->delete();
            if($check_like)
            {
                $like_count = DB::table('likes')
                    ->where('comment_id','=',$request->cmt_id)
                    ->count();

                $output .= '
                    <ins>'.$like_count.'</ins>
                    <i  class="fa fa-thumbs-o-up we-reply" title=""></i>
                    
                    <button class="changelike" title=""
                    id="like'.$request->cmt_id.'"
                    data-like_user="'.$request->user_id.'" data-like_cmt="'.$request->cmt_id.'" type="button">
                    Like this comment!
                    </button>
                ';
            }
            else
            {
                Db::table('likes')
                    ->insert(['user_id'=>$request->user_id,'comment_id'=>$request->cmt_id]);

                $like_count = DB::table('likes')
                    ->where('comment_id','=',$request->cmt_id)
                    ->count();

                $output .= '
                    <ins>'.$like_count.'</ins>
                    <i  class="fa fa-thumbs-up we-reply" title=""></i>
                    <button class="changelike" title=""
                    id="like'.$request->cmt_id.'"
                    data-like_user="'.$request->user_id.'" data-like_cmt="'.$request->cmt_id.'" type="button">
                    Liked!
                    </button>
                ';
            }
            echo $output;
        }

    }

}
