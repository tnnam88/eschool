@extends('layouts.app')

@section('content')

    <div class="central-meta">
        <h5 class="f-title"><i class="ti-info-alt"></i> Your Perfomance</h5>


        <div id="linechart" style="width: 900px; height: 500px"></div>
        <div id="warning" style="display: none"><p>Not enough test to show graph</p></div>
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
</body>

</html>






@endsection
