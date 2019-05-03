<?php
use App\Post;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\User;

$user = Auth::user();
$notifications = DB::table('notifications')
    ->where('receiver_id','=',$user->id)
    ->where('sender_id','!=',$user->id)
    ->where('checked','=',0)
    ->orderBy('id','DESC')
    ->limit(5)
    ->get();
$not_count = DB::table('notifications')
    ->where('receiver_id','=',$user->id)
    ->where('sender_id','!=',$user->id)
    ->where('checked','=',0)
    ->orderBy('id','DESC')
    ->count();
$activities = DB::table('notifications')
    ->where('sender_id','=',$user->id)
    ->where('checked','=',0)
    ->orderBy('id','DESC')
    ->limit(5)
    ->get();
$frs= User::all();



?>
        <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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

    <section>
        <div class="gap gray-bg">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row" id="page-contents">
                        @include('layouts.lsidebar')<!-- sidebar -->
                            <div class="col-lg-6"><!-- center -->
                                @if (Session::has('success'))
                                    <div class="alert alert-success">
                                        <p>{{ \Session::get('success') }}</p>
                                    </div><br />
                                @endif

                                <div class="central-meta">
                                    <div class="editing-info">
                                        <h5 class="f-title"><i class="ti-info-alt"></i> Your Profile</h5>

                                        <div class="user_pic">
                                            <img class="img-thumbnail" src="{{URL::asset('avatars/'.Auth::user()->filename)}}" alt="{{Auth::user()->original_filename}}">
                                        </div>

                                        <div class="form-group half show_profile" >
                                            <h3>Your Username</h3><i class="mtrl-select"></i>
                                            <input type="text" id="input" readonly placeholder="{{$currentuser->name}}">
                                        </div>
                                        <div class="form-group half show_profile">
                                            <h3>Your Email</h3><i class="mtrl-select"></i>
                                            <input type="text" id="input" readonly placeholder="{{$currentuser->email}}">
                                        </div>
                                        <div class="form-group half show_profile">
                                            <h3>Your Role</h3><i class="mtrl-select"></i>
                                            <input type="text" id="input" readonly placeholder="{{$currentuser->role}}">

                                        </div>
                                        <div class="form-group half show_profile">
                                            <h3>Your City</h3><i class="mtrl-select"></i>
                                            <input type="text" id="input" readonly placeholder="{{$currentuser->city}}">

                                        </div>
                                        <div class="form-group half show_profile">
                                            <h3>Your Subject</h3><i class="mtrl-select"></i>
                                            <input type="text" id="input" readonly placeholder="{{$currentuser->subject}}">

                                        </div>
                                        <div class="form-group half show_profile">
                                            <h3>Your Grade</h3><i class="mtrl-select"></i>
                                            <input type="text" id="input" readonly placeholder="{{$currentuser->level}}">

                                        </div>

                                        <a href="{{route('profiles.edit')}}"><button type="button" class="mtr-btn"><span>Edit Your Profile</span></button></a>



                                    </div>
                                </div>

                                <div class="central-meta">
                                    <h5 class="f-title"><i class="ti-info-alt"></i> Your Recent Test Score</h5>

                                </div>

                                <div class="central-meta">
                                    <h5 class="f-title"><i class="ti-info-alt"></i> Your Recent Test Score</h5>

                                </div>

                                <div class="central-meta">
                                    <h5 class="f-title"><i class="ti-info-alt"></i> Check Your Perfomence</h5>

                                    <form method="post" action="{{url('showmark')}}">
                                        @csrf
                                        <div class="col-md-12">
                                            <div class="col-md-4"></div>
                                            <div class="form-group col-md-4">
                                                <label for="name">Select Subject :</label>
                                                <select name="subject_id" required>
                                                    <option value="" selected disabled hidden>Choose here</option>
                                                    @foreach ($subject as $sub)
                                                        <option value="{{ $sub->id }}">{{$sub->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4"></div>
                                            <div class="form-group col-md-4">
                                                <label for="name">Select Level :</label>
                                                <select name="level_id" required>
                                                    <option value="" selected disabled hidden>Choose here</option>
                                                    @foreach ($level as $lv)
                                                        <option value="{{ $lv->id }}">{{$lv->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <button type="submit" class="mtr-btn"><span>Check Now !</span></button>

                                    </form>
                                </div>

                                <script>
                                    //clear form
                                    function myFunction() {
                                        document.getElementById("myForm").reset();
                                    }


                                </script>

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
