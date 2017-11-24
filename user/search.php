<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';

// instantiate database and user object
$database = new Database();
$db = $database->getConnection();

// initialize object
$user = new User($db);

// get keywords
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";

// query user
$stmt = $user->search($keywords);
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
    // users array
    $users_arr=array();
    $users_arr["records"]=array();
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        extract($row);
        $user_item=array(
            "id" =>  $user->id,
            "firstName" => $user->firstName,
            "lastName" => $user->lastName,
            "email" => $user->email,
            "username" => $user->username,
            "joiningDate" => $user->joiningDate,
            "interest1" => $user->interest1,
            "interest2" => $user->interest2,
            "interest3" => $user->interest3
        );
        array_push($users_arr["records"], $user_item);
    }
    echo json_encode($users_arr);
}
else{
    echo json_encode(
        array("message" => "No records found.")
    );
}
