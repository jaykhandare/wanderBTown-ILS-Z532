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
    <script src="../js/jquery.session.js"></script>
    <style>
        .floating-box {
            display: inline-block;
            width: 150px;
            height: 75px;
            margin: 5px;
        }
    </style>

</head>
<body>
<header>
    <div class="container">
        <a href="homepage.php"><img style="float: left" src="../images/logooo.png" class="logo" alt="" width="150"></a>
        <h1 align="center">Wander<span name="btown">BTOWN</span></h1>
        <h4 align="center">Live . Learn . Explore</h4>
        <div id="Profile_name"><?= "Hello ".$_SESSION['userName'] ?></div>
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
                <li class="active"><a href="homepage.php">Home</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<section>
    <?php
    include_once "../venue/read.php";

    for ($i = 0; $i < $size; $i++) {

        if($venues_arr[$i][0]=='imu') $imu = $i;
        if($venues_arr[$i][0]=='artmuseum') $artmuseum = $i;
        if($venues_arr[$i][0]=='huhot') $huhot = $i;
        if($venues_arr[$i][0]=='motherbears') $motherbears = $i;

    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Places around the town</h3>
                    </div>
                    <div class="panel-body">
                        <ul>
                            <div>
                                <li><a href="../html/venue.php?name=imu" style="width: 500px" class="thumbnail">Indiana Memorial Union<img src="../images/imu.jpg" alt=""></a></li>
                                <p><strong>Details:<?=$venues_arr[$imu][1] ?></p>
                                <p>Contact:<?=$venues_arr[$imu][2] ?></p>
                            </div>
                            <div>
                                <li><a href="../html/venue.php?name=artmuseum" style="width: 500px" class="thumbnail">Eskenazi Arts Museum<img src="../images/artmuseum.jpg" alt=""></a></li>
                                <p><strong>Details:<?=$venues_arr[$artmuseum][1] ?></p>
                                <p>Contact:<?=$venues_arr[$artmuseum][2] ?></p>
                            </div>
                            <div>
                                <li><a href="../html/venue.php?name=huhot" style="width: 500px" class="thumbnail">Hu Hot Grill<img src="../images/huhot.jpg" alt=""></a></li>
                                <p><strong>Details:<?=$venues_arr[$huhot][1] ?></p>
                                <p>Contact:<?=$venues_arr[$huhot][2] ?></p>
                            </div>
                            <div>
                                <li><a href="../html/venue.php?name=motherbears" style="width: 500px" class="thumbnail">Mother Bears<img src="../images/motherbears.jpg" alt=""></a></li>
                                <p><strong>Details:<?=$venues_arr[$motherbears][1] ?></p>
                                <p>Contact:<?=$venues_arr[$motherbears][2] ?></p>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

</body>
</html>