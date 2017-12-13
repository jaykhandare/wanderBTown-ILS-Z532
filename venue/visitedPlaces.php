<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/post.php';
// instantiate database and reply object
$database = new DatabaseTest();
$db = $database->getConnection();

// initialize object
$post = new Post($db);
$post->userID = $_SESSION['userID'];
$stmt = $post->visitedPlaces();

$num = $stmt->rowCount();
// check if more than 0 record found
$venues_arr=array();
if($num>0){
    // retrieve our table contents
    while ($num!=0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $venue_item=array($row['venueName'],$row['details'],$row['contact']);
        array_push($venues_arr, $venue_item);
        $num = $num - 1;
    }
}
else{
    array_push($venues_arr, 0);
}

