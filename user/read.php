<?php

// required headers
/*
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
*/
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

// users array
$users_arr["records"] = array();

$users_arr["records"] = array();
// check if more than 0 record found
if ($num > 0) {
    // retrieve our table contents
    while ($num != 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $user_item = array($row['id'], $row['firstName'], $row['lastName'], $row['email'],
            $row['username'], $row['joiningDate']);
        array_push($users_arr["records"], $user_item);
        $num = $num - 1;
    }
} else {
    array_push($users_arr["records"], json_encode(
        array("message" => "No records found.")
    ));
}
