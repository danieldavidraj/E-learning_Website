<?php
	$name=$_GET["name"];
	$host = "localhost";
	$user = "Daniel Davidraj";
	$password = "password";
	$dbname = "daniel davidraj";
	$con = mysqli_connect($host, $user, $password,$dbname);
	// Check connection
	if (!$con) 
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	$sql = "UPDATE `accounts` SET `approved`='1' WHERE `Name`='$name'";
	if(!mysqli_query($con,$sql)) 
	{
		echo "Error updating record: " . mysqli_error($con);
	}
?>