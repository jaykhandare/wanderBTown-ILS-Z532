<!DOCTYPE html>
<!--[if lt IE 7 ]>
<html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>
<html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>
<html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>
<html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="UTF-8"/>
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
    <title>Login and Registration Form</title>
    <link rel="stylesheet" type="text/css" href="../css/register.css"/>
    <script src="../js/jquery-3.2.1.min.js"></script>
    <!--
        <script src="../js/create_user.js"></script>
    -->
    <script src="../js/jquery.session.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

</head>
<body>
<div class="container">

    <header>
        <h1>Login and Registration Form</h1>

    </header>
    <section>
        <div id="container_demo">
            <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
            <a class="hiddenanchor" id="toregister"></a>
            <a class="hiddenanchor" id="tologin"></a>
            <div id="wrapper">
                <div id="login" class="animate form">
                    <form id="login_check" action="../user/login.php" autocomplete="on" method="post">
                        <h1>Log in</h1>
                        <p>
                            <label for="username" class="uname"> Your email or username </label>
                            <input id="username" name="userName" required="required" type="text"
                                   placeholder="myusername or mymail@mail.com"/>
                        </p>
                        <p>
                            <label for="password" class="youpasswd"> Your password </label>
                            <input id="password" name="password" required="required" type="password"
                                   placeholder="eg. X8df!90EO"/>
                        </p>
                        <p class="keeplogin">
                            <input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping"/>
                            <label for="loginkeeping">Keep me logged in</label>
                        </p>
                        <p class="login button">
                            <input type="submit" value="Login"/>
                        </p>
                        <div id="failed_login"><?php
                            if (isset($_GET['Message'])) {
                                echo $_GET['Message'];
                            }
                            ?>
                        </div>
                    </form>
                    <p class="change_link">
                        Not a member yet ?
                        <a href="#toregister" class="to_register">Join us</a>
                    </p>
                </div>

                <div id="register" class="animate form">
                    <form id="register_user" action="../user/create.php" autocomplete="on" method="post">
                        <h1> Sign up </h1>
                        <p>
                            <label for="firstNameRegister" class="uname">Your First Name</label>
                            <input id="firstNameRegister" name="firstName" required="required" type="text"
                                   placeholder="Your First Name"/>
                        </p>
                        <p>
                            <label for="lastNameRegister" class="uname">Your Last Name</label>
                            <input id="lastNameRegister" name="lastName" required="required" type="text"
                                   placeholder="Your Last Name"/>
                        </p>
                        <p>
                            <label for="userNameRegister" class="uname">Your User Name</label>
                            <input id="userNameRegister" name="userName" required="required" type="text"
                                   placeholder="Your User Name"/>
                        </p>
                        <p>
                            <label for="emailsignup" class="youmail"> Your email</label>
                            <input id="emailsignup" name="email" required="required" type="email"
                                   placeholder="mysupermail@mail.com"/>
                        </p>
                        <p>
                            <label for="passwordsignup" class="youpasswd">Your password </label>
                            <input id="passwordsignup" name="passwordsignup" required="required" type="password"
                                   placeholder="eg. X8df!90EO"/>
                        </p>
                        <p>
                            <label for="passwordsignup_confirm" class="youpasswd">Please confirm your password </label>
                            <input id="passwordsignup_confirm" name="password" required="required"
                                   type="password" placeholder="eg. X8df!90EO"/>
                        </p>

                        <p class="signin button">
                            <input type="submit" value="Sign up"/>
                        </p>
                        <p class="change_link">
                            Already a member ?
                            <a href="#tologin" class="to_register"> Go and log in </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
</body>
</html>