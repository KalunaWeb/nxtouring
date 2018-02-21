<?php

require 'classlib.php';

session_start();
$_SESSION['user_id']=330;
$current = new current;

$contact = $current -> getContactById($_SESSION['user_id']);

$request = file_get_contents("php://input"); // gets the raw data
$params = json_decode($request,true); // true for return as array


/*if (isset($params['icon'])){
    $client["icon"]["url"] = "http://www.darkelf.darktech.org/".$params["icon"]);
}*/
// Check for deleted phone numbers

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

// Check for deleted emails

$email_id_array =[];

foreach ($params["emails"] as $key=>$value) {

    array_push($email_id_array,$value["id"]);
}

$arrNum = count($email_id_array);
// Take each current email id and see if it's in the updated array
foreach ($contact["member"]["emails"] as $key=>$value){

    $flag = 0;
    for ($i=0; $i<$arrNum; $i++) {                  //loop through the array of id numbers
        if ($value["id"] == $email_id_array[$i]){   //is the member id in the array

            $flag = 1;                              //If it is, flag the id to remain
        }
    }
    if ($flag != 1) {                               //If the id is no longer in the update, set conditions
        $params["emails"][$key]["id"] = $value["id"];
        $params["emails"][$key]["number"] = null;
        $params["emails"][$key]["_destroy"] = 1;
    }
}

// Check for deleted web link addresses

$link_id_array =[];

foreach ($params["links"] as $key=>$value) {

    array_push($link_id_array,$value["id"]);
}

$arrNum = count($link_id_array);
// Take each current link id and see if it's in the updated array
foreach ($contact["member"]["links"] as $key=>$value){

    $flag = 0;
    for ($i=0; $i<$arrNum; $i++) {                  //loop through the array of id numbers
        if ($value["id"] == $link_id_array[$i]){   //is the member id in the array

            $flag = 1;                              //If it is, flag the id to remain
        }
    }
    if ($flag != 1) {                               //If the id is no longer in the update, set conditions
        $params["links"][$key]["id"] = $value["id"];
        $params["links"][$key]["number"] = null;
        $params["links"][$key]["_destroy"] = 1;
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

$client["name"] = $contact["member"]["name"];
$client["emails"] = $params["emails"];
$client["phones"] = $params["phones"];
$client["links"] = $params["links"];
$client["primary_address"] = $params["primary_address"];
$client["description"] = $contact['member']['description'];
$client["active"] = $contact['member']['active'];
$client["bookable"] = $contact['member']['bookable'];
$client["location_type"] = $contact['member']['location_type'];
$client["locale"] = $contact['member']['locale'];
$client["membership_type"] = $contact['member']['membership_type'];
$client["membership"]["owned_by"] = $contact['member']['membership']['owned_by'];
$client["tag_list"] = $contact['member']['tag_list'];


$new = json_encode($client);

$data = '{"member":'.$new.'}';

$result = $current->updateContact($data, $_SESSION['user_id']);

print_r ($result);

?>