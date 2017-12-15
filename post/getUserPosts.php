<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/post.php';


// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare user object
$post = new Post($db);

$stmt = $post->getUserPosts();
$num = $stmt->rowCount();

// posts array
$posts_arr=array();
// check if more than 0 record found
if($num>0){
    // retrieve our table contents
    while ($num!=0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $post_item=array(
            "postID" =>  $row['postID'],
            "content" => $row['content'],
            "tag1" => $row['tag1'],
            "tag2" => $row['tag2'],
            "tag3" => $row['tag3'],
            "venue" => $row['venue'],
            "postDate" => $row['postDate'],
            "pic" => $row['pic'],
            "likes" => $row['likes']
        );
        array_push($posts_arr, $post_item);
        $num = $num - 1;
    }
}
else{
    array_push($posts_arr, 0);
}

