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
                <li><a href="visitedPlacesNot.php">Not Visited Places</a></li>
                <li><a href="visitedPlaces.php">Visited Places</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="venueView.php">VenueTest</a></li>
            </ul>
        </div>
    </div>
</nav>
<script>
    function myFunction() {
        var x = document.getElementById("hiddenval1").innerText;
        var y = document.getElementById("demo");
        var link = document.getElementById("adddd");
        var out = "../images/"+x+".jpg";
        var linkAdd = "../html/venueSpec.php?name="+x;
        y.setAttribute("src",out);
        link.setAttribute("href",linkAdd);
    }
</script>

<section>
    <?php
    include_once '../venue/read.php';

    ?>

    <?  if($size!=0) {  for($i = 0;$i<=$size-1;$i++){ ?>

    <div class="container">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><?=$venues_arr[$i][0]?></h4>
                </div>
            </div>
                <p id="hiddenval1" hidden><?=$venues_arr[$i][1]?></p>
                <script>
                    myFunction();
                </script>

                <div class="panel panel-default post">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <a id = "adddd" href="" class="post-avatar thumbnail"><img id = "demo" src="../images/back.jpg" alt=""></a>
                                <?=$venues_arr[$i][1]?>
                            </div>
                            <div class="col-sm-10">
                                <div class="bubble">
                                    <div class="pointer">
                                        <p><?= $venues_arr[$i][3];?></p>
                                    </div>
                                    <div class="pointer-border"></div>
                                </div>
                                <p class="post-actions"><a href="#">Like</a> </p>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?}}else{echo "No Venues at this time.";}  ?>
        </div>
    </div>
</section>

</body>
</html>