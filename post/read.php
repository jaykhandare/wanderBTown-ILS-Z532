<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

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

// check if more than 0 record found
if($num>0){
    // posts array
    $posts_arr["records"]=array();
    // retrieve our table contents
    while ($num!=0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $post_item=array(
            "postID" =>  $row['postID'],
            "content" => $row['content'],
            "userID" => $row['userID'],
            "tag1" => $row['tag1'],
            "tag2" => $row['tag2'],
            "tag3" => $row['tag3'],
            "venue" => $row['venue'],
            "postDate" => $row['postDate'],
            "pic1" => $row['pic1'],
            "pic2" => $row['pic2'],
            "pic3" => $row['pic3'],
            "likes" => $row['likes']
        );
        array_push($posts_arr["records"], $post_item);
        $num = $num - 1;
    }
    echo json_encode($posts_arr["records"]);
}
else{
    echo json_encode(
        array("message" => "No records found.")
    );
}