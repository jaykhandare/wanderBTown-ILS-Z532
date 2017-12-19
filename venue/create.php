<?php
session_start();

// get database connection
include_once '../config/database.php';

// instantiate reply object
include_once '../objects/venue.php';

$database = new Database();
$db = $database->getConnection();

$venue = new Venue($db);

if($_SERVER["REQUEST_METHOD"]!="POST") {
    echo '{';
    echo '"message": "POST method not used"';
    echo '}';
    exit();
}

// set reply property values
$venue->details = $_POST["details"];
$venue->contact = $_POST["contact"];


// create the reply
if($venue->create()){
    echo '{';
    echo '"message": "Venue was added."';
    echo '}';
}
// if unable to create the reply, tell the user
else{
    echo '{';
    echo '"message": "Unable to add the Venue."';
    echo '}';
}
