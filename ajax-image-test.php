<?php


require 'classlib.php';

session_start();

$current = new current;
$image = new image;
$contact = $current -> getContactById(345);

$client["name"] = $contact["member"]["name"];
//$client["emails"] = $params["emails"];
//$client["phones"] = $params["phones"];
//$client["links"] = $params["links"];
//$client["primary_address"] = $params["primary_address"];
$client["description"] = $contact['member']['description'];
$client["active"] = $contact['member']['active'];
$client["bookable"] = $contact['member']['bookable'];
$client["location_type"] = $contact['member']['location_type'];
$client["locale"] = $contact['member']['locale'];
$client["membership_type"] = $contact['member']['membership_type'];
$client["membership"]["owned_by"] = 1;
$client["tag_list"] = $contact['member']['tag_list'];
//$client["parent_members"]["relatable_id"] = 330;
//$client["parent_members"]["relatable_type"] = "Member";
//$client["parent_members"]["relatable_membership_type"] = "Organisation";
//$client["parent_members"]["related_id"] = 345;
//$client["parent_members"]["related_type"] = "Member";

$client["service_stock_levels"]["item_id"] = 42;
$client["service_stock_levels"]["member_id"] = 345;


$new = json_encode($client);

$data = '{"member":'.$new.'}';
print_r ($client);
$result = $current->updateContact($data, 345);

print_r ($result);

?>
