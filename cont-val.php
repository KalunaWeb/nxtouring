<?php
/**
 * Created by PhpStorm.
 * User: alanluckett
 * Date: 02/02/2018
 * Time: 23:26
 */
if (isset($_POST) && $_POST['cont_val'] == $_POST['number_one'] + $_POST['number_two']) {
    echo json_encode("true");
} else {
    echo json_encode("Incorrect Answer");
}

?>