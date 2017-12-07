<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/reply.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare reply object
$reply = new Reply($db);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["replyID"])) {
        echo "replyID is required";
    }
    else {
        $reply->replyID = $_POST["replyID"];
    }
}

// set reply property values
if(isset($_POST["content"])) {
    $reply->content = $_POST["content"];
}

// update the reply
if($reply->update()){
    echo '{';
    echo '"message": "Reply was updated."';
    echo '}';
}
// if unable to update the reply, tell the user
else{
    echo '{';
    echo '"message": "Unable to update reply."';
    echo '}';
}
