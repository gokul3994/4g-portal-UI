<?php

error_reporting(E_ERROR);
ini_set('error_reporting', E_ERROR);
ini_set("display_errors", 1);

// Include config file
require_once "config.php";

require_once('vendor/autoload.php');
use InfluxDB\Client;
use InfluxDB\Driver\Guzzle;
use InfluxDB\Point;
$client = new Client('localhost', 8086);
$database = $client->selectDB("vision_test");




		/*
		
		// Prepare an insert statement
        $sql = "INSERT INTO igate (plant_name, igate_id, unit_desc, igate_prefix, ip, broadcast_ip, gateway_ip, unit_switch, portal_id, portal_url) VALUES (:plant_name, :igate_id, :unit_desc, :igate_prefix, :ip, :broadcast_ip, :gateway_ip, :unit_switch, :portal_id, :portal_url)";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":plant_name", $param_plant_name);

			
			
            // Set parameters
            $param_plant_name = $_POST["plant_name"];

            
            // Attempt to execute the prepared statement
            if($stmt->execute()){

            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    //}
    
 
	
	
	// Close connection
    unset($pdo);

*/
    


















$widget_id = $_GET['widget_id'];

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


$query="select last(value) from v where (\"d\"='10439395' AND \"f\"='KWH') OR (\"d\"='10439395' AND \"f\"='KW') OR (\"d\"='10439395' AND \"f\"='KW_MAX') AND time > ".$tsStartingTimestamp."s AND time < ".$tsEndingTimestamp."s group by time(1d),d,f fill(null)";

$influxResult = $database->query($query, array("epoch"=>$seconds));
$series = $influxResult->getSeries();

echo json_encode($series);
foreach ($series as $key => $value) {
	//$mysqlPoints[] = $value['values'][0][1];
	
			// Prepare an insert statement
        $sql = "UPDATE meter SET today_energy = :today_energy WHERE meter_id = :meter_id";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":meter_id", $meter_id);
            $stmt->bindParam(":today_energy", $today_energy);
            $meter_id     = $value['tags']['d'];
			$today_energy = $value['values'][0][1];


            
            // Attempt to execute the prepared statement
            if($stmt->execute()){

            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    //}
    
 
	
	
	
}


echo $meter_id."***".$today_energy;

}


// Close connection
    unset($pdo);


?>