<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/reply.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare reply object
$reply = new Reply($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["postID"])) {
        echo "postID is required";
    }
    else {
        $reply->postID = $_POST["postID"];
    }
}

$stmt = $reply->allRepliesForAPost();
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
