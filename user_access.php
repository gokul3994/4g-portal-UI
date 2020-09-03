<?php


    // Include config file
    require_once "config.php";
	
	
	
    
    // Prepare a select statement
    $sql = "SELECT * FROM user";
    
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
        $sql = "Insert into user (login, password, name, email, address,org_id,theme,created,updated, last_seen_at,status) VALUES (:login, :password, :name ,:email, :address,0,0,now(),now(),now(),1);";
		
		
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":login", $param_user_name);
            $stmt->bindParam(":password", $param_password);
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":email", $param_email);
			$stmt->bindParam(":address", $param_address);
          
			
            // Set parameters
            $param_user_name = $_POST["user_name"];
            $param_password = $_POST["password"];
            $param_name = $_POST["name"];
            $param_email = $_POST["email"];
			$param_address = $_POST["address"];
			$param_role = $_POST["optradio"];
			
           // echo "***";
            // Attempt to execute the prepared statement
            if($stmt->execute()){
				//echo "execute";
                // Records created successfully. Redirect to landing page
                header("location: user_access.php");
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
  <h2>User Role Access</h2>
  
  
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
    <li class="breadcrumb-item"><a href="user_access.php">Users</a></li>
  </ol>
</nav>
  
  
  
  
  
  
  
  
  
  <form action="" method="post">

	<table class="table table-striped">
          <tbody>
             <tr>
			 <td width="50%">
	
	<div class="form-group" >
      <label for="plant_name">Username:</label>
      <input type="text" class="form-control" id="users_name" placeholder="Enter your name" name="user_name" required>
    </div>
	
	
	<div class="form-group" >
      <label for="ip">Email id:</label>
      <input type="email" class="form-control" id="emails" placeholder="Enter your email id" name="email" required >
    </div>
	<div class="form-group" >
      <label for="ip">Address:</label>
      <input type="text" class="form-control" id="addresss" placeholder="Enter your address" name="address" required>
    </div>
	
	<div class="form-group" >
	<h5><b>User access:</b></h5>
	
	<form>
    <label class="radio-inline">
      <input type="radio" name="optradio" value="Home Owner" id="radio1">Home Owner
    </label>
    <label class="radio-inline">
      <input type="radio" name="optradio" value="Installer" id="radio2">Installer
    </label>
    <label class="radio-inline">
      <input type="radio" name="optradio" value="Project Administrator" id="radio3">Project Administrator
    </label>
  </form>
	  </div>
    
	
	</td>
	
	<td>
	<div class="form-group">
      <label for="igate_id">Password:</label>
      <input type="password" class="form-control" id="passwords" placeholder="Enter your password" name="password" required>
    </div>
	
	<div class="form-group" >
      <label for="gateway_ip">Installer Name:</label>
      <input type="text" class="form-control" id="names" placeholder="Enter your installer name" name="name" required>
    </div>
	
	
	<!--
	<div class="form-group" >
	<br>
         <br>
	<label for="toogle">Users:</label>
	&nbsp;
	&nbsp;
	&nbsp;
	<label class="switch">
  <input type="checkbox" checked id="toogle">
  <span class="slider round"></span>
</label>
	</div>-->
	
	</td>
	
	
	
	
	
	</tr>
	</tbody>
	</table>
	
	
	
	

	
	


    <button type="submit" class="btn btn-default">Add User</button>
  </form>
  
  </br>
  
  
  <h2>Available Users</h2>  
  <input class="form-control" id="myInput" type="text" placeholder="Search..">
  <br>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
		<th>S.No</th>
		<th>Username</th>
		<th>Password</th>
		<th>Email Id</th>
		<th>Name</th>
		<th>Address</th>
		<th>Role</th>
		
		
		<th>Edit User</th>
		<th>Delete User</th>
		
      </tr>
    </thead>
    <tbody id="myTable">
      <?php foreach($data[0] as $key=>$value){ ?>
	  
	  <tr>
		
		<td><?php echo $value['sl_no'];?></td>
		<td><?php echo $value['login'];?></td>
		<td><?php echo $value['password'];?></td>
		<td><?php echo $value['email'];?></td>
		<td><?php echo $value['name'];?></td>
		<td><?php echo $value['address'];?></td>
		<td><?php echo $value['role'];?></td>
		
		
		<td><a href="edit_user.php?sl_no=<?php echo $value['sl_no'];?>">Edit</a></td>
		<td><a href="del_user.php?sl_no=<?php echo $value['sl_no'];?>">Delete</a></td>
		
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

