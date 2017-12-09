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
        <a href="index.html"><img style="float: left" src="../images/logooo.png" class="logo" alt="" width="150"></a>
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
                <li class="active"><a href="index.html">Home</a></li>
                <li><a href="members.html">Members</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="photos.html">Places</a></li>
                <li><a href="profile.html">Logout</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>


<section>
    <?php
    // required headers
    /*                header("Access-Control-Allow-Origin: *");
                    header("Content-Type: application/json; charset=UTF-8");
                    header("Access-Control-Allow-Methods: POST");
                    header("Access-Control-Max-Age: 3600");
                    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");*/

    // instantiate post object
    include_once '../objects/post.php';

    include_once '../config/database.php';
    include_once '../objects/user.php';

    // instantiate database and user object
    $database = new Database();
    $db = $database->getConnection();
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default friends">
                    <div class="panel-heading">
                        <h3 class="panel-title">Must Visit Places</h3>
                    </div>
                    <div class="panel-body">
                        <ul>
                            <li><a href="eskenazi.html" class="thumbnail"><img src="../images/museum.jpg" alt=""></a>
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

            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Wall</h4>
                    </div>
                    <div class="panel-body">
                        <form>
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Write on the wall"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Place Name">
                                <input type="text" class="form-control" placeholder="Address">

                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                            <div class="pull-right">
                                <div class="btn-toolbar">
                                    <button type="button" class="btn btn-default"><i class="fa fa-file-image-o"></i>Image
                                    </button>
                                    <button type="button" class="btn btn-default"><i class="fa fa-file-video-o"></i>Video
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                /* // initialize object
                $user = new User($db);

                // query users
                $stmt = $user->read();
                $num = $stmt->rowCount();
                $users_arr["records"] = array();

                // check if more than 0 record found
                if ($num > 0) {
                // users array
                // retrieve our table contents
                while ($num != 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $user_item = array($row['id'], $row['firstName'], $row['lastName'], $row['email'],
                $row['username'], $row['joiningDate']);
                array_push($users_arr["records"], $user_item);
                $num = $num - 1;
                }
                } else {
                array_push($users_arr["records"], json_encode(
                array("message" => "No records found.")
                ));
                }
                */?>
                <? foreach ($users_arr["records"] as &$value){ ?>

                <div class="panel panel-default post">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <a href="profile.html" class="post-avatar thumbnail"><img src="../images/back.jpg"
                                                                                          alt="">

                                    <div class="text-center"><?= $value[0]; ?></div>
                                </a>
                                <div class="likes text-center"> <? $value[1]; ?></div>
                            </div>
                            <div class="col-sm-10">
                                <div class="bubble">
                                    <div class="pointer">
                                        <p><?= $value[2]; ?></p>
                                    </div>
                                    <div class="pointer-border"></div>
                                </div>
                                <p class="post-actions"><a href="#">Comment</a> - <a href="#">Like</a> - <a href="#">Follow</a>
                                    - <a href="#">Share</a></p>
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
                                            <p><?= $value[3]; ?></p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="comment">
                                        <a href="#" class="comment-avatar pull-left"><img src="../images/jay_round.png"
                                                                                          alt=""></a>
                                        <div class="comment-text">
                                            <p><?= $value[3]; ?> &#x2602;</p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <? } ?>
                </div>


            </div>
        </div>

    </div>
</section>

<!--        <div class="panel panel-default post">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-2">
                        <a href="profile.html" class="post-avatar thumbnail"><img src="img/user.png" alt="">
                            <div class="text-center">DevUser1</div>
                        </a>
                        <div class="likes text-center">7 Likes</div>
                    </div>
                    <div class="col-sm-10">
                        <div class="bubble">
                            <div class="pointer">
                                <p>Hey I was wondering if you wanted to go check out the football game later. I
                                    heard they are supposed to be really good!</p>
                            </div>
                            <div class="pointer-border"></div>
                        </div>
                        <p class="post-actions"><a href="#">Comment</a> - <a href="#">Like</a> - <a href="#">Follow</a>
                            - <a href="#">Share</a></p>
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
                                <a href="#" class="comment-avatar pull-left"><img src="img/user.png" alt=""></a>
                                <div class="comment-text">
                                    <p>I am just going to paste in a paragraph, then we will add another
                                        clearfix.</p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="comment">
                                <a href="#" class="comment-avatar pull-left"><img src="img/user.png" alt=""></a>
                                <div class="comment-text">
                                    <p>I am just going to paste in a paragraph, then we will add another
                                        clearfix.</p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
<!--                <div class="col-md-4">
                    <div class="panel panel-default friends">
                        <div class="panel-heading">
                            <h3 class="panel-title">My Friends</h3>
                        </div>
                        <div class="panel-body">
                            <ul>
                                <li><a href="profile.html" class="thumbnail"><img src="../images/1.jpg" alt=""></a></li>
                                <li><a href="profile.html" class="thumbnail"><img src="../images/1.jpg" alt=""></a></li>
                                <li><a href="profile.html" class="thumbnail"><img src="../images/1.jpg" alt=""></a></li>
                                <li><a href="profile.html" class="thumbnail"><img src="../images/1.jpg" alt=""></a></li>
                                <li><a href="profile.html" class="thumbnail"><img src="../images/1.jpg" alt=""></a></li>
                                <li><a href="profile.html" class="thumbnail"><img src="../images/1.jpg" alt=""></a></li>
                                <li><a href="profile.html" class="thumbnail"><img src="../images/1.jpg" alt=""></a></li>
                                <li><a href="profile.html" class="thumbnail"><img src="../images/1.jpg" alt=""></a></li>
                                <li><a href="profile.html" class="thumbnail"><img src="../images/1.jpg" alt=""></a></li>
                            </ul>
                            <div class="clearfix"></div>
                            <a class="btn btn-primary" href="#">View All Friends</a>
                        </div>
                    </div>
                    <div class="panel panel-default groups">
                        <div class="panel-heading">
                            <h3 class="panel-title">Latest Groups</h3>
                        </div>
                        <div class="panel-body">
                            <div class="group-item">
                                <img src="img/group.png" alt="">
                                <h4><a href="#" class="">Sample Group One</a></h4>
                                <p>This is a paragraph of intro text, or whatever I want to call it.</p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="group-item">
                                <img src="img/group.png" alt="">
                                <h4><a href="#" class="">Sample Group Two</a></h4>
                                <p>This is a paragraph of intro text, or whatever I want to call it.</p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="group-item">
                                <img src="img/group.png" alt="">
                                <h4><a href="#" class="">Sample Group Three</a></h4>
                                <p>This is a paragraph of intro text, or whatever I want to call it.</p>
                            </div>
                            <div class="clearfix"></div>
                            <a href="#" class="btn btn-primary">View All Groups</a>
                        </div>
                    </div>
                </div>-->


</body>
</html>