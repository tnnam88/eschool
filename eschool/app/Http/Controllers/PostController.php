<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Post;
use App\Comment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class PostController extends Controller
{
    /**
     * Link to Home Page
     *
     *
     * @return welcome
     */
    function index()
    {
        $frs= User::all();
        return view('welcome', compact('posts','frs'));
    }
    /**
     * Control ajax  load more post on Home Page
     * return post data through echo not view
     *
     */
    function loadpost(Request $request)
    {
        if($request->ajax())
        {
            if($request->id > 0)
            {
                $data = DB::table('posts')
                    ->where('id', '<', $request->id)
                    ->orderBy('id', 'DESC')
                    ->limit(5)
                    ->get();
            }
            else
            {
                $data = DB::table('posts')
                    ->orderBy('id', 'DESC')
                    ->limit(5)
                    ->get();

            }
            $output = '';
            $last_id = '';

            if(!$data->isEmpty())
            {
                foreach($data as $post)
                {
                    $user_avt = Auth::user()->filename;
                    $post_user = DB::table('users')
                        ->where('id', $post->user_id)
                        ->first();
                    $count_cm =  DB::table('comments')
                        ->where('post_id','=',$post->id)
                        ->count();
                    $comments =  DB::table('comments')
                        ->where('post_id','=',$post->id)
                        ->limit(3)
                        ->get();
                    $avatar=$post_user->filename;
                    $car = new Carbon($post->updated_at);
                    $dif = $car->diffForHumans();



                    $output .= '<div class="central-meta item">
                    <div class="user-post">
                        <div class="friend-info">
                            <figure class="post-avatar">
                                <img src="'.url('avatars/'.$avatar).'" alt="">
                            </figure>
                            <div class="friend-name">
                                <ins><a href="'.url('wall/'.$post_user->id).'" title="">'.$post_user->name.'</a></ins>
                                <a href="'.url('post/show/'.$post->id).'" class="lead">'.$post->title.'</a>
                                <span>'.$dif.'</span>
                
                            </div>
                            <div class="post-meta">
                                <img src="uploads/'.$post->filename.'" alt="">
                
                                <div class="we-video-info">
                                    <ul>
                
                                        <li>
                                               <span class="comment" data-toggle="tooltip" title="Comments">
                                                   <i class="fa fa-comments-o"></i>
                                                   <ins>'.$count_cm.'</ins>
                                               </span>
                                        </li>
                
                
                                        <li class="social-media">
                                            <div class="menu">
                                                <div class="btn trigger"><i class="fa fa-share-alt"></i></div>
                                                <div class="rotater">
                                                    <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-html5"></i></a></div>
                                                </div>
                                                <div class="rotater">
                                                    <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-facebook"></i></a></div>
                                                </div>
                                                <div class="rotater">
                                                    <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-google-plus"></i></a></div>
                                                </div>
                                                <div class="rotater">
                                                    <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-twitter"></i></a></div>
                                                </div>
                                                <div class="rotater">
                                                    <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-css3"></i></a></div>
                                                </div>
                                                <div class="rotater">
                                                    <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-instagram"></i></a>
                                                    </div>
                                                </div>
                                                <div class="rotater">
                                                    <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-dribbble"></i></a>
                                                    </div>
                                                </div>
                                                <div class="rotater">
                                                    <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-pinterest"></i></a>
                                                    </div>
                                                </div>
                
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                
                                <div class="description">
                
                                    <p>
                                        '.$post->content.'
                                    </p>
                                </div>
                            </div>
                
                        </div>
                        
                        <div class="coment-area" >
                            
                            <ul class="we-comet'.$post->id.' we-comet" id="post-cmt'.$post->id.'" data-cmt="'.$post->id.'">
                                
                                <li class="post-comment">
                                    <div class="comet-avatar">
                                        <img src="'.url('avatars/'.$user_avt).'" alt="{{$avatar}}">
                                    </div>
                                    <div class="post-comt-box">
                                        <form method="post" action={{url(\'comment/store\')}}>

                                            <input type="hidden" id="post-id-comment" name="post_id" value="'.$post->id.'">
                                            <textarea  placeholder="Post your comment" required="required" name="content"></textarea>        
                                            <button type="submit">Comment</button>

                                        </form>
                                    </div>
                                </li>
                                <li>
                                    <button type="button" name="l" class="btn btn-success load_more_cmt" 
                                    id="load_more_cmt'.$post->id.'"
                                    data-id="0" data-post="'.$post->id.'">Load Comment</button>
                                </li>
          
                                
                            </ul>
                            
                        </div>
                    </div>
                </div>';
                                    $last_id = $post->id;
                }
                                $output .= '
                       <div id="load_more">
                        <button type="button" name="load_more_button" class="btn btn-success form-control" data-id="'.$last_id.'" id="load_more_button">Load More</button>
                       </div>
                       ';
            }
            else
            {
                $output .= '
       <div id="load_more">
        <button type="button" name="load_more_button" class="btn btn-info form-control">No Data Found</button>
       </div>
       ';
            }

            echo $output;


        }
    }

    /**
     * Control ajax  load more comment on Home Page, Wall
     * return comment data through echo not view
     *
     */
    function loadcomment(Request $request)
    {
        if($request->ajax())
        {
            if($request->id > 0)
            {
                $comments = DB::table('comments')
                    ->where('post_id',$request->post_id)
                    ->where('id','<',$request->id)
                    ->orderBy('id', 'DESC')
                    ->limit(5)
                    ->get();

            }
            else
            {
                $comments = DB::table('comments')
                    ->where('post_id',$request->post_id)
                    ->orderBy('id', 'DESC')
                    ->limit(5)
                    ->get();

            }
            $output = '';
            $last_id = '';

            if(!$comments->isEmpty())
            {
                foreach($comments as $cmt) {
                    $cmt_user = DB::table('users')
                        ->where('id', $cmt->user_id)
                        ->first();
                    $avatar=$cmt_user->filename;
                    $car = new Carbon($cmt->updated_at);
                    $dif = $car->diffForHumans();
                    $like_count= DB::table('likes')
                        ->where('comment_id','=',$cmt->id)
                        ->count();
                    $check_like=DB::table('likes')
                        ->where('user_id','=',$cmt_user->id)
                        ->where('comment_id','=',$cmt->id)
                        ->exists();
                    if($check_like)
                    {
                        $like_box ='
                            
                    <ins>'.$like_count.'</ins>
                    <i  class="fa fa-thumbs-up we-reply" title=""></i>
                    
                    <button class="changelike" title=""
                    id="like'.$cmt->id.'"
                    data-like_user="'.$cmt_user->id.'" data-like_cmt="'.$cmt->id.'" type="button">
                    Liked!
                    </button>
                        ';
                    }
                    else{
                        $like_box ='
                            
                    <ins>'.$like_count.'</ins>
                    <i  class="fa fa-thumbs-o-up we-reply" title=""></i>
                    
                    <button class="changelike" title=""
                    id="like'.$cmt->id.'"
                    data-like_user="'.$cmt_user->id.'" data-like_cmt="'.$cmt->id.'" type="button">
                    Like this comment!
                    </button>
                        ';
                    }


                    $output .= '
                        <li>
                            <div class="comet-avatar">
                                <img src="'.url('avatars/'.$avatar).'" alt="">

                            </div>
                            <div class="we-comment">
                                <div class="coment-head" >
                                    <h5><a href="'.url('wall/'.$cmt_user->id).'" title="">'.$cmt_user->name.'</a></h5>
                                    <span>'.$dif.'</span>  
                                </div>
                                <p> '.$cmt->content.'
                                    <i class="em em-smiley"></i>
                                </p>
                                <input type="hidden" name="_token" value='.csrf_token().'>
                                <div id="changelike'.$cmt->id.'">
                                    '.$like_box.'
                                </div>
                            </div>
                            
                        </li>';
                    $last_id = $cmt->id;
                }
                $output .= '
                       <button type="button" name="l" class="btn btn-success  load_more_cmt" 
                                    id="load_more_cmt'.$request->post_id.'"
                                    data-id="'.$last_id.'" data-post="'.$request->post_id.'">Load More Comment</button>
                       ';
            }
            else
            {
                $output .= '
       <div id="load_more">
        <button type="button" name="l" class="btn btn-info ">No More Found</button>
       </div>
       ';
            }

            echo $output;


        }
    }

    /**
     * Control ajax  load more post on Wall Page
     * return comment data through echo not view
     *
     */
    function wall($id)
    {
        $frs= User::all();
        $wall_id= $id;
        return view('wall', compact('wall_id','frs'));
    }
    function  wallpost(Request $request)
    {
        if($request->ajax())
        {
            if($request->id > 0)
            {
                $data = DB::table('posts')
                    ->where('user_id','=',$request->wall_user_id)
                    ->where('id', '<', $request->id)
                    ->orderBy('id', 'DESC')
                    ->limit(5)
                    ->get();
            }
            else
            {
                $data = DB::table('posts')
                    ->where('user_id','=',$request->wall_user_id)
                    ->orderBy('id', 'DESC')
                    ->limit(5)
                    ->get();

            }
            $output = '';
            $last_id = '';

            if(!$data->isEmpty())
            {
                foreach($data as $post)
                {
                    $user_avt = Auth::user()->filename;
                    $post_user = DB::table('users')
                        ->where('id', $post->user_id)
                        ->first();
                    $count_cm =  DB::table('comments')
                        ->where('post_id','=',$post->id)
                        ->count();
                    $comments =  DB::table('comments')
                        ->where('post_id','=',$post->id)
                        ->limit(3)
                        ->get();
                    $avatar=$post_user->filename;
                    $car = new Carbon($post->updated_at);
                    $dif = $car->diffForHumans();



                    $output .= '<div class="central-meta item">
                    <div class="user-post">
                        <div class="friend-info">
                            <figure class="post-avatar">
                                <img src="'.url('avatars/'.$avatar).'" alt="">
                            </figure>
                            <div class="friend-name">
                                <ins><a href="'.url('wall/'.$post_user->id).'" title="">'.$post_user->name.'</a></ins>
                                <a href="" class="lead">'.$post->title.'</a>
                                <span>'.$dif.'</span>
                
                            </div>
                            <div class="post-meta">
                                <img src="'.url('uploads/'.$post->filename).'" alt="">
                
                                <div class="we-video-info">
                                    <ul>
                
                                        <li>
                                               <span class="comment" data-toggle="tooltip" title="Comments">
                                                   <i class="fa fa-comments-o"></i>
                                                   <ins>'.$count_cm.'</ins>
                                               </span>
                                        </li>
                
                
                                        <li class="social-media">
                                            <div class="menu">
                                                <div class="btn trigger"><i class="fa fa-share-alt"></i></div>
                                                <div class="rotater">
                                                    <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-html5"></i></a></div>
                                                </div>
                                                <div class="rotater">
                                                    <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-facebook"></i></a></div>
                                                </div>
                                                <div class="rotater">
                                                    <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-google-plus"></i></a></div>
                                                </div>
                                                <div class="rotater">
                                                    <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-twitter"></i></a></div>
                                                </div>
                                                <div class="rotater">
                                                    <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-css3"></i></a></div>
                                                </div>
                                                <div class="rotater">
                                                    <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-instagram"></i></a>
                                                    </div>
                                                </div>
                                                <div class="rotater">
                                                    <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-dribbble"></i></a>
                                                    </div>
                                                </div>
                                                <div class="rotater">
                                                    <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-pinterest"></i></a>
                                                    </div>
                                                </div>
                
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                
                                <div class="description">
                
                                    <p>
                                        '.$post->content.'
                                    </p>
                                </div>
                            </div>
                
                        </div>
                        
                        <div class="coment-area" >
                            
                            <ul class="we-comet'.$post->id.' we-comet" id="post-cmt'.$post->id.'" data-cmt="'.$post->id.'">
                                
                                <li class="post-comment">
                                    <div class="comet-avatar">
                                        <img src="'.url('avatars/'.$user_avt).'" alt="{{$avatar}}">
                                    </div>
                                    <div class="post-comt-box">
                                        <form method="post" action={{url(\'comment/store\')}}>

                                            <input type="hidden" id="post-id-comment" name="post_id" value={{$post_id}}>
                                            <textarea  placeholder="Post your comment" required="required" name="content"></textarea>        
                                            <button type="submit">Comment</button>

                                        </form>
                                    </div>
                                </li>
                                <li>
                                    <button type="button" name="l" class="btn btn-success load_more_cmt" 
                                    id="load_more_cmt'.$post->id.'"
                                    data-id="0" data-post="'.$post->id.'">Load Comment</button>
                                </li>
          
                                
                            </ul>
                            
                        </div>
                    </div>
                </div>';
                    $last_id = $post->id;
                }
                $output .= '
                       <div id="load_more">
                        <button type="button" name="load_more_button" class="btn btn-success form-control" data-id="'.$last_id.'" id="load_more_button">Load More</button>
                       </div>
                       ';
            }
            else
            {
                $output .= '
       <div id="load_more">
        <button type="button" name="load_more_button" class="btn btn-info form-control">No Data Found</button>
       </div>
       ';
            }

            echo $output;


        }
    }

    function  showpost($id)
    {
        $frs= User::all();
        return view('posts.show', compact('id','frs'));
    }


}
