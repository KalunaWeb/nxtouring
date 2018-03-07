<?php

require 'classlib.php';

session_start();

$current = new current;



$request = file_get_contents("php://input"); // gets the raw data
$params = json_decode($request,true); // true for return as array
$contact = $current -> getContactById($params['user_id']);

if (isset($params['icon'])) {
    if ($params["icon"] != $contact["member"]["icon"]["url"]) {
        $client["icon"]["iconable_id"] = $contact["member"]["id"];
        $client["icon"]["iconable_type"] = "Member";
        $client["icon"]["image"] = "http://www.darkelf.darktech.org/" . $params["icon"];

    }
}
// Check for deleted phone numbers
if (isset($params["phones"]) && $params["phones"] != "") {
$phone_id_array =[];

foreach ($params["phones"] as $key=>$value) {

    array_push($phone_id_array,$value["id"]);
}

$arrNum = count($phone_id_array);
// Take each current phone id and see if it's in the updated array
foreach ($contact["member"]["phones"] as $key=>$value){

    $flag = 0;
    for ($i=0; $i<$arrNum; $i++) {                  //loop through the array of id numbers
        if ($value["id"] == $phone_id_array[$i]){   //is the member id in the array

            $flag = 1;                              //If it is, flag the id to remain
        }
    }

    if ($flag != 1) {                               //If the id is no longer in the update, set conditions
        $params["phones"][$key]["id"] = $value["id"];
        $params["phones"][$key]["number"] = null;
        $params["phones"][$key]["_destroy"] = 1;
    }
}
}
if (!isset($params["phones"]) || $params["phones"] == "") {
    foreach ($contact["member"]["phones"] as $key=>$value){
        $params["phones"][$key]["id"] = $value["id"];
        $params["phones"][$key]["number"] = null;
        $params["phones"][$key]["_destroy"] = 1;
    }
}
// Check for deleted emails
if (isset($params["emails"]) && $params["emails"] != "") {

    $email_id_array = [];

    foreach ($params["emails"] as $key => $value) {

        array_push($email_id_array, $value["id"]);
    }

    $arrNum = count($email_id_array);
// Take each current email id and see if it's in the updated array
    foreach ($contact["member"]["emails"] as $key => $value) {

        $flag = 0;
        for ($i = 0; $i < $arrNum; $i++) {                  //loop through the array of id numbers
            if ($value["id"] == $email_id_array[$i]) {   //is the member id in the array

                $flag = 1;                              //If it is, flag the id to remain
            }
        }
        if ($flag != 1) {                               //If the id is no longer in the update, set conditions
            $params["emails"][$key]["id"] = $value["id"];
            $params["emails"][$key]["number"] = null;
            $params["emails"][$key]["_destroy"] = 1;
        }
    }
}

if (!isset($params["emails"]) || $params["emails"] == "") {
    foreach ($contact["member"]["emails"] as $key => $value) {
        $params["emails"][$key]["id"] = $value["id"];
        $params["emails"][$key]["number"] = null;
        $params["emails"][$key]["_destroy"] = 1;
    }
}
// Check for deleted web link addresses
if (isset($params["links"]) && $params["links"] != "") {

    $link_id_array = [];

    foreach ($params["links"] as $key => $value) {

        array_push($link_id_array, $value["id"]);
    }

    $arrNum = count($link_id_array);
// Take each current link id and see if it's in the updated array
    foreach ($contact["member"]["links"] as $key => $value) {

        $flag = 0;
        for ($i = 0; $i < $arrNum; $i++) {                  //loop through the array of id numbers
            if ($value["id"] == $link_id_array[$i]) {   //is the member id in the array

                $flag = 1;                              //If it is, flag the id to remain
            }
        }
        if ($flag != 1) {                               //If the id is no longer in the update, set conditions
            $params["links"][$key]["id"] = $value["id"];
            $params["links"][$key]["number"] = null;
            $params["links"][$key]["_destroy"] = 1;
        }
    }
}
if (isset($params["links"]) && $params["links"] != "") {
    foreach ($contact["member"]["links"] as $key => $value) {
        $params["links"][$key]["id"] = $value["id"];
        $params["links"][$key]["number"] = null;
        $params["links"][$key]["_destroy"] = 1;
    }
}
$client["name"] = $contact["member"]["name"];
if (isset($params["emails"])) {
    $client["emails"] = $params["emails"];
}
if (isset($params["phones"])) {
    $client["phones"] = $params["phones"];
}
if (isset($params["links"])) {
    $client["links"] = $params["links"];
}
if (isset($params["primary_address"])) {
    $client["primary_address"] = $params["primary_address"];
}
if (isset($params['password1']) && isset($params['password2']) && $params['password1'] === $params['password2'] && $params['password1'] !="") {

    $user = $current->createClientData($params['password1']);

    $client["custom_fields"]["web_login_password"] = $user["salted_password"];
    $client["custom_fields"]["user_salt"] = $user["user_salt"];
    $client["custom_fields"]["verification_code"] = $user["verification_code"];
}
$client["custom_fields"]["date_of_birth"] = $params["custom_fields"]['date_of_birth'];
$client["custom_fields"]["date_of_test"] = $params["custom_fields"]['date_of_test'];
$client["custom_fields"]["national_insurance_number"] = $params["custom_fields"]['national_insurance_number'];
$client["custom_fields"]["dvla_code"] = $params["custom_fields"]['dvla_code'];
$client["custom_fields"]["endorsements"] = $params["custom_fields"]['endorsements'];
$client["custom_fields"]["drivers_licence_number"] = $params["custom_fields"]['drivers_licence_number'];

$client["description"] = $contact['member']['description'];
$client["active"] = $contact['member']['active'];
$client["bookable"] = $contact['member']['bookable'];
$client["location_type"] = $contact['member']['location_type'];
$client["locale"] = $contact['member']['locale'];
$client["membership_type"] = $contact['member']['membership_type'];
if (isset($contact['member']['membership']['owned_by'])) {
    $client["membership"]["owned_by"] = $contact['member']['membership']['owned_by'];
} else {
    $client["membership"]["owned_by"] = 1;
}
$client["tag_list"] = $contact['member']['tag_list'];


$new = json_encode($client, JSON_UNESCAPED_SLASHES);

$data = '{"member":'.$new.'}';

$result = $current->updateContact($data, $_SESSION['user_id']);

echo json_encode($result);

?>
