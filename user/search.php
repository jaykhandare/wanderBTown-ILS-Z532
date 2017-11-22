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
$product = new Product($db);

// get keywords
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";

// query user
$stmt = $product->search($keywords);
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // users array
    $users_arr=array();
    $users_arr["records"]=array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $user_item=array(
            "id" => $id,
            "firstName" => $firstName,
            "lastName" => $lastName,
            "email" => $email,
            "username" => $username,
            "joiningDate" => $joiningDate,
        );

        array_push($users_arr["records"], $user_item);
    }

    echo json_encode($users_arr);
}

else{
    echo json_encode(
        array("message" => "No records found.")
    );
}
