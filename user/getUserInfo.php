<?php
session_start();

// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';


// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare user object
$user = new User($db);

/*if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["userName"])) {
        echo "userName is required";
    }
    else {
        $user->userName = $_POST["userName"];
    }
}*/
$user->userName = $_SESSION['userName'];

$user->getUserinfo();