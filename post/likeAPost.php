<?php

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

    if (empty($_POST["venueName"])) {
        echo "venueName is required";
    }
    else {
        $venueName = $_POST["venueName"];
    }
}


// add like
if($post->likeAPost()){
    header("Location: ../html/venue.php?name=".$venueName);
}
// if unable to add like , tell the user
else{
    echo '{';
    echo '"message": "Unable to add like to the post."';
    echo '}';
}
