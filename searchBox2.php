<?php

require 'classlib.php';
require 'classes.php';
session_start();
$rms = "";
$database = new db();
$user = new Auth($database);


if(!isset($_SESSION['user_id'])) // Is user logged in
{
  $url = "newcli.php"; // No - create new user in booking

} else {

  $row = $user -> getUser($_SESSION['user_id']);

  $rms = $row['rms_id'];
  $url = "existcli.php"; // Yes, pass Users RMS id to booking
}

$current = new current;

$multiplier = [0,1,2,3,4,4,4,4,5,6,7,8,8,8,8,9,10,11,12,12,12,12,13,14,15,16,16,16,16,17,18,19,20,20,20,20,21,22,23,24,24,24,24,25,26,27,28,28,28,28,29,30,31,32,32,32,32,33,34,35,36,36,36,36,37,38,39,40,40,40,40,41,42,43,44,44,44,44,45,46,47,48,48,48,48,49,50,51,52,52,52,52,53,54,55,56,56,56,56,57,58,59,60,60,60,60];


$request = file_get_contents("php://input"); // gets the requested dates and location from index
$params = json_decode($request,true); // true for return as array
$vehicle = $current->getProduct($params["product_id"]);
$date1 = date("d-m-Y",strtotime($params["startDate"]));

$date2 = date("d-m-Y",strtotime($params["endDate"]));

$diff = abs(strtotime($date2) - strtotime($date1));
$rtnHour = date("H",strtotime($params["endDate"]));


$years   = floor($diff / (365*60*60*24));  
$months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));  
$days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
$hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60));
$minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);  
$seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60)); 

if ($rtnHour > 10) {
  $days++;
}
$hirefee = $vehicle["product"]["rental_rate"]["price"] * $multiplier[$days];

$data2 = '{
  "booking_availability_view_options": {
    "product_id": '.$params["product_id"].',
    "store_ids": [
      '.$params["location"].'
    ],
    "starts_at": "'.$params["startDate"].'",
    "days_period": '.$days.'
  }
}';


$result = $current->getProductAvailability($data2);

if ($result['product_bookings']['quantity_available'][0] != 0) {


  $response = ["available" => true, "loop"=>$params['loop_id'], "result"=>"Fantastic News!</br>We have ".$params['name']." vans available between ".$date1." and ".$date2];
} else {
  $response = ["available" => false, "loop"=>$params['loop_id'], "result"=>"Sorry! </br>We dont have any ".$params['name']." vans available between ".$date1." and ".$date2];
};
if(!isset($_SESSION['user_id'])) // Is user logged in
{
 // No - create new user in booking
  $response['buttonCode'] = '<button id="van" class="btn vanSelect" data-dismiss="modal" data-toggle="modal" data-van-id="'.$params["product_id"].'" data-van-start="'.$date1.'" data-van-end="'.$date2.'" data-van-period="'.$days.'" data-van-name="'.$params["name"].'" data-van-store="'.$params["location"].'" data-van-price="'.$hirefee.'" href="#newCliModal">Book Van</button>';


} else {
// Yes, pass Users RMS id to booking
  $row = $user -> getUser($_SESSION['user_id']);

  $rms = $row['rms_id'];

  $response['buttonCode'] = '<a class="btn btn-default btn-responsive" href="existcli.php?id='.$params["product_id"].'&start_date='.$date1.'&end_date='.$date2.'&period='.$days.'&type='.$params["name"].'&store_ids='.$params["location"].'&rms_id='.$rms.'">Book Van</a>';

}

$response['name'] = $params['name'];
$response['thumb'] = $params['thumb'];


$ret = json_encode($response);
echo $ret;

?>