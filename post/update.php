<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/post.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare post object
$post = new Post($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["postID"])) {
        echo "postID is required";
    }
    else {
        $post->postID = $_POST["postID"];
    }
}

// set post property values
if(isset($_POST["content"])) {
    $post->content = $_POST["content"];
}
if(isset($_POST["tag1"])) {
    $post->tag1 = $_POST["tag1"];
}
if(isset($_POST["tag2"])) {
    $post->tag2 = $_POST["tag2"];
}
if(isset($_POST["tag3"])) {
    $post->tag3 = $_POST["tag3"];
}
if(isset($_POST["venue"])) {
    $post->venue = $_POST["venue"];
}
if(isset($_POST["pic1"])) {
    $post->pic1 = $_POST["pic1"];
}
if(isset($_POST["pic2"])) {
    $post->pic2 = $_POST["pic2"];
}
if(isset($_POST["pic3"])) {
    $post->pic3 = $_POST["pic3"];
}



// update the post
if($post->update()){
    echo '{';
    echo '"message": "Post was updated."';
    echo '}';
}
// if unable to update the post, tell the user
else{
    echo '{';
    echo '"message": "Unable to update post."';
    echo '}';
}
