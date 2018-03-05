<?php
session_start();
require_once("classlib.php");
$response = [];
if(isset($_SESSION['user_id'])) {
    $response['status'] = "success";
    echo json_encode($response);
} else {

    $current = new current;

// If email is set, send it to Current
    if (isset($_POST['emails'][0]['address'])) {

        $type = "work_email_address_or_identity_email_cont";

        $name = $current->getContact($_POST['emails'][0]['address'], $type);
        if ($name['meta']['total_row_count'] != 0) {

            foreach ($name['members'] as $key) {
                if ($key['membership_type'] == "Organisation") {
                    $response['error'] = "Email address already exists - Please Log in.";
                } else {
                    if ($key['membership_type'] == "Contact") {
                        $response['code'] = $key['id'];
                        $response['name'] = $key['name'];
                    }
                }
            }
        } else {
            $response['status'] = "success";
        }

        echo json_encode($response);

    }
}

?>