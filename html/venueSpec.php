<?php
session_start();
include_once '../venue/read_one.php';
// query replies
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link href="../css/bootstrap.css" rel='stylesheet' type='text/css'/>
    <link href="../css/style2.css" rel='stylesheet' type='text/css'/>
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/homePage.js"></script>
    <script src="../js/jquery.session.js"></script>


</head>
<body>
<header>
    <div class="container">
        <a href="homepage.php"><img style="float: left" src="../images/logooo.png" class="logo" alt="" width="150"></a>
        <h1 align="center">Wander<span name="btown">BTOWN</span></h1>
        <h4 align="center">Live . Learn . Explore</h4>
        <div id="Profile_name"></div>
    </div>
</header>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            </ul>
        </div>
    </div>
</nav>

<section>

<head>
    <meta charset="UTF-8">
    <title>Indiana Memorial Union</title>
    <link href="bootstrap.css" rel='stylesheet' type='text/css'/>
    <link href="style2.css" rel='stylesheet' type='text/css'/>
<link href="https://fonts.googleapis.com/css?family=Jura" rel="stylesheet">
</head>
<body>
<script>
    function myFunction() {
        var x = document.getElementById("hiddenval1").innerText;
        var y = document.getElementById("demo");
        var out = "../images/"+x+".jpg";
        y.setAttribute("src",out);
    }
</script>


<div class="banner">
    <p id="hiddenval1" hidden><?=$venue->venueName?></p>
            <div class="banner-image">
                    <img id = "demo" src="imu.jpg" alt="IMU" class="img-responsive img-fullwidth", height="500", width="750", style="float: left;margin-right: 50px;padding-bottom: 75px">
            </div>
    <script>
        myFunction();
    </script>

    <div class="banner-title">
            <h4> <b><?=$venue->venueName ?> </b> </h4>
            <div id="text">

                <strong><?=$venue->details ?></strong>
            </div>
        </div>
<p> <b> Contact Details:</b></p>    <?=$venue->contact ?>

    <? if(isset($_SESSION['userName'])){ ?>

    <div class="container">
        <div class="col-md-8">
                <div class="panel panel-default post">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <a href="profile.html" class="post-avatar thumbnail"><img src="../images/back.jpg" alt="">
                                </a>
                                <div class="likes text-center"><? ?></div>
                            </div>
                            <div class="col-sm-10">
                                <div class="bubble">
                                    <div class="pointer">
                                        <p><? ?></p>
                                    </div>
                                    <div class="pointer-border"></div>
                                </div>
                                <p class="post-actions"><a href="#">Comment</a> - <a href="#">Like</a> </p>
                                <div class="comment-form">
                                    <form class="form-inline">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="enter comment">
                                        </div>
                                        <button type="submit" class="btn btn-default">Add</button>
                                    </form>
                                </div>
                                <div class="clearfix"></div>

                                <div class="comments">
                                    <div class="comment">
                                        <a href="#" class="comment-avatar pull-left"><img src="../images/cutmypic.png"
                                                                                          alt=""></a>
                                        <div class="comment-text">
                                            <p><? ?></p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="comment">
                                        <a href="#" class="comment-avatar pull-left"><img src="../images/jay_round.png"
                                                                                          alt=""></a>
                                        <div class="comment-text">
                                            <p><? ?> &#x2602;</p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <?} ?>



</section>

</body>
</html>