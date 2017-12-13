<?php

session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

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
$user->userName = $_SESSION["userName"];

// add the user interest
if($user->add_interests()){
    echo '{';
    echo '"message": "User interests were added."';
    echo '}';
}
// if unable to add the user interests, tell the user
else{
    echo '{';
    echo '"message": "Unable to add the user interests."';
    echo '}';
}
