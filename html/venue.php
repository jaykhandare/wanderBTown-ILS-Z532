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

$numPosts = count($post_arr);
$numReplies = count($replies_arr);

?>

<script>
    function myFunction() {
        var x = document.getElementById("hiddenval1").innerText;
        var y = document.getElementById("demo");
        var out = "../images/"+x+".jpg";
        y.setAttribute("src",out);
    }
</script>


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

        .grooverborder{
            border-style: groove;
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
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
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
                        <p id="hiddenval1" hidden><?=$venue_item[0]?></p>
                        <img id="demo" src="../images/samplegates.jpg" alt="default_image" style="width:400px;height:200px;border:0;">
                    </div>
                    <script>
                        myFunction();
                    </script>
                </div>
            </div>
            <div class="col-sm-6">
                <br/>
                <br/>
                <p>
                    <strong>What is this place:</strong><br> <?=$venue_item[1]?>
                </p>
                <br/>
                <br/>
                <p>
                    <strong>Timings and Contacts:</strong><br> <?=$venue_item[2]?>
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
                <form action="../post/create.php" method="post" class="form-inline">
                    <input type="text" name="content" size="100" placeholder="What you have to say about this place?">
                    <br>
                    <input type="text" class="form-control floating-box" name="tag1" placeholder="#tag">
                    <input type="text" class="form-control floating-box" name="tag2" placeholder="#tag2">
                    <input type="text" class="form-control floating-box" name="tag3" placeholder="#tag3">
                    <input value= <?=$venue_item[0]?> name ="venueName" hidden>
                    <input value= <?=$_SESSION['userID']?> name ="userID" hidden>
                    <button type="submit" class="btn btn-default" name="post" value="submit">POST</button>
                </form>

            </div>

        </div>

    </div>

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Posts about this place</h4>
            </div>
            <?if($numPosts>1){?>
            <? for($i = 0;$i < $numPosts;$i++){ ?>
                <div class="panel-body grooverborder">
                    <p><strong><?=$post_arr[$i][2]?> </strong></p>
                    <div class="row">
                        <div class="col-sm-4">
                            <form method="post" action="../post/likeAPost.php">
                                <input value=<?=   $post_arr[$i][1]?> name="postID" hidden>
                                <input value=<?=   $post_arr[$i][8]?> name="venueName" hidden>
                                <button type="submit" name="" value="" onclick="submit">Like!</button>
                            </form>
                            <p>LikeCount: <?=$post_arr[$i][3]?></p>
                        </div>
                        <div class="col-sm-8">
                            <p>-<?=   $post_arr[$i][0]?></p>
                            <p>-<?=   $post_arr[$i][7]?></p>
                        </div>
                    </div>
                    <div>
                        <p><strong>Replies</strong></p>
                    </div>
                    <? for($j = 0;$j < $numReplies;$j++){
                        if($replies_arr[$j][0]==$post_arr[$i][1]){

                            ?>
                            <div class="row">

                                <div class="col-sm-6">
                                    <p><?=   $replies_arr[$j][2]?></p>

                                </div>

                                <div class="col-sm-6">
                                    <p><?=   $replies_arr[$j][1]?> : <?=   $replies_arr[$j][3]?></p>
                                </div>
                            </div>
                        <?  }}   ?>
                    <div >
                        <form method="post" action="../reply/create.php">
                            <input type="text" name="content" placeholder="Enter Comment" size="100">
                            <input value=<?=$post_arr[$i][8]?> name="venueName" hidden>
                            <input value=<?=$_SESSION['userID']?> name="userID" placeholder="Enter Comment" hidden>
                            <input value=<?=$post_arr[$i][1]?> name="postID" placeholder="Enter Comment" hidden>
                            <button type="submit" onclick="submit">Send</button>
                        </form>
                    </div>
                </div>
            <?}?>

            <?}
            else{
            ?><strong><?= "No posts about this place yet. Be the first one to post something.";?></strong>
            <?}?>
        </div>
    </div>

</section>

</body>
</html>