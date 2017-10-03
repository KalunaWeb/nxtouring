<?php

//header("Content-Type: application/octet-stream");

$file = $_GET["file"] .".pdf";
$path = $_GET["path"];
$fullfile = $path.$file;

header("Content-Disposition: attachment; filename=" . Urlencode($file));   
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Description: File Transfer");            
header("Content-Length: " . Filesize($fullfile));
flush(); // this doesn't really matter.
$fp = fopen($fullfile, "r");
while (!feof($fp))
{
    echo fread($fp, 65536);
    flush(); // this is essential for large downloads
} 
fclose($fp);