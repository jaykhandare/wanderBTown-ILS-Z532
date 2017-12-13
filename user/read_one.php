<?php
/*header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');*/

// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare user object
$user = new User($db);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["userID"])) {
        echo "userID is required";
    }
    else {
        $user->userID = $_POST["userID"];
    }
}

$user->userID = 1;

// read the details of user to be edited
$user->readOne();

// create array
$user_item = array($user->userID,$user->firstName,$user->lastName,$user->username,$user->email,$user->joiningDate);
