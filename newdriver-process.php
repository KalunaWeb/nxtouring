<?php

require 'classlib.php';

session_start();

$current = new current;

$contact = $current -> getContactById($_SESSION['user_id']);

$request = file_get_contents("php://input"); // gets the raw data
$params = json_decode($request,true); // true for return as array

print_r($params);

?>