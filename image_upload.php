<?php
/**
 * Created by PhpStorm.
 * User: alanluckett
 * Date: 08/02/2018
 * Time: 01:48
 */

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp'); // valid extensions
$path = 'uploads/'; // upload directory

function correctImageOrientation($filename) {
    if (function_exists('exif_read_data')) {
        $exif = exif_read_data($filename);
        if($exif && isset($exif['Orientation'])) {
            $orientation = $exif['Orientation'];
            if($orientation != 1){
                $img = imagecreatefromjpeg($filename);
                $deg = 0;
                switch ($orientation) {
                    case 3:
                        $deg = 180;
                        break;
                    case 6:
                        $deg = 270;
                        break;
                    case 8:
                        $deg = 90;
                        break;
                }
                if ($deg) {
                    $img = imagerotate($img, $deg, 0);
                }
                // then rewrite the rotated image back to the disk as $filename
                imagejpeg($img, $filename, 95);
            } // if there is some rotation necessary
        } // if have the exif orientation info
    } // if function exists
}

if(isset($_FILES['image']))
{
    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    // get uploaded file's extension
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

    // can upload same image using rand function
    $final_image = rand(1000,1000000).$img;

    // check's valid format
    if(in_array($ext, $valid_extensions))
    {
        $path = $path.strtolower($final_image);

        if(move_uploaded_file($tmp,$path))
        {
            correctImageOrientation($path);
            echo "<img src='$path' height='140px' /><a href=\"#\" type=\"submit\" class=\"btn uploadBtn\" id=\"uploadBtn\" data-target=\"#uploadModal\" role=\"button\" data-toggle=\"modal\">Change Image</a>";
        }
    }
    else
    {
        echo 'invalid file';
    }
}

?>