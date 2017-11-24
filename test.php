<?php
/**
 * Created by PhpStorm.
 * User: jkhandar
 * Date: 11/21/17
 * Time: 7:12 PM
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

echo "HIT";

echo 'Hello ' . htmlspecialchars($_POST["name"]) . '!';

//          http://localhost/wanderBTown-ILS-Z532/test.php

//          Content-Type: application/json
