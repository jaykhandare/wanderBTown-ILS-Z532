<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

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
// add like
if($post->likeAPost()){
    echo '{';
    echo '"message": "Post was liked."';
    echo '#likes = ' + $post->likes;
    echo '}';
}
// if unable to add like , tell the user
else{
    echo '{';
    echo '"message": "Unable to add like to the post."';
    echo '}';
}
