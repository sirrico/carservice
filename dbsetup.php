<?php
	$servername = "";
	$username = "";
	$password = "";
	$user = "" . $db->lastInsertId();
	

	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	
	$query = "CREATE DATABASE IF NOT EXISTS " . $user;

	if($conn->query($query) === TRUE)
		echo "success create db";
	else
		echo "fail create db";
	
	$query = "USE " . $user;
	if($conn->query($query) === TRUE)
		echo "success use db";
	else
		echo "fail use db";
	
	$query = "CREATE TABLE IF NOT EXISTS car1 (ID int NOT NULL AUTO_INCREMENT, service_name varchar(255) NOT NULL, service_date date, service_miles decimal(10,2), description varchar(1000), notify_miles decimal(10,2), notify_date date, notify INT NOT NULL, PRIMARY KEY (ID))";
	mysqli_query($conn, $query);

	$conn -> close();
	
?> 