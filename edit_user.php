<?php


    // Include config file
    require_once "config.php";
	
	
	
    
    // Prepare a select statement
    $sql = "SELECT * FROM user where sl_no=".$_GET['sl_no'];
    
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
				$igate_id = $row[0]['igate_id'];
				
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
        $sql = "UPDATE user SET login=:login, password=:password, name=:name ,address=:address , email=:email WHERE sl_no=:sl_no";
		
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":login", $param_user_name);
            $stmt->bindParam(":password", $param_password);
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":email", $param_email);
			$stmt->bindParam(":address", $param_address);
			$stmt->bindParam(":sl_no", $param_sl_no);
			
			
            // Set parameters
            $param_user_name = $_POST["user_name"];
            $param_password = $_POST["password"];
            $param_name = $_POST["name"];
            $param_email = $_POST["email"];
			$param_address = $_POST["address"];
			$param_sl_no = $_GET["sl_no"];
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
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
</head>
<body>

<div class="container">
  <h2>Edit user</h2>
  
  <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="user_access.php">Users</a></li>
	<li class="breadcrumb-item">Edit User</li>
	<li class="breadcrumb-item"><?php echo $igate_id; ?></li>
	
  </ol>
</nav>
  
  
  
  
  
  
  <?php foreach($data[0] as $key=>$value){ ?>
  
  
  <form action="" method="post">

	<table class="table table-striped">
          <tbody>
             <tr>
			 <td width="50%">
	
	<div class="form-group" >
      <label for="plant_name">Username:</label>
      <input type="text" class="form-control" id="users_name" placeholder="Enter your name" name="user_name" value="<?php echo $value['login']; ?>">
    </div>
	
	
	<div class="form-group" >
      <label for="ip">Email id:</label>
      <input type="email" class="form-control" id="emails" placeholder="Enter your email id" name="email" value="<?php echo $value['email']; ?>">
    </div>
	<div class="form-group" >
      <label for="ip">Address:</label>
      <input type="text" class="form-control" id="addresss" placeholder="Enter your address" name="address" value="<?php echo $value['address']; ?>">
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
      <input type="password" class="form-control" id="passwords" placeholder="Enter your password" name="password" value="<?php echo $value['password']; ?>">
    </div>
	
	<div class="form-group" >
      <label for="gateway_ip">Name:</label>
      <input type="text" class="form-control" id="names"  name="name"  value="<?php echo $value['name']; ?>">
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
	
  <button type="submit" class="btn btn-default">Edit user</button>
  </form>
  
  
  <?php } ?>
  </br>
  
  
</div>
</body>
</html>

