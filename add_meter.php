<?php


    // Include config file
    require_once "config.php";
	
	
	
    
    // Prepare a select statement
    $sql = "SELECT * FROM meter";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        //$stmt->bindParam(":id", $param_id);
        
        // Set parameters
        //$param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                while($row = $stmt->fetchAll(PDO::FETCH_ASSOC)){
				
				$data[] = $row;
				
				}
                
				
				
                /*// Retrieve individual field value
                $sl_no = $row["sl_no"];
                $plant_name = $row["plant_name"];
                $igate_id = $row["igate_id"];
				$unit_desc = $row["unit_desc"];
                $igate_prefix = $row["igate_prefix"];
                $ip = $row["ip"];
				$broadcast_ip = $row["broadcast_ip"];
                $gateway_ip = $row["gateway_ip"];
                $unit_switch = $row["unit_switch"];
				$portal_id = $row["portal_id"];
                $portal_url = $row["portal_url"];*/
                
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                //header("location: error.php");
                //exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);
    
    
	
	
	
	
	
	
	
	
//insert command

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    /*$input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";     
    } else{
        $address = $input_address;
    }
    
    // Validate salary
    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_salary)){
        $salary_err = "Please enter a positive integer value.";
    } else{
        $salary = $input_salary;
    }*/
    
    // Check input errors before inserting in database
    //if(empty($name_err) && empty($address_err) && empty($salary_err)){
		
		
		// Prepare an insert statement
        $sql = "INSERT INTO meter (meter_id, plant_name, capacity, plant_address, city, state, zipcode, reporting_agency_name, reporting_agency_sl_no, status,org_sl_no,last_read,today_energy,month_energy,year_energy) VALUES (:meter_id, :plant_name, :capacity, :plant_address, :city, :state, :zipcode, :agency, :agencyid, :status,'0','2020-09-03 00:00:00','0','0','0')";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":plant_name", $param_plant_name);
			$stmt->bindParam(":meter_id", $param_meter_id);
            $stmt->bindParam(":capacity", $param_capacity);
			$stmt->bindParam(":city", $param_city);
			$stmt->bindParam(":zipcode", $param_zipcode);
			$stmt->bindParam(":state", $param_state);
			$stmt->bindParam(":plant_address", $param_plant_address);
			$stmt->bindParam(":agency", $param_agency);
			$stmt->bindParam(":agencyid", $param_agency_id);
			$stmt->bindParam(":status", $param_status);
			
            // Set parameters
			$param_meter_id = $_POST["meter_id"];
            $param_plant_name = $_POST["plantname"];
			$param_capacity = $_POST["capacity"];
			$param_city = $_POST["city"];
			$param_zipcode = $_POST["zipcode"];
			$param_state = $_POST["states"];
			$param_plant_address = $_POST["plantaddress"];
			$param_agency = $_POST["agency"];
			$param_agency_id = $_POST["agencyid"];
			if($_POST["status"]=='on'){
				$param_status= 1;
			}
			else{
				$param_status=0;
			}
	
			
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: add_meter.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    //}
    
 
}	
	
	// Close connection
    unset($pdo);

?>




<!DOCTYPE html>
<html lang="en">
<head>
  <title>Meter Config</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: -10px;
  left: 0;
  right: 0;
  bottom: 10px;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
</head>
<body>

<div class="container">
  <h2>Add meter</h2>
  
  
  		  <div class="row">
				  <div class="col-md-10">
				  </div>
				  <div class="col-md-2">
				  <!--<a href="index.php"><button type="button" class="btn btn-primary">Done Devices</button></a>-->
				  </div>
				  
		  </div>
		  </br>
  
  
  <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="add_igate.php">Meters</a></li>
  </ol>
</nav>
  
  
  
  
  
  
  
  
  
  <form action="" method="post" autocomplete="off">

	<table class="table table-striped">
          <tbody>
             <tr>
			 <td>
	
	<div class="form-group" >
      <label for="meterid">Meter no:</label>
      <input type="number" class="form-control" id="meterid" placeholder="Enter the number" name="meter_id" required>
    </div>
	
	<div class="form-group" >
      <label for="capacity">Capacity (kW):</label>
      <input type="text" class="form-control" id="capacity" placeholder="Enter plant capacity" name="capacity" required>
    </div>
	
	
	
	<div class="form-group" >
      <label for="city">City:</label>
      <input type="text" class="form-control" id="city" placeholder="Enter the city" name="city" required>
    </div>
	
	<div class="form-group" >
      <label for="zip">zip code:</label>
      <input type="text" class="form-control" id="zip" placeholder="Enter the zip code" name="zipcode" required>
    </div>
	
	<div class="form-group" >
      <label for="aid">Agency ID:</label>
      <input type="number" class="form-control" id="aid" placeholder="Enter the id" name="agencyid" required>
    </div>
	
	</td>
	
	<td>
	<div class="form-group">
      <label for="plantname">Plant name:</label>
      <input type="text" class="form-control" id="plantname" placeholder="Enter the name" name="plantname" required>
    </div>
	
	<div class="form-group" >
      <label for="address">Plant Address:</label>
      <input type="text" class="form-control" id="address" placeholder="Enter the plant address" name="plantaddress" required>
    </div>
	
	<div class="form-group" >
      <label for="state">State:</label>
    <select id="state" class="form-control" name="states">
      <option value="none">--select--</option>
	  <option value="IL">IL</option>
      <option value="WA">WA</option>
      <option value="MA">MA</option>
    </select>
    </div>
	
	
	
	<div class="form-group" >
      <label for="agency">Agency:</label>
    <select id="agency" class="form-control" name="agency">
	<option value="none">--select--</option>
      <option value="PATS">PATS</option>
      <option value="GATS">GATS</option>
      <option value="NEEPOOL">NEEPOOL</option>
    </select>
    </div>
	
	<div class="form-group" >
	<br>
         <br>
	<label for="toogle">Meter Status:</label>
	&nbsp;
	&nbsp;
	&nbsp;
	<label class="switch">
  <input type="checkbox" id="toogle" name="status" >
  <span class="slider round"></span>
</label>
	</div>
	
	</td>
	
	
	
	
	
	</tr>
	</tbody>
	</table>
	
	
	
	

	
	


    <button type="submit" class="btn btn-default">Add Meter</button>
  </form>
  
  </br>
  
  
  <h2>Available Meters</h2>  
  <input class="form-control" id="myInput" type="text" placeholder="Search..">
  <br>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
		<th>Meter id</th>
		<th>Plant Name</th>
		<th>Capcity(kW)</th>
		<th>Plant Address</th>
		<th>City</th>
		<th>State</th>
		<th>Zipcode</th>
		<th>Agency Name</th>
		<th>Agency ID</th>
		<th>Status</th>
		
		<th>Edit Meter</th>
		<th>Delete Meter</th>
		
      </tr>
    </thead>
    <tbody id="myTable">
      <?php foreach($data[0] as $key=>$value){ ?>
	  
	  <tr>
		
		<td><?php echo $value['meter_id'];?></td>
		<td><?php echo $value['plant_name'];?></td>
		<td><?php echo $value['capacity'];?></td>
		<td><?php echo $value['plant_address'];?></td>
		<td><?php echo $value['city'];?></td>
		<td><?php echo $value['state'];?></td>
		<td><?php echo $value['zipcode'];?></td>
		<td><?php echo $value['reporting_agency_name'];?></td>
		<td><?php echo $value['reporting_agency_sl_no'];?></td>
		<td><?php echo $value['status'];?></td>
		
		<td><a href="edit_meter.php?sl_no=<?php echo $value['sl_no'];?>">Edit</a></td>
		<td><a href="del_meter.php?sl_no=<?php echo $value['sl_no'];?>">Delete</a></td>
		
      </tr>
	  
	  <?php } ?>

	  

	  
      
      
    </tbody>
  </table>
  
  
</div>


<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  
  
  
  $("#igate_id").on("keyup", function() {
    var igate_id = $(this).val().toLowerCase();
	var series = igate_id.substring(0, 2);
	var ip_address =  igate_id.substring(2, 4);

	$("#ip").val("192.168."+series+"."+ip_address);
	$("#broadcast_ip").val("192.168."+series+"."+255);
	$("#gateway_ip").val("192.168."+series+"."+100);
	

  });
  
  
});
</script>


</body>
</html>

