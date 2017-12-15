<?php
session_start();

// required headers

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
    header("Location:../html/homepage.php");
}
// if unable to create the reply, tell the user
else{
    echo '{';
    echo '"message": "Unable to add the reply."';
    echo '}';
}
