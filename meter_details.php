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

$monthCalendar = $_GET['month_calendar'];
list($calendarMonth, $calendarDate, $calendarYear)=explode("/", $monthCalendar);

$monthStarting = $calendarYear."-".$calendarMonth."-01";
// Creating timestamp from given date
$monthStartingTimestamp = strtotime($monthStarting);

$monthEnding   = $calendarYear."-".$calendarMonth."-".getDaysOfMonth($calendarMonth,$calendarYear);
// Creating timestamp from given date
$monthEndingTimestamp = strtotime($monthEnding);

$query="select last(value) from v where (\"d\"='10439395' AND \"f\"='KW') OR (\"d\"='10439395' AND \"f\"='KWH') AND time >  ".$monthStartingTimestamp."s AND time < ".$monthEndingTimestamp."s group by time(12h),f fill(null)";
//$query = "select last(value) from v where \"d\"='10439395' AND \"f\"='KWH' AND time > ".$monthStartingTimestamp." AND time < ".$monthEndingTimestamp;
//$query = "select last(value) from v where time > ".$monthStartingTimestamp."AND time < ".$monthEndingTimestamp;
$influxResult = $database->query($query, array("epoch"=>$seconds));
$series = $influxResult->getSeries();

echo json_encode($series);
}


if($widget_id == "dayPeakPower"){

$monthCalendar = $_GET['month_calendar'];
list($calendarMonth, $calendarDate, $calendarYear)=explode("/", $monthCalendar);

$monthStarting = $calendarYear."-".$calendarMonth."-01";
// Creating timestamp from given date
$monthStartingTimestamp = strtotime($monthStarting);

$monthEnding   = $calendarYear."-".$calendarMonth."-".getDaysOfMonth($calendarMonth,$calendarYear);
// Creating timestamp from given date
$monthEndingTimestamp = strtotime($monthEnding);


$query="select max(value) from v where \"d\"='10439395' AND \"f\"='KW' AND time >  ".$monthStartingTimestamp."s AND time < ".$monthEndingTimestamp."s group by time(30d),f fill(null)";
$influxResult = $database->query($query, array("epoch"=>$seconds));
$series = $influxResult->getSeries();

echo json_encode($series);
}

if($widget_id == "yearGen"){

$monthCalendar = $_GET['year_calendar'];
list($calendarMonth, $calendarDate, $calendarYear)=explode("/", $monthCalendar);

$monthStarting = $calendarYear."-01-01";
// Creating timestamp from given date
$monthStartingTimestamp = strtotime($monthStarting);

$monthEnding   = $calendarYear."-12-".getDaysOfMonth($calendarMonth,$calendarYear);
// Creating timestamp from given date
$monthEndingTimestamp = strtotime($monthEnding);

$query="select sum(value) from v where (\"d\"='10439395' AND \"f\"='KW') OR (\"d\"='10439395' AND \"f\"='KWH') AND time >  ".$monthStartingTimestamp."s AND time < ".$monthEndingTimestamp."s group by time(30d),f fill(null)";
//$query = "select last(value) from v where \"d\"='10439395' AND \"f\"='KWH' AND time > ".$monthStartingTimestamp." AND time < ".$monthEndingTimestamp;
//$query = "select last(value) from v where time > ".$monthStartingTimestamp."AND time < ".$monthEndingTimestamp;
$influxResult = $database->query($query, array("epoch"=>$seconds));
$series = $influxResult->getSeries();

echo json_encode($series);
}

if($widget_id == "topwidget"){

$transdate = date('m-d-Y', time());
$day = date('d');
$month = date('m');
$year = date('y');
$yearFull = date('Y');
$nextday = $day + 1;
//$tsStarting = $yearFull."-".$month."-".$day;
$tsStarting="2020-07-20";
// Creating timestamp from given date
$tsStartingTimestamp = strtotime($tsStarting);
$tsStartingTimestamp =$tsStartingTimestamp - 19800;

$tsEndingTimestamp=$tsStartingTimestamp+86400;


$query="select last(value) from v where (\"d\"='10439395' AND \"f\"='Deg_C') OR (\"d\"='10439395' AND \"f\"='Connected') OR (\"d\"='10439395' AND \"f\"='KW') OR (\"d\"='10439395' AND \"f\"='V') AND time > ".$tsStartingTimestamp."s AND time < ".$tsEndingTimestamp."s group by time(-1m),f fill(null)";
//$query = "select last(value) from v where \"d\"='10439395' AND \"f\"='KWH' AND time > ".$monthStartingTimestamp." AND time < ".$monthEndingTimestamp;
//$query = "select last(value) from v where time > ".$monthStartingTimestamp."AND time < ".$monthEndingTimestamp;
$influxResult = $database->query($query, array("epoch"=>$seconds));
$series = $influxResult->getSeries();

echo json_encode($series);
}
if($widget_id == "daywidget"){

$transdate = date('m-d-Y', time());
$day = date('d');
$month = date('m');
$year = date('y');
$yearFull = date('Y');
$nextday = $day + 1;
//$tsStarting = $yearFull."-".$month."-".$day;
$tsStarting="2020-07-20";
// Creating timestamp from given date
$tsStartingTimestamp = strtotime($tsStarting);
$tsStartingTimestamp =$tsStartingTimestamp - 19800;

$tsEndingTimestamp=$tsStartingTimestamp+86400;


$query="select last(value) from v where (\"d\"='10439395' AND \"f\"='KWH') OR (\"d\"='10439395' AND \"f\"='KW') OR (\"d\"='10439395' AND \"f\"='KW_MAX') AND time > ".$tsStartingTimestamp."s AND time < ".$tsEndingTimestamp."s group by time(-1m),f fill(null)";
//$query = "select last(value) from v where \"d\"='10439395' AND \"f\"='KWH' AND time > ".$monthStartingTimestamp." AND time < ".$monthEndingTimestamp;
//$query = "select last(value) from v where time > ".$monthStartingTimestamp."AND time < ".$monthEndingTimestamp;
$influxResult = $database->query($query, array("epoch"=>$seconds));
$series = $influxResult->getSeries();

echo json_encode($series);

}
if($widget_id == "monthwidget"){


$transdate = date('m-d-Y', time());
$day = date('d');
$month = date('m');
$year = date('y');
$yearFull = date('Y');
$nextday = $day + 1;
//$tsStarting = $yearFull."-".$month."-".$day;
$tsStarting="2020-07-20";
// Creating timestamp from given date
$tsStartingTimestamp = strtotime($tsStarting);
$tsStartingTimestamp =$tsStartingTimestamp - 19800;

$tsEndingTimestamp=$tsStartingTimestamp+86400;


$query="select last(value) from v where (\"d\"='10439395' AND \"f\"='KWH') OR (\"d\"='10439395' AND \"f\"='KW') OR (\"d\"='10439395' AND \"f\"='KW_MAX') AND time > ".$tsStartingTimestamp."s AND time < ".$tsEndingTimestamp."s group by time(-1m),f fill(null)";
//$query = "select last(value) from v where \"d\"='10439395' AND \"f\"='KWH' AND time > ".$monthStartingTimestamp." AND time < ".$monthEndingTimestamp;
//$query = "select last(value) from v where time > ".$monthStartingTimestamp."AND time < ".$monthEndingTimestamp;
$influxResult = $database->query($query, array("epoch"=>$seconds));
$series = $influxResult->getSeries();

echo json_encode($series);

}
if($widget_id == "lifetimewidget"){

$transdate = date('m-d-Y', time());
$day = date('d');
$month = date('m');
$year = date('y');
$yearFull = date('Y');
$nextday = $day + 1;
//$tsStarting = $yearFull."-".$month."-".$day;
$tsStarting="2020-07-20";
// Creating timestamp from given date
$tsStartingTimestamp = strtotime($tsStarting);
$tsStartingTimestamp =$tsStartingTimestamp - 19800;

$tsEndingTimestamp=$tsStartingTimestamp+86400;


$query="select last(value) from v where (\"d\"='10439395' AND \"f\"='KWH') OR (\"d\"='10439395' AND \"f\"='KW') AND time > ".$tsStartingTimestamp."s AND time < ".$tsEndingTimestamp."s group by time(-1m),f fill(null)";
//$query = "select last(value) from v where \"d\"='10439395' AND \"f\"='KWH' AND time > ".$monthStartingTimestamp." AND time < ".$monthEndingTimestamp;
//$query = "select last(value) from v where time > ".$monthStartingTimestamp."AND time < ".$monthEndingTimestamp;
$influxResult = $database->query($query, array("epoch"=>$seconds));
$series = $influxResult->getSeries();

echo json_encode($series);

}
if($widget_id == "yeartablewidget"){

$transdate = date('m-d-Y', time());
$day = date('d');
$month = date('m');
$year = date('y');
$yearFull = date('Y');
$nextday = $day + 1;
//$tsStarting = $yearFull."-01-01";
$tsStarting="2020-07-20";
// Creating timestamp from given date
$tsStartingTimestamp = strtotime($tsStarting);
$tsStartingTimestamp =$tsStartingTimestamp - 19800;

$tsEndingTimestamp=$tsStartingTimestamp+86400;


$query="select sum(value) from v where (\"d\"='10439395' AND \"f\"='KWH') OR (\"d\"='10439395' AND \"f\"='KW') OR (\"d\"='10439395' AND \"f\"='KW_MAX') AND time > ".$tsStartingTimestamp."s AND time < ".$tsEndingTimestamp."s group by time(-1m),f fill(null)";
//$query = "select last(value) from v where \"d\"='10439395' AND \"f\"='KWH' AND time > ".$monthStartingTimestamp." AND time < ".$monthEndingTimestamp;
//$query = "select last(value) from v where time > ".$monthStartingTimestamp."AND time < ".$monthEndingTimestamp;
$influxResult = $database->query($query, array("epoch"=>$seconds));
$series = $influxResult->getSeries();

echo json_encode($series);

}
if($widget_id == "monthtablewidget"){

$transdate = date('m-d-Y', time());
$day = date('d');
$month = date('m');
$year = date('y');
$yearFull = date('Y');
$nextday = $day + 1;
$tsStarting = $yearFull."-01-01";
//$tsStarting="2020-07-20";
// Creating timestamp from given date
$tsStartingTimestamp = strtotime($tsStarting);
$tsStartingTimestamp =$tsStartingTimestamp -19800;
 
 
//$tsEndingTimestamp=$tsStartingTimestamp+86400;


$query="select sum(value) from v where (\"d\"='10439395' AND \"f\"='KWH') OR (\"d\"='10439395' AND \"f\"='KW') OR (\"d\"='10439395' AND \"f\"='KW_MAX') AND time > ".$tsStartingTimestamp."s  group by time(30d),f fill(null)";
//$query = "select last(value) from v where \"d\"='10439395' AND \"f\"='KWH' AND time > ".$monthStartingTimestamp." AND time < ".$monthEndingTimestamp;
//$query = "select last(value) from v where time > ".$monthStartingTimestamp."AND time < ".$monthEndingTimestamp;
$influxResult = $database->query($query, array("epoch"=>$seconds));
$series = $influxResult->getSeries();

echo json_encode($series);

}
?>