<?php
	$serverName = "localhost";
	$userName = "root";
	$userPassword = "";
	$dbName = "mydatabase_pet_clinic";
		
	$conn = new mysqli($serverName, $userName, $userPassword, $dbName);
	mysqli_query($conn, "SET CHARACTER SET UTF8");
	
	if ($conn->connect_error){
		die("connection failed".$conn->connect_error);
	}
?>