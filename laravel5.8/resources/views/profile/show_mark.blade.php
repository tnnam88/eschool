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

    <?php echo $visitor; ?>
    <div class="container">
        <div class="row">

            <div class="col-md-10">
                <p>{{$currentuser->name}}</p>
                <p>{{$currentuser->email}}</p>
                <p>{{$currentuser->role}}</p>
                <p>{{$currentuser->usre_city}}</p>
                <p>{{$currentuser->original_filename}}</p>

                {{--<img class="card-img-top" src="{{URL::asset('storage/app/public/image/profile_pic/'.$currentuser->filename)}}" alt="{{$currentuser->original_filename}}">--}}

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
                <div class="row">
                    <div class="col-md-4"></div>


                    <div class="form-group col-md-4">

                        <button type="submit" class="btn btn-success" style="margin-left:38px">Check !</button>

                    </div>

                </div>
                <div class="row" id="user_mark" style="display:none;">
                    <div class="col-md-4"></div>
                    <div class="form-group col-md-4">
                        <p id="demo"></p>
                    </div>
                </div>
                <div id="linechart" style="width: 900px; height: 500px"></div>
                <div id="warning" style="display: none"><p>Not enough test to show graph</p></div>
                </form>
            </div>


        </div>
    </div>

</div>
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
            title: 'Your Score  ',
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
</body>

</html>






@endsection
