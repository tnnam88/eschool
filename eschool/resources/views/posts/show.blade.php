<?php
$avatar = Auth::user()->filename;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Eschool Uruk Babylon</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">

    <link rel="icon" href="images/fav.png" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="{{asset('css/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/color.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
                        @include('layouts.lsidebar')<!-- lsidebar -->
                            <div class="col-lg-6"><!-- center -->

                                {{ csrf_field() }}
                                <div class="loadMore" id="post_data" data-wall="{{$id}}"><!-- post & cmd -->
                                    <div class="central-meta item">
                                        <div class="user-post">
                                            <div class="friend-info">
                                                <figure class="post-avatar">
                                                    <?php
                                                     $post = App\Post::where('id',$id)->first();
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
                                                <ul class="we-comet" id="{{'post-cmt'.$id}}">
                                                    <li class="post-comment">
                                                        <div class="comet-avatar">
                                                            <img src="{{url('avatars/'.$avatar)}}" alt="">
                                                        </div>
                                                        <div class="post-comt-box">
                                                            <form method="post" action={{url('comment/store')}}>

                                                                <input type="hidden" id="post-id-comment" name="post_id" value="'.$post->id.'">
                                                                <textarea  placeholder="Post your comment" required="required" name="content"></textarea>
                                                                <button type="submit">Comment</button>

                                                            </form>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <button type="button" name="l" class="btn btn-success load_more_cmt"
                                                                id="{{'load_more_cmt'.$post->id}}"
                                                                data-id="0" data-post="{{$post->id}}">Load Comment</button>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>



                                </div><!-- post & cmd -->

                            </div><!-- center-->
                        @include('layouts.rsidebar')<!-- rsidebar -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@include('layouts.footer')<!-- responsive footer -->
</div>
@include('layouts.side-panel')<!-- side panel -->

<script data-cfasync="false" src="{{asset('js/email-decode.min.js')}}">

</script><script src="{{asset('js/main.min.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
<script>
    $(document).ready(function(){

        var _token = $('input[name="_token"]').val();


        function load_cmt(id="", post_id, _token)
        {
            $.ajax({
                url:"{{ route('loadcmt') }}",
                method:"POST",
                data:{id:id, post_id:post_id, _token:_token},
                success:function(data)
                {
                    $('#load_more_cmt'+post_id).remove();
                    $('#post-cmt'+post_id).append(data);
                    console.log(data);
                }
            });
        }

        $(document).on('click', '.load_more_cmt', function(){
            var id = $(this).data('id');
            var post_id = $(this).data('post');
            $(this).html('<b>Loading...</b>');
            load_cmt(id,post_id, _token);
        });

        function changelike(user_id="",cmt_id="",_token) {
            $.ajax({
                url:"{{route('changelike')}}",
                method:"POST",
                data:{user_id:user_id,cmt_id: cmt_id,_token:_token},
                success:function(data)
                {
                    $('#changelike'+cmt_id).html("");
                    $('#changelike'+cmt_id).append(data);
                }
            });
        }


        $(document).on('click','.changelike',function () {
            var user_id = $(this).data('like_user');
            var cmt_id = $(this).data('like_cmt');
            changelike(user_id,cmt_id,_token);

        });




    });
</script><!-- ajax -->

</body>
</html>