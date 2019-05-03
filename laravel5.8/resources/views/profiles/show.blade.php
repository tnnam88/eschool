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
                                        <p class="f-title"><i class="ti-info-alt"></i> Your Profile</p>

                                        <div class="user_pic">
                                            <img class="img-thumbnail" src="{{URL::asset('avatars/'.Auth::user()->filename)}}" alt="{{Auth::user()->original_filename}}">
                                        </div>

                                        <div class="form-group half show_profile" >
                                            <p style="color: #088dcd;font-size: 22px">Your Username</p><i class="mtrl-select"></i>
                                            <input type="text" id="input" readonly placeholder="{{$currentuser->name}}">
                                        </div>
                                        <div class="form-group half show_profile">
                                            <p style="color: #088dcd;font-size: 22px">Your Email</p><i class="mtrl-select"></i>
                                            <input type="text" id="input" readonly placeholder="{{$currentuser->email}}">
                                        </div>
                                        <div class="form-group half show_profile">
                                            <p style="color: #088dcd;font-size: 22px">Your Role</p><i class="mtrl-select"></i>
                                            <input type="text" id="input" readonly placeholder="{{$currentuser->role}}">

                                        </div>
                                        <div class="form-group half show_profile">
                                            <p style="color: #088dcd;font-size: 22px">Your City</p><i class="mtrl-select"></i>
                                            <input type="text" id="input" readonly placeholder="{{$currentuser->city}}">

                                        </div>
                                        <div class="form-group half show_profile">
                                            <p style="color: #088dcd;font-size: 22px">Your Subject</p><i class="mtrl-select"></i>
                                            <input type="text" id="input" readonly placeholder="{{$currentuser->subject}}">

                                        </div>
                                        <div class="form-group half show_profile">
                                            <p style="color: #088dcd;font-size: 22px">Your Grade</p><i class="mtrl-select"></i>
                                            <input type="text" id="input" readonly placeholder="{{$currentuser->level}}">

                                        </div>

                                        <a href="{{route('profiles.edit')}}"><button type="button" class="mtr-btn"><span>Edit Your Profile</span></button></a>



                                    </div>
                                </div>

                                <div class="central-meta">
                                    <p class="f-title"><i class="ti-info-alt"></i> Your Recent Test Score</p>

                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">Level</th>
                                            <th scope="col">Mark</th>
                                            <th scope="col">Time</th>
                                            <th scope="col">Test Date Done</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php $i = 1;?>
                                        @foreach($test as $t)
                                            <?php
                                                $subj = new \App\Subject();
                                                foreach ($subject as $s){
                                                    if ($s->id == $t->subject_id){
                                                        $subj = $s;
                                                    }
                                                }
                                                $lv = new \App\Level();
                                                foreach ($level as $l){
                                                    if ($l->id == $t->level_id){
                                                        $lv = $l;
                                                    }
                                                }
                                            ?>
                                            <tr>
                                                <th scope="row">{{$i++}}</th>
                                                <td>{{$subj->name}}</td>
                                                <td>{{$lv->name}}</td>
                                                <td>{{$t->mark}}</td>
                                                <td>{{$t->time}}</td>
                                                <td>{{$t->created_at}}</td>
                                            </tr>
                                        @endforeach


                                        {{--@if(sizeof($test) <10){--}}
                                            {{--@for($i=1;$i<=sizeof($test);$i++){--}}
                                                {{--<tr>--}}
                                                    {{--<th scope="row">{{$i}}</th>--}}
                                                    {{--<td>{{$test->subject_id}}</td>--}}
                                                    {{--<td>{{$test->level_id}}</td>--}}
                                                    {{--<td>{{$test->mark}}</td>--}}
                                                    {{--<td>{{$test->time}}</td>--}}
                                                    {{--<td>{{$test->created_at}}</td>--}}
                                                {{--</tr>--}}
                                            {{--}@endfor--}}
                                        {{--}@else{--}}
                                            {{--@for($i=1;$i<=10;$i++){--}}
                                            {{--<tr>--}}
                                                {{--<th scope="row">{{$i}}</th>--}}
                                                {{--<td>{{$test->subject_id}}</td>--}}
                                                {{--<td>{{$test->level_id}}</td>--}}
                                                {{--<td>{{$test->mark}}</td>--}}
                                                {{--<td>{{$test->time}}</td>--}}
                                                {{--<td>{{$test->created_at}}</td>--}}
                                            {{--</tr>--}}
                                            {{--}@endfor--}}
                                        {{--}@endif--}}
                                        </tbody>
                                    </table>
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
