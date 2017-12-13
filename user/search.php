<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';

// instantiate database and user object
$database = new Database();
$db = $database->getConnection();

// initialize object
$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["searchString"])) {
        echo "searchString is required";
    }
    else {
        $keywords = $_POST["searchString"];
    }
}
// query user
$stmt = $user->search($keywords);
$num = $stmt->rowCount();

// users array
$users_arr=array();
// check if more than 0 record found
if($num>0){
    // retrieve our table contents
    while ($num!=0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $user_item=array(
            "id" =>  $row['id'],
            "firstName" => $row['firstName'],
            "lastName" => $row['lastName'],
            "email" => $row['email'],
            "username" => $row['username'],
            "joiningDate" => $row['joiningDate']
        );
        array_push($users_arr, $user_item);
        $num = $num - 1;
    }
}
else{
    array_push($users_arr, 0);
}