<?php
session_start();
include_once '../post/venuePosts.php';

if (isset($_GET['name'])) {
    $venueName = $_GET['name'];
}
$arr = myFunction($venueName);

//all venue details
$venue_item = $arr[0];

//all posts at this venue
$post_arr = $arr[1];

//all replies to these posts
$replies_arr = $arr[2];


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
            width: 100px;
            height: 50px;
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
        <div id="Profile_name"><?= "Hello,".$_SESSION['userName'] ?></div>
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
                <li><a href="venue.php">VenueTest</a></li>
            </ul>
        </div>
    </div>
</nav>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><?=strtoupper($venue_item[0])?></h4>
                    </div>
                    <div class="panel-body">
                        <img src="../images/museum.jpg" alt="default_image" style="width:400px;height:200px;border:0;">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <br/>
                <br/>
                <p>
                    What is this place: <?=$venue_item[1]?>
                </p>
                <br/>
                <br/>
                <p>
                    Timings and Contacts: <?=$venue_item[2]?>
                </p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">POST</h4>
            </div>
            <div class="panel-body">
                <input type="text" name="content" value="default content" size="100">
                <br/>
                <input type="text" class="form-control floating-box" name="tag1" placeholder="#tag">
                <input type="text" class="form-control floating-box" name="tag2" placeholder="#tag2">
                <input type="text" class="form-control floating-box" name="tag2" placeholder="#tag3">

            </div>

        </div>

    </div>


    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Venue posts</h4>
            </div>
            <div class="panel-body">
                <p>Post content</p>
                <div class="row">
                    <div class="col-sm-4">
                        <button type="button">Like!</button>
                    </div>

                    <div class="col-sm-8">
                        <p>Usrname</p>
                        <p>posting date</p>
                    </div>

                </div>

                <div class="row">


                    <div>
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reply object</p>
                    </div>

                    <div class="col-sm-6">
                        <p>reply copntent</p>

                    </div>


                    <div class="col-sm-6">
                        <p>username</p>
                        <p>reply date</p>

                    </div>

                </div>
                <div >
                    <input type="text" name="comment" value="enter comment" size="100">
                    <button type="button">Submit!</button>
                </div>





            </div>


        </div>
    </div>




</section>

</body>
</html>