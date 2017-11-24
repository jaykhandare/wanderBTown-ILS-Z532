<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// include database and object file
include_once '../config/database.php';
include_once '../objects/user.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare user object
$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
        echo "username is required";
    }
    else {
        $user->username = $_POST["username"];
    }
}

// delete the user
if($user->delete()){
    echo '{';
    echo '"message": "User was deleted."';
    echo '}';
}
// if unable to delete the user
else{
    echo '{';
    echo '"message": "Unable to delete user."';
    echo '}';
}
