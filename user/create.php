<?php

/*// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");*/

// get database connection
include_once '../config/database.php';

// instantiate user object
include_once '../objects/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if($_SERVER["REQUEST_METHOD"]!="POST") {
    echo '{';
    echo '"message": "POST method not used"';
    echo '}';
    exit();
}

// set user property values
$user->firstName = $_POST["firstName"];
$user->lastName = $_POST["lastName"];
$user->userName = $_POST["userName"];
$user->email = $_POST["email"];
$user->password = $_POST["password"];


// create the user
if($user->create()){
    header("Location: ../html/register.php#tologin");
    exit();
}
// if unable to create the user, tell the user
else{
    echo '{';
    echo '"message": "Unable to add the user."';
    echo '}';
}