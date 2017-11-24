<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
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

// set user property values
if(isset($_POST["firstName"])) {
    $user->firstName = $_POST["firstName"];
}
if(isset($_POST["lastName"])) {
    $user->lastName = $_POST["lastName"];
}
if(isset($_POST["email"])) {
    $user->email = $_POST["email"];
}
if(isset($_POST["password"])) {
    $user->password = $_POST["password"];
}

#echo $user->username."    ";
echo $user->firstName."   ";
echo $user->lastName."     ";
echo $user->email."     ";
echo $user->password;

// update the user
if($user->update()){
    echo '{';
    echo '"message": "User was updated."';
    echo '}';
}
// if unable to update the user, tell the user
else{
    echo '{';
    echo '"message": "Unable to update user."';
    echo '}';
}
