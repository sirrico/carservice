 <?php
	$servername = "";
	$username = "";
	$password = "";
	$user = "" . strval($_COOKIE["ID"]);
	$new_service_name = addslashes($_GET["element_1"]);
	$new_service_date = $_GET["element_3"];
	$new_service_miles = $_GET["element_2"];
	$new_description = addslashes($_GET["element_4"]);
	$new_notify_miles = $_GET["element_5"];
	$new_notify_date = $_GET["element_6"];
	//$new_notify2 = $_GET["element_7_1"];
	if($_GET["element_7_1"] == "email"){
		$new_notify = 1;
	}
	else{
		$new_notify = 0;
	}

	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	
	
	$query = "USE " . $user;
	if($conn->query($query) === TRUE){
		$query = "INSERT INTO car1 (service_name, service_date, service_miles, description, notify_miles, notify_date, notify) VALUES (" . "\"" . $new_service_name . "\", '" . $new_service_date . "', " . $new_service_miles . ", \"" . $new_description . "\", " . $new_notify_miles . ", '" . $new_notify_date . "', " . $new_notify . ")";
		mysqli_query($conn, $query);
	}
	else{
		echo "fail use db";
	}
	
	

	$conn -> close();
	
	header('Location: index.php');
	exit();
	
?> 