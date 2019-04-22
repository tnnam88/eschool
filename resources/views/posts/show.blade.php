@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (\Session::has('msg_cmt_added'))
                    <div class="alert alert-success">
                        <p>{{ \Session::get('msg_cmt_added') }}</p>
                    </div><br />
                @endif

                    @if (\Session::has('msg_cmt_not_added'))
                        <div class="alert alert-warning">
                            <p>{{ \Session::get('msg_cmt_not_added') }}</p>
                        </div><br />
                    @endif

                <div class="card">
                    <div class="card-body">
                        <p><b>Posted by: {{ $post->user->name }}</b></p>
                        <p><b>{{ $post->title }}</b></p>
                        <p>
                            {{ $post->content }}
                        </p>

                        <p><img src="{{url('uploads/'.$post->filename)}}" alt="{{$post->filename}}" width="200"></p>

                        <hr />
                        <h4>Display Comments</h4>
                        @foreach($comments as $comment)

                            <div class="display-comment">

                                <strong>{{ $comment->user->name }}</strong>

                                <p>{{ $comment->content }}</p>

                                <p>{{ count($comment->like) }}</p>

                                <form action="{{ route('comment.like') }}" method="POST">
                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                                    {{ csrf_field() }}
                                    <input type = "submit" value = "like" name='like'/>
                                </form>

                            </div>
                        @endforeach
                        <hr />

                        <h4>Add comment</h4>
                        <form method="post" action="{{ route('comment.add') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="text" name="content" class="form-control" />
                                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-warning" value="Add Comment" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection