<?php
session_start();

error_reporting(E_ALL); ini_set('display_errors', '1');

require 'classlib.php';

$current = new current;

$request = file_get_contents("php://input"); // gets the raw data.
$params = json_decode($request,true); // true for return as array
$params["primary_address"]["primary_address[street]"] = $params['line1']."
".$params['line2']."
".$params['line3'];
$params["primary_address"]["primary_address[city]"] = $params['town'];
$params["primary_address"]['primary_address[county]'] = $params['county'];
$params["primary_address"]['primary_address[postcode]'] = $params['postcode'];


if (!isset($params["collection"])) {
    $params["collection"] = 0;
}
if (!isset($params["delivery"])) {
    $params["delivery"] = 0;
}
if (!isset($params["agree"])) {
    $params["agree"] = 0;
}

if (!isset($_SESSION['user_id'])) {
// build the client array
    $x ="";
    $user = $current->createClientData($x);

    $client = [];
    $client["phones"] = $params["phones"];
    $client["emails"] = $params["emails"];
    $client["links"] = $params["links"];
    $client["primary_address"] = $params["primary_address"];
    $client["name"] = $params["name"];
    $client["active"] = true;
    $client["locale"] = "en-GB";
    $client["membership_type"] = "organisation";
    $client["membership"]["owned_by"] = $params["store_ids"];
    $client["custom_fields"]["web_login_password"] = $user["salted_password"];
    $client["custom_fields"]["user_salt"] = $user["user_salt"];
    $client["custom_fields"]["verification_code"] = $user["verification_code"];


    $new = json_encode($client);

    $data = '{"member":' . $new . '}';

// Send JSON encoded details to Current to Create new contact

    $result = $current->createContact($data);

// Take the JSON result from current and turn it into a PHP accessable array so that we can access the ID #

    $client = json_decode($result, true);

    // Create discussion to confirm email details and initial booking

    $client1["member_id"] = 1; // NX User ID
    $client1["mute"] = true;
    $client2["member_id"] = $client['member']['id']; // New client ID
    $client2["mute"] = false;
    $discussion["discussable_id"] = $client['member']['id']; // id of the opportunity
    $discussion["discussable_type"] = "Member";
    $discussion["subject"] = "New User Registration";
    $discussion["first_comment"]["remark"] = "Thank you for registering with us.
    
    You can login to your account using the details as follows;
    email - ".$params['emails'][0]['address']."
    Password - ".$user['password']."
    from there you can add or remove Drivers details, review previous hires and your current bookings
    
    Regards,
    
    NX Touring Ltd";

    $discussion["participants"] = [$client1, $client2];

    $query = '{"discussion":'.json_encode($discussion).'}';// Create discussion to notify booking

    $result = $current->creatediscussion($query);


} else {
    $client = $current -> getContactById($_SESSION['user_id']);
}
//Retrieve Insurance Excess Waiver Object

    $deposit = $current->getService($params['options']);

    $opportunity = [];
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
    $opportunity["customer_collecting"] =  $params["collection"];
    $opportunity["customer_returning"] =  $params["delivery"];
    $opportunity["owned_by"] = 1;

    $vehicle["opportunity_id"] = 5;
    $vehicle["item_id"] = $params["type_id"];
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


    $iewStartDate = date("Y-m-d",strtotime($params["startDate"]));
    $iewEndDate = date("Y-m-d",strtotime($params["endDate"]));

    $IEW["opportunity_id"] = 5;
    $IEW["item_id"] = $params['options']; // Insurance excess waiver ID
    $IEW["item_type"] = "Service";
    $IEW["opportunity_item_type"] = 0;
    $IEW["transaction_type"] = 3; // 1 = Rental, 2 = Sale, 3 = Service
    $IEW["accessory_inclusion_type"] = 0;
    $IEW["accessory_mode"] = 0;
    $IEW["quantity"] = 1;
    $IEW["revenue_group_id"] = null; // must be Null
    $IEW["rate_definition_id"] = 60;
    $IEW["discount_percent"] = "0.0";
    $IEW["starts_at"] = $iewStartDate;
    $IEW["ends_at"] = $iewEndDate;
    $IEW["use_chargeable_days"] = true;
    $IEW["chargeable_days"] = $params["days"];
    $IEW["sub_rent"] = false;
    $IEW["description"] = "";  
    $IEW["replacement_charge"] = "0.0";

    $driver["item_id"] = 42; // Client Drivers ID
    $driver["item_type"] = "Service";
    $driver["opportunity_item_type"] = 0;
    $driver["opportunity_id"] = 5;
    $driver["transaction_type"] = 3; // 1 = Rental, 2 = Sale, 3 = Service
    $driver["accessory_inclusion_type"] = 0;
    $driver["accessory_mode"] = 0;
    $driver["quantity"] = $params["drivers"];
    $driver["revenue_group_id"] = null; // must be Null
    $driver["rate_definition_id"] = 60;
    $driver["discount_percent"] = "0.0";
    $driver["starts_at"] = $params["startDate"];
    $driver["ends_at"] = $params["endDate"];
    $driver["use_chargeable_days"] = false;
    $driver["chargeable_days"] = $params["days"];
    $driver["sub_rent"] = false;
    $driver["description"] = "";
    $driver["replacement_charge"] = "0.0";

    $items = [$vehicle, $IEW, $driver];

// Create Json object in Current RMS accepted format

    $data = '{"opportunity":'.json_encode($opportunity).',"items":'.json_encode($items).'}';

// And send the data to Current to create the opportunity and populate it

	$result= $current->createOpportunity($data);

// Create discussion to confirm email details and initial booking

    $client1["member_id"] = 1; // NX User ID
    $client1["mute"] = false;
    $client2["member_id"] = $result["opportunity"]["member_id"]; // New client ID
    $client2["mute"] = false;
    $discussion["discussable_id"] = $result["opportunity"]["id"]; // id of the opportunity
    $discussion["discussable_type"] = "Opportunity";
    $discussion["subject"] = "New Splitter Van Booking";    
    $discussion["first_comment"]["remark"] = "Thank you for your booking.

    Start Date - ".$params["startDate"]."
    End Date - ".$params["endDate"]."
    Vehicle Type - ".$params['prod_type']."
    Total Hire Cost - ".$params['totprice'];


    $discussion["participants"] = [$client1, $client2];

    $query = '{"discussion":'.json_encode($discussion).'}';// Create discussion to notify booking

    $result = $current->creatediscussion($query);
if (!isset($_SESSION['user_id'])) {
    $response = $current->login($params['emails'][0]['address'], $user['password']); // Log new user in

    echo json_encode($response);
} else {
    echo json_encode("ok");
}
?>