<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare user object
$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["id"])) {
        echo "id is required";
    }
    else {
        $user->id = $_POST["id"];
    }
}

// read the details of user to be edited
$user->readOne();

// create array
$user_arr = array(
    "id" =>  $user->id,
    "firstName" => $user->firstName,
    "lastName" => $user->lastName,
    "email" => $user->email,
    "username" => $user->username,
    "joiningDate" => $user->joiningDate,
);
// make it json format
print_r(json_encode($user_arr));
