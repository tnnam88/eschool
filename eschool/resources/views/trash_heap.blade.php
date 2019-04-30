<?php

namespace App\Http\Controllers;
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
    function index()
    {
        $frs= User::all();
        return view('welcome', compact('posts','frs'));
    }

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
                    $post_user = DB::table('users')
                        ->where('id', $post->user_id)
                        ->first();
                    $count_cm =  DB::table('comments')
                        ->where('post_id','=',$post->id)
                        ->count();
                    $avatar=$post_user->filename;
                    $car = new Carbon($post->updated_at);
                    $dif = $car->diffForHumans();
                    $output .= '<div class="central-meta item">
                    <div class="user-post">
                        <div class="friend-info">
                            <figure class="post-avatar">
                                <img src="avatars/'.$avatar. '" alt="">
                            </figure>
                            <div class="friend-name">
                                <ins><a href="" title="">'.$post_user->name.'</a></ins>
                                <a href="" class="lead">'.$post->title.'</a>
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
}
