<?php

// include database and object files
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

// set reply property values
if(isset($_POST["details"])&&isset($_POST["contact"])) {
    $venue->details = $_POST["details"];
    $venue->contact = $_POST["contact"];
}

// update the reply
if($venue->update()){
    echo '{';
    echo '"message": "venue was updated."';
    echo '}';
}
// if unable to update the reply, tell the user
else{
    echo '{';
    echo '"message": "Unable to update venue."';
    echo '}';
}
