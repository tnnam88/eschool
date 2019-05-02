<?php
use App\Post;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


?>
        <!DOCTYPE html>
<html lang="en">
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
                <div class="row" id="page-contents">
                @include('layouts.lsidebar')<!-- lsidebar -->
                    <div class="col-lg-9">
                        <div>
                            <h2>Filterable Table</h2>
                            <p>Type something in the input field to search the table for first names, last names or emails:</p>
                            <input id="myInput" type="text" placeholder="Search..">
                            <br><br>

                            <table>
                                <thead>
                                <tr>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                </tr>
                                </thead>
                                <tbody id="myTable">
                                <tr>
                                    <td>John</td>
                                    <td>Doe</td>
                                    <td>john@example.com</td>
                                </tr>
                                <tr>
                                    <td>Mary</td>
                                    <td>Moe</td>
                                    <td>mary@mail.com</td>
                                </tr>
                                <tr>
                                    <td>July</td>
                                    <td>Dooley</td>
                                    <td>july@greatstuff.com</td>
                                </tr>
                                <tr>
                                    <td>Anja</td>
                                    <td>Ravendale</td>
                                    <td>a_r@test.com</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@include('layouts.footer')<!-- responsive footer -->
</div>
@include('layouts.side-panel')<!-- side panel -->

<script data-cfasync="false" src="{{asset('js/email-decode.min.js')}}">

</script><script src="{{asset('js/main.min.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
<script src="{{asset('js/strip.pkgd.min.js')}}"></script>
<script>
    $(document).ready(function(){

        var _token = $('input[name="_token"]').val();

        load_data('', _token);

        function load_data(id="", _token)
        {
            $.ajax({
                url:"{{ route('activity') }}",
                method:"POST",
                data:{id:id, _token:_token},
                success:function(data)
                {
                    $('#load_more_button').remove();
                    $('#post_data').append(data);
                }
            });
        }

        $(document).on('click', '#load_more_button', function(){
            var id = $(this).data('id');
            $('#load_more_button').html('<b>Loading...</b>');
            load_data(id, _token);
        });

        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

    });
</script><!-- ajax -->

</body>
</html>
