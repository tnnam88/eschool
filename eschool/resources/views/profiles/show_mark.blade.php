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
                                <div class="central-meta">
                                    <h5 class="f-title"><i class="ti-info-alt"></i> Your Perfomance</h5>


                                    <div id="linechart" style="width: 900px; height: 500px"></div>
                                    <div id="warning" style="display: none"><p>Not enough test to show graph</p></div>
                                </div><!-- show_mark -->
                                <script>
                                    function ShowDiv() {
                                        document.getElementById("user_mark").style.display = "";
                                    }
                                    var visitor = <?php echo $visitor; ?>;
                                    console.log(visitor);
                                    google.charts.load('current', {'packages':['corechart']});
                                    google.charts.setOnLoadCallback(drawChart);
                                    function drawChart() {
                                        var data = google.visualization.arrayToDataTable(visitor);


                                        var options = {
                                            title: 'Your Score ',
                                            vAxis: {title: 'Score',
                                                minValue: 0,
                                                viewWindow:{
                                                    max:20,
                                                    min:0
                                                },
                                                ticks: [0,2,4,6,8,10,12,14,16,18,20],
                                            },
                                            hAxis:{title: 'Date Completed'},
                                            legend: {position: 'bottom'}
                                        };
                                        var chart = new google.visualization.LineChart(document.getElementById('linechart'));
                                        chart.draw(data, options);
                                    }
                                    if (visitor.length<3){
                                        document.getElementById('linechart').style.display = "none";
                                        document.getElementById('warning').style.display = "block";
                                    }else {
                                        document.getElementById('warning').style.display = "none";
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
