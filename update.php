<?php

require 'classlib.php';

session_start();
$current = new current;

if(!isset($_SESSION['user_id']))
{
  $url = "newcli.php";

} else {

    $member = $current->getContactById($_SESSION['user_id']);

}

$request = file_get_contents("php://input"); // gets the raw data
$params = json_decode($request,true); // true for return as array


if (isset($params['icon'])){
    //$client["icon"]["image"] = base64_encode("http://www.darkelf.darktech.org/".$params["icon"]);
}
if (count($params["phones"]) < count($member["member"]["phones"])){
    foreach ($member["member"]["phones"] as $key=>$value) {
        echo $key." ";
        print_r ($value);
    }
}
//address = $member['member']['primary_address'];
/*
$address['name'] = $member['member']['primary_address']['name'];
$address['street'] = $params['primary_address']['street'];
$address['postcode'] = $params['primary_address']['postcode'];
$address['city'] = $params['primary_address']['city'];
$address['county'] = $params['primary_address']['county'];
$address['country_code'] = 1;*/

$client["name"] = $member["member"]["name"];
$client["emails"] = $params["emails"];
$client["phones"] = $params["phones"];
$client["links"] = $params["links"];
$client["primary_address"] = $params["primary_address"];
$client["description"] = $member['member']['description'];
$client["active"] = $member['member']['active'];
$client["bookable"] = $member['member']['bookable'];
$client["location_type"] = $member['member']['location_type'];
$client["locale"] = $member['member']['locale'];
$client["membership_type"] = $member['member']['membership_type'];
$client["membership"]["owned_by"] = $member['member']['membership']['owned_by'];
$client["tag_list"] = $member['member']['tag_list'];



$new = json_encode($client);

$data = '{"member":'.$new.'}';

$result = $current->updateContact($data, $_SESSION['user_id']);

print_r ($result);

?>