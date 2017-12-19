<?php

// include database and object file
include_once '../config/database.php';
include_once '../objects/venue.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare reply object
$venue = new Venue($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["venueID"])) {
        echo "venueID is required";
    }
    else {
        $venue->venueID = $_POST["venueID"];
    }
}

// delete the reply
if($venue->delete()){
    echo '{';
    echo '"message": "venue was deleted."';
    echo '}';
}
// if unable to delete the reply
else{
    echo '{';
    echo '"message": "Unable to delete venue."';
    echo '}';
}
