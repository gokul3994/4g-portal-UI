<!DOCTYPE html>
<html>
<style>
body {
  font-family: Arial;
  background-color:#995c00;
}
.row1 {
  width: 25%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 30%;
  background-color: #f0132d;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  display: inline;
}

input[type=submit]:hover {
  background-color: #d44657;
}

div.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  width: 85%;
  margin-left:5%;
}
form{
	margin-left:5%;
}
</style>

<body>

<h1 align="center" style="color:#66d9ff;"> Meter Information Delete</h1>

<div class="container">
<a href="meter_upload.php">Back</a>
<a href="tables_dynamic.php" style="margin-left:85%;display:inline;">Back to dashboard</a>
<br>
<br>
<br>
  <form action="/usaportal/production/action_delete.php" method="get" autocomplete="off">
    <label for="fname" >Meter No.</label>
    <input type="text" id="fname" name="meterid"  class="row1" placeholder="Enter meter number to delete..">
	&nbsp;
	&nbsp;&nbsp;
	
	<input type="submit" value="Delete">
    
	<br>
	<br>
	<br>
    
  </form>
</div>

</body>
</html>
