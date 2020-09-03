<?php
// Process delete operation after confirmation
if(isset($_GET["sl_no"]) && !empty($_GET["sl_no"])){
    // Include config file
    require_once "config.php";
    
    // Prepare a delete statement
    $sql = "DELETE FROM user WHERE sl_no = :sl_no";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":sl_no", $sl_no);
        
        // Set parameters
        $sl_no = trim($_GET["sl_no"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Records deleted successfully. Redirect to landing page
            header("location: user_access.php");
			echo "deleted";
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);
    
    // Close connection
    unset($pdo);
}
?>