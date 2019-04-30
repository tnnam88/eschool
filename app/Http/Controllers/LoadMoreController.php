<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Post;

class LoadMoreController extends Controller
{
    function index()
    {
        return view('load_more');
    }

    function load_data(Request $request)
    {
        if($request->ajax())
        {
            if($request->id > 0)
            {
                $data = POST::where('id', '<', $request->id)
                    ->orderBy('id', 'DESC')
                    ->limit(5)
                    ->get();
            }
            else
            {
                $data = POST::where('id', '<', $request->id)
                    ->orderBy('id', 'DESC')
                    ->limit(5)
                    ->get();
            }
            $output = '';
            $last_id = '';

            if(!$data->isEmpty())
            {
                foreach($data as $row)
                {
                    $output .= ' <div class="central-meta item" id="'.$row->id.'">
                                        <div class="user-post">
                                            <div class="friend-info">
                                                <figure>
                                                    <img src="avatars/'.$row->user->filename.'" alt="'.$row->user->filename.'">
                                                </figure>
                                                <div class="friend-name">
                                                    <ins><a href="time-line.html" title="">'. $row->user->name .'</a></ins>
                                                    <a href="#" class="lead">'. $row->title .'</a>
                                                    <span>published: '.$row->updated_at->diffForHumans().'</span>

                                                </div>
                                                <div class="post-meta">
                                                   
                                                    <img src="uploads/'.$row->filename.'" alt="'.$row->filename.'">
                                                    

                                                    <div class="we-video-info">
                                                        <ul>

                                                            <li>
															<span class="comment" data-toggle="tooltip" title="Comments">
																<i class="fa fa-comments-o"></i>
																<ins>'.count($row->comment).'</ins>
															</span>
                                                            </li>

                                                            
                                                        </ul>
                                                    </div>
                                                    <div class="description">

                                                        <p>
                                                            '.$row['content'].'
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
        ';
                    $last_id = $row->id;
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

?>
