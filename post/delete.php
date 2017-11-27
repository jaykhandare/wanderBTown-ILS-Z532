<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// include database and object file
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

// delete the post
if($post->delete()){
    echo '{';
    echo '"message": "Post was deleted."';
    echo '}';
}
// if unable to delete the post
else{
    echo '{';
    echo '"message": "Unable to delete post."';
    echo '}';
}
