<?php

require 'classlib.php';
require 'classes.php';

$current = new current;
$db = new db();
$user = new Auth($db);
$characters ='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$password ='';

for ($p=0; $p<8; $p++) {
    $password .= $characters[mt_rand(0,strlen($characters)-1)];
}

$client =[];
$opportunity = [];

$request = file_get_contents("php://input"); // gets the raw data.
$params = json_decode($request,true); // true for return as array

// build the client array

$client["name"] = $params["name"];
$client["emails"] = $params["emails"];
$client["phones"] = $params["phones"];
$client["links"] = $params["links"];
$client["primary_address"] = $params["primary_address"];
$client["description"] = $params["description"];
$client["active"] = $params["active"];
$client["locale"] = $params["locale"];
$client["membership_type"] = $params["membership_type"];
$client["membership"]["owned_by"] = $params["store_ids"];

$new = json_encode($client);

$data = '{"member":'.$new.'}';   

//Retrive Insurance Excess Waiver Object

$deposit = $current->getService("40");

// Send JSON encoded details to Current to Create new contact 

$result = $current->createContact($data);

// Take the JSON result from current and turn it into a PHP accessable array so that we can access the ID #

$client = json_decode($result,true);

	$opportunity["store_id"] = $params["store_ids"];
	$opportunity["member_id"] = $client["member"]["id"];
	$opportunity["tax_class_id"] = 1;
	$opportunity["subject"] = $params["artist"];
	$opportunity["starts_at"] = $params["startDate"];
	$opportunity["ends_at"] = $params["endDate"];
	$opportunity["state"] = 1;
    $opportunity["use_chargeable_days"] = true;
    $opportunity["chargeable_days"] = $params["days"];
    $opportunity["open_ended_rental"] =  false;
    $opportunity["invoiced"] =  false;
    $opportunity["revenue"] =  "0";
    $opportunity["customer_collecting"] =  true;
    $opportunity["customer_returning"] =  true;
    $opportunity["owned_by"] = 1;

    $vehicle["opportunity_id"] = 5;
    $vehicle["item_id"] = $params["product_id"];
    $vehicle["item_type"] = "Product";
    $vehicle["opportunity_item_type"] = 0;
    $vehicle["transaction_type"] = 1;  // 1 = Rental, 2 = Sale, 3 = Service
    $vehicle["accessory_inclusion_type"] = 0;
    $vehicle["accessory_mode"] = 0;
    $vehicle["quantity"] = 1;
    $vehicle["revenue_group_id"] = null; // Must be Null
    $vehicle["rate_definition_id"] = 60;
    $vehicle["service_rate_type"] = 0;
    $vehicle["price"] = $params["price"];
    $vehicle["discount_percent"] = "0.0";
    $vehicle["starts_at"] = $params["startDate"];
    $vehicle["ends_at"] = $params["endDate"];
    $vehicle["use_chargeable_days"] = true;
    $vehicle["chargeable_days"] = $params["days"];
    $vehicle["sub_rent"] = false;
    $vehicle["description"] = "";  
    $vehicle["replacement_charge"] = "0.0";


    $IEW["opportunity_id"] = 5;
    $IEW["item_id"] = 40; // Insurance excess waiver ID
    $IEW["item_type"] = "Service";
    $IEW["opportunity_item_type"] = 0;
    $IEW["transaction_type"] = 3; // 1 = Rental, 2 = Sale, 3 = Service
    $IEW["accessory_inclusion_type"] = 0;
    $IEW["accessory_mode"] = 0;
    $IEW["quantity"] = 1;
    $IEW["revenue_group_id"] = null; // must be Null
    $IEW["rate_definition_id"] = 60;
    $IEW["price"] = $deposit["service"]["day_price"];
    $IEW["discount_percent"] = "0.0";
    $IEW["starts_at"] = $params["startDate"];
    $IEW["ends_at"] = $params["endDate"];
    $IEW["use_chargeable_days"] = false;
    $IEW["chargeable_days"] = $params["days"];
    $IEW["sub_rent"] = false;
    $IEW["description"] = "";  
    $IEW["replacement_charge"] = "0.0";

    $items = [$vehicle, $IEW];

// Create Json object in Current RMS accepted format

    $data = '{"opportunity":'.json_encode($opportunity).',"items":'.json_encode($items).'}';

// And send the data to Current to create the opportunity and populate it

	$result= $current->createOpportunity($data); 

// Create User in NX database

    $user -> createUser($params['name'], $params['emails'][0]['address'], $password, $result["opportunity"]["member_id"]);

    $client1["member_id"] = 1; // Current User ID
    $client1["mute"] = false;
    $client2["member_id"] = $result["opportunity"]["member_id"]; // New client ID
    $client2["mute"] = false;
    $discussion["discussable_id"] = $result["opportunity"]["id"]; // id of the opportunity
    $discussion["discussable_type"] = "Opportunity";
    $discussion["subject"] = "New Splitter Van Booking";    
    $discussion["first_comment"]["remark"] = "Thank you for your booking.

    Start Date - ".$params["startDate"]."
    End Date - ".$params["endDate"]."
    Vehicle Type - ".$params['product_type']."

    You can login to your account using the details as follows;
    email - ".$params['emails'][0]['address']."
    Password - ".$password."
    from there you can add Driver details, review previous hires and your current bookings";

    $discussion["participants"] = [$client1, $client2];

    $query = '{"discussion":'.json_encode($discussion).'}';// Create discussion to notify booking

    $result = $current->creatediscussion($query);

    $response = $user -> login($params['emails'][0]['address'], $password); // Log new user in

    echo json_encode($response);
?>