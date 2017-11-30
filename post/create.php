<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate post object
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
$post->content = $_POST["content"];
$post->tag1 = $_POST["tag1"];
$post->tag2 = $_POST["tag2"];
$post->tag3 = $_POST["tag3"];
$post->venue = $_POST["venue"];
$post->pic1 = $_POST["pic1"];
$post->pic2 = $_POST["pic2"];
$post->pic3 = $_POST["pic3"];
$post->likes = 0;
$post->userID = "my userID";

// create a post
if($post->create()){
    echo '{';
    echo '"message": "Post was made."';
    echo '}';
}
// if unable to create a post , tell the user
else{
    echo '{';
    echo '"message": "Unable to create the post."';
    echo '}';
}
