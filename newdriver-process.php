<?php

require 'classlib.php';

session_start();

$current = new current;
$image = new image;
$contact = $current -> getContactById($_SESSION['user_id']);



if(isset($_FILES['profile']))
{
    $profileImage = $image->uploadImage($_FILES['profile']);

}
if(isset($_FILES['front']))
{
    $frontImage = $image->uploadImage($_FILES['profile']);

}
if(isset($_FILES['rear']))
{
    $rearImage = $image->uploadImage($_FILES['profile']);

}

$user = $current->createClientData();

$client = [];
if (isset($_POST["name"]) && $_POST["name"] != "") {
    $client["name"] = $_POST["name"];
    $client["emails"] = $_POST["emails"];

if (isset($_POST['phones'][0]['number']) && $_POST['phones'][0]['number'] !=""){
    $client["phones"] = $_POST["phones"];
}

if (isset($_POST["links"][0]["address"]) && $_POST['links'][0]['address'] !=""){
    $client["links"] = $_POST["links"];
}

if (isset($_POST["primary_address"])){
    $client["primary_address"] = $_POST["primary_address"];
    $client["primary_address"]["country_id"]=1;
}

//if (isset($profileImage)){

    $client["icon"]["image"] = "https://s3.amazonaws.com/current-rms/4c45bed0-e393-0133-e219-125c65feeb4d/icons/75/original/IMG_2819.JPG";//$profileImage;
//}
$client["bookable"] = true;
$client["active"] = true;
$client["locale"] = "en-GB";
$client["membership_type"] = "Contact";
$client["membership"]["owned_by"] = $_POST["store_ids"];
$client["custom_fields"]["web_login_password"] = $user["salted_password"];
$client["custom_fields"]["user_salt"] = $user["user_salt"];
$client["custom_fields"]["verification_code"] = $user["verification_code"];
$client["custom_fields"]["dvla_code"] = $_POST["custom_fields"]["dvla_code"];
$client["custom_fields"]["national_insurance_number"] = $_POST["custom_fields"]["national_insurance_number"];
$client["custom_fields"]["drivers_licence_number"] = $_POST["custom_fields"]["drivers_licence_number"];
//$client["custom_fields"]["date_of_birth"] = $_POST["custom_fields"]["date_of_birth"];
//$client["custom_fields"]["date_of_test"] = $_POST["custom_fields"]["date_of_test"];

//$client["service_stock_levels"]["item_id"] = 42;
//$client["service_stock_levels"]["item_type"] = "Client Drivers";
//$client["service_stock_levels"]["stock_type"] = 3;
//$client["service_stock_levels"]["stock_type_name"] = "Service";
//$client["service_stock_levels"]["stock_category"] = 60;
//$client["service_stock_levels"]["stock_category_name"] = "Resource";
//$client["parent_members"]["id"] = 110;
//$client["parent_members"]["relatable_id"] = $_POST["parent_id"];
//$client["parent_members"]["relatable_type"] = "Member";
//$client["parent_members"]["relatable_membership_type"] = "Organisation";

$new = json_encode($client);
print_r($client);
$data = '{"member":' . $new . '}';

// Send JSON encoded details to Current to Create new contact

$result = $current->createContact($data);
print_r ($result);
// Take the JSON result from current and turn it into a PHP accessable array so that we can access the ID #

/*$client = json_decode($result, true);

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

*/}
?>