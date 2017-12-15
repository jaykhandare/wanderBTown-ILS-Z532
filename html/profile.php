<?
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
                <li><a href="homepage.php">Home</a></li>
                <li class="active"><a href="profile.php">Profile</a></li>
                <li><a href="tagSearch.php">Tag Search</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
<?
include_once '../user/getUserInfo.php';

?>
<script>
    function myFunction() {
        var x = document.getElementById("hiddenval1").innerText;
        var y = document.getElementById("demo");
        var out = "../images/profilePics/"+x+".jpg";
        y.setAttribute("src",out);
    }
</script>

<div class="container">
    <div class="row">
        <div class="col-md-5  toppad  pull-right col-md-offset-3 "> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
            <p id="hiddenval1" hidden><?=$_SESSION['userName']?></p>

            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><?=$_SESSION['userName']?></h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-2 thumbnail" align="center">
                            <a href="fileUpload.php"><img id = "demo" alt="User Pic" src="../images/back.jpg" class=img-circle img-responsive"></a>
                        </div>
                        <script>
                            myFunction();
                        </script>
                        <div class=" col-md-9 col-lg-9 ">
                            <form action="../user/update.php" method="post" class="form-inline">
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>First Name:</td>
                                        <td><input type="text" name ="firstName" class="form-control" placeholder=<?=$user->firstName?> /></td>
                                    </tr>
                                    <tr>
                                        <td>Last Name:</td>
                                        <td><input type="text" name ="lastName" class="form-control" placeholder=<?=$user->lastName?> /></td>
                                    </tr>
                                    <tr>
                                        <td>Email:</td>
                                        <td><input type="email" name ="email" class="form-control" placeholder=<?=$user->email?> /></td>
                                    </tr>
                                    <tr>
                                        <td>Password:</td>
                                        <td><input type="password" name ="password" class="form-control" placeholder="New Password" /></td>
                                    </tr>

                                    <tr>
                                    <tr>
                                        <td>Joining date:</td>
                                        <td><?=$user->joiningDate?></td>
                                    </tr>
                                    </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <button type="submit" class="btn btn-default" name="update" value="update">UPDATE</button>
                                <button type="submit" class="btn btn-default" name="cancel">CANCEL</button>
                                <div id="failed_update">
                                    <?php
                                    if (isset($_GET['Message'])) {
                                        echo $_GET['Message'];
                                    }
                                    ?>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


</body>

</html>