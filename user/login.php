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
    if (empty($_POST["userName"])) {
        echo "userName is required";
    }
    else {
        $user->username = $_POST["userName"];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["password"])) {
        echo "password is required";
    }
    else {
        $user->password = $_POST["password"];
    }
}

if($user->login()){
    echo '{';
    echo '"message": "Allow access. Correct credentials."';
    echo '}';
}
else{
    echo '{';
    echo '"message": "Restrict access. Incorrect credentials."';
    echo '}';
}