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

if($user->getUserinfo()){
// create array
    $user_arr = array(
        "id" =>  $user->id,
        "firstName" => $user->firstName,
        "lastName" => $user->lastName,
        "email" => $user->email,
        "joiningDate" => $user->joiningDate,
    );

// make it json format
    print_r(json_encode($user_arr));
}
else{
    echo json_encode(
        array("message" => "No records found.")
    );
}