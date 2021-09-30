 <?php
	$servername = "";
	$username = "";
	$password = "";
	$user = "" . strval($_COOKIE["ID"]);
	

	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	
	$query = "USE " . $user;
	if($conn->query($query) === TRUE){
		$query = "SELECT * FROM car1";
		$result = $conn->query($query);
		if ($result->num_rows > 0) {
		  while($row = $result->fetch_assoc()) {
			echo "<div class=\"record\"><div class=\"rtit\"><div class=\"tremove\"><a href='https://sirrico.net/car/remove.php?del=".$row["ID"]."'>DEL</a></div><p><b>".$row["ID"].": </b>".$row["service_name"]."</p><hr></div><p>Date: ".$row["service_date"]." / Miles: ".$row["service_miles"]."</p><p>Description: ".$row["description"]."</p><p>Service again at ".$row["notify_miles"]." or on ".$row["notify_date"]."</p></div>";
		  }
		} else {
		  echo "No service records.  Please add a service through the form above.";
		}
	}
	else{
		echo "fail use db";
	}
			
			
	$conn -> close();
	
?> 