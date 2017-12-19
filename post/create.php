<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// instantiate post object
include_once '../config/database.php';
include_once '../objects/post.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);

if($_SERVER["REQUEST_METHOD"]!="POST") {
    echo '{';
    echo '"message": "POST method not used"';
    echo '}';
    exit();
}

// set post property values
$post->venueName = $_POST["venueName"];
$post->content = $_POST["content"];
//$post->pic = $_POST["pic"];
$post->likes = 0;
$post->userID = $_POST["userID"];


// create a post
if($post->create()){
    header("Location: ../html/homepage.php");

/*    echo '{';
    echo '"message": "Post was made."';
    echo '}';*/
}
// if unable to create a post , tell the user
else{
    echo '{';
    echo '"message": "Unable to create the post."';
    echo '}';
}
