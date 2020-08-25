<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php
$meter_id = $_GET['meter'];

 ?>

<script>

$(document).ready(function(){



$('#upload').on('click', function() {
    var file_data = $('#sortpicture').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    //alert(form_data);                             
    $.ajax({
        url: 'upload.php?meter=<?php echo $meter_id;?>', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(php_script_response){
            //alert(php_script_response); // display response from the PHP script, if any
			$('#err').html(php_script_response);
			
        }
     });
});

});

</script>


</head>
<body>
<h3> * Choose only docx, xlsx, xls, pdf, png, jpg, jpeg.</h3>
<input id="sortpicture" type="file" name="sortpic" />
<br>
<br>
<br>
<button id="upload">Upload</button>
<br>
<span id="err" style="color:red;"> <span>
</body>
</html>