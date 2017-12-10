<?php

// include database and object files
include_once '/home/jkhandar/PhpstormProjects/wanderBTown_test/wanderBTown-ILS-Z532/config/database.php';
include_once '/home/jkhandar/PhpstormProjects/wanderBTown_test/wanderBTown-ILS-Z532/objects/post.php';

// instantiate database and post object
$database = new Database();
$db = $database->getConnection();

// initialize object
$post = new Post($db);

// query posts
$stmt = $post->read();
$num = $stmt->rowCount();

// posts array
global $posts_arr;
$posts_arr = array();
// check if more than 0 record found
if($num>0){
    // retrieve our table contents
    while ($num!=0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $post_item=array($row['postID'], $row['content'], $row['userID'], $row['tag1'], $row['tag2'],
            $row['tag3'], $row['venue'], $row['postDate'], $row['pic1'], $row['pic2'], $row['pic3'], $row['likes']);
        array_push($posts_arr, $post_item);
        $num = $num - 1;
    }
}
else{
    array_push($posts_arr, json_encode(
        array("message" => "No records found.")
    ));
}
