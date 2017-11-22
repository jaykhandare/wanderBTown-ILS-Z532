<?php
/**
 * Created by PhpStorm.
 * User: jkhandar
 * Date: 11/21/17
 * Time: 7:12 PM
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');


echo $_GET['name'];

echo "Hello";