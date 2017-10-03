<?php

require 'classlib.php';
require 'classes.php';
session_start();
$rms = "";
$database = new db();
$user = new Auth($database);


if(!isset($_SESSION['user_id']))
{
  $url = "newcli.php";

} else {

  $row = $user -> getUser($_SESSION['user_id']);

  $rms = $row['rms_id'];

}

$current = new current;

$member = $current->getMember($rms);



$request = file_get_contents("php://input"); // gets the raw data
$params = json_decode($request,true); // true for return as array
//address = $member['member']['primary_address'];

$address['name'] = $member['member']['primary_address']['name'];
$address['street'] = $params['primary_address']['street'];
$address['postcode'] = $params['primary_address']['postcode'];
$address['city'] = $params['primary_address']['city'];
$address['county'] = $params['primary_address']['county'];
$address['country_code'] = 1;

$client["name"] = $params["name"];
$client["emails"] = $params["emails"];
$client["phones"] = $params["phones"];
$client["links"] = $params["links"];
$client["primary_address"] = $address;
$client["description"] = $member['member']['description'];
$client["active"] = $member['member']['active'];
$client["bookable"] = $member['member']['bookable'];
$client["location_type"] = $member['member']['location_type'];
$client["locale"] = $member['member']['locale'];
$client["membership_type"] = $member['member']['membership_type'];
$client["membership"]["owned_by"] = $member['member']['membership']['owned_by'];
$client["tag_list"] = $member['member']['tag_list'];

print_r ($client);
$new = json_encode($client);

$data = '{"member":'.$new.'}';

$result = $current->updateContact($data, $rms);

print_r ($result);
?>