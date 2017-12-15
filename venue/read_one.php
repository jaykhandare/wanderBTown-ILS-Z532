<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/venue.php';

// instantiate database and reply object
$database = new Database();
$db = $database->getConnection();

// initialize object
$venue = new Venue($db);

if (isset($_GET['name'])) {
    $venue->venueName = $_GET['name'];
}
$stmt = $venue->readOne();

$venue_item = array($user->userID,$user->firstName,$user->lastName,$user->username,$user->email,$user->joiningDate);
