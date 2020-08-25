<?php

    /*if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }else {
        move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);
        //echo $_FILES['file']['name'];
    }*/

//   $file_unique_separator = $org_sl_no."_".$user_sl_no;

   if(isset($_FILES['file'])){
      $errors= array();
      $file_name = $_FILES['file']['name'];
      $file_size =$_FILES['file']['size'];
      $file_tmp =$_FILES['file']['tmp_name'];
      $file_type=$_FILES['file']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
	  $meter_id = $_GET['meter'];
	  
      $file_path="uploads/".$meter_id."/";
	  
      //file extension based filtering
      $extensions= array("jpeg","jpg","png","docx","xlsx","xls","pdf");
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      //file size filtering
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      if (!file_exists($file_path)) {
    mkdir($file_path, 0777, true);
}
      //error checking
      if(empty($errors)==true){
         //move_uploaded_file($file_tmp,"uploads/".$file_unique_separator."_".$file_name);
         move_uploaded_file($file_tmp,$file_path.$file_name);
         echo "File Uploaded Successfully!!";
      }else{
         //print_r($errors);
		 echo "Incorrect format";
      }
   }
?>