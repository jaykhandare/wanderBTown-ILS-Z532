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

// query users
$stmt = $user->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
    // users array
    $users_arr["records"]=array();
    // retrieve our table contents
    while ($num!=0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $user_item=array(
            "id" =>  $row['id'],
            "firstName" => $row['firstName'],
            "lastName" => $row['lastName'],
            "email" => $row['email'],
            "username" => $row['username'],
            "joiningDate" => $row['joiningDate']
        );
        array_push($users_arr["records"], $user_item);
        $num = $num - 1;
    }
    echo json_encode($users_arr["records"]);
}
else{
    echo json_encode(
        array("message" => "No records found.")
    );
}