<?php
/**
 * Created by PhpStorm.
 * User: The Doctor
 * Date: 4/25/2019
 * Time: 1:35 AM
 */
?>

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
                                    <div class="editing-info">
                                        <h5 class="f-title"><i class="ti-info-alt"></i> Question's Content</h5>
                                        <form action={{url('add_question')}} method="post">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <select class="" name="testlvl_id" required="required">
                                                    <?php
                                                    foreach($levels as $level) {
                                                        echo "<option value='$level->id'>$level->id/12</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select class="" name="testsubject_id" required="required">
                                                    <?php
                                                    foreach($subjects as $subject) {
                                                        echo "<option value='$subject->id'>$subject->name</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <textarea rows="4" id="textarea" required="required" name="question"></textarea>
                                                <label class="control-label" for="textarea">Content</label><i class="mtrl-select"></i>
                                            </div>


                                            <h5 class="f-title ext-margin"><i class="ti-share"></i> Answer Option</h5>
                                            <br/>
                                            <h6 class="f-title ext-margin"><i class="ti-share"></i> False Option</h6>
                                            <div class="form-group">
                                                <input type="text" required="required" name="answer1"/>
                                                <label class="control-label" for="input"> False </label><i class="mtrl-select"></i>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" required="required" name="answer2"/>
                                                <label class="control-label" for="input"> False</label><i class="mtrl-select"></i>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" required="required" name="answer3"/>
                                                <label class="control-label" for="input"> False</label><i class="mtrl-select"></i>
                                            </div>
                                            <h6 class="f-title ext-margin"><i class="ti-share"></i> True Option</h6>
                                            <div class="form-group">
                                                <input type="text" required="required" name="answer"/>
                                                <label class="control-label" for="input"> True</label><i class="mtrl-select"></i>
                                            </div>
                                            <div class="submit-btns">
                                                <button  class="mtr-btn"><span>Save</span></button>
                                            </div>
                                        </form>
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
