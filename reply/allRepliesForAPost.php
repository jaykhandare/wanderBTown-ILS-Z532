<?php

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

// replies array
$replies_arr=array();
// check if more than 0 record found
if($num>0){
    // retrieve our table contents
    while ($num!=0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $reply_item=array(
            "replyID" =>  $row['replyID'],
            "content" => $row['content'],
            "userID" => $row['userID'],
            "replyDate" => $row['replyDate']
        );
        array_push($replies_arr, $reply_item);
        $num = $num - 1;
    }
}
else{
    array_push($replies_arr, 0);
}

return $replies_arr;
