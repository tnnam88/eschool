<?php
use App\Post;
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

    <link rel="stylesheet" href={{asset('css/main.min.css')}}>
    <link rel="stylesheet" href={{asset('css/style.css')}}>
    <link rel="stylesheet" href={{asset('css/color.css')}}>
    <link rel="stylesheet" href={{asset('css/responsive.css')}}>
    <link rel="stylesheet" href={{asset('css/font-awesome.min.css')}}>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">



</head>
<body>
<!--<div class="se-pre-con"></div>-->
<div class="theme-layout">

@include('layouts.header')<!-- responsive header -->

    <section>
        <div class="gap gray-bg">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row" id="page-contents">
                            @include('layouts.lsidebar')<!-- sidebar -->

                            <div class="col-lg-6"><!-- center -->

                                <div class="loadMore"><!-- post & cmd -->


                                        <div class="central-meta item">
                                            <div class="user-post">
                                                <div class="friend-info">
                                                    <figure class="post-avatar">
                                                        <?php
                                                        $post_user = App\User::where('id',$post->user_id)->first();
                                                        $post_avatar = $post_user->filename;

                                                        ?>
                                                        <img src="{{url('avatars/'.$post_avatar)}}" alt="{{$post_avatar}}">
                                                    </figure>
                                                    <div class="friend-name">
                                                        <ins><a href="{{url('user/'.$post_user->id)}}" title="">{{ $post->user->name }}</a></ins>
                                                        <a href="#" class="lead">{{$post['title']}}</a>
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
                                                        {{--@foreach($comments as $comment)--}}
                                                            {{--<?php--}}
                                                                {{--$cm_user= App\User::where('id',$comment->user_id)->first();--}}
                                                                {{--$cm_avatar = $cm_user->filename;--}}
                                                            {{--?>--}}

                                                            {{--<li>--}}
                                                                {{--<div class="comet-avatar">--}}
                                                                    {{--<img src={{url('avatars/'.$cm_avatar)}} alt="">--}}
                                                                {{--</div>--}}
                                                                {{--<div class="we-comment">--}}
                                                                    {{--<div class="coment-head">--}}
                                                                        {{--<h5><a href="{{url('user/'.$cm_user->id)}}" title="">{{$cm_user->name}}</a></h5>--}}
                                                                        {{--<span>{{$comment->updated_at->diffForHumans()}}</span>--}}
                                                                        {{--<span class="comment" data-toggle="tooltip" title="Like this comment">--}}
                                                                                {{--<a--}}
                                                                                        {{--href="#" onclick="event.preventDefault();--}}
                                                                                        {{--document.getElementById('{{'like'.$comment->id}}').submit();">--}}
                                                                                {{--<i class="fa fa-thumbs-up"></i>--}}
                                                                                {{--</a>--}}
                                                                                {{--<ins>{{ count($comment->like) }}</ins>--}}
                                                                                {{--<form id={{'like'.$comment->id}} action="{{ route('comment.like') }}" method="POST" style="display: none;">--}}
                                                                                    {{--<input type="hidden" name="comment_id" value="{{ $comment->id }}" />--}}
                                                                                    {{--@csrf--}}
                                                                                    {{--<input type = "submit" value = "like" name='like'/>--}}
                                                                                {{--</form>--}}
                                                                            {{--</span>--}}
                                                                    {{--</div>--}}
                                                                    {{--<p> {{$comment->content}}--}}
                                                                        {{--<i class="em em-smiley"></i>--}}
                                                                    {{--</p>--}}

                                                                {{--</div>--}}
                                                            {{--</li>--}}

                                                        {{--@endforeach--}}

                                                        {{ csrf_field() }}
                                                        <div id="post_data"></div>
                                                        <li>
                                                            {{--<a href="{{ route('posts.show', ['id' => $post['id'],'comment_length'=>$comment_length+3]) }}" title="" class="showmore underline">more comments</a>--}}

                                                        </li>
                                                        <li class="post-comment">
                                                            <div class="comet-avatar">
                                                                <img src="images/resources/comet-1.jpg" alt="">
                                                            </div>
                                                            <div class="post-comt-box">
                                                                <form method="post" action={{url('comment/store')}}>
                                                                    {{ csrf_field() }}

                                                                    <input type="hidden" id="post-id-comment" name="post_id" value={{$id}}>
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


<script data-cfasync="false" src={{asset('js/email-decode.min.js')}}></script>
<script src={{asset('js/main.min.js')}}></script>
<script src={{asset('js/script.js')}}></script>
<script src={{asset('js/map-init.js')}}></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8c55_YHLvDHGACkQscgbGLtLRdxBDCfI"></script>
<script>
    $(document).ready(function(){

        var _token = $('input[name="_token"]').val();

        load_data('', _token);

        function load_data(id="", _token)
        {
            $.ajax({
                url:"{{ route('loadmore.load_data') }}",
                method:"POST",
                data:{id:id, _token:_token},
                success:function(data)
                {
                    $('#load_more_button').remove();
                    $('#post_data').append(data);
                }
            })
        }

        $(document).on('click', '#load_more_button', function(){
            var id = $(this).data('id');
            $('#load_more_button').html('<b>Loading...</b>');
            load_data(id, _token);
        });

    });
</script>

</body>
</html>
