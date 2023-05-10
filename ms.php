<!DOCTYPE html>
<html>
<head>
	<title>Username and Password Form</title>
	<style>
    p{
        margin-top: 100px;
        font-size:30px;
    }
	  </style></head>
<?php
session_start();
$reg = $_SESSION['username'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "example";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$fromd = $_POST["fromd"];
$tod = $_POST["tod"];
$days = $_POST["days"];
$des=$_POST["dest"];
$reason = $_POST["reason"];

// Check if the values of fromd and tod already exist in the database
$sql = "SELECT * FROM outpass WHERE reg='$reg' AND fromd='$fromd' AND tod='$tod'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo"<center>";
    echo "<p>You have already requested for outpass so please wait!!</p>";
    echo"</center>";
} else {
    // Insert data into database
    $sql = "INSERT INTO outpass (reg,fromd,tod,days,dest,reason) VALUES ('$reg','$fromd', '$tod','$days','$des','$reason')";

    if ($conn->query($sql) === TRUE) {
        echo"<center>";
        echo "<p>Your Details have been successfully recorded</p>";
        echo"</center>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
echo"<br>";
$conn->close();


?>
<center><a href="show.html">Back</a></center>