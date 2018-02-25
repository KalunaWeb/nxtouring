<?php
/**
 * Created by PhpStorm.
 * User: alanluckett
 * Date: 08/02/2018
 * Time: 01:48
 */
require_once 'classlib.php';
$image = new image;
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp'); // valid extensions
$path = 'uploads/'; // upload directory


$image_url = $image->uploadImage($_FILES['image']);

echo $image_url;

?>