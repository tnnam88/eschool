@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="flex-center position-ref full-height">
                    {{--@if (Route::has('login'))--}}
                        {{--<div class="top-right links">--}}
                            {{--@auth--}}
                                {{--<a href="{{ url('/home') }}">Home</a>--}}
                            {{--@else--}}
                                {{--<a href="{{ route('login') }}">Login</a>--}}

                                {{--@if (Route::has('register'))--}}
                                    {{--<a href="{{ route('register') }}">Register</a>--}}
                                {{--@endif--}}
                            {{--@endauth--}}
                        {{--</div>--}}
                    {{--@endif--}}

                    <div class="content">
                        <form method="post" action="{{url('editprofile')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Change your username !</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="user_name" placeholder="{{$user_name}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Change your City !</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="user_city" placeholder="{{$user_city}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Change your role !</label>
                                <div class="col-md-6">
                                    <select name="user_role">
                                        <option value="" selected disabled hidden>Choose here</option>
                                        <option value="teacher">Teacher</option>
                                        <option value="">Student</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Change your favourite Subject !</label>
                                <div class="col-md-6">
                                    <select name="user_subject">
                                        <option value="" selected disabled hidden>Choose here</option>
                                        @foreach ($subject as $sub)
                                            <option value="{{ $sub->name }}">{{$sub->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Change your Grade !</label>
                                <div class="col-md-6">
                                    <select name="user_level">
                                        <option value="" selected disabled hidden>Choose here</option>
                                        @foreach ($level as $lv)
                                            <option value="{{ $lv->level }}">{{$lv->level }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                                <div class="form-group">
                                    <label for="author">Update your profile picture</label>
                                    <input type="file" class="form-control" name="bookcover"/>
                                </div>
                                <button type="submit" class="btn btn-success" style="margin-left:38px">Upload !</button>


                        </form>
                    </div>
                </div>
            </div>

            <a href="{{route('showprofile')}}"><button type="submit" class="btn btn-success" style="margin-left:38px">Check Your Profile !</button></a>
        </div>
    </div>

@endsection

