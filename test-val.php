<?php


include 'classlib.php';

$current = new current;

// If Name is set, send name to Current

    $client = str_replace(' ', '%20', $_POST['name']);

    $type = "name_matches";

    $name = $current->getContact($client, $type);

// If there is a result then name already exists

    if ($name['meta']['total_row_count'] != 0 ){

      echo json_encode("Name already exists. Please Log In");

    } else {
      echo json_encode("true");
  }



?>