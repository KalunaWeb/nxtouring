<?php

require 'classlib.php';
require 'classes.php';
session_start();
$rms = "";
$database = new db();
$user = new Auth($database);

$current = new current();

$multiplier = [0,1,2,3,4,4,4,4,5,6,7,8,8,8,8,9,10,11,12,12,12,12,13,14,15,16,16,16,16,17,18,19,20,20,20,20,21,22,23,24,24,24,24,25,26,27,28,28,28,28,29,30,31,32,32,32,32,33,34,35,36,36,36,36,37,38,39,40,40,40,40,41,42,43,44,44,44,44,45,46,47,48,48,48,48,49,50,51,52,52,52,52,53,54,55,56,56,56,56,57,58,59,60,60,60,60];


$request = file_get_contents("php://input"); // gets the requested dates and location from index
$params = json_decode($request,true); // true for return as array

//$date1 = date("l-d-F-Y",strtotime($params["startDate"]));
$date1 = date("Y-m-d H:i",strtotime($params["startDate"]));

$date2 = date("Y-m-d H:i",strtotime($params["endDate"]));

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

$data2 = '{
  "product_availability_view_options": {
    "product_group_id": 8, 
    "store_ids": ['.$params["location"].'],
    "starts_at": "'.$params["startDate"].'",
    "days_period": '.$days.',
 
    "shortages_only": false,
    "rental_sale": true,
    "include_quoted": true
  }
}';

$result = $current->getGroupAvailability($data2);
$stock =[];

//check each product for availability
foreach ($result["product_availability"] as $data) {

	$st = 1;

	foreach ($data["quantity_available"] as $stock_avail) {
		if ($stock_avail < 1) {
			$st = 0;
		}
	}
	$stock[$data["product_id"]] = $st;	
};

$count = 0;
foreach ($stock as $key=>$value) {

$result = $current->getProduct($key);

$index = $result['product']['custom_fields']['order'];

$name[$index] = $result['product']['name'];
$price[$index] = $result['product']['rental_rate']['price'];
$thumb_url[$index] = $result["product"]["icon"]["thumb_url"];
$desc1[$index] = $result['product']['custom_fields']['desc1'];
$desc2[$index] = $result['product']['custom_fields']['desc2'];
$desc3[$index] = $result['product']['custom_fields']['desc3'];
$desc4[$index] = $result['product']['custom_fields']['desc4'];
$main[$index] = $result['product']['description'];
$hirefee[$index] = $result["product"]["rental_rate"]["price"] * $multiplier[$days];
$id[$index] = $result['product']['id'];
$val[$index] = $value;
$count ++;
};

$response = '<div class="container resbox">';

$i= 1;
while ($i <= $count) {
if ($val[$i] == 1) {
$response .= '<div class="resultsBox col-md-10 col-xs-10">
<div class="row"><div class="col-md-3 col-xs-4">
<div class="pictureBox"><img src='.$thumb_url[$i].'></div>
</div>
<div class="col-md-5 col-xs-5 descBox"><h5>'.$name[$i].'</h5></br>£ '.$hirefee[$i].'.00<span class="xtraSmall"> + Vat</span></div>
<div class="col-md-2 col-xs-1 hireButtonBox">';

if(!isset($_SESSION['user_id'])) // Is user logged in
{
 // No - create new user in booking
  $response .= '<button id="van" class="btn vanSelect" data-toggle="modal" data-van-id="'.$id[$i].'" data-van-start="'.$date1.'" data-van-end="'.$date2.'" data-van-period="'.$days.'" data-van-name="'.$name[$i].'" data-van-store="'.$params["location"].'" data-van-price="'.$price[$i].'" href="#newCliModal">Book</button>';

} else {
// Yes, pass Users RMS id to booking
  $row = $current -> getContactById($_SESSION['user_id']);


  $rms = $row['rms_id'];

  $response .= '<a class="btn btn-default btn-responsive" href="existcli.php?id='.$id[$i].'&start_date='.$date1.'&end_date='.$date2.'&period='.$days.'&type='.$name[$i].'&store_ids='.$params["location"].'&price='.$price[$i].'&rms_id='.$rms.'&artist='.$params["artistName"].'">Book</a>';

}

$response .= '</div><div class="clearfix"></div>
</div></div>';
}
$i ++;
}

$ret = json_encode($response.'</div>');
echo $ret;
//
?>