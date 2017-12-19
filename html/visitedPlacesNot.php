<?php
session_start();
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
                <li><a href="homepage.php">Home</a></li>
                <li class="active"><a href="visitedPlacesNot.php">Not Visited Places</a></li>
                <li><a href="visitedPlaces.php">Visited Places</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<section>
    <?php
    include_once '../venue/visitedPlacesNot.php';
    ?>

    <div class="container">
        <div class="col-md-8">

            <?  foreach ($venues_arr as &$value){ if($value!=0) {?>

                <? /*venue items are available as $value[0][0]*/    ?>

                <div class="panel panel-default post">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <a href="profile.html" class="post-avatar thumbnail"><img src="../images/back.jpg" alt="">
                                    <div class="text-center"><?= $value[0];?></div>
                                </a>
                                <div class="likes text-center"><?= $value[1];?></div>
                            </div>
                            <div class="col-sm-10">
                                <div class="bubble">
                                    <div class="pointer">
                                        <p><?= $value[2];?></p>
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
                                            <p><?= $value[0]; ?></p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="comment">
                                        <a href="#" class="comment-avatar pull-left"><img src="../images/jay_round.png"
                                                                                          alt=""></a>
                                        <div class="comment-text">
                                            <p><?= $value[0];?> &#x2602;</p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?}else{echo "No Venues at this time.";}}  ?>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default friends">
                    <div class="panel-heading">
                        <h3 class="panel-title">Must Visit Places</h3>
                    </div>
                    <div class="panel-body">
                        <ul>
                            <li><a href="eskenazi.php" class="thumbnail"><img src="../images/museum.jpg" alt=""></a>
                            </li>
                            <li><a href="imu.html" class="thumbnail"><img src="../images/imu-frontdoors.jpg" alt=""></a>
                            </li>
                            <li><a href="lakemonroe.html" class="thumbnail"><img src="../images/lake.jpg" alt=""></a>
                            </li>
                            <li><a href="motherbears.html" class="thumbnail"><img src="../images/motherbears.jpg"
                                                                                  alt=""></a></li>
                        </ul>
                        <div class="clearfix"></div>
                        <a class="btn btn-primary" href="#">View All Places</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

</body>
</html>