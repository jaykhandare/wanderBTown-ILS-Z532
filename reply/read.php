<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/reply.php';

// instantiate database and reply object
$database = new Database();
$db = $database->getConnection();

// initialize object
$reply = new Reply($db);

// query replies
$stmt = $reply->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
    // replies array
    $replies_arr["records"]=array();
    // retrieve our table contents
    while ($num!=0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $reply_item=array(
            "replyID" =>  $row['replyID'],
            "postID" => $row['postID'],
            "content" => $row['content'],
            "userID" => $row['userID'],
            "replyDate" => $row['replyDate']
        );
        array_push($replies_arr["records"], $reply_item);
        $num = $num - 1;
    }
    echo json_encode($replies_arr["records"]);
}
else{
    echo json_encode(
        array("message" => "No records found.")
    );
}
