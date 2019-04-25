
<!DOCTYPE html>
<html lang="en">
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
    <style>
        .chosen-container-single .chosen-single {
            background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
            border-color: -moz-use-text-color -moz-use-text-color #e1e8ed;
            border-radius: 0;
            border-style: solid;
            border-width: 1px;
            box-shadow: none;
            color: none !important;
            font-size: 16px;
            height: 35px;
            line-height: 35px;
            margin-bottom: 10px;

        }
        .select_test{
            background: #088dcd;
            border: medium none;
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            padding: 3px 10px;
        }
    </style>

</head>
<body>
<!--<div class="se-pre-con"></div>-->
<div class="theme-layout">

    @include('layouts.header')<!-- responsive header -->

    @include('layouts.coverphoto')<!-- coverphoto -->

    <section>
        <div class="gap gray-bg">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row" id="page-contents">
                            @include("layouts.lsidebar")<!-- lsidebar -->
                            <div class="col-lg-6">
                                <div class="central-meta">
                                    <div class="about">
                                        Select Your Free Option
                                        <div class="d-flex flex-row mt-2">
                                            <form class="" action="/test" method="get">
                                            <ul class="" >
                                                <li class="">
                                                    <p class="select_test">Select Class</p>
                                                    <select class="" name="testlvl_id" >
                                                        <?php
                                                        foreach($levels as $level) {
                                                            echo "<option value='$level->id'>$level->id/12</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </li>
                                                <li class="nav-item">
                                                    <p class="select_test">Select Subject</p>
                                                    <select class="" name="testsubject_id" >
                                                        <?php
                                                        foreach($subjects as $subject) {
                                                            echo "<option value='$subject->id'>$subject->name</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </li>
                                                <p><button class="">Do test</button></p>

                                            </ul>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- centerl meta -->
                            @include("layouts.rsidebar")<!-- rsidebar -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include("layouts.footer")<!-- footer -->
</div>
@include("layouts.side-panel")<!-- side panel -->

<script data-cfasync="false" src="js/email-decode.min.js"></script><script src="js/main.min.js"></script>
<script src="js/script.js"></script>
<script src="js/map-init.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8c55_YHLvDHGACkQscgbGLtLRdxBDCfI"></script>

</body>
</html>