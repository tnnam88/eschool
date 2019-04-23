@extends('layouts.app')

@section('content')
        <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>


</head>
<body>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

<div class="flex-center position-ref full-height">


        <div class="container">
            <div class="row">

                <div class="col-md-10">
                    <div class="user_info">
                        <p><input readonly placeholder="{{$currentuser->name}}"></p>
                        <p><input readonly placeholder="{{$currentuser->email}}"></p>
                        <p><input readonly placeholder="{{$currentuser->role}}"></p>
                        <p><input readonly placeholder="{{$currentuser->user_city}}"></p>
                        <p><input readonly placeholder="{{$currentuser->user_fav_subject}}"></p>
                        <p><input readonly placeholder="{{$currentuser->user_level}}"></p>

                        <img class="card-img-top" src="{{URL::asset('storage/app/public/image/profile_pic/'.$currentuser->filename)}}" alt="{{$currentuser->original_filename}}">
                    </div>



                    <div class="row">
                        <form method="post" action="{{url('showmark')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="form-group col-md-4">
                                    <label for="name">Select Subject :</label>
                                    <select name="subject_id">
                                        <option value="" selected disabled hidden>Choose here</option>
                                        @foreach ($subject as $sub)
                                            <option value="{{ $sub->id }}">{{$sub->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="form-group col-md-4">
                                    <label for="name">Select Level :</label>
                                    <select name="level_id">
                                        <option value="" selected disabled hidden>Choose here</option>
                                        @foreach ($level as $lv)
                                            <option value="{{ $lv->id }}">{{$lv->level }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success" style="margin-left:38px">Check !</button>

                        </form>
                    </div>



                </div>


            </div>
        </div>
</div>
</body>
</html>






@endsection
