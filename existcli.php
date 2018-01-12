<?php

session_start();
require 'classlib.php';
require 'classes.php';

$current = new current;

if(isset($_SESSION['user_id'])) {

	$row = $current -> getContactById($_SESSION['user_id']);
//Retrive Insurance Excess Waiver Object

$deposit = $current->getService("40");

	$opportunity["store_id"] = $_GET["store_ids"];
	$opportunity["member_id"] = $_GET['rms_id'];
	$opportunity["tax_class_id"] = 1;
	$opportunity["subject"] = $_GET['artist'];
	$opportunity["starts_at"] = $_GET["start_date"];
	$opportunity["ends_at"] = $_GET["end_date"];
	$opportunity["state"] = 1;
    $opportunity["use_chargeable_days"] = true;
    $opportunity["chargeable_days"] = $_GET["period"];
    $opportunity["open_ended_rental"] =  false;
    $opportunity["invoiced"] =  false;
    $opportunity["revenue"] =  "0";
    $opportunity["customer_collecting"] =  true;
    $opportunity["customer_returning"] =  true;
    $opportunity["owned_by"] = 1;

    $vehicle["opportunity_id"] = 5;
    $vehicle["item_id"] = $_GET["id"];
    $vehicle["item_type"] = "Product";
    $vehicle["opportunity_item_type"] = 0;
    $vehicle["transaction_type"] = 1;  // 1 = Rental, 2 = Sale, 3 = Service
    $vehicle["accessory_inclusion_type"] = 0;
    $vehicle["accessory_mode"] = 0;
    $vehicle["quantity"] = 1;
    $vehicle["revenue_group_id"] = null; // Must be Null
    $vehicle["rate_definition_id"] = 60;
    $vehicle["service_rate_type"] = 0;
    $vehicle["price"] = $_GET["price"];
    $vehicle["discount_percent"] = "0.0";
    $vehicle["starts_at"] = $_GET["start_date"];
    $vehicle["ends_at"] = $_GET["end_date"];
    $vehicle["use_chargeable_days"] = true;
    $vehicle["chargeable_days"] = $_GET["period"];
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
    $IEW["starts_at"] = $_GET["start_date"];
    $IEW["ends_at"] = $_GET["end_date"];
    $IEW["use_chargeable_days"] = false;
    $IEW["chargeable_days"] = $_GET["period"];
    $IEW["sub_rent"] = false;
    $IEW["description"] = "";  
    $IEW["replacement_charge"] = "0.0";

    $items = [$vehicle, $IEW];

// Create Json object in Current RMS accepted format

    $data = '{"opportunity":'.json_encode($opportunity).',"items":'.json_encode($items).'}';

// And send the data to Current to create the opportunity and populate it

	$result= $current->createOpportunity($data); 

    $client1["member_id"] = 1; // Current User ID
    $client1["mute"] = false;
    $client2["member_id"] = $result["opportunity"]["member_id"]; // New client ID
    $client2["mute"] = false;
    $discussion["discussable_id"] = $result["opportunity"]["id"]; // id of the opportunity
    $discussion["discussable_type"] = "Opportunity";
    $discussion["subject"] = "New Splitter Van Booking";    
    $discussion["first_comment"]["remark"] = "Thank you for your booking.

    Start Date - ".$_GET["start_date"]."
    End Date - ".$_GET["end_date"]."
    Vehicle Type - ".$_GET['type']."

    Please add your driver(s) to the hire details";

    $discussion["participants"] = [$client1, $client2];

    $query = '{"discussion":'.json_encode($discussion).'}';// Create discussion to notify booking

    $result = $current->creatediscussion($query);

    echo "Thank you for your business, You will receive a confirmation email shortly";

}
    sleep(2);

    echo"<script>window.location.href = 'index.php';</script>"
?>