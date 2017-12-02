<?php
session_start();

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate user object
include_once '../objects/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if($_SERVER["REQUEST_METHOD"]!="POST") {
    echo '{';
    echo '"message": "POST method not used"';
    echo '}';
    exit();
}

// set user property values
$user->firstName = $_POST["firstName"];
$user->lastName = $_POST["lastName"];
$user->username = $_POST["username"];
$user->email = $_POST["email"];
$user->password = $_POST["password"];

$_SESSION['username'] = $user->username;

/*
// get posted data
$data = json_decode(file_get_contents("php://input"));

// set user property values
$user->firstName = $data->firstName;
$user->lastName = $data->lastName;
$user->username = $data->username;
$user->email = $data->email;
$user->password = $data->password;
$user->interest1 = $data->interest1;
$user->interest2 = $data->interest2;
$user->interest3 = $data->interest3;
*/

// create the user
if($user->create()){
    echo '{';
    echo '"message": "User was added."';
    echo '}';
}
// if unable to create the user, tell the user
else{
    echo '{';
    echo '"message": "Unable to add the user."';
    echo '}';
}
