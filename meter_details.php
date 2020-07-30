<?php

error_reporting(E_ERROR);
ini_set('error_reporting', E_ERROR);
ini_set("display_errors", 1);

require_once('vendor/autoload.php');
use InfluxDB\Client;
use InfluxDB\Driver\Guzzle;
use InfluxDB\Point;
$client = new Client('localhost', 8086);
$database = $client->selectDB("vision_test");

$widget_id = $_GET['widget_id'];


function getDaysOfMonth($month,$year){
	return $monthDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
}



if($widget_id == "monthGen"){

$monthCalendar = $_GET['monthCalendar'];
list($calendarMonth, $calendarDate, $calendarYear)=explode("/", $monthCalendar);

$monthStarting = $calendarYear."-".$calendarMonth."-01";
// Creating timestamp from given date
$monthStartingTimestamp = strtotime($monthStarting);

$monthEnding   = $calendarYear."-".$calendarMonth."-".getDaysOfMonth($calendarMonth,$calendarYear);
// Creating timestamp from given date
$monthEndingTimestamp = strtotime($monthEnding);

$query = "select last(value) from v where \"d\"='10439395' AND \"f\"='KWH' AND time > ".$monthStartingTimestamp." AND time < ".$monthEndingTimestamp;
//$query = "select last(value) from v where time > ".$monthStartingTimestamp."AND time < ".$monthEndingTimestamp;
$influxResult = $database->query($query, array("epoch"=>$seconds));
$series = $influxResult->getSeries();

echo json_encode($series);
}


if($widget_id == "dayPeakPower"){

$monthCalendar = $_GET['monthCalendar'];
list($calendarMonth, $calendarDate, $calendarYear)=explode("/", $monthCalendar);

$monthStarting = $calendarYear."-".$calendarMonth."-01";
// Creating timestamp from given date
$monthStartingTimestamp = strtotime($monthStarting);

$monthEnding   = $calendarYear."-".$calendarMonth."-".getDaysOfMonth($calendarMonth,$calendarYear);
// Creating timestamp from given date
$monthEndingTimestamp = strtotime($monthEnding);


$query = "select last(value) from v where time > ".$monthStartingTimestamp."AND time < ".$monthEndingTimestamp;
$influxResult = $database->query($query, array("epoch"=>$seconds));
$series = $influxResult->getSeries();

echo json_encode($series);
}


?>