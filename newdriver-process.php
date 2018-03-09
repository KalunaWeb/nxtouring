<?php

require 'classlib.php';

session_start();

$current = new current;
$image = new image;
$contact = $current -> getContactById($_SESSION['user_id']);
$main_url = "http://darkelf.darktech.org/";
$flag=0;
$email = str_replace(' ', '%20', $_POST['emails'][0]['address']);

$type = "work_email_address_or_identity_email_matches";

$name = $current->getContact($email, $type);
$count = count($name['members']);

for ($i=0; $i<$count; $i++) {
    foreach ($name['members'] as $key=>$value) {

        if ($_POST['emails'][0]['address'] == $value['emails'][0]['address'] && $value['membership_type'] == "Contact") {
            $flag=1;
            $id = $value['id'];
        }
    }
}

// If there is a result then name already exists

if ($flag != 0) {

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
    $client["child_members"][0]["relatable_id"] = $_SESSION['user_id'];//organisation
    $client["child_members"][0]["relatable_type"] = "Member";
    $client["child_members"][0]["related_id"] = $id;//contact
    $client["child_members"][0]["related_type"] = "Member";

    $new = json_encode($client, JSON_UNESCAPED_SLASHES);

    $data = '{"member":'.$new.'}';

    $result = $current->updateContact($data, $_SESSION['user_id']);

    echo json_encode($result);

} else {



    if(isset($_FILES['profile']))
    {
        $profileImage = $image->uploadImage($_FILES['profile']);

    }



    $user = $current->createClientData("");

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

        //$client["icon"]["image"] = $profileImage;//$profileImage;
    //}
    $client["bookable"] = true;
    $client["active"] = false;
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

    $client["service_stock_levels"][0]["item_id"] = 42;
    $client["service_stock_levels"][0]["store_id"] = 1;
    $client["service_stock_levels"][0]["starts_at"] = "";
    $client["service_stock_levels"][0]["ends_at"] = "";

    $client["parent_members"][0]["relatable_id"] = $_POST["parent_id"];
    $client["parent_members"][0]["relatable_type"] = "Member";
    //$client["parent_members"]["relatable_membership_type"] = "Organisation";

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
    $discussion["first_comment"]["remark"] = "Hi ".$client['member']['name'].",
        You have been registered by ".$contact['member']['name']." as a driver on their account.
        
        Please login to your profile here - www.nxtouring.co.uk and check through / amend your details.
        
        We will need a scan of the front and rear of your driving licence, your DVLA code or NI Number as well as your usual contact details in order to get you approved as a driver.
        
        You can login to your account using the details as follows;
        email - ".$client['member']['emails'][0]['address']."
        Password - ".$user['password']."
        
        Regards,
        
        NX Touring Ltd";

    $discussion["participants"] = [$client1, $client2];

    $query = '{"discussion":'.json_encode($discussion).'}';// Create discussion to notify booking

    $result = $current->creatediscussion($query);

    echo json_encode($result);

    // Add licences to the New drivers profile
        if(isset($_FILES['front']))
        {
            $frontImage = $image->uploadImage($_FILES['front']);
            $attachment2['attachable_id'] = $client['member']['id'];
            $attachment2['attachable_type'] = "Member";
            $attachment2['name'] = "Drivers Licence Front Scan";
            $attachment2['description'] = "";
            $attachment2['attachment_link_url'] = $main_url . $frontImage;
            $attachment2['attachment'] = "";

            $term = json_encode($attachment2, JSON_UNESCAPED_SLASHES);

            $data = '{"attachment":' . $term . '}';
            $attach = $current->createAttachment($data);

        }

        if(isset($_FILES['rear']))
        {
            $rearImage = $image->uploadImage($_FILES['rear']);
            $attachment1['attachable_id'] = $client['member']['id'];
            $attachment1['attachable_type'] = "Member";
            $attachment1['name'] = "Drivers Licence Rear Scan";
            $attachment1['description'] = "";
            $attachment1['attachment_link_url'] = $main_url . $rearImage;
            $attachment1['attachment'] = "";

            $term = json_encode($attachment1, JSON_UNESCAPED_SLASHES);

            $data = '{"attachment":' . $term . '}';
            $attach = $current->createAttachment($data);

            echo json_encode($attach);

        }
    }
}
?>