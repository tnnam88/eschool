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


    <style>
        /* ---------------------style quizmain------------------- */
        #quizmain {
            font-family: "Segoe UI",Arial,sans-serif;
            width:100%;
            background-color:#fff;
        }
        #quizcontainer {
            padding:0 20px 40px 0;
        }
        #qtext {
            font-size:18px;
            margin-bottom:40px;
        }
        .altcontainer {
            background-color:#fff;
            font-size:120%;
            line-height:1.7em;
        }
        #answerbuttoncontainer {
            position:relative;
            padding:20px 0;
        }
        .answerbutton {
            background-color:#4CAF50;
            padding:12px 30px !important;
            font-size:17px;
        }
        #timespent {
            position:absolute;
            right:0;
            text-align:right;
            border:none;
            font-family: "Segoe UI",Arial,sans-serif;
            font-size:16px;
            width:80px;
        }
        /* The radiocontainer */
        .radiocontainer {
            background-color:#f1f1f1;
            display: block;
            position: relative;
            padding:10px 10px 10px 50px;
            margin-bottom: 1px;
            cursor: pointer;
            font-size: 18px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            word-wrap: break-word;
        }

        /* Hide the browser's default radio button */
        .radiocontainer input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* Create a custom radio button */
        .checkmark {
            position: absolute;
            top: 15px;
            left: 15px;
            height: 19px;
            width: 19px;
            background-color: #fff;
            border-radius: 50%;
        }
        .checkedlabel {
            background-color:#ddd;
        }
        /* On mouse-over, add a grey background color */
        .radiocontainer:hover input ~ .checkmark {
            /*nothing*/
        }
        .radiocontainer:hover {
            background-color: #ddd;
        }

        /* When the radio button is checked, add a blue background */
        .radiocontainer input:checked ~ .checkmark {
            background-color: #2196F3;
        }

        /* Create the indicator (the dot/circle - hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the indicator (dot/circle) when checked */
        .radiocontainer input:checked ~ .checkmark:after {
            display: block;
        }
        /* Style the indicator (dot/circle) */
        .radiocontainer .checkmark:after {
            top: 6px;
            left: 6px;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: white;
        }
    </style>

</head>
<body>
<!--<div class="se-pre-con"></div>-->
<div class="theme-layout">

@include('layouts.header')<!-- responsive header -->




    <section>
        <div class="gap2 color-bg">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="top-banner">
                            <i><img src="images/faq.png" alt=""></i>
                            <h1>EXAM SIMULATOR!</h1>
                        </div>
                        <nav class="breadcrumb">
                            <a class="breadcrumb-item" href="/">Home</a>
                            <span class="breadcrumb-item active"></span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section><!--test photo bar-->

    <section><!-- main web-->
        <div class="gap gray-bg">
            <div class="container-fluid">
                <div class="row" id="page-contents">
                    @include('layouts.lsidebar')
                    <div class="col-lg-9">
                        <div class="faq-area">
                            <h2>CONGRAT!</h2>

                            <div class="content">
                                <div class="links">
                                    <?php

                                    echo "<p>your result: $p/20</p>";
                                    echo "<p>Your time test : $time</p>";
                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@include('layouts.footer')<!-- responsive footer -->
</div>
@include('layouts.side-panel')<!-- side panel -->

<script src="js/main.min.js"></script>
<script src="js/strip.pkgd.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>


