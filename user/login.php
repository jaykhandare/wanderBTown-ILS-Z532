<?php
session_start();

/*header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');*/

// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare user object
$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["userName"])) {
        echo "userName is required";
    }
    else {
        $user->userName = $_POST["userName"];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["password"])) {
        echo "password is required";
    }
    else {
        $user->password = $_POST["password"];
    }
}

if($user->login()){
    $_SESSION['userName'] = $user->userName;
    $_SESSION['userID'] = $user->userID;
    $_SESSION['picName'] = $_SESSION['userName'].".jpg";
    header("Location:../html/homepage.php");
//    header("Location: https://cas.iu.edu/cas/login?cassvc=IU&casurl=http://ella.ils.indiana.edu/~jkhandar/php/html/homepage.php");
    exit();
}
else{
    /*Error mechanism*/
    $Message = urlencode("Incorrect Credentials ");
    header("Location: ../html/register.php?Message=".$Message);
    exit();
}