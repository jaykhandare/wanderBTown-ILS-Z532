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

// instantiate reply object
include_once '../objects/reply.php';

$database = new Database();
$db = $database->getConnection();

$reply = new Reply($db);

if($_SERVER["REQUEST_METHOD"]!="POST") {
    echo '{';
    echo '"message": "POST method not used"';
    echo '}';
    exit();
}

// set reply property values
$reply->content = $_POST["content"];
$reply->userID = $_POST["userID"];
$reply->postID = $_POST["postID"];


// create the reply
if($reply->create()){
    echo '{';
    echo '"message": "Reply was added."';
    echo '}';
}
// if unable to create the reply, tell the user
else{
    echo '{';
    echo '"message": "Unable to add the reply."';
    echo '}';
}
