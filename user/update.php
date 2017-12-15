<?php
session_start();
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';

if (isset($_POST['cancel'])){
    header('Location: ../html/homepage.php');
    exit();
}
// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare user object
$user = new User($db);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user->userName = $_SESSION["userName"];
}


$old_user = new User($db);
$old_user->userName = $_SESSION["userName"];
$old_user->getUserInfo();


if(empty($_POST["firstName"])){
    $user->firstName = $old_user->firstName;
}
else{
    $user->firstName = $_POST['firstName'];
}

if(empty($_POST["lastName"])){
    $user->lastName = $old_user->lastName;
}
else{
    $user->lastName = $_POST['lastName'];
}

if(empty($_POST["email"])){
    $user->email = $old_user->email;
}
else{
    $user->email = $_POST['email'];
}

if(empty($_POST["password"])){
    $user->password = $old_user->password;
}
else{
    $user->password = $_POST['password'];
}


// update the user
if($user->update()){
    if($user->changePassword()){
        header('Location: ../html/profile.php');
    }
    else{
        $Message = urlencode("Same Password. Please try again.");
        header('Location: ../html/profile.php?Message='.$Message);
    }
}
// if unable to update the user, tell the user
else{
    $Message = urlencode("Database problem. Please try again.");
    header('Location: ../html/profile.php?Message='.$Message);
}
