<?php


$request = file_get_contents("php://input"); // gets the raw data.
$params = json_decode($request,true); // true for return as array

require_once("classlib.php");


$current = new current;
// build the client array

$client1["member_id"] = 1; // Current User ID
$client1["mute"] = false;
$discussion["discussable_id"] = 1; // id of the opportunity
$discussion["discussable_type"] = "Member";
$discussion["subject"] = "General Web Enquiry";
$discussion["first_comment"]["remark"] = $params['cont_name'] . " from " .$params['cont_mail']. "
Sent
" . $params['con_msg'];

$discussion["participants"] = [$client1];

$query = '{"discussion":'.json_encode($discussion).'}';// Create discussion

$result = $current->creatediscussion($query);

echo json_encode($result);
?>