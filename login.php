<?php


    // Include config file
    require_once "config.php";
    session_start();
    

   if($_SESSION["session_liveness"] == 1){
    header("Location: tables_dynamic.php");
   }



    function getRolesOfUser($pdo,$userSlNo){

      // Prepare a select statement
    $rolesOfUserSql = "SELECT * FROM org_user where `user_sl_no`='".$userSlNo."'";

    if($stmt = $pdo->prepare($rolesOfUserSql)){
 
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() > 0){


                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                while($row = $stmt->fetchAll(PDO::FETCH_ASSOC)){
                $roleOfUser = getRoles($pdo,$row[0]['role_sl_no']);
                //print_r($roles);
                //$roleOfUser = $row;
        
                }
                return $roleOfUser;
        
                
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                //header("location: error.php");
                //exit();
              
            }
            
        } else{
            
        }
    }


    }






function getMetersOfInstaller($pdo,$orgSlNo){

      // Prepare a select statement
    $meterOfInstallerSql = "SELECT * FROM meter where `org_sl_no`='".$orgSlNo."'";

    if($stmt = $pdo->prepare($meterOfInstallerSql)){
 
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() > 0){


                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                while($row = $stmt->fetchAll(PDO::FETCH_ASSOC)){
                //$roleOfUser = getRoles($pdo,$row[0]['role_sl_no']);
                //print_r($roles);
                $meters[] = $row;
        
                }
                return $meters;
        
                
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                //header("location: error.php");
                //exit();
              
            }
            
        } else{
            
        }
    }


    }




    function getRoles($pdo,$roleSlNo){

      // Prepare a select statement
     $sql = "SELECT * FROM roles where `role_id`='".$roleSlNo."'";

    //echo $sql;exit;
    
    if($stmt = $pdo->prepare($sql)){
        
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() > 0){


                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                while($row = $stmt->fetchAll(PDO::FETCH_ASSOC)){
               // $_SESSION['user_sl_no'] = $row[0]['sl_no'];
                $roleNameOfSlNo = $row;

        
                }
        return $roleNameOfSlNo;
                
        
                
            } else{
              // URL doesn't contain valid id parameter. Redirect to error page
              //header("location: error.php");
              //exit();
              //$login_err = "Username OR Password doesnt Match!!";
            }
            
        } else{
              //echo "Oops! Something went wrong. Please try again later.";
        }
    }


  }



  
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    if(empty($username)){
        $login_err = "Please enter username.";
    }elseif(empty($password)){
        $login_err = "Please enter password.";
    }else{

    }





    // Prepare a select statement
    $sql = "SELECT * FROM user where `login`='".$username."' AND `password`='".$password."' LIMIT 0,1";

    //echo $sql;exit;

    
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
               $_SESSION['user_sl_no'] = $row[0]['sl_no'];
               $_SESSION['org_sl_no'] = $row[0]['org_id'];
               $_SESSION['session_liveness'] = 1;
               
               $userSlNo = $row[0]['sl_no'];
               //print_r($row);
               
        $roleOfUser = getRolesOfUser($pdo,$userSlNo);
        $data = $row;
        $data[0]['role'] = $roleOfUser[0]['role_name'];

        if($data[0]['role'] == "Installer"){
          header("location: tables_dynamic.php");
          getMetersOfInstaller($pdo,$row[0]['org_id']);


        }else{
          //header("location: project_detail_2.php?meter=10439395");
        }
        //print_r($row);exit;
        //Array ( [0] => Array ( [sl_no] => 1 [login] => test@iplon.in [email] => test@iplon.in [name] => Tester [password] => test123 [org_id] => 1 [theme] => gentelella [created] => 2020-07-13 00:00:00 [updated] => 2020-07-13 00:00:00 [last_seen_at] => 2020-07-13 00:00:00 [status] => 1 ) )
       // 
        
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
              $login_err = "Username OR Password doesnt Match!!";
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
  // Close statement
  unset($stmt);

  }
  
     
    
    
    
  
  
  
  
  
  
  

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login | Solar-log</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>


<script type="text/javascript">
  //{"message":"Invalid username or password"}


/*$(document).ready(function(){


$( "#login" ).click(function() {
  alert("tet");
  var formData = {username:$("#username").val(),password:$("#password").val()}; //Array 
$.ajax( {
                  url:'http://pv-india.eu:3455/login',
                  type: "POST",
                  data : formData,
                  success:function(realdata) {
                    alert(realdata);
                  
                  }
               });
});

  
});*/



  

</script>

  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="POST">
              <h1>Login Form</h1>
              <p><?php echo $login_err; ?></p>
              <div>
                <input type="text" class="form-control" placeholder="Username" id="username" name="username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" id="password" name="password" required="" />
              </div>
              <div>
                <input type="submit" id="login" value="Log in" class="btn btn-default">
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1> </h1>
                  <p></p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="#">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1></h1>
                  <p></p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
