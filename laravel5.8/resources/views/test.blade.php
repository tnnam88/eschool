<?php
use Illuminate\Support\Facades\DB;
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }


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
        <script>


            function startTimer() {
                var tobj = document.getElementById("timespent")
                var t = "0:00";
                var s = 00;
                var d = new Date();
                var timeint = setInterval(function () {
                    s += 1;
                    d.setMinutes("0");
                    d.setSeconds(s);
                    min = d.getMinutes();
                    sec = d.getSeconds();
                    if (sec < 10) sec = "0" + sec;
                    document.getElementById("timespent").value = min + ":" + sec;
                }, 1000);
                tobj.value = t;
            }
            if (window.addEventListener) {
                window.addEventListener("load", startTimer);
            } else if (window.attachEvent) {
                window.attachEvent("onload", startTimer);
            }

        </script>

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div id="quizmain">
                    <div id="quizcontainer">

                        <h3>Easy peasy!</h3>
                        <form role="form" id="quizform" name="quizform" action='/result' method='get'>
                            <input type="hidden" name="starttime" value="">
                            <input type="hidden" name="subject_id" value="{{$subject_id}}">
                            <input type="hidden" name="level_id" value="{{$level_id}}">
                            <?php
                            foreach($questions as $quest) {

                                echo "<div class='altcontainer'>";
                                echo $quest->content ."<br/>";
                                $answers = DB::table('answers')->where('question_id',$quest->id)
                                    ->inRandomOrder()
                                    ->get();
                                foreach($answers as $answer) {
                                    echo "<label class='radiocontainer'>$answer->content
                                        <input type='radio' name='$quest->id' value='$answer->id'
                                        /><span class='checkmark'></span></label>";

                                }
                                echo "</div>";
                            }
                            ?>
                            <div id="answerbuttoncontainer">
                                <button class="answerbutton w3-btn" type="submit" >Next &#10095;</button>
                                <input type="text" readonly id="timespent" value="0:00">
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </body>
</html>
