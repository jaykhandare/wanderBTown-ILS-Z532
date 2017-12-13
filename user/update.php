<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';

if (isset($_POST['cancel'])){
    header('Location: ../html/profile.php');
    exit();
}
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
        $user->userName = $_POST["userName"];
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
