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

// read the details of post to be edited
$post->readOne();

// create array
$post_item = array(
    "postID" =>  $post->postID,
    "content" => $post->content,
    "userID" => $post->userID,
    "tag1" => $post->tag1,
    "tag2" => $post->tag2,
    "tag3" => $post->tag3,
    "venue" => $post->venue,
    "postDate" => $post->postDate,
    "pic1" => $post->pic1,
    "pic2" => $post->pic2,
    "pic3" => $post->pic3,
    "likes" => $post->likes
);

// make it json format
print_r(json_encode($post_item));
