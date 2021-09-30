<?php
	$servername = "";
	$username = "";
	$password = "";
	$user = "" . strval($_COOKIE["ID"]);
	$del = $_GET["del"];
	
	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	
	
	$query = "USE " . $user;
	if($conn->query($query) === TRUE){
		$query = "DELETE FROM car1 WHERE ID=".strval($del);
		mysqli_query($conn, $query);
	}
	else{
		echo "fail delete";
	}
	
	

	$conn -> close();
	
	header('Location: index.php');
	exit();
?>