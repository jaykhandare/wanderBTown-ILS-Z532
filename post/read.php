<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/post.php';

// instantiate database and post object
$database = new Database();
$db = $database->getConnection();

// initialize object
$post = new Post($db);

// query posts
$stmt = $post->read();
$num = $stmt->rowCount();
$size = $num;
// posts array
global $posts_arr;
$posts_arr = array();
// check if more than 0 record found
if($num>0){
    // retrieve our table contents
    while ($num!=0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $post_item=array($row['postID'], $row['venueName'], $row['userID'],$row['content'], $row['postDate'], $row['pic'],$row['likes']);
        array_push($posts_arr, $post_item);
        $num = $num - 1;
    }
}
else{
    array_push($posts_arr, "No posts available now.");
}
