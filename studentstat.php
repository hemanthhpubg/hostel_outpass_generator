<!DOCTYPE html>
<html>
<head>
	<title>Username and Password Form</title>
	<style>
		table {
		
		background-color: lightgrey;
  		border: 1px solid black;
  		border-spacing: 10px;
      width:700px;
      
		}

		th, td {
		  padding: 10px;
		  
		}
		input{
			width: 500px;
        	height: 50px;
		}
		button{
			width: 500px;
      height: 50px;
			background-color: brown;
			color: white;
		}
    table, th, td {
    border-collapse: collapse;
    border: 1px solid black;
    
}
	  </style></head>
<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "example";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT Id,fromd,tod,days,status,response FROM outpass";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  echo"<center>";
  echo"<h1>STUDENT OUTPASS STATUS</h1>";
  echo "<table>";
  echo "<tr><th>ID</th><th>fromdate</th><th>todate</th><th>days</th><th>Status</th><th>Response</th></tr>";
  
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row["Id"] . "</td>";
    echo "<td>" . $row["fromd"] . "</td>";
    echo "<td>" . $row["tod"] . "</td>";
    echo "<td>" . $row["days"] . "</td>";
    echo "<td>" . $row["status"] . "</td>";
    
    if ($row["status"] == "Pending") {
      echo "<td>wait for response</td>";
    } 
    else if ($row["status"] == "accept") {
      echo "<td>Accepted</td>";
    } 
    else {
      echo "<td>" . $row["response"] . "</td>";
    }
  
    echo "</tr>";
}
  echo "</table>";
  echo "</center>";
} else {
  echo "No data found";
}

mysqli_close($conn);
?>
<br>
<center><a href="show.html">Back</a></center?
