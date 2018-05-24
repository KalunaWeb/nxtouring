<?php
/**
 * Created by PhpStorm.
 * User: alanluckett
 * Date: 24/05/2018
 * Time: 21:47
 */
require_once("classlib.php");

$current = new current();

$response['vehicles'] = "";

$month = $_POST['info']['month'];
$year = $_POST['info']['year'];
$headings = array('S','M','T','W','T','F','S');

$days_in_last_month = date('t',mktime(0,0,0,$month-1,1,$year))-2;
$months = date('F',mktime(0,0,0,$month,1,$year)); //month in words
$running_day = date('w',mktime(0,0,0,$month,1,$year))-2; // day position (Sun = 0 Mon = 1 etc)
$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
$days_in_this_week = 1;
$day_counter = 0;
$dates_array = array();

if ($running_day == -1) {
    $running_day = 6;
}
if ($running_day == -2) {
    $running_day = 5;
}

$response['month'] = $months;
$response['year'] = $year;
$response['days'] = $days_in_month;
$response['running_day'] = $running_day;
$response['last'] = $days_in_last_month;

$response['calendar'] = '<table cellpadding="0" cellspacing="0" class="planner"><tr class="header strip"><th class="van">Van reg</th>';

for($y=0; $y<2; $y++) {

    if ($running_day == 0 || $running_day == 6) {
        $day = "weekend";
    } else {
        $day = "days";
    }

    $response['calendar'] .= "<th class='".$day."'>".$days_in_last_month."<br>".$headings[$running_day]."</th>";
    $days_in_last_month ++;
    if ($running_day == 6) {
        $running_day = 0;
    } else {
        $running_day++;
    }
}

for($x=1; $x<=$days_in_month; $x++ ) {
    if ($running_day == 0 || $running_day == 6) {
        $day = "weekend";
    } else {
        $day = "days";
    }
    $response['calendar'] .= "<th class='".$day."'>".$x."<br>".$headings[$running_day]."</th>";
    if ($running_day == 6) {
        $running_day = 0;
    } else {
        $running_day++;
    }
}
$next_month =1;

for($y=0; $y<2; $y++) {
    if ($running_day == 0 || $running_day == 6) {
        $day = "weekend";
    } else {
        $day = "days";
    }

    $response['calendar'] .= "<th class='".$day."'>".$next_month."<br>".$headings[$running_day]."</th>";
    $next_month ++;
    if ($running_day == 6) {
        $running_day = 0;
    } else {
        $running_day++;
    }
}
$response['calendar'] .="<th></th></tr></table>";

$vehicleGroups = $current->getVehiclesList();
$vehGrp = $vehicleGroups['product_inventories'];
$v = 0;
foreach ( $vehGrp as $key => $value) { //get IDs of each vehicle group
    $vehicles[$v] = $value['id'];
    $v++;
}

foreach ($vehicles as $id) {
    $vans = $current -> getStock($id);
    foreach ($vans['stock_levels'] as $key=>$value) {
        if ($value['serial_number'] != null) {
            $response['vehicles'] .= $value['asset_number'];
        }
    }
}


echo (json_encode($response));

//echo (json_encode($response);

?>


