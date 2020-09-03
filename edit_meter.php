<?php


    // Include config file
    require_once "config.php";
	
	
	
    
    // Prepare a select statement
    $sql = "SELECT * FROM meter where sl_no=".$_GET['sl_no'];
    
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
				
				$meter_id = $row[0]['meter_id'];
				$status=$row[0]['status'];
				
				
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
        $sql = "UPDATE meter SET plant_name=:plant_name, meter_id=:meter_id, capacity=:capacity, city=:city, zipcode=:zipcode, state=:state, plant_address=:plant_address, reporting_agency_name=:agency, reporting_agency_sl_no=:agencyid, status=:status WHERE sl_no=:sl_no";
		
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":plant_name", $param_plant_name, PDO::PARAM_STR);
			$stmt->bindParam(":meter_id", $param_meter_id);
            $stmt->bindParam(":capacity", $param_capacity);
			$stmt->bindParam(":city", $param_city);
			$stmt->bindParam(":state", $param_state);
			$stmt->bindParam(":plant_address", $param_plant_address);
			$stmt->bindParam(":agency", $param_agency);
			$stmt->bindParam(":agencyid", $param_agency_id);
			$stmt->bindParam(":status", $param_status);
			$stmt->bindParam(":sl_no", $param_sl_no);
			$stmt->bindParam(":zipcode", $param_zipcode);
			print_r($_POST);
            // Set parameters
			
            $param_plant_name = $_POST["plantname"];
			$param_meter_id = $_POST["meter_id"];
			$param_capacity = $_POST["capacity"];
			$param_city = $_POST["city"];
			$param_zipcode = $_POST["zipcode"];
			$param_state = $_POST["states"];
			$param_plant_address = $_POST["plantaddress"];
			$param_agency = $_POST["agency"];
			$param_agency_id = $_POST["agencyid"];
			if($_POST["status"]=='0'){
				$param_status= '1';
			}
			if(!isset($_POST["status"])){
				$param_status='0';
				}
			echo $param_status;
	    $param_sl_no = $_GET["sl_no"];
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
  <h2>Edit Meter</h2>
  
  <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="add_meter.php">Meters</a></li>
	<li class="breadcrumb-item">Edit meter</li>
	<li class="breadcrumb-item"><?php echo $meter_id; ?></li>
	
  </ol>
</nav>
  
  
  
  
  
  
  <?php foreach($data[0] as $key=>$value){ ?>
  
  
  <form action="" method="post">

	<table class="table table-striped">
          <tbody>
             <tr>
			 <td>
	
	<div class="form-group" >
      <label for="meterid">Meter no:</label>
      <input type="number" class="form-control" id="meterid" placeholder="Enter the number" name="meter_id" value="<?php echo $value['meter_id']; ?>">
    </div>
	
	<div class="form-group" >
      <label for="capacity">Capacity (kW):</label>
      <input type="text" class="form-control" id="capacity" placeholder="Enter plant capacity" name="capacity" value="<?php echo $value['capacity']; ?>">
    </div>
	
	
	
	<div class="form-group" >
      <label for="city">City:</label>
      <input type="text" class="form-control" id="city" placeholder="Enter the city" name="city" value="<?php echo $value['city']; ?>">
    </div>
	
	<div class="form-group" >
      <label for="zip">zip code:</label>
      <input type="text" class="form-control" id="zip" placeholder="Enter the zip code" name="zipcode" value="<?php echo $value['zipcode']; ?>">
    </div>
	
	<div class="form-group" >
      <label for="aid">Agency ID:</label>
      <input type="number" class="form-control" id="aid" placeholder="Enter the id" name="agencyid" value="<?php echo $value['reporting_agency_sl_no']; ?>">
    </div>
	
	</td>
	
	<td>
	<div class="form-group">
      <label for="plantname">Plant name:</label>
      <input type="text" class="form-control" id="plantname" placeholder="Enter the name" name="plantname" value="<?php echo $value['plant_name']; ?>">
    </div>
	
	<div class="form-group" >
      <label for="address">Plant Address:</label>
      <input type="text" class="form-control" id="address" placeholder="Enter the plant address" name="plantaddress" value="<?php echo $value['plant_address']; ?>">
    </div>
	
	<div class="form-group" >
      <label for="state">State:</label>
    <select id="state" class="form-control" name="states" id="states" value="<?php echo $value
	['state']; ?>" >
      <option value="<?php echo $value
	['state']; ?>"><?php echo $value
	['state']; ?></option>
	  <option value="IL">IL</option>
      <option value="WA">WA</option>
      <option value="MA">MA</option>
    </select>
    </div>
	
	
	
	<div class="form-group" >
      <label for="agency">Agency:</label>
    <select id="agency" class="form-control" name="agency" value="<?php echo $value
	['reporting_agency_name']; ?>">
	<option value="<?php echo $value
	['reporting_agency_name']; ?>"><?php echo $value
	['reporting_agency_name']; ?></option>
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
  <input type="checkbox" checked id="toogle" name="status" value="<?php echo $status;?>">
  <span class="slider round"></span>
</label>
	</div>
	
	</td>
	
	
	
	
	
	</tr>
	</tbody>
	</table>
	
  <button type="submit" class="btn btn-default">Edit Meter</button>
  </form>

  
  <?php } ?>
  </br>
  
  
</div>
<script>
      var a=document.getElementById("toogle").value;
	  
	  if(a=='1')
	  {
		  
		  document.getElementById("toogle").checked=true;
	  }
	  else{
		  
		   document.getElementById("toogle").checked=false;
	  }
	  
</script>

</body>

</html>

