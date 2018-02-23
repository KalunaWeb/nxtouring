<?php
session_start();
require_once("classlib.php");
$flag=0;
    $current = new current;

// If Name is set, send name to Current

    $client = str_replace(' ', '%20', $_POST['name']);

    $type = "name_matches";

    $name = $current->getContact($client, $type);
    $count = count($name['members']);

    for ($i=0; $i<$count; $i++) {
        foreach ($name['members'][$i]['emails'] as $key=>$value) {
           if ($value['address'] == $_POST['emails'][0]['address']) {
               $flag=1;
           }
        }
    }

// If there is a result then name already exists

    if ($flag != 0) {

        echo json_encode($_POST['name']." already exists.");

    } else {
        echo json_encode("true");
    }



?>