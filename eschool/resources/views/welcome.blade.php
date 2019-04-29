<?php
    use App\Post;
    // import the Intervention Image Manager Class
    use Intervention\Image\ImageManagerStatic as Image;


?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Winku Social Network Toolkit</title>
    <link rel="icon" href="images/fav.png" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">



</head>
<body>
<!--<div class="se-pre-con"></div>-->
<div class="theme-layout">

    @include('layouts.header')<!-- responsive header -->

    <section><!-- main web-->
        <div class="gap gray-bg">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row" id="page-contents">
                            @include('layouts.lsidebar')<!-- sidebar -->
                            <div class="col-lg-6"><!-- center -->
                                <div class="central-meta">
                                    <div class="new-postbox">
                                        <figure class="avatar">
                                            <?php
                                            $avatar = Auth::user()->filename;
//                                            Image::make('avatars/'.$avatar)->resize(45,45)->save();
                                            ?>
                                            <img src="{{url('avatars/'.$avatar)}}" alt="{{$avatar}}">
                                        </figure>
                                        <div class="newpst-input">

                                            <form method="post" action="{{url('posts')}}" enctype="multipart/form-data" >
                                                @csrf
                                                <textarea rows="1" placeholder="Title" name="title"></textarea>
                                                <textarea rows="2" placeholder="Write something" name="content"></textarea>
                                                <div class="attachments">
                                                    <ul>
                                                        {{--<li>--}}
                                                            {{--<i class="fa fa-music"></i>--}}
                                                            {{--<label class="fileContainer">--}}
                                                                {{--<input type="file">--}}
                                                            {{--</label>--}}
                                                        {{--</li>--}}
                                                        <li>
                                                            <i class="fa fa-image"></i>
                                                            <label class="fileContainer">
                                                                <input type="file" name="photo">
                                                            </label>
                                                        </li>
                                                        {{--<li>--}}
                                                            {{--<i class="fa fa-video-camera"></i>--}}
                                                            {{--<label class="fileContainer">--}}
                                                                {{--<input type="file">--}}
                                                            {{--</label>--}}
                                                        {{--</li>--}}
                                                        {{--<li>--}}
                                                            {{--<i class="fa fa-camera"></i>--}}
                                                            {{--<label class="fileContainer">--}}
                                                                {{--<input type="file">--}}
                                                            {{--</label>--}}
                                                        {{--</li>--}}
                                                        <li>
                                                            <button type="submit">Post</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger" style="margin-top: 50px">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div><br />
                                    @endif
                                    @if (\Session::has('success'))
                                        <div class="alert alert-success" style="margin-top: 50px">
                                            <p>{{ \Session::get('success') }}</p>
                                        </div><br />
                                    @endif
                                </div><!-- add post -->
                                <div class="loadMore"><!-- post & cmd -->

                                    @foreach($posts as $post)
                                        @php

                                            $post_id = $post->id;
                                            $comments =  App\Comment::where('post_id', $post_id)->orderBy('id','desc')->take(2)->get();
                                            $avatar = App\User::where('id',$post->user_id)->first()->filename;
                                        @endphp
                                        <div class="central-meta item">
                                            <div class="user-post">
                                                <div class="friend-info">
                                                    <figure class="post-avatar">
                                                        <img src="{{url('avatars/'.$avatar)}}" alt="{{$avatar}}">
                                                    </figure>
                                                    <div class="friend-name">
                                                        <ins><a href="time-line.html" title="">{{ $post->user->name }}</a></ins>
                                                        <a href="{{ route('posts.show', ['id' => $post['id'],'comment_length'=>5]) }}" class="lead">{{$post['title']}}</a>
                                                        <span>{{$post->updated_at->diffForHumans()}}</span>

                                                    </div>
                                                    <div class="post-meta">
                                                        <img src="{{url('uploads/'.$post->filename)}}" alt="{{$post->filename}}">

                                                        <div class="we-video-info">
                                                            <ul>

                                                                <li>
															        <span class="comment" data-toggle="tooltip" title="Comments">
																        <i class="fa fa-comments-o"></i>
																        <ins>{{ count($post->comment) }}</ins>
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
                                                                {{$post['content']}}
                                                            </p>
                                                        </div>
                                                    </div>

                                                </div><!-- post-->
                                                <div class="coment-area"><!--  cmd -->
                                                    <ul class="we-comet">
                                                        @foreach($comments as $comment)

                                                        <li>
                                                            <div class="comet-avatar">

                                                                    <?php
                                                                    $cm_user = App\User::where('id',$comment->user_id)->first();
                                                                    $cm_avatar = $cm_user->filename;
                                                                    ?>
                                                                    <img src="{{url('avatars/'.$cm_avatar)}}" alt="{{$cm_avatar}}">

                                                            </div>
                                                            <div class="we-comment">
                                                                <div class="coment-head">
                                                                    <h5><a href="time-line.html" title="">{{$cm_user->name}}</a></h5>
                                                                    <span>{{$comment->updated_at->diffForHumans()}}</span>
                                                                    <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
                                                                </div>
                                                                <p> {{$comment->content}}
                                                                    <i class="em em-smiley"></i>
                                                                </p>
                                                            </div>
                                                        </li>

                                                        @endforeach
                                                        <li>
                                                            <a href="{{ route('posts.show', ['id' => $post['id'],'comment_length'=>5]) }}" title="" class="showmore underline">more comments</a>
                                                        </li>
                                                        <li class="post-comment">
                                                            <div class="comet-avatar">
                                                                <?php
                                                                $avatar = Auth::user()->filename;
                                                                ?>
                                                                <img src="{{url('avatars/'.$avatar)}}" alt="{{$avatar}}">
                                                            </div>
                                                            <div class="post-comt-box">
                                                                <form method="post" action={{url('comment/store')}}>
                                                                    {{ csrf_field() }}

                                                                    <input type="hidden" id="post-id-comment" name="post_id" value={{$post_id}}>
                                                                    <textarea  placeholder="Post your comment" required="required" name="content"></textarea>
                                                                    <div class="add-smiles">
                                                                        <span class="em em-expressionless" title="add icon"></span>
                                                                    </div>
                                                                    <div class="smiles-bunch">
                                                                        <i class="em em---1"></i>
                                                                        <i class="em em-smiley"></i>
                                                                        <i class="em em-anguished"></i>
                                                                        <i class="em em-laughing"></i>
                                                                        <i class="em em-angry"></i>
                                                                        <i class="em em-astonished"></i>
                                                                        <i class="em em-blush"></i>
                                                                        <i class="em em-disappointed"></i>
                                                                        <i class="em em-worried"></i>
                                                                        <i class="em em-kissing_heart"></i>
                                                                        <i class="em em-rage"></i>
                                                                        <i class="em em-stuck_out_tongue"></i>
                                                                    </div>


                                                                    <button type="submit">Comment</button>

                                                                </form>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach

                                </div><!-- post & cmd -->

                            </div><!-- center-->
                            @include('layouts.rsidebar')<!-- sidebar -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')<!-- responsive footer -->
</div>

@include('layouts.side-panel')<!-- side panel -->

<script data-cfasync="false" src={{asset('js/email-decode.min.js')}}></script>
<script src={{asset('js/main.min.js')}}></script>
<script src={{asset('js/script.js')}}></script>
<script src={{asset('js/map-init.js')}}></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8c55_YHLvDHGACkQscgbGLtLRdxBDCfI"></script>

</body>
</html>

